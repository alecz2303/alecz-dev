@extends('layouts.app')

@section('title', $project['name'].' · Case Study · Alecz')
@section('meta_description', $project['summary'])
@section('og_title', $project['name'].' · Case Study · Alecz')
@section('og_description', $project['summary'])

@section('content')
<article class="case-study">
    <header class="case-hero" data-reveal>
        <a class="case-back" href="{{ route('home') }}#proyectos">← Volver a ~/projects</a>
        <div class="case-meta"><span>{{ $project['type'] }}</span><span>{{ $project['status'] }}</span></div>
        <h1>{{ $project['name'] }}</h1>
        <p class="case-lead">{{ $project['summary'] }}</p>
        <div class="case-signal">{{ $project['signal'] }}</div>
    </header>

    <section class="case-section case-context" aria-labelledby="context-title" data-reveal>
        <div><p class="section-path">~/context</p><h2 id="context-title">El contexto.</h2></div>
        <p>{{ $project['context'] }}</p>
    </section>

    <section class="case-section case-two-column" aria-label="Problema y solución" data-reveal>
        <div><p class="section-path">~/problem</p><h2>El problema.</h2><p>{{ $project['problem'] }}</p></div>
        <div><p class="section-path">~/solution</p><h2>La solución.</h2><p>{{ $project['solution'] }}</p></div>
    </section>

    <section class="case-section" aria-labelledby="capabilities-title" data-reveal>
        <div class="case-heading"><div><p class="section-path">~/capabilities</p><h2 id="capabilities-title">Qué resuelve.</h2></div><p>Capacidades implementadas que forman parte del producto y su operación real.</p></div>
        <ol class="case-capabilities">
            @foreach ($project['capabilities'] as $capability)
                <li><span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><strong>{{ $capability }}</strong></li>
            @endforeach
        </ol>
    </section>

    <section class="case-section case-two-column" aria-labelledby="architecture-title" data-reveal>
        <div><p class="section-path">~/architecture</p><h2 id="architecture-title">Cómo está construido.</h2><p>La arquitectura se explica por responsabilidades e integraciones, no por una lista de buzzwords.</p></div>
        <ul class="case-architecture">
            @foreach ($project['architecture'] as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </section>

    <section class="case-section" aria-labelledby="stack-case-title" data-reveal>
        <div class="case-heading"><div><p class="section-path">~/stack</p><h2 id="stack-case-title">Stack.</h2></div></div>
        <ul class="case-stack" aria-label="Tecnologías de {{ $project['name'] }}">
            @foreach ($project['stack'] as $technology)<li>{{ $technology }}</li>@endforeach
        </ul>
    </section>

    <nav class="case-pagination" aria-label="Navegación entre proyectos" data-reveal>
        @if ($previous)
            <a href="{{ route('projects.show', $previous['slug']) }}"><span>← Anterior</span><strong>{{ $previous['name'] }}</strong></a>
        @else
            <span></span>
        @endif
        @if ($next)
            <a class="case-next" href="{{ route('projects.show', $next['slug']) }}"><span>Siguiente →</span><strong>{{ $next['name'] }}</strong></a>
        @endif
    </nav>
</article>
@endsection
