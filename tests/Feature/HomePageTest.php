<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_home_page_is_available(): void
    {
        $this->get('/')->assertOk()->assertSee('Alecz')->assertSee('Alejandro Fedle Rueda Jiménez')->assertSee('Software Developer')->assertSee('Product Builder')->assertSee('Convierto problemas reales en software que funciona.')->assertSee('Ver proyectos')->assertSee('Conocerme')->assertSee('alecz@dev:~$');
    }

    public function test_featured_projects_are_rendered(): void
    {
        $this->get('/')->assertOk()->assertSee('~/projects')->assertSee('Trabajo real. Productos en funcionamiento.')->assertSee('Citas CRIT')->assertSee('Digital Persona SchoolBio')->assertSee('Baseball App')->assertSee('DocTotal')->assertSee('URPE Gestión Clínica')->assertSee('AcadControl')->assertSee('AcadNotify')->assertSee('ChamiloBridge')->assertSee('PROBLEMA')->assertSee('SOLUCIÓN')->assertSee('Ver case study')->assertSee('/proyectos/citas-crit')->assertSee('/proyectos/digital-persona-schoolbio')->assertSee('/proyectos/baseball-app');
    }

    public function test_secondary_projects_are_rendered_below_featured_work(): void
    {
        $response = $this->get('/')->assertOk();
        $response->assertSee('~/more')->assertSee('También he construido.')->assertSee('PartyX')->assertSee('RSVP + panel de invitados');
        $content = $response->getContent();
        $this->assertLessThan(strpos($content, 'PartyX'), strpos($content, 'AcadControl'));
    }

    public function test_services_are_commercial_bilingual_and_backed_by_real_projects(): void
    {
        $this->get('/')->assertOk()->assertSee('~/servicios')->assertSee('~/services')->assertSee('¿Qué puedo construir contigo?')->assertSee('Plataformas web y productos SaaS')->assertSee('Aplicaciones móviles')->assertSee('Sistemas especializados de gestión')->assertSee('Integraciones y automatización')->assertSee('Software conectado con hardware')->assertSee('Productos digitales a medida')->assertSee('DocTotal')->assertSee('Citas CRIT')->assertSee('Digital Persona SchoolBio')->assertSee('Cuéntame tu proyecto')->assertDontSee('precio desde')->assertDontSee('github.com/alecz2303');
        $this->get('/en')->assertOk()->assertSee('~/services')->assertSee('What can I build with you?')->assertSee('Web platforms and SaaS products')->assertSee('Mobile applications')->assertSee('Specialized management systems')->assertSee('Integrations and automation')->assertSee('Software connected to hardware')->assertSee('Tailored digital products')->assertSee('Tell me about your project')->assertSee('data-services-label="Explore services"', false);
    }

    public function test_command_dock_is_persistent_bilingual_and_accessible(): void
    {
        $this->get('/')->assertOk()->assertSee('data-command-dock', false)->assertSee('data-dock-section="proyectos"', false)->assertSee('data-dock-section="servicios"', false)->assertSee('data-dock-section="sobre-mi"', false)->assertSee('data-dock-section="contacto"', false)->assertSee('↑ root')->assertSee('aria-label="Volver arriba"', false);
        $this->get('/en')->assertOk()->assertSee('data-command-dock', false)->assertSee('↑ root')->assertSee('aria-label="Back to top"', false);
        $this->get('/proyectos/citas-crit')->assertOk()->assertDontSee('data-command-dock', false);
    }

    public function test_about_stack_and_experience_sections_are_rendered(): void
    {
        $this->get('/')->assertOk()->assertSee('~/about')->assertSee('Código con contexto de negocio.')->assertSee('Producto antes que código')->assertSee('~/stack')->assertSee('Laravel · PHP · Blade')->assertSee('Flutter · Dart')->assertSee('C# · .NET · Biometría')->assertSee('GitHub · CI · Jira')->assertSee('~/experience')->assertSee('Construir. Aprender. Repetir.')->assertSee('De necesidades reales a software utilizable')->assertSee('Proceso técnico verificable');
    }

    public function test_contact_and_home_seo_are_rendered(): void
    {
        $this->get('/')->assertOk()->assertSee('~/contact')->assertSee('¿Qué necesitas resolver?')->assertDontSee('valga la pena resolver')->assertSee('Abrir asistente')->assertSee('Asistente de Alecz')->assertSee('English')->assertDontSee('https://github.com/alecz2303')->assertSee('<meta name="description" content="Portafolio de Alejandro Fedle Rueda Jiménez', false)->assertSee('<meta property="og:title"', false)->assertSee('<link rel="canonical" href="http://localhost">', false)->assertSee('hreflang="en" href="http://localhost/en"', false);
    }
}
