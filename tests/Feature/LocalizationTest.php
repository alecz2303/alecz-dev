<?php

namespace Tests\Feature;

use Tests\TestCase;

class LocalizationTest extends TestCase
{
    public function test_english_home_is_available_and_fully_localized(): void
    {
        $this->get('/en')
            ->assertOk()
            ->assertSee('<html lang="en">', false)
            ->assertSee('I turn real-world problems into software that works.')
            ->assertSee('Real work. Working products.')
            ->assertSee('Code with business context.')
            ->assertSee('Technology as a tool.')
            ->assertSee('Build. Learn. Repeat.')
            ->assertSee('What do you need to solve?')
            ->assertSee('Talk to the assistant')
            ->assertSee('Español')
            ->assertDontSee('¿Qué necesitas resolver?')
            ->assertSee('hreflang="es" href="http://localhost"', false)
            ->assertSee('hreflang="en" href="http://localhost/en"', false)
            ->assertSee('href="#proyectos"', false)
            ->assertSee('href="#servicios"', false)
            ->assertSee('href="#sobre-mi"', false)
            ->assertSee('href="#contacto"', false);
    }

    public function test_spanish_home_navigation_uses_local_fragments(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('<html lang="es">', false)
            ->assertSee('href="#proyectos"', false)
            ->assertSee('href="#servicios"', false)
            ->assertSee('href="#sobre-mi"', false)
            ->assertSee('href="#contacto"', false);
    }

    public function test_internal_navigation_returns_to_the_equivalent_locale_home(): void
    {
        $this->get('/proyectos/citas-crit')
            ->assertOk()
            ->assertSee('href="http://localhost#proyectos"', false)
            ->assertSee('href="http://localhost#servicios"', false)
            ->assertSee('href="http://localhost#sobre-mi"', false)
            ->assertSee('href="http://localhost#contacto"', false);

        $this->get('/en/projects/citas-crit')
            ->assertOk()
            ->assertSee('href="http://localhost/en#proyectos"', false)
            ->assertSee('href="http://localhost/en#servicios"', false)
            ->assertSee('href="http://localhost/en#sobre-mi"', false)
            ->assertSee('href="http://localhost/en#contacto"', false);
    }

    public function test_mobile_menu_has_a_solid_high_contrast_panel(): void
    {
        $css = file_get_contents(resource_path('css/localization.css'));

        $this->assertStringContainsString('background: #0a0d12;', $css);
        $this->assertStringContainsString('z-index: 90;', $css);
        $this->assertStringContainsString('color: #f7f8fb;', $css);
        $this->assertStringContainsString('backdrop-filter: none;', $css);
    }

    public function test_english_case_study_uses_english_content_and_navigation(): void
    {
        $this->get('/en/projects/citas-crit')
            ->assertOk()
            ->assertSee('<html lang="en">', false)
            ->assertSee('Back to ~/projects')
            ->assertSee('Published on Google Play')
            ->assertSee('The context.')
            ->assertSee('The problem.')
            ->assertSee('The solution.')
            ->assertSee('What it solves.')
            ->assertSee('/en/projects/digital-persona-schoolbio')
            ->assertSee('hreflang="es" href="http://localhost/proyectos/citas-crit"', false);
    }

    public function test_english_chat_endpoint_responds_in_english(): void
    {
        $this->postJson('/en/chat', ['message' => 'I need a clinical scheduling system'])
            ->assertOk()
            ->assertJsonPath('source', 'local')
            ->assertJsonPath('lead_intent', true)
            ->assertJsonFragment(['name' => 'URPE Gestión Clínica'])
            ->assertJsonMissing(['message' => 'No encontré una coincidencia clara todavía.']);
    }

    public function test_sitemap_contains_both_languages(): void
    {
        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertSee('http://localhost</loc>', false)
            ->assertSee('http://localhost/en</loc>', false)
            ->assertSee('http://localhost/proyectos/citas-crit</loc>', false)
            ->assertSee('http://localhost/en/projects/citas-crit</loc>', false);
    }
}
