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

    public function test_approved_contact_channels_render_when_configured_in_spanish_and_english(): void
    {
        Config::set('profile.contact.whatsapp', '529611120913');
        Config::set('profile.contact.email', 'me@alecz.dev');

        foreach (['/', '/en'] as $uri) {
            $this->get($uri)
                ->assertOk()
                ->assertSee('data-whatsapp="529611120913"', false)
                ->assertSee('data-email="me@alecz.dev"', false)
                ->assertSee('https://wa.me/529611120913', false)
                ->assertSee('mailto:me@alecz.dev', false);
        }
    }

    public function test_contact_channels_remain_optional_when_not_configured(): void
    {
        Config::set('profile.contact.whatsapp', null);
        Config::set('profile.contact.email', null);

        $this->get('/')
            ->assertOk()
            ->assertDontSee('https://wa.me/', false)
            ->assertDontSee('mailto:', false);
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
