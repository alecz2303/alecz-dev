<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Throwable;

class PortfolioChatService
{
    public function reply(string $message): array
    {
        $local = $this->localReply($message);

        if (! $this->remoteEnabled()) {
            return $local;
        }

        try {
            $remote = $this->remoteReply($message);

            if ($remote && $this->isSafeRemoteReply($remote)) {
                return [
                    'message' => $remote,
                    'projects' => $local['projects'],
                    'show_contact' => $local['show_contact'],
                    'lead_intent' => $local['lead_intent'],
                    'source' => 'remote',
                ];
            }
        } catch (Throwable) {
            // Privacy-first graceful degradation: never expose provider errors to visitors.
        }

        return $local;
    }

    public function publicContext(): array
    {
        $config = app()->getLocale() === 'en' ? 'portfolio_en' : 'portfolio';
        $routeName = app()->getLocale() === 'en' ? 'en.projects.show' : 'projects.show';

        return collect(config("{$config}.projects", []))
            ->map(fn (array $project) => [
                'name' => $project['name'],
                'slug' => $project['slug'],
                'type' => $project['type'],
                'summary' => $project['summary'],
                'stack' => $project['stack'],
                'signal' => $project['signal'],
                'capabilities' => $project['capabilities'] ?? [],
                'url' => route($routeName, $project['slug']),
            ])
            ->values()
            ->all();
    }

    private function localReply(string $message): array
    {
        $normalized = $this->normalize($message);
        $leadIntent = $this->hasLeadIntent($normalized);

        if ($this->containsAny($normalized, ['contacto','contactar','whatsapp','correo','email','contact','reach','message'])) {
            return $this->response(__('ui.chat.server.contact'), [], true, $leadIntent);
        }

        if ($this->containsAny($normalized, ['que haces','que puede','servicio','servicios','desarrollas','construyes','puedes hacer','what do you do','what can you build','services','build','develop'])) {
            return $this->response(__('ui.chat.server.services'), [], false, false);
        }

        $matches = $this->scoreProjects($normalized);

        if ($matches->isNotEmpty()) {
            $names = $matches->take(3)->pluck('name')->join(', ');

            return $this->response(
                __('ui.chat.server.matches', ['projects' => $names]),
                $matches->take(3)->map(fn (array $project) => ['name' => $project['name'], 'url' => $project['url']])->values()->all(),
                false,
                $leadIntent
            );
        }

        return $this->response(__('ui.chat.server.fallback'), [], false, $leadIntent);
    }

    private function response(string $message, array $projects, bool $showContact, bool $leadIntent): array
    {
        return [
            'message' => $message,
            'projects' => $projects,
            'show_contact' => $showContact,
            'lead_intent' => $leadIntent,
            'source' => 'local',
        ];
    }

    private function hasLeadIntent(string $normalized): bool
    {
        $commercial = [
            'cotizar','cotizacion','presupuesto','proyecto','necesito','quiero desarrollar','quiero crear','quiero una app','quiero un sistema','busco una app','busco un sistema','cuanto cuesta','precio','contratar','solucion para',
            'quote','estimate','budget','project','i need','i want to build','i want to create','need an app','need a system','how much','price','hire','solution for',
        ];

        $problemSignals = ['app','sistema','system','plataforma','platform','software','automatizar','automate','automation','integracion','integration','api','clinica','clinical','school','escuela','academia','citas','appointments','pagos','payments','biometria','biometrics','whatsapp'];

        return $this->containsAny($normalized, $commercial)
            || ($this->containsAny($normalized, ['necesito','quiero','busco','i need','i want','looking for'])
                && $this->containsAny($normalized, $problemSignals));
    }

    private function scoreProjects(string $normalized)
    {
        $intentKeywords = [
            'mobile' => ['app','apps','movil','mobile','android','flutter','celular','phone','baseball','beisbol'],
            'biometrics' => ['biometria','biometrico','biometrics','fingerprint','huella','identidad','identity','attendance','asistencia','reader','lector','digital persona'],
            'clinical' => ['clinica','clinico','clinical','therapy','terapia','therapist','terapeuta','patient','paciente','appointment','appointments','cita','citas','agenda','schedule'],
            'academic' => ['academia','academico','academic','school','escuela','student','students','alumno','alumnos','tuition','mensualidad','chamilo','lms'],
            'payments' => ['pago','pagos','payment','payments','billing','cobro','cobros','mensualidad','receipt','recibo','subscription','suscripcion'],
            'integrations' => ['api','integracion','integraciones','integration','integrations','whatsapp','google drive','drive','sync','sincronizacion','hardware','lms'],
            'saas' => ['saas','sistema','system','plataforma','platform','web','laravel','multi tenant','multitenant'],
            'automation' => ['automatizar','automatizacion','automation','automate','notification','notificacion','reminder','recordatorio','process','proceso','procesos'],
        ];

        $projectHints = [
            'mobile' => ['citas-crit','baseball-app'],
            'biometrics' => ['digital-persona-schoolbio'],
            'clinical' => ['urpe-gestion-clinica','citas-crit'],
            'academic' => ['acadcontrol','digital-persona-schoolbio'],
            'payments' => ['acadcontrol','doctotal'],
            'integrations' => ['digital-persona-schoolbio','acadcontrol','baseball-app'],
            'saas' => ['doctotal','urpe-gestion-clinica','acadcontrol'],
            'automation' => ['acadcontrol','doctotal'],
        ];

        $boosted = collect();
        foreach ($intentKeywords as $intent => $keywords) {
            if ($this->containsAny($normalized, $keywords)) {
                $boosted = $boosted->merge($projectHints[$intent] ?? []);
            }
        }

        $words = collect(explode(' ', $normalized))->filter(fn (string $word) => mb_strlen($word) > 2);

        return collect($this->publicContext())
            ->map(function (array $project) use ($normalized, $words, $boosted) {
                $haystack = $this->normalize(implode(' ', [$project['name'],$project['type'],$project['summary'],$project['signal'],implode(' ', $project['stack']),implode(' ', $project['capabilities'])]));
                $score = $boosted->contains($project['slug']) ? 4 : 0;
                foreach ($words as $word) {
                    if (Str::contains($haystack, $word)) $score++;
                }
                if (Str::contains($normalized, $this->normalize($project['name']))) $score += 8;

                return [...$project, 'score' => $score];
            })
            ->filter(fn (array $project) => $project['score'] > 0)
            ->sortByDesc('score')
            ->values();
    }

    private function remoteReply(string $message): ?string
    {
        $context = collect($this->publicContext())->map(fn (array $project) => Arr::only($project, ['name','type','summary','stack','signal','capabilities','url']))->values()->all();
        $english = app()->getLocale() === 'en';

        $system = $english
            ? 'You are the commercial assistant for Alecz portfolio. Reply in English, briefly and usefully. '
            : 'Eres el asistente comercial del portafolio de Alecz. Responde en español, breve y útil. ';

        $system .= 'Only state information present in the provided public context. Do not invent prices, clients, metrics, dates or capabilities. '
            .'Never mention or request repositories, source code, secrets, Jira, internal GitHub or credentials. '
            .'When useful, connect the visitor need with one or more real projects. If they want to hire or request a quote, invite them to complete the short qualification flow; do not ask for sensitive data. '
            .'Direct channels available: WhatsApp '.(config('profile.contact.whatsapp') ? 'yes' : 'no').', email '.(config('profile.contact.email') ? 'yes' : 'no').'. '
            .'Public context: '.json_encode($context, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $response = Http::acceptJson()->withToken(config('chatbot.remote.key'))->timeout(config('chatbot.remote.timeout', 8))->post(config('chatbot.remote.url'), [
            'model' => config('chatbot.remote.model'),
            'messages' => [['role'=>'system','content'=>$system],['role'=>'user','content'=>$message]],
            'temperature' => 0.3,
        ])->throw();

        $content = trim((string) data_get($response->json(), 'choices.0.message.content'));

        return $content !== '' ? $content : null;
    }

    private function isSafeRemoteReply(string $reply): bool
    {
        return ! Str::contains(Str::lower($reply), ['github.com/','gitlab.com/','bitbucket.org/','raw.githubusercontent.com/']);
    }

    private function remoteEnabled(): bool
    {
        return config('chatbot.provider') === 'remote'
            && filled(config('chatbot.remote.url'))
            && filled(config('chatbot.remote.key'))
            && filled(config('chatbot.remote.model'));
    }

    private function normalize(string $value): string
    {
        $value = Str::ascii(Str::lower($value));
        $value = preg_replace('/[^a-z0-9\s+#.]/', ' ', $value) ?? '';
        $value = preg_replace('/\s+/', ' ', $value) ?? '';

        return trim($value);
    }

    private function containsAny(string $haystack, array $needles): bool
    {
        return collect($needles)->contains(fn (string $needle) => Str::contains($haystack, $this->normalize($needle)));
    }
}
