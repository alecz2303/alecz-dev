@extends('layouts.app')

@section('title', 'Alecz · Software Developer & Product Builder')
@section('meta_description', __('ui.meta.home_description'))
@section('og_title', 'Alecz · Software Developer & Product Builder')
@section('og_description', __('ui.meta.home_og'))

@section('content')
@php($portfolioConfig = app()->getLocale() === 'en' ? config('portfolio_en') : config('portfolio'))
@php($projects = $portfolioConfig['projects'] ?? [])
@php($otherProjects = $portfolioConfig['other_projects'] ?? [])
@php($whatsapp = config('profile.contact.whatsapp'))
@php($email = config('profile.contact.email'))
@php($home = __('ui.home'))
@php($projectRoute = app()->getLocale() === 'en' ? 'en.projects.show' : 'projects.show')

<section class="hero" aria-labelledby="hero-title">
    <div class="hero-copy" data-reveal>
        <p class="hero-kicker"><span class="status-dot" aria-hidden="true"></span>{{ $home['hero']['kicker'] }}</p>
        <h1 id="hero-title">Alecz<span class="accent">.</span></h1>
        <p class="hero-name">Alejandro Fedle Rueda Jiménez</p>
        <p class="hero-role">{{ $home['hero']['role'] }}</p>
        <p class="hero-lead">{{ $home['hero']['lead'] }}</p>
        <p class="hero-support">{{ $home['hero']['support'] }}</p>
        <div class="hero-actions">
            <a class="button button-primary" href="#proyectos">{{ $home['hero']['projects'] }} <span aria-hidden="true">↘</span></a>
            <a class="button button-secondary" href="#sobre-mi">{{ $home['hero']['about'] }}</a>
        </div>
    </div>

    <div class="terminal-wrap" data-reveal data-delay="1">
        <div class="terminal-glow" aria-hidden="true"></div>
        <article class="terminal" aria-label="Alecz identity terminal">
            <header class="terminal-bar"><div class="terminal-dots" aria-hidden="true"><span></span><span></span><span></span></div><span class="terminal-title">alecz — zsh</span><span class="terminal-meta">portfolio</span></header>
            <div class="terminal-body">
                <p><span class="prompt">alecz@dev:~$</span> <span class="command">whoami</span></p>
                <div class="terminal-output"><strong>Alejandro Fedle Rueda Jiménez</strong><span>AKA <b>Alecz</b></span></div>
                <p><span class="prompt">alecz@dev:~$</span> <span class="command">cat role.txt</span></p>
                <div class="terminal-output muted"><span>Software Developer</span><span>Product Builder</span><span>Problem Solver</span></div>
                <p><span class="prompt">alecz@dev:~$</span> <span class="command">status</span></p>
                <div class="terminal-output status-lines"><span><i>[ OK ]</i> Citas CRIT</span><span><i>[ OK ]</i> SchoolBio</span><span><i>[ OK ]</i> Baseball App</span><span><i>[ OK ]</i> DocTotal</span><span><i>[ .. ]</i> Building what comes next</span></div>
                <p class="terminal-cursor"><span class="prompt">alecz@dev:~$</span> <span class="cursor" aria-hidden="true"></span></p>
            </div>
        </article>
    </div>
</section>

<section id="proyectos" class="projects-section" aria-labelledby="projects-title">
    <div class="section-heading" data-reveal><div><p class="section-path">~/projects</p><h2 id="projects-title">{{ $home['projects']['title'] }}</h2></div><p class="section-intro">{{ $home['projects']['intro'] }}</p></div>
    <div class="projects-grid">
        @foreach ($projects as $project)
            <article class="project-card" id="{{ $project['slug'] }}" data-reveal>
                <div class="project-topline"><span class="project-type">{{ $project['type'] }}</span><span class="project-status">{{ $project['status'] }}</span></div>
                <h3>{{ $project['name'] }}</h3><p class="project-summary">{{ $project['summary'] }}</p>
                <div class="project-story"><div><span>{{ $home['projects']['problem'] }}</span><p>{{ $project['problem'] }}</p></div><div><span>{{ $home['projects']['solution'] }}</span><p>{{ $project['solution'] }}</p></div></div>
                <ul class="project-stack" aria-label="Stack · {{ $project['name'] }}">@foreach ($project['stack'] as $technology)<li>{{ $technology }}</li>@endforeach</ul>
                <footer class="project-footer"><span class="project-signal">{{ $project['signal'] }}</span><a class="project-link" href="{{ route($projectRoute, $project['slug']) }}">{{ $home['projects']['case_study'] }}</a></footer>
            </article>
        @endforeach
    </div>
    @if ($otherProjects)
        <div class="other-projects" data-reveal><div class="other-projects-heading"><p class="section-path">~/more</p><h3>{{ $home['projects']['more'] }}</h3></div>
            @foreach ($otherProjects as $project)
                <article class="other-project-card" id="{{ $project['slug'] }}"><div><span class="project-type">{{ $project['type'] }}</span><h4>{{ $project['name'] }}</h4><p>{{ $project['summary'] }}</p></div><div class="other-project-meta"><ul class="project-stack" aria-label="Stack · {{ $project['name'] }}">@foreach ($project['stack'] as $technology)<li>{{ $technology }}</li>@endforeach</ul><span class="project-signal">{{ $project['signal'] }}</span></div></article>
            @endforeach
        </div>
    @endif
</section>

<section id="sobre-mi" class="about-section" aria-labelledby="about-title" data-reveal>
    <div class="section-heading"><div><p class="section-path">~/about</p><h2 id="about-title">{{ $home['about']['title'] }}</h2></div><div class="about-copy"><p>{{ $home['about']['p1'] }}</p><p>{{ $home['about']['p2'] }}</p></div></div>
    <div class="principles-grid">
        @foreach ($home['about']['principles'] as $principle)
            <article><span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $principle['title'] }}</h3><p>{{ $principle['text'] }}</p></article>
        @endforeach
    </div>
</section>

<section id="stack" class="stack-section" aria-labelledby="stack-title" data-reveal>
    <div class="section-heading"><div><p class="section-path">~/stack</p><h2 id="stack-title">{{ $home['stack']['title'] }}</h2></div><p class="section-intro">{{ $home['stack']['intro'] }}</p></div>
    <div class="stack-grid">
        @foreach ($home['stack']['cards'] as $card)
            <article><span class="stack-label">{{ $card['label'] }}</span><h3>{{ $card['title'] }}</h3><p>{{ $card['text'] }}</p><ul>@foreach ($card['items'] as $item)<li>{{ $item }}</li>@endforeach</ul></article>
        @endforeach
    </div>
</section>

<section id="experiencia" class="experience-section" aria-labelledby="experience-title" data-reveal>
    <div class="section-heading"><div><p class="section-path">~/experience</p><h2 id="experience-title">{{ $home['experience']['title'] }}</h2></div><p class="section-intro">{{ $home['experience']['intro'] }}</p></div>
    <div class="experience-list">
        @foreach ($home['experience']['items'] as $item)
            <article><span>{{ $item['label'] }}</span><h3>{{ $item['title'] }}</h3><p>{{ $item['text'] }}</p></article>
        @endforeach
    </div>
</section>

<section id="contacto" class="contact-section" aria-labelledby="contact-title" data-reveal>
    <p class="section-path">~/contact</p>
    <div class="contact-grid">
        <div><h2 id="contact-title">{{ $home['contact']['title'] }}</h2><p>{{ $home['contact']['text'] }}</p></div>
        <div class="contact-actions">
            <p><span class="prompt">alecz@dev:~$</span> contact --new-project</p>
            @if ($whatsapp)<a class="button button-primary" href="https://wa.me/{{ preg_replace('/\D+/', '', $whatsapp) }}" rel="noopener noreferrer" target="_blank">{{ $home['contact']['whatsapp'] }}</a>@endif
            @if ($email)<a class="button button-secondary" href="mailto:{{ $email }}">{{ $home['contact']['email'] }}</a>@endif
            <button class="button button-secondary" type="button" data-chat-open>{{ $home['contact']['assistant'] }}</button>
            @unless ($whatsapp || $email)<small>{{ $home['contact']['pending'] }}</small>@endunless
        </div>
    </div>
</section>
@endsection
