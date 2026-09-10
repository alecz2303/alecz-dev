<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'Portafolio profesional de Alejandro Fedle Rueda Jiménez, AKA Alecz. Software Developer y Product Builder enfocado en soluciones digitales para problemas reales.')">
    <meta name="robots" content="@yield('robots', 'index,follow')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="Alecz">
    <meta property="og:title" content="@yield('og_title', trim($__env->yieldContent('title', 'Alecz · Software Developer & Product Builder')))">
    <meta property="og:description" content="@yield('og_description', trim($__env->yieldContent('meta_description', 'Portafolio profesional de Alecz. Software Developer y Product Builder.')))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="@yield('og_title', trim($__env->yieldContent('title', 'Alecz · Software Developer & Product Builder')))">
    <meta name="twitter:description" content="@yield('og_description', trim($__env->yieldContent('meta_description', 'Portafolio profesional de Alecz. Software Developer y Product Builder.')))">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <meta name="theme-color" content="#090b10">
    <title>@yield('title', 'Alecz · Software Developer & Product Builder')</title>
    @vite(['resources/css/app.css', 'resources/css/projects.css', 'resources/css/chatbot.css', 'resources/css/case-media.css', 'resources/js/app.js'])
</head>
<body>
    <a class="skip-link" href="#contenido">Saltar al contenido</a>

    <div class="site-shell">
        <header class="site-header" data-reveal>
            <a class="brand" href="{{ route('home') }}" aria-label="Alecz, inicio">
                <span class="brand-mark" aria-hidden="true">&gt;_</span>
                <span>Alecz</span>
            </a>

            <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation" data-nav-toggle>
                <span class="sr-only">Abrir navegación</span>
                <span></span>
                <span></span>
            </button>

            <nav class="site-nav" id="primary-navigation" aria-label="Navegación principal" data-nav>
                <a href="{{ route('home') }}#proyectos">~/projects</a>
                <a href="{{ route('home') }}#sobre-mi">~/about</a>
                <a href="{{ route('home') }}#contacto">~/contact</a>
            </nav>
        </header>

        <main id="contenido">
            @yield('content')
        </main>
    </div>

    @php($whatsapp = config('profile.contact.whatsapp'))
    @php($email = config('profile.contact.email'))
    @php($chatProjects = collect(config('portfolio.projects', []))->map(fn ($project) => [
        'name' => $project['name'],
        'slug' => $project['slug'],
        'type' => $project['type'],
        'summary' => $project['summary'],
        'stack' => $project['stack'],
        'signal' => $project['signal'],
        'capabilities' => $project['capabilities'] ?? [],
        'url' => route('projects.show', $project['slug']),
    ])->values())

    <script type="application/json" data-chat-knowledge>@json($chatProjects)</script>

    <aside class="portfolio-chat"
        data-chat
        data-chat-endpoint="{{ route('chat') }}"
        data-whatsapp="{{ $whatsapp ? preg_replace('/\D+/', '', $whatsapp) : '' }}"
        data-email="{{ $email ?? '' }}">
        <button class="chat-launcher" type="button" aria-expanded="false" aria-controls="portfolio-chat-panel" data-chat-toggle>
            <span aria-hidden="true">&gt;_</span>
            <span>Hablar con el asistente</span>
        </button>
        <section class="chat-panel" id="portfolio-chat-panel" aria-label="Asistente del portafolio" aria-hidden="true" data-chat-panel>
            <header class="chat-header">
                <div><span class="status-dot" aria-hidden="true"></span><strong>Asistente de Alecz</strong></div>
                <button type="button" aria-label="Cerrar asistente" data-chat-close>×</button>
            </header>
            <div class="chat-messages" aria-live="polite" aria-atomic="false" data-chat-messages>
                <div class="chat-message is-bot">Hola. Cuéntame qué necesitas construir o mejorar. Puedo relacionarlo con proyectos reales de Alecz y, si buscas cotizar, preparar el contexto para hablar con él.</div>
            </div>
            <div class="chat-options" id="portfolio-chat-options" data-chat-options>
                <button type="button" data-chat-topic="projects">Ver proyectos</button>
                <button type="button" data-chat-topic="services">¿Qué puede construir?</button>
                <button type="button" data-chat-topic="lead">Quiero cotizar un proyecto</button>
                <button type="button" data-chat-topic="contact">Quiero contactarlo</button>
            </div>
            <div class="chat-options-toolbar">
                <button class="chat-options-toggle" type="button" aria-expanded="false" aria-controls="portfolio-chat-options" data-chat-options-toggle hidden>Opciones</button>
            </div>
            <form class="chat-form" data-chat-form>
                <label class="sr-only" for="portfolio-chat-input">Escribe qué necesitas</label>
                <input id="portfolio-chat-input" type="text" autocomplete="off" maxlength="500" placeholder="Ej. Necesito una app para citas y pagos" data-chat-input>
                <button type="submit" data-chat-submit>Enviar</button>
            </form>
            <p class="chat-privacy">No guardamos esta conversación en base de datos. No necesitas compartir datos sensibles. Solo se procesa para responder y preparar, si tú quieres, un resumen para contactar a Alecz.</p>
        </section>
    </aside>
</body>
</html>
