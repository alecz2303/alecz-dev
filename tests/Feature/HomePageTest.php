<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_home_page_is_available(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Alecz')
            ->assertSee('Alejandro Fedle Rueda Jiménez')
            ->assertSee('Software Developer')
            ->assertSee('Product Builder')
            ->assertSee('Convierto problemas reales en software que funciona.')
            ->assertSee('Ver proyectos')
            ->assertSee('Conocerme')
            ->assertSee('alecz@dev:~$');
    }

    public function test_featured_projects_are_rendered(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('~/projects')
            ->assertSee('Productos construidos')
            ->assertSee('Citas CRIT')
            ->assertSee('Digital Persona SchoolBio')
            ->assertSee('Baseball App')
            ->assertSee('DocTotal')
            ->assertSee('URPE Gestión Clínica')
            ->assertSee('AcadControl')
            ->assertSee('AcadNotify')
            ->assertSee('ChamiloBridge')
            ->assertSee('PROBLEMA')
            ->assertSee('SOLUCIÓN')
            ->assertSee('Ver case study')
            ->assertSee('/proyectos/citas-crit')
            ->assertSee('/proyectos/digital-persona-schoolbio')
            ->assertSee('/proyectos/baseball-app');
    }

    public function test_secondary_projects_are_rendered_below_featured_work(): void
    {
        $response = $this->get('/')->assertOk();

        $response
            ->assertSee('~/more')
            ->assertSee('También he construido.')
            ->assertSee('PartyX')
            ->assertSee('RSVP + panel de invitados');

        $content = $response->getContent();
        $this->assertLessThan(strpos($content, 'PartyX'), strpos($content, 'AcadControl'));
    }

    public function test_about_stack_and_experience_sections_are_rendered(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('~/about')
            ->assertSee('Código con')
            ->assertSee('contexto de negocio.')
            ->assertSee('Producto antes que código')
            ->assertSee('~/stack')
            ->assertSee('Laravel · PHP · Blade')
            ->assertSee('Flutter · Dart')
            ->assertSee('C# · .NET · Biometría')
            ->assertSee('GitHub · CI · Jira')
            ->assertSee('~/experience')
            ->assertSee('Construir.')
            ->assertSee('De necesidades reales a software utilizable')
            ->assertSee('Proceso técnico verificable');
    }

    public function test_contact_and_home_seo_are_rendered(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('~/contact')
            ->assertSee('¿Qué necesitas')
            ->assertSee('Cuéntame qué necesitas construir, mejorar o automatizar.')
            ->assertDontSee('valga la pena resolver')
            ->assertSee('Abrir asistente')
            ->assertSee('Asistente de Alecz')
            ->assertDontSee('https://github.com/alecz2303')
            ->assertSee('<meta name="description" content="Portafolio de Alejandro Fedle Rueda Jiménez', false)
            ->assertSee('<meta property="og:title"', false)
            ->assertSee('<link rel="canonical" href="http://localhost">', false);
    }
}
