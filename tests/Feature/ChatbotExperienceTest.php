<?php

namespace Tests\Feature;

use Tests\TestCase;

class ChatbotExperienceTest extends TestCase
{
    public function test_chatbot_exposes_free_text_input_and_public_project_knowledge(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('data-chat-knowledge', false)
            ->assertSee('data-chat-form', false)
            ->assertSee('data-chat-input', false)
            ->assertSee('Necesito una app para citas y pagos')
            ->assertSee('Citas CRIT')
            ->assertSee('Digital Persona SchoolBio')
            ->assertSee('Baseball App')
            ->assertSee('DocTotal')
            ->assertSee('URPE Gestión Clínica')
            ->assertSee('AcadControl')
            ->assertSee('No consulta repositorios ni expone código fuente.');
    }

    public function test_chatbot_does_not_publish_repository_links(): void
    {
        $response = $this->get('/')->assertOk();

        $response
            ->assertDontSee('https://github.com/alecz2303', false)
            ->assertDontSee('Ver perfil en GitHub');
    }

    public function test_contact_channels_remain_environment_driven(): void
    {
        config()->set('profile.contact.whatsapp', '529611234567');
        config()->set('profile.contact.email', 'contacto@example.test');

        $this->get('/')
            ->assertOk()
            ->assertSee('data-whatsapp="529611234567"', false)
            ->assertSee('data-email="contacto@example.test"', false)
            ->assertSee('https://wa.me/529611234567', false)
            ->assertSee('mailto:contacto@example.test', false);
    }
}
