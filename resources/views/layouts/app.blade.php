<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', 'Portafolio profesional de Alejandro Fedle Rueda Jiménez, AKA Alecz. Software Developer y Product Builder enfocado en soluciones digitales para problemas reales.')">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('og_title', trim($__env->yieldContent('title', 'Alecz · Software Developer & Product Builder')))">
    <meta property="og:description" content="@yield('og_description', trim($__env->yieldContent('meta_description', 'Portafolio profesional de Alecz. Software Developer y Product Builder.')))">
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="theme-color" content="#090b10">
    <title>@yield('title', 'Alecz · Software Developer & Product Builder')</title>
    @vite(['resources/css/app.css', 'resources/css/projects.css', 'resources/js/app.js'])
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
</body>
</html>
