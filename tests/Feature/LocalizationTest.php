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
            ->assertSee('hreflang="en" href="http://localhost/en"', false);
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
