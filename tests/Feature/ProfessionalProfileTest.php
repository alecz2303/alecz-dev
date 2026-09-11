<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProfessionalProfileTest extends TestCase
{
    public function test_professional_profile_is_bilingual_and_factual(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('~/profile')
            ->assertSee('PERFIL PROFESIONAL')
            ->assertSee('Construyo producto, no solo funcionalidades.')
            ->assertSee('Alejandro Fedle Rueda Jiménez')
            ->assertSee('Experiencia demostrada en productos reales')
            ->assertSee('Citas CRIT')
            ->assertSee('Digital Persona SchoolBio')
            ->assertSee('Baseball App')
            ->assertSee('DocTotal')
            ->assertSee('URPE Gestión Clínica')
            ->assertSee('AcadControl');

        $this->get('/en')
            ->assertOk()
            ->assertSee('~/profile')
            ->assertSee('PROFESSIONAL PROFILE')
            ->assertSee('I build products, not just features.')
            ->assertSee('Experience demonstrated through real products');
    }

    public function test_cv_link_is_hidden_until_an_approved_public_file_exists(): void
    {
        config()->set('profile.cv.path', null);
        $this->get('/')
            ->assertOk()
            ->assertDontSee('Descargar CV')
            ->assertSee('El CV descargable aparecerá únicamente cuando exista un archivo público aprobado.');

        config()->set('profile.cv.path', 'cv/not-present.pdf');
        $this->get('/en')
            ->assertOk()
            ->assertDontSee('Download CV')
            ->assertSee('The downloadable CV will appear only when an approved public file exists.');
    }

    public function test_professional_profile_is_not_injected_into_case_studies(): void
    {
        $this->get('/proyectos/citas-crit')
            ->assertOk()
            ->assertDontSee('id="perfil"', false)
            ->assertDontSee('Construyo producto, no solo funcionalidades.');
    }
}
