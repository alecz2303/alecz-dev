<?php

use App\Http\Controllers\PortfolioChatController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::post('/chat', PortfolioChatController::class)
    ->middleware('throttle:30,1')
    ->name('chat');

Route::get('/proyectos/{slug}', function (string $slug) {
    $projects = collect(config('portfolio.projects', []));
    $project = $projects->firstWhere('slug', $slug);

    abort_unless($project, 404);

    $currentIndex = $projects->search(fn (array $item) => $item['slug'] === $slug);
    $previous = $currentIndex > 0 ? $projects->get($currentIndex - 1) : null;
    $next = $currentIndex < $projects->count() - 1 ? $projects->get($currentIndex + 1) : null;

    return view('projects.show', compact('project', 'previous', 'next'));
})->name('projects.show');

Route::get('/robots.txt', function () {
    $lines = app()->environment('production')
        ? ['User-agent: *', 'Allow: /', 'Sitemap: '.url('/sitemap.xml')]
        : ['User-agent: *', 'Disallow: /'];

    return response(implode("\n", $lines)."\n", 200)
        ->header('Content-Type', 'text/plain; charset=UTF-8');
})->name('robots');

Route::get('/sitemap.xml', function () {
    $urls = collect([route('home')])
        ->merge(collect(config('portfolio.projects', []))->map(
            fn (array $project) => route('projects.show', $project['slug'])
        ));

    $xml = view('sitemap', compact('urls'))->render();

    return response($xml, 200)
        ->header('Content-Type', 'application/xml; charset=UTF-8');
})->name('sitemap');
