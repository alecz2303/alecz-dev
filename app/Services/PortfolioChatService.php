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
        return collect(config('portfolio.projects', []))
            ->map(fn (array $project) => [
                'name' => $project['name'],
                'slug' => $project['slug'],
                'type' => $project['type'],
                'summary' => $project['summary'],
                'stack' => $project['stack'],
                'signal' => $project['signal'],
                'capabilities' => $project['capabilities'] ?? [],
                'url' => route('projects.show', $project['slug']),
            ])
            ->values()
            ->all();
    }

    private function localReply(string $message): array
    {
        $normalized = $this->normalize($message);
        $leadIntent = $this->hasLeadIntent($normalized);

        $contactWords = ['contacto', 'contactar', 'whatsapp', 'correo', 'email'];
        if ($this->containsAny($normalized, $contactWords)) {
            return [
                'message' => 'Sí. Si Alecz tiene canales directos habilitados, te los muestro aquí. Si quieres cotizar un proyecto, también puedo hacerte unas preguntas breves y preparar el contexto para la conversación.',
                'projects' => [],
                'show_contact' => true,
                'lead_intent' => $leadIntent,
                'source' => 'local',
            ];
        }

        $servicePhrases = ['que haces', 'que puede', 'servicio', 'servicios', 'desarrollas', 'construyes', 'puedes hacer'];
        if ($this->containsAny($normalized, $servicePhrases)) {
            return [
                'message' => 'Alecz construye productos web y móviles, sistemas de gestión, automatizaciones e integraciones entre APIs, servicios externos, datos y hardware. Si me cuentas el problema, puedo relacionarlo con experiencia real del portafolio.',
                'projects' => [],
                'show_contact' => false,
                'lead_intent' => false,
                'source' => 'local',
            ];
        }

        $matches = $this->scoreProjects($normalized);

        if ($matches->isNotEmpty()) {
            $names = $matches->take(3)->pluck('name')->join(', ');

            return [
                'message' => "Por lo que describes, revisaría {$names}. Son proyectos reales que cubren partes parecidas del problema. Puedes abrir sus case studies para ver contexto, solución y arquitectura sin exponer código fuente.",
                'projects' => $matches->take(3)->map(fn (array $project) => [
                    'name' => $project['name'],
                    'url' => $project['url'],
                ])->values()->all(),
                'show_contact' => false,
                'lead_intent' => $leadIntent,
                'source' => 'local',
            ];
        }

        return [
            'message' => 'No encontré una coincidencia clara todavía. Cuéntame qué proceso quieres mejorar, quién lo usaría y si imaginas una app, plataforma web, integración o automatización. Con eso puedo orientarte mejor.',
            'projects' => [],
            'show_contact' => false,
            'lead_intent' => $leadIntent,
            'source' => 'local',
        ];
    }

    private function hasLeadIntent(string $normalized): bool
    {
        $commercial = [
            'cotizar', 'cotizacion', 'presupuesto', 'proyecto', 'necesito', 'quiero desarrollar',
            'quiero crear', 'quiero una app', 'quiero un sistema', 'busco una app', 'busco un sistema',
            'cuanto cuesta', 'precio', 'contratar', 'desarrollo para', 'solucion para',
        ];

        $problemSignals = [
            'app', 'sistema', 'plataforma', 'software', 'automatizar', 'integracion', 'api',
            'clinica', 'escuela', 'academia', 'citas', 'pagos', 'biometria', 'whatsapp',
        ];

        return $this->containsAny($normalized, $commercial)
            || ($this->containsAny($normalized, ['necesito', 'quiero', 'busco'])
                && $this->containsAny($normalized, $problemSignals));
    }

    private function scoreProjects(string $normalized)
    {
        $intentKeywords = [
            'mobile' => ['app', 'apps', 'movil', 'android', 'flutter', 'celular', 'baseball', 'beisbol'],
            'biometrics' => ['biometria', 'biometrico', 'huella', 'identidad', 'asistencia', 'lector', 'digital persona'],
            'clinical' => ['clinica', 'clinico', 'terapia', 'terapeuta', 'paciente', 'cita', 'citas', 'agenda'],
            'academic' => ['academia', 'academico', 'escuela', 'alumno', 'alumnos', 'mensualidad', 'mensualidades', 'chamilo', 'lms'],
            'payments' => ['pago', 'pagos', 'cobro', 'cobros', 'mensualidad', 'recibo', 'suscripcion'],
            'integrations' => ['api', 'integracion', 'integraciones', 'whatsapp', 'google drive', 'drive', 'sincronizacion', 'hardware', 'lms'],
            'saas' => ['saas', 'sistema', 'plataforma', 'web', 'laravel', 'multi tenant', 'multitenant'],
            'automation' => ['automatizar', 'automatizacion', 'notificacion', 'recordatorio', 'proceso', 'procesos'],
        ];

        $projectHints = [
            'mobile' => ['citas-crit', 'baseball-app'],
            'biometrics' => ['digital-persona-schoolbio'],
            'clinical' => ['urpe-gestion-clinica', 'citas-crit'],
            'academic' => ['acadcontrol', 'digital-persona-schoolbio'],
            'payments' => ['acadcontrol', 'doctotal'],
            'integrations' => ['digital-persona-schoolbio', 'acadcontrol', 'baseball-app'],
            'saas' => ['doctotal', 'urpe-gestion-clinica', 'acadcontrol'],
            'automation' => ['acadcontrol', 'doctotal'],
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
                $haystack = $this->normalize(implode(' ', [
                    $project['name'],
                    $project['type'],
                    $project['summary'],
                    $project['signal'],
                    implode(' ', $project['stack']),
                    implode(' ', $project['capabilities']),
                ]));

                $score = $boosted->contains($project['slug']) ? 4 : 0;
                foreach ($words as $word) {
                    if (Str::contains($haystack, $word)) {
                        $score++;
                    }
                }

                if (Str::contains($normalized, $this->normalize($project['name']))) {
                    $score += 8;
                }

                return [...$project, 'score' => $score];
            })
            ->filter(fn (array $project) => $project['score'] > 0)
            ->sortByDesc('score')
            ->values();
    }

    private function remoteReply(string $message): ?string
    {
        $context = collect($this->publicContext())->map(fn (array $project) => Arr::only($project, [
            'name', 'type', 'summary', 'stack', 'signal', 'capabilities', 'url',
        ]))->values()->all();

        $system = 'Eres el asistente comercial del portafolio de Alecz. Responde en español, breve y útil. '
            .'Solo puedes afirmar información presente en el contexto público proporcionado. '
            .'No inventes precios, clientes, métricas, fechas ni capacidades. '
            .'Nunca menciones ni solicites repositorios, código fuente, secretos, Jira, GitHub interno o credenciales. '
            .'Cuando sea útil, relaciona la necesidad con uno o más proyectos reales. '
            .'Si el visitante expresa intención de contratar o cotizar, invítalo a completar la calificación breve del sitio; no pidas datos sensibles. '
            .'Canales directos disponibles: WhatsApp '.(config('profile.contact.whatsapp') ? 'sí' : 'no')
            .', correo '.(config('profile.contact.email') ? 'sí' : 'no').'. '
            .'Contexto público: '.json_encode($context, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $response = Http::acceptJson()
            ->withToken(config('chatbot.remote.key'))
            ->timeout(config('chatbot.remote.timeout', 8))
            ->post(config('chatbot.remote.url'), [
                'model' => config('chatbot.remote.model'),
                'messages' => [
                    ['role' => 'system', 'content' => $system],
                    ['role' => 'user', 'content' => $message],
                ],
                'temperature' => 0.3,
            ])
            ->throw();

        $content = trim((string) data_get($response->json(), 'choices.0.message.content'));

        return $content !== '' ? $content : null;
    }

    private function isSafeRemoteReply(string $reply): bool
    {
        $normalized = Str::lower($reply);

        return ! Str::contains($normalized, [
            'github.com/',
            'gitlab.com/',
            'bitbucket.org/',
            'raw.githubusercontent.com/',
        ]);
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
