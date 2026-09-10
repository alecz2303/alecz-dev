@extends('layouts.app')

@section('title', 'Alecz · Software Developer & Product Builder')

@section('content')
@php($projects = config('portfolio.projects', []))
@php($otherProjects = config('portfolio.other_projects', []))

<section class="hero" aria-labelledby="hero-title">
    <div class="hero-copy" data-reveal>
        <p class="hero-kicker"><span class="status-dot" aria-hidden="true"></span>Disponible para construir cosas que importan</p>
        <h1 id="hero-title">Alecz<span class="accent">.</span></h1>
        <p class="hero-name">Alejandro Fedle Rueda Jiménez</p>
        <p class="hero-role">Software Developer <span aria-hidden="true">·</span> Product Builder</p>
        <p class="hero-lead">Convierto problemas reales en software que funciona.</p>
        <p class="hero-support">Diseño y desarrollo productos digitales completos: desde la idea y la arquitectura hasta una experiencia lista para usarse.</p>
        <div class="hero-actions">
            <a class="button button-primary" href="#proyectos">Ver proyectos <span aria-hidden="true">↘</span></a>
            <a class="button button-secondary" href="#sobre-mi">Conocerme</a>
        </div>
    </div>

    <div class="terminal-wrap" data-reveal data-delay="1">
        <div class="terminal-glow" aria-hidden="true"></div>
        <article class="terminal" aria-label="Terminal de identidad de Alecz">
            <header class="terminal-bar">
                <div class="terminal-dots" aria-hidden="true"><span></span><span></span><span></span></div>
                <span class="terminal-title">alecz — zsh</span><span class="terminal-meta">portfolio</span>
            </header>
            <div class="terminal-body">
                <p><span class="prompt">alecz@dev:~$</span> <span class="command">whoami</span></p>
                <div class="terminal-output"><strong>Alejandro Fedle Rueda Jiménez</strong><span>AKA <b>Alecz</b></span></div>
                <p><span class="prompt">alecz@dev:~$</span> <span class="command">cat role.txt</span></p>
                <div class="terminal-output muted"><span>Software Developer</span><span>Product Builder</span><span>Problem Solver</span></div>
                <p><span class="prompt">alecz@dev:~$</span> <span class="command">status</span></p>
                <div class="terminal-output status-lines">
                    <span><i>[ OK ]</i> Citas CRIT</span>
                    <span><i>[ OK ]</i> SchoolBio</span>
                    <span><i>[ OK ]</i> Baseball App</span>
                    <span><i>[ OK ]</i> DocTotal</span>
                    <span><i>[ .. ]</i> Building what comes next</span>
                </div>
                <p class="terminal-cursor"><span class="prompt">alecz@dev:~$</span> <span class="cursor" aria-hidden="true"></span></p>
            </div>
        </article>
    </div>
</section>

<section id="proyectos" class="projects-section" aria-labelledby="projects-title">
    <div class="section-heading" data-reveal>
        <div><p class="section-path">~/projects</p><h2 id="projects-title">Productos reales.<br>No demos.</h2></div>
        <p class="section-intro">Mobile, SaaS, biometría, software clínico y plataformas académicas. Cada proyecto parte de una necesidad concreta y busca convertirla en un producto que funcione en el mundo real.</p>
    </div>

    <div class="projects-grid">
        @foreach ($projects as $project)
            <article class="project-card" id="{{ $project['slug'] }}" data-reveal>
                <div class="project-topline"><span class="project-type">{{ $project['type'] }}</span><span class="project-status">{{ $project['status'] }}</span></div>
                <h3>{{ $project['name'] }}</h3>
                <p class="project-summary">{{ $project['summary'] }}</p>
                <div class="project-story">
                    <div><span>PROBLEMA</span><p>{{ $project['problem'] }}</p></div>
                    <div><span>SOLUCIÓN</span><p>{{ $project['solution'] }}</p></div>
                </div>
                <ul class="project-stack" aria-label="Tecnologías de {{ $project['name'] }}">
                    @foreach ($project['stack'] as $technology)<li>{{ $technology }}</li>@endforeach
                </ul>
                <footer class="project-footer"><span class="project-signal">{{ $project['signal'] }}</span><span class="project-link">Case study próximamente →</span></footer>
            </article>
        @endforeach
    </div>

    @if ($otherProjects)
        <div class="other-projects" data-reveal>
            <div class="other-projects-heading"><p class="section-path">~/more</p><h3>También he construido.</h3></div>
            @foreach ($otherProjects as $project)
                <article class="other-project-card" id="{{ $project['slug'] }}">
                    <div><span class="project-type">{{ $project['type'] }}</span><h4>{{ $project['name'] }}</h4><p>{{ $project['summary'] }}</p></div>
                    <div class="other-project-meta">
                        <ul class="project-stack" aria-label="Tecnologías de {{ $project['name'] }}">@foreach ($project['stack'] as $technology)<li>{{ $technology }}</li>@endforeach</ul>
                        <span class="project-signal">{{ $project['signal'] }}</span>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</section>

<section class="preview-strip" aria-label="Vista previa de secciones próximas" data-reveal>
    <div id="sobre-mi" class="preview-item"><span class="preview-index">01</span><div><span class="preview-path">~/about</span><strong>Código con contexto de negocio.</strong></div><span class="preview-arrow" aria-hidden="true">→</span></div>
    <div id="contacto" class="preview-item"><span class="preview-index">02</span><div><span class="preview-path">~/contact</span><strong>Construyamos algo útil.</strong></div><span class="preview-arrow" aria-hidden="true">→</span></div>
</section>
@endsection
