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
            $this->get(route('projects.show', $project['slug']))
                ->assertOk()
                ->assertSee($project['name'])
                ->assertSee($project['summary'])
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
        }
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
