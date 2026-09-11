<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', __('ui.meta.default_description'))">
    <meta name="robots" content="@yield('robots', 'index,follow')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="Alecz">
    <meta property="og:title" content="@yield('og_title', trim($__env->yieldContent('title', 'Alecz · Software Developer & Product Builder')))">
    <meta property="og:description" content="@yield('og_description', trim($__env->yieldContent('meta_description', __('ui.meta.short_description'))))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:locale" content="{{ app()->getLocale() === 'en' ? 'en_US' : 'es_MX' }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="@yield('og_title', trim($__env->yieldContent('title', 'Alecz · Software Developer & Product Builder')))">
    <meta name="twitter:description" content="@yield('og_description', trim($__env->yieldContent('meta_description', __('ui.meta.short_description'))))">
    <link rel="canonical" href="{{ url()->current() }}">
    @php($isEnglish = app()->getLocale() === 'en')
    @php($slug = request()->route('slug'))
    @php($spanishUrl = $slug ? route('projects.show', $slug) : route('home'))
    @php($englishUrl = $slug ? route('en.projects.show', $slug) : route('en.home'))
    <link rel="alternate" hreflang="es" href="{{ $spanishUrl }}">
    <link rel="alternate" hreflang="en" href="{{ $englishUrl }}">
    <link rel="alternate" hreflang="x-default" href="{{ $spanishUrl }}">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <meta name="theme-color" content="#090b10">
    <title>@yield('title', 'Alecz · Software Developer & Product Builder')</title>
    @vite(['resources/css/app.css', 'resources/css/projects.css', 'resources/css/chatbot.css', 'resources/css/case-media.css', 'resources/css/localization.css', 'resources/js/app.js'])
</head>
<body>
    <a class="skip-link" href="#contenido">{{ __('ui.nav.skip') }}</a>

    <div class="site-shell">
        <header class="site-header" data-reveal>
            <a class="brand" href="{{ $isEnglish ? route('en.home') : route('home') }}" aria-label="{{ __('ui.nav.home') }}">
                <span class="brand-mark" aria-hidden="true">&gt;_</span><span>Alecz</span>
            </a>

            <div class="header-actions">
                <a class="locale-switch" href="{{ $isEnglish ? $spanishUrl : $englishUrl }}" hreflang="{{ $isEnglish ? 'es' : 'en' }}" aria-label="{{ __('ui.nav.language_label') }}">{{ __('ui.nav.language') }}</a>
                <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation" data-nav-toggle>
                    <span class="sr-only">{{ __('ui.nav.open') }}</span><span></span><span></span>
                </button>
            </div>

            <nav class="site-nav" id="primary-navigation" aria-label="{{ __('ui.nav.label') }}" data-nav>
                <a href="{{ $isEnglish ? route('en.home') : route('home') }}#proyectos">{{ __('ui.nav.projects') }}</a>
                <a href="{{ $isEnglish ? route('en.home') : route('home') }}#sobre-mi">{{ __('ui.nav.about') }}</a>
                <a href="{{ $isEnglish ? route('en.home') : route('home') }}#contacto">{{ __('ui.nav.contact') }}</a>
            </nav>
        </header>

        <main id="contenido">@yield('content')</main>
    </div>

    @php($whatsapp = config('profile.contact.whatsapp'))
    @php($email = config('profile.contact.email'))
    @php($portfolioConfig = $isEnglish ? config('portfolio_en') : config('portfolio'))
    @php($projectRoute = $isEnglish ? 'en.projects.show' : 'projects.show')
    @php($chatProjects = collect($portfolioConfig['projects'] ?? [])->map(fn ($project) => [
        'name'=>$project['name'],'slug'=>$project['slug'],'type'=>$project['type'],'summary'=>$project['summary'],'stack'=>$project['stack'],'signal'=>$project['signal'],'capabilities'=>$project['capabilities'] ?? [],'url'=>route($projectRoute, $project['slug']),
    ])->values())

    <script type="application/json" data-chat-knowledge>@json($chatProjects)</script>
    <script type="application/json" data-chat-copy>@json(__('ui.chat'))</script>

    <aside class="portfolio-chat" data-chat data-chat-endpoint="{{ route($isEnglish ? 'en.chat' : 'chat') }}" data-whatsapp="{{ $whatsapp ? preg_replace('/\D+/', '', $whatsapp) : '' }}" data-email="{{ $email ?? '' }}">
        <button class="chat-launcher" type="button" aria-expanded="false" aria-controls="portfolio-chat-panel" data-chat-toggle><span aria-hidden="true">&gt;_</span><span>{{ __('ui.chat.launcher') }}</span></button>
        <section class="chat-panel" id="portfolio-chat-panel" aria-label="{{ __('ui.chat.panel_label') }}" aria-hidden="true" data-chat-panel>
            <header class="chat-header"><div><span class="status-dot" aria-hidden="true"></span><strong>{{ __('ui.chat.title') }}</strong></div><button type="button" aria-label="{{ __('ui.chat.close') }}" data-chat-close>×</button></header>
            <div class="chat-messages" aria-live="polite" aria-atomic="false" data-chat-messages><div class="chat-message is-bot">{{ __('ui.chat.welcome') }}</div></div>
            <div class="chat-options" id="portfolio-chat-options" data-chat-options>
                @foreach (__('ui.chat.topics') as $topic => $label)<button type="button" data-chat-topic="{{ $topic }}">{{ $label }}</button>@endforeach
            </div>
            <div class="chat-options-toolbar"><button class="chat-options-toggle" type="button" aria-expanded="false" aria-controls="portfolio-chat-options" data-chat-options-toggle hidden>{{ __('ui.chat.options') }}</button></div>
            <form class="chat-form" data-chat-form>
                <label class="sr-only" for="portfolio-chat-input">{{ __('ui.chat.input_label') }}</label>
                <input id="portfolio-chat-input" type="text" autocomplete="off" maxlength="500" placeholder="{{ __('ui.chat.placeholder') }}" data-chat-input>
                <button type="submit" data-chat-submit>{{ __('ui.chat.send') }}</button>
            </form>
            <p class="chat-privacy">{{ __('ui.chat.privacy') }}</p>
        </section>
    </aside>
</body>
</html>
