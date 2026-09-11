@extends('layouts.app')

@section('title', $project['name'].' · Case Study · Alecz')
@section('meta_description', $project['summary'])
@section('og_title', $project['name'].' · Case Study · Alecz')
@section('og_description', $project['summary'])

@section('content')
@php($configuredMedia = config('project_media.'.$project['slug'].'.'.app()->getLocale()))
@php($media = collect($configuredMedia ?? ($project['media'] ?? [])))
@php($heroMedia = $media->firstWhere('role', 'hero') ?? $media->first())
@php($galleryMedia = $media->reject(fn ($item) => $heroMedia && ($item['src'] ?? null) === ($heroMedia['src'] ?? null))->values())
@php($visualAudit = config('project_visuals.'.$project['slug']))
@php($preview = ($visualAudit['classification'] ?? null) === 'CODE-DERIVED PREVIEW' ? ($visualAudit[app()->getLocale()] ?? null) : null)
@php($case = __('ui.case'))
@php($projectRoute = app()->getLocale() === 'en' ? 'en.projects.show' : 'projects.show')
@php($homeRoute = app()->getLocale() === 'en' ? 'en.home' : 'home')
@php($isEnglish = app()->getLocale() === 'en')

<article class="case-study">
    <header class="case-hero" data-reveal>
        <a class="case-back" href="{{ route($homeRoute) }}#proyectos">{{ $case['back'] }}</a>
        <div class="case-meta"><span>{{ $project['type'] }}</span><span>{{ $project['status'] }}</span></div>
        <h1>{{ $project['name'] }}</h1><p class="case-lead">{{ $project['summary'] }}</p><div class="case-signal">{{ $project['signal'] }}</div>
    </header>

    <section class="case-showcase" aria-labelledby="showcase-title" data-reveal>
        <div class="case-showcase-shell">
            @if ($heroMedia)
                <figure class="case-visual is-media"><img src="{{ asset($heroMedia['src']) }}" alt="{{ $heroMedia['alt'] ?? $project['name'] }}">@if (!empty($heroMedia['caption']))<figcaption>{{ $heroMedia['caption'] }}</figcaption>@endif</figure>
            @elseif ($preview)
                <figure class="case-visual is-code-preview preview-{{ $visualAudit['theme'] ?? 'default' }}" aria-labelledby="showcase-title">
                    <div class="code-preview-bar"><span>{{ $preview['label'] }}</span><strong>CODE-DERIVED PREVIEW</strong></div>
                    <div class="code-preview-window"><div class="code-preview-sidebar"><span class="preview-mark">{{ mb_substr($project['name'], 0, 1) }}</span>@foreach(array_slice($preview['items'],0,4) as $item)<i></i>@endforeach</div><div class="code-preview-main"><p class="code-preview-eyebrow">{{ $project['type'] }}</p><h2 id="showcase-title">{{ $preview['title'] }}</h2><p>{{ $preview['subtitle'] }}</p><div class="code-preview-grid">@foreach($preview['items'] as $item)<div><span>{{ str_pad((string)$loop->iteration,2,'0',STR_PAD_LEFT) }}</span><strong>{{ $item }}</strong><i></i><i></i></div>@endforeach</div></div></div>
                    <figcaption>{{ $isEnglish ? 'Editorial representation derived from verified product code; it is not a runtime screenshot.' : 'Representación editorial derivada de código verificado del producto; no es una captura de la aplicación en ejecución.' }}</figcaption>
                </figure>
            @else
                <div class="case-visual" role="img" aria-label="{{ __('ui.case.visual_label', ['project'=>$project['name']]) }}"><div class="case-visual-fallback"><div class="case-visual-kicker"><span id="showcase-title">{{ $case['snapshot'] }}</span><span>{{ $project['status'] }}</span></div><div><h2 class="case-visual-name">{{ $project['name'] }}</h2><p class="case-visual-signal">{{ $project['signal'] }}</p><ul class="case-visual-stack" aria-label="Stack · {{ $project['name'] }}">@foreach (array_slice($project['stack'], 0, 6) as $technology)<li>{{ $technology }}</li>@endforeach</ul></div></div></div>
            @endif
            <aside class="case-proof" aria-label="{{ $case['proof_label'] }}"><div><p class="case-proof-label">{{ $case['proof'] }}</p><ul class="case-proof-list">@foreach (array_slice($project['capabilities'], 0, 5) as $capability)<li>{{ $capability }}</li>@endforeach</ul></div><p class="case-proof-note">{{ $case['proof_note'] }}</p></aside>
        </div>
        @if ($galleryMedia->isNotEmpty())<div class="case-media-gallery" aria-label="{{ __('ui.case.gallery', ['project'=>$project['name']]) }}">@foreach ($galleryMedia as $item)<figure class="case-media-item"><img src="{{ asset($item['src']) }}" alt="{{ $item['alt'] ?? $project['name'] }}" loading="lazy">@if (!empty($item['caption']))<figcaption>{{ $item['caption'] }}</figcaption>@endif</figure>@endforeach</div>@endif
    </section>

    <section class="case-section case-context" aria-labelledby="context-title" data-reveal><div><p class="section-path">~/context</p><h2 id="context-title">{{ $case['context'] }}</h2></div><p>{{ $project['context'] }}</p></section>
    <section class="case-section case-two-column" aria-label="{{ $case['problem_solution'] }}" data-reveal><div><p class="section-path">~/problem</p><h2>{{ $case['problem'] }}</h2><p>{{ $project['problem'] }}</p></div><div><p class="section-path">~/solution</p><h2>{{ $case['solution'] }}</h2><p>{{ $project['solution'] }}</p></div></section>
    <section class="case-section" aria-labelledby="capabilities-title" data-reveal><div class="case-heading"><div><p class="section-path">~/capabilities</p><h2 id="capabilities-title">{{ $case['capabilities'] }}</h2></div><p>{{ $case['capabilities_intro'] }}</p></div><ol class="case-capabilities">@foreach ($project['capabilities'] as $capability)<li><span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><strong>{{ $capability }}</strong></li>@endforeach</ol></section>
    <section class="case-section case-two-column" aria-labelledby="architecture-title" data-reveal><div><p class="section-path">~/architecture</p><h2 id="architecture-title">{{ $case['architecture'] }}</h2><p>{{ $case['architecture_intro'] }}</p></div><ul class="case-architecture">@foreach ($project['architecture'] as $item)<li>{{ $item }}</li>@endforeach</ul></section>
    <section class="case-section" aria-labelledby="stack-case-title" data-reveal><div class="case-heading"><div><p class="section-path">~/stack</p><h2 id="stack-case-title">{{ $case['stack'] }}</h2></div></div><ul class="case-stack" aria-label="Stack · {{ $project['name'] }}">@foreach ($project['stack'] as $technology)<li>{{ $technology }}</li>@endforeach</ul></section>

    <section class="case-section" aria-label="{{ $isEnglish ? 'Start a project conversation' : 'Iniciar conversación sobre un proyecto' }}" data-reveal>
        <div class="case-heading"><div><p class="section-path">~/next-step</p><h2>{{ $isEnglish ? 'Do you need something similar?' : '¿Necesitas resolver algo parecido?' }}</h2></div><p>{{ $isEnglish ? 'Tell the assistant what you need. It can connect your idea with relevant experience and prepare a concise handoff without asking for sensitive data.' : 'Cuéntale al asistente qué necesitas. Puede relacionar tu idea con experiencia relevante y preparar un resumen breve para continuar la conversación sin pedir datos sensibles.' }}</p></div>
        <button class="button button-primary" type="button" data-chat-open>{{ $isEnglish ? 'Tell me about your project ↗' : 'Cuéntame tu proyecto ↗' }}</button>
    </section>

    <nav class="case-pagination" aria-label="{{ $case['pagination'] }}" data-reveal>@if ($previous)<a href="{{ route($projectRoute, $previous['slug']) }}"><span>{{ $case['previous'] }}</span><strong>{{ $previous['name'] }}</strong></a>@else<span></span>@endif @if ($next)<a class="case-next" href="{{ route($projectRoute, $next['slug']) }}"><span>{{ $case['next'] }}</span><strong>{{ $next['name'] }}</strong></a>@endif</nav>
</article>
@endsection
