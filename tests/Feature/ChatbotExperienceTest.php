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
            ->assertSee('data-chat-copy', false)
            ->assertSee('data-chat-endpoint', false)
            ->assertSee('data-chat-form', false)
            ->assertSee('data-chat-input', false)
            ->assertSee('Necesito una app para citas y pagos')
            ->assertSee('Citas CRIT')
            ->assertSee('Digital Persona SchoolBio')
            ->assertSee('Baseball App')
            ->assertSee('DocTotal')
            ->assertSee('URPE Gestión Clínica')
            ->assertSee('AcadControl');
    }

    public function test_chatbot_exposes_lead_qualification_without_persistence_claims(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('data-chat-topic="lead"', false)
            ->assertSee('Quiero cotizar un proyecto')
            ->assertSee('No guardamos esta conversación en base de datos.')
            ->assertSee('No necesitas compartir datos sensibles.');
    }

    public function test_quick_actions_can_collapse_after_conversation_starts(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('id="portfolio-chat-options"', false)
            ->assertSee('data-chat-options', false)
            ->assertSee('data-chat-options-toggle', false)
            ->assertSee('aria-controls="portfolio-chat-options"', false)
            ->assertSee('>Opciones</button>', false);

        $javascript = file_get_contents(resource_path('js/app.js'));
        $spanish = require resource_path('../lang/es/ui.php');
        $english = require resource_path('../lang/en/ui.php');

        $this->assertStringContainsString('collapseQuickOptions', $javascript);
        $this->assertStringContainsString('options.hidden = !visible', $javascript);
        $this->assertStringContainsString('visible ? copy.hide_options : copy.options', $javascript);
        $this->assertSame('Ocultar opciones', $spanish['chat']['hide_options']);
        $this->assertSame('Hide options', $english['chat']['hide_options']);
        $this->assertStringContainsString('const submitQuery = async (query) => {', $javascript);
        $this->assertStringContainsString('collapseQuickOptions();', $javascript);
        $this->assertStringContainsString("if (topic === 'lead')", $javascript);
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

    public function test_unconfigured_channels_do_not_create_broken_direct_links(): void
    {
        config()->set('profile.contact.whatsapp', null);
        config()->set('profile.contact.email', null);

        $this->get('/')
            ->assertOk()
            ->assertSee('data-whatsapp=""', false)
            ->assertSee('data-email=""', false)
            ->assertDontSee('https://wa.me/', false)
            ->assertDontSee('mailto:', false)
            ->assertSee('El asistente ya puede ayudarte a explorar el portafolio.');
    }

    public function test_lead_handoff_logic_is_client_side_and_builds_prefilled_channels(): void
    {
        $javascript = file_get_contents(resource_path('js/app.js'));
        $handoff = file_get_contents(resource_path('js/contact-handoff.js'));
        $spanish = require resource_path('../lang/es/ui.php');
        $english = require resource_path('../lang/en/ui.php');

        $this->assertStringContainsString('buildLeadSummary', $javascript);
        $this->assertStringContainsString('copy.actions.wa_summary', $javascript);
        $this->assertStringContainsString('copy.actions.mail_summary', $javascript);
        $this->assertSame('Enviar resumen por WhatsApp ↗', $spanish['chat']['actions']['wa_summary']);
        $this->assertSame('Send summary on WhatsApp ↗', $english['chat']['actions']['wa_summary']);
        $this->assertStringContainsString('?text=${encodedSummary}', $javascript);
        $this->assertStringContainsString('subject=${subject}&body=${encodedSummary}', $javascript);
        $this->assertStringContainsString('Hola Alecz, me gustaría platicar sobre este proyecto:', $handoff);
        $this->assertStringContainsString('Hi Alecz, I would like to talk about this project:', $handoff);
        $this->assertStringContainsString('navigator.clipboard.writeText', $handoff);
        $this->assertStringContainsString('Copiar resumen del proyecto', $handoff);
        $this->assertStringContainsString('Copy project summary', $handoff);
        $this->assertStringNotContainsString('localStorage', $javascript.$handoff);
        $this->assertStringNotContainsString('sessionStorage', $javascript.$handoff);
    }
}
