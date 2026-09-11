<?php

use App\Http\Controllers\PortfolioChatController;
use Illuminate\Support\Facades\Route;

$projectPage = function (string $slug, string $locale = 'es') {
    app()->setLocale($locale);

    $config = $locale === 'en' ? 'portfolio_en' : 'portfolio';
    $projects = collect(config("{$config}.projects", []));
    $project = $projects->firstWhere('slug', $slug);

    abort_unless($project, 404);

    $currentIndex = $projects->search(fn (array $item) => $item['slug'] === $slug);
    $previous = $currentIndex > 0 ? $projects->get($currentIndex - 1) : null;
    $next = $currentIndex < $projects->count() - 1 ? $projects->get($currentIndex + 1) : null;

    return view('projects.show', compact('project', 'previous', 'next'));
};

Route::get('/', function () {
    app()->setLocale('es');

    return view('home');
})->name('home');

Route::get('/en', function () {
    app()->setLocale('en');

    return view('home');
})->name('en.home');

Route::post('/chat', PortfolioChatController::class)
    ->defaults('locale', 'es')
    ->middleware('throttle:30,1')
    ->name('chat');

Route::post('/en/chat', PortfolioChatController::class)
    ->defaults('locale', 'en')
    ->middleware('throttle:30,1')
    ->name('en.chat');

Route::get('/proyectos/{slug}', fn (string $slug) => $projectPage($slug, 'es'))
    ->name('projects.show');

Route::get('/en/projects/{slug}', fn (string $slug) => $projectPage($slug, 'en'))
    ->name('en.projects.show');

Route::get('/robots.txt', function () {
    $lines = app()->environment('production')
        ? ['User-agent: *', 'Allow: /', 'Sitemap: '.url('/sitemap.xml')]
        : ['User-agent: *', 'Disallow: /'];

    return response(implode("\n", $lines)."\n", 200)
        ->header('Content-Type', 'text/plain; charset=UTF-8');
})->name('robots');

Route::get('/sitemap.xml', function () {
    $spanishProjects = collect(config('portfolio.projects', []));
    $englishProjects = collect(config('portfolio_en.projects', []));

    $urls = collect([route('home'), route('en.home')])
        ->merge($spanishProjects->map(fn (array $project) => route('projects.show', $project['slug'])))
        ->merge($englishProjects->map(fn (array $project) => route('en.projects.show', $project['slug'])));

    $xml = view('sitemap', compact('urls'))->render();

    return response($xml, 200)
        ->header('Content-Type', 'application/xml; charset=UTF-8');
})->name('sitemap');
