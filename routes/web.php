<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::get('/proyectos/{slug}', function (string $slug) {
    $projects = collect(config('portfolio.projects', []));
    $project = $projects->firstWhere('slug', $slug);

    abort_unless($project, 404);

    $currentIndex = $projects->search(fn (array $item) => $item['slug'] === $slug);
    $previous = $currentIndex > 0 ? $projects->get($currentIndex - 1) : null;
    $next = $currentIndex < $projects->count() - 1 ? $projects->get($currentIndex + 1) : null;

    return view('projects.show', compact('project', 'previous', 'next'));
})->name('projects.show');
