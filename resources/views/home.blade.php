@extends('layouts.app')

@section('title', 'Alecz · Software Developer & Product Builder')
@section('meta_description', 'Portafolio de Alejandro Fedle Rueda Jiménez, AKA Alecz. Software Developer y Product Builder enfocado en productos móviles, SaaS, biometría e integraciones.')
@section('og_title', 'Alecz · Software Developer & Product Builder')
@section('og_description', 'Productos reales, case studies y experiencia construyendo software que resuelve problemas concretos.')

@section('content')
@php($projects = config('portfolio.projects', []))
@php($otherProjects = config('portfolio.other_projects', []))
@php($whatsapp = config('profile.contact.whatsapp'))
@php($email = config('profile.contact.email'))

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
    <div class="section-heading" data-reveal><div><p class="section-path">~/projects</p><h2 id="projects-title">Productos reales.<br>No demos.</h2></div><p class="section-intro">Mobile, SaaS, biometría, software clínico y plataformas académicas. Cada proyecto parte de una necesidad concreta y busca convertirla en un producto que funcione en el mundo real.</p></div>
    <div class="projects-grid">
        @foreach ($projects as $project)
            <article class="project-card" id="{{ $project['slug'] }}" data-reveal>
                <div class="project-topline"><span class="project-type">{{ $project['type'] }}</span><span class="project-status">{{ $project['status'] }}</span></div>
                <h3>{{ $project['name'] }}</h3><p class="project-summary">{{ $project['summary'] }}</p>
                <div class="project-story"><div><span>PROBLEMA</span><p>{{ $project['problem'] }}</p></div><div><span>SOLUCIÓN</span><p>{{ $project['solution'] }}</p></div></div>
                <ul class="project-stack" aria-label="Tecnologías de {{ $project['name'] }}">@foreach ($project['stack'] as $technology)<li>{{ $technology }}</li>@endforeach</ul>
                <footer class="project-footer"><span class="project-signal">{{ $project['signal'] }}</span><a class="project-link" href="{{ route('projects.show', $project['slug']) }}">Ver case study →</a></footer>
            </article>
        @endforeach
    </div>
    @if ($otherProjects)
        <div class="other-projects" data-reveal><div class="other-projects-heading"><p class="section-path">~/more</p><h3>También he construido.</h3></div>
            @foreach ($otherProjects as $project)
                <article class="other-project-card" id="{{ $project['slug'] }}"><div><span class="project-type">{{ $project['type'] }}</span><h4>{{ $project['name'] }}</h4><p>{{ $project['summary'] }}</p></div><div class="other-project-meta"><ul class="project-stack" aria-label="Tecnologías de {{ $project['name'] }}">@foreach ($project['stack'] as $technology)<li>{{ $technology }}</li>@endforeach</ul><span class="project-signal">{{ $project['signal'] }}</span></div></article>
            @endforeach
        </div>
    @endif
</section>

<section id="sobre-mi" class="about-section" aria-labelledby="about-title" data-reveal>
    <div class="section-heading"><div><p class="section-path">~/about</p><h2 id="about-title">Código con<br>contexto de negocio.</h2></div><div class="about-copy"><p>No me interesa programar por programar. Me gusta entender el problema, aterrizarlo a una experiencia útil y construir el producto completo: lógica, interfaz, datos, integraciones, pruebas y despliegue.</p><p>He trabajado en productos móviles, SaaS, gestión clínica, plataformas académicas y sistemas biométricos. Esa variedad me obliga a pensar más allá del framework y a elegir la tecnología según lo que el producto necesita.</p></div></div>
    <div class="principles-grid">
        <article><span>01</span><h3>Producto antes que código</h3><p>Primero entiendo para quién construimos, qué duele y qué resultado importa.</p></article>
        <article><span>02</span><h3>Extremo a extremo</h3><p>Puedo moverme desde arquitectura y backend hasta mobile, frontend, integraciones y entrega.</p></article>
        <article><span>03</span><h3>Iterar con disciplina</h3><p>Trabajo por tickets, pruebas, CI, revisión de PR y cambios pequeños que puedan verificarse.</p></article>
    </div>
</section>

<section id="stack" class="stack-section" aria-labelledby="stack-title" data-reveal>
    <div class="section-heading"><div><p class="section-path">~/stack</p><h2 id="stack-title">Tecnología como<br>herramienta.</h2></div><p class="section-intro">No es una colección de logos. Es el conjunto de herramientas que uso para llevar productos desde la idea hasta producción.</p></div>
    <div class="stack-grid">
        <article><span class="stack-label">BACKEND · WEB</span><h3>Laravel · PHP · Blade</h3><p>Arquitectura SaaS, seguridad, procesos de negocio, APIs, paneles y productos web mantenibles.</p><ul><li>Laravel</li><li>PHP</li><li>Blade</li><li>JavaScript</li></ul></article>
        <article><span class="stack-label">MOBILE</span><h3>Flutter · Dart</h3><p>Apps Android con estado, persistencia, exportaciones, monetización e integración con servicios externos.</p><ul><li>Flutter</li><li>Dart</li><li>Android</li><li>IAP</li></ul></article>
        <article><span class="stack-label">DESKTOP · HARDWARE</span><h3>C# · .NET · Biometría</h3><p>Clientes Windows conectados con hardware biométrico, repositorios locales y servicios remotos.</p><ul><li>C#</li><li>WinForms</li><li>.NET Framework</li><li>Digital Persona</li></ul></article>
        <article><span class="stack-label">DATA · INTEGRATIONS</span><h3>MySQL · SQLite · APIs</h3><p>Modelado de datos, sincronización, Google Drive, LMS, WhatsApp y servicios de terceros.</p><ul><li>MySQL</li><li>SQLite</li><li>REST APIs</li><li>Google Drive</li></ul></article>
        <article><span class="stack-label">DELIVERY</span><h3>GitHub · CI · Jira</h3><p>Ramas pequeñas, commits consolidados, pruebas automatizadas, pull requests y trazabilidad de trabajo.</p><ul><li>GitHub Actions</li><li>Git</li><li>Jira</li><li>PR Review</li></ul></article>
    </div>
</section>

<section id="experiencia" class="experience-section" aria-labelledby="experience-title" data-reveal>
    <div class="section-heading"><div><p class="section-path">~/experience</p><h2 id="experience-title">Construir.<br>Aprender. Repetir.</h2></div><p class="section-intro">Mi trayectoria se entiende mejor por los problemas que he resuelto y los sistemas que he llevado cada vez más lejos.</p></div>
    <div class="experience-list">
        <article><span>PRODUCTS</span><h3>De necesidades reales a software utilizable</h3><p>Citas CRIT, DocTotal, URPE, AcadControl y PartyX nacen de flujos concretos de personas y organizaciones, no de ejercicios de portafolio.</p></article>
        <article><span>MOBILE</span><h3>Apps con profundidad de producto</h3><p>Baseball App combina lógica deportiva compleja, estadísticas, archivos PDF/Excel, backup en Drive y modelo Free/Pro; Citas CRIT lleva una necesidad familiar a una app publicada.</p></article>
        <article><span>INTEGRATIONS</span><h3>Software que conversa con otros sistemas</h3><p>He conectado APIs, servicios de mensajería, LMS, almacenamiento en la nube, pagos y hardware biométrico para cerrar procesos completos.</p></article>
        <article><span>ENGINEERING</span><h3>Proceso técnico verificable</h3><p>Desarrollo con GitHub, Jira, CI, pruebas y revisión humana de PR para mantener contexto, calidad y trazabilidad mientras el producto crece.</p></article>
    </div>
</section>

<section id="contacto" class="contact-section" aria-labelledby="contact-title" data-reveal>
    <p class="section-path">~/contact</p>
    <div class="contact-grid">
        <div>
            <h2 id="contact-title">¿Tienes un problema que<br>valga la pena resolver?</h2>
            <p>Cuéntaselo al asistente del sitio. Puede orientarte entre proyectos, capacidades y la mejor forma de iniciar una conversación conmigo.</p>
        </div>
        <div class="contact-actions">
            <p><span class="prompt">alecz@dev:~$</span> contact --new-project</p>
            @if ($whatsapp)
                <a class="button button-primary" href="https://wa.me/{{ preg_replace('/\D+/', '', $whatsapp) }}" rel="noopener noreferrer" target="_blank">Escribir por WhatsApp ↗</a>
            @endif
            @if ($email)
                <a class="button button-secondary" href="mailto:{{ $email }}">Enviar correo</a>
            @endif
            <button class="button button-secondary" type="button" data-chat-open>Abrir asistente</button>
            @unless ($whatsapp || $email)
                <small>WhatsApp y correo se activarán aquí cuando estén configurados. El asistente ya puede ayudarte a explorar el portafolio.</small>
            @endunless
        </div>
    </div>
</section>
@endsection
