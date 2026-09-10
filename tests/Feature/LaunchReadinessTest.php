<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class LaunchReadinessTest extends TestCase
{
    public function test_home_exposes_launch_metadata_and_chatbot_without_public_github_link(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('rel="icon"', false)
            ->assertSee('favicon.svg', false)
            ->assertSee('og:site_name', false)
            ->assertSee('twitter:card', false)
            ->assertSee('Asistente de Alecz')
            ->assertSee('¿Qué puede construir?')
            ->assertDontSee('https://github.com/alecz2303');
    }

    public function test_contact_channels_only_render_when_configured(): void
    {
        Config::set('profile.contact.whatsapp', '5215551234567');
        Config::set('profile.contact.email', 'hola@example.test');

        $this->get('/')
            ->assertOk()
            ->assertSee('https://wa.me/5215551234567', false)
            ->assertSee('mailto:hola@example.test', false);
    }

    public function test_sitemap_contains_home_and_all_featured_case_studies(): void
    {
        $response = $this->get('/sitemap.xml')
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml; charset=UTF-8');

        $response->assertSee(route('home'), false);

        foreach (config('portfolio.projects', []) as $project) {
            $response->assertSee(route('projects.show', $project['slug']), false);
        }
    }

    public function test_robots_blocks_indexing_outside_production(): void
    {
        $this->get('/robots.txt')
            ->assertOk()
            ->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
            ->assertSee('User-agent: *')
            ->assertSee('Disallow: /');
    }
}
