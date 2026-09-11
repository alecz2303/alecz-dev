<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProjectCaseStudyTest extends TestCase
{
    public function test_each_featured_project_has_a_case_study_page(): void
    {
        $projects = config('portfolio.projects', []);

        $this->assertCount(6, $projects);

        foreach ($projects as $project) {
            $response = $this->get(route('projects.show', $project['slug']))
                ->assertOk()
                ->assertSee($project['name'])
                ->assertSee($project['summary'])
                ->assertSee('Lo que ya existe')
                ->assertSee('Las capturas se muestran solo cuando existe media configurada.')
                ->assertSee('El contexto.')
                ->assertSee('El problema.')
                ->assertSee('La solución.')
                ->assertSee('Qué resuelve.')
                ->assertSee('Cómo está construido.')
                ->assertSee('Stack.')
                ->assertSee('<title>'.$project['name'].' · Case Study · Alecz</title>', false)
                ->assertSee('<meta name="description" content="'.e($project['summary']).'">', false)
                ->assertSee('<meta property="og:url"', false)
                ->assertSee('<link rel="canonical"', false);

            if ($project['slug'] !== 'digital-persona-schoolbio') {
                $response->assertSee('Product snapshot');
            }
        }
    }

    public function test_case_study_can_render_configured_media_with_accessible_metadata(): void
    {
        $projects = config('portfolio.projects', []);
        $projects[0]['media'] = [
            [
                'role' => 'hero',
                'src' => 'favicon.svg',
                'alt' => 'Vista principal de Citas CRIT',
                'caption' => 'Evidencia visual real de Citas CRIT.',
            ],
            [
                'src' => 'favicon.svg?gallery=1',
                'alt' => 'Detalle visual de Citas CRIT',
                'caption' => 'Ejemplo de caption para media real.',
            ],
        ];
        config()->set('portfolio.projects', $projects);

        $this->get('/proyectos/citas-crit')
            ->assertOk()
            ->assertSee('src="'.asset('favicon.svg').'"', false)
            ->assertSee('alt="Vista principal de Citas CRIT"', false)
            ->assertSee('Evidencia visual real de Citas CRIT.')
            ->assertSee('alt="Detalle visual de Citas CRIT"', false)
            ->assertSee('Ejemplo de caption para media real.');
    }

    public function test_schoolbio_uses_real_public_safe_media_in_spanish_and_english(): void
    {
        $this->get('/proyectos/digital-persona-schoolbio')
            ->assertOk()
            ->assertSee('media/projects/schoolbio/registro-biometrico.webp')
            ->assertSee('Pantalla real de SchoolBio para el registro biométrico de alumnos mediante huella digital.')
            ->assertSee('Registro biométrico real de SchoolBio')
            ->assertDontSee('Product snapshot');

        $this->get('/en/projects/digital-persona-schoolbio')
            ->assertOk()
            ->assertSee('media/projects/schoolbio/registro-biometrico.webp')
            ->assertSee('Real SchoolBio screen for student fingerprint biometric enrollment.')
            ->assertSee('Real SchoolBio biometric enrollment')
            ->assertDontSee('Product snapshot');
    }

    public function test_schoolbio_case_study_describes_biometrics_hardware_and_api(): void
    {
        $this->get('/proyectos/digital-persona-schoolbio')
            ->assertOk()
            ->assertSee('Digital Persona SchoolBio')
            ->assertSee('Enrolamiento de huellas')
            ->assertSee('Integración con hardware Digital Persona')
            ->assertSee('SchoolBio API');
    }

    public function test_baseball_case_study_describes_product_depth(): void
    {
        $this->get('/proyectos/baseball-app')
            ->assertOk()
            ->assertSee('Scoring jugada a jugada')
            ->assertSee('Estadísticas de pitcher')
            ->assertSee('Exportación PDF y Excel')
            ->assertSee('Google Drive')
            ->assertSee('Free/Pro');
    }

    public function test_acadcontrol_case_study_keeps_suite_context(): void
    {
        $this->get('/proyectos/acadcontrol')
            ->assertOk()
            ->assertSee('AcadControl')
            ->assertSee('AcadNotify')
            ->assertSee('ChamiloBridge');
    }

    public function test_unknown_project_slug_returns_not_found(): void
    {
        $this->get('/proyectos/no-existe')->assertNotFound();
    }
}
