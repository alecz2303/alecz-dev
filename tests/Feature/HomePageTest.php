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
            ->assertSee('Productos reales.')
            ->assertSee('Citas CRIT')
            ->assertSee('DocTotal')
            ->assertSee('URPE Gestión Clínica')
            ->assertSee('AcadControl')
            ->assertSee('PROBLEMA')
            ->assertSee('SOLUCIÓN')
            ->assertSee('Case study próximamente');
    }
}
