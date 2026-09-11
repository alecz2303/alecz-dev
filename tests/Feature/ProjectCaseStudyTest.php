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
            $this->get(route('projects.show', $project['slug']))->assertOk()->assertSee($project['name'])->assertSee($project['summary'])->assertSee('Lo que ya existe')->assertSee('El contexto.')->assertSee('El problema.')->assertSee('La solución.')->assertSee('Qué resuelve.')->assertSee('Cómo está construido.')->assertSee('Stack.')->assertSee('<title>'.$project['name'].' · Case Study · Alecz</title>', false);
        }
    }

    public function test_code_derived_previews_are_truthfully_labeled_in_both_locales(): void
    {
        foreach (['citas-crit','baseball-app','doctotal','urpe-gestion-clinica'] as $slug) {
            $this->get('/proyectos/'.$slug)->assertOk()->assertSee('CODE-DERIVED PREVIEW')->assertSee('Representación editorial derivada de código verificado del producto; no es una captura de la aplicación en ejecución.')->assertDontSee('Product snapshot');
            $this->get('/en/projects/'.$slug)->assertOk()->assertSee('CODE-DERIVED PREVIEW')->assertSee('Editorial representation derived from verified product code; it is not a runtime screenshot.')->assertDontSee('Product snapshot');
        }
    }

    public function test_visual_audit_registry_classifies_every_featured_project(): void
    {
        $audit = config('project_visuals');
        $this->assertSame('CODE-DERIVED PREVIEW', $audit['citas-crit']['classification']);
        $this->assertSame('CODE-DERIVED PREVIEW', $audit['baseball-app']['classification']);
        $this->assertSame('CODE-DERIVED PREVIEW', $audit['doctotal']['classification']);
        $this->assertSame('CODE-DERIVED PREVIEW', $audit['urpe-gestion-clinica']['classification']);
        $this->assertSame('NO PUBLIC VISUAL', $audit['acadcontrol']['classification']);
        $this->assertNotEmpty(config('project_media.digital-persona-schoolbio.es'));
    }

    public function test_schoolbio_uses_real_public_safe_media_in_spanish_and_english(): void
    {
        $this->get('/proyectos/digital-persona-schoolbio')->assertOk()->assertSee('media/projects/schoolbio/registro-biometrico.webp')->assertSee('Registro biométrico real de SchoolBio')->assertDontSee('CODE-DERIVED PREVIEW');
        $this->get('/en/projects/digital-persona-schoolbio')->assertOk()->assertSee('media/projects/schoolbio/registro-biometrico.webp')->assertSee('Real SchoolBio biometric enrollment')->assertDontSee('CODE-DERIVED PREVIEW');
    }

    public function test_acadcontrol_keeps_fallback_when_no_verifiable_public_visual_exists(): void
    {
        $this->get('/proyectos/acadcontrol')->assertOk()->assertSee('Product snapshot')->assertDontSee('CODE-DERIVED PREVIEW');
    }

    public function test_baseball_case_study_describes_product_depth(): void
    {
        $this->get('/proyectos/baseball-app')->assertOk()->assertSee('Scoring jugada a jugada')->assertSee('Estadísticas de pitcher')->assertSee('Exportación PDF y Excel')->assertSee('Google Drive')->assertSee('Free/Pro');
    }

    public function test_acadcontrol_case_study_keeps_suite_context(): void
    {
        $this->get('/proyectos/acadcontrol')->assertOk()->assertSee('AcadControl')->assertSee('AcadNotify')->assertSee('ChamiloBridge');
    }

    public function test_unknown_project_slug_returns_not_found(): void
    {
        $this->get('/proyectos/no-existe')->assertNotFound();
    }
}
