<?php

namespace Tests\Feature;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ServerChatTest extends TestCase
{
    public function test_chat_endpoint_uses_local_fallback_without_remote_provider(): void
    {
        config()->set('chatbot.provider', 'local');

        $this->postJson('/chat', ['message' => 'Necesito una plataforma para una clínica con citas'])
            ->assertOk()
            ->assertJsonPath('source', 'local')
            ->assertJsonPath('lead_intent', true)
            ->assertJsonFragment(['name' => 'URPE Gestión Clínica'])
            ->assertJsonMissingPath('error');
    }

    public function test_general_portfolio_question_does_not_trigger_lead_qualification(): void
    {
        config()->set('chatbot.provider', 'local');

        $this->postJson('/chat', ['message' => '¿Qué servicios puede construir Alecz?'])
            ->assertOk()
            ->assertJsonPath('source', 'local')
            ->assertJsonPath('lead_intent', false);
    }

    public function test_explicit_quote_request_triggers_lead_qualification(): void
    {
        config()->set('chatbot.provider', 'local');

        $this->postJson('/chat', ['message' => 'Quiero cotizar un proyecto'])
            ->assertOk()
            ->assertJsonPath('source', 'local')
            ->assertJsonPath('lead_intent', true);
    }

    public function test_chat_endpoint_validates_message_length(): void
    {
        $this->postJson('/chat', ['message' => str_repeat('a', 501)])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('message');
    }

    public function test_remote_provider_can_answer_using_only_public_portfolio_context(): void
    {
        config()->set('chatbot.provider', 'remote');
        config()->set('chatbot.remote.url', 'https://ai.example.test/chat');
        config()->set('chatbot.remote.key', 'super-secret-key');
        config()->set('chatbot.remote.model', 'portfolio-model');

        Http::fake([
            'https://ai.example.test/chat' => Http::response([
                'choices' => [[
                    'message' => ['content' => 'DocTotal es el case study más cercano a una plataforma SaaS.'],
                ]],
            ]),
        ]);

        $this->postJson('/chat', ['message' => 'Necesito construir un SaaS'])
            ->assertOk()
            ->assertJsonPath('source', 'remote')
            ->assertJsonPath('lead_intent', true)
            ->assertJsonPath('message', 'DocTotal es el case study más cercano a una plataforma SaaS.');

        Http::assertSent(function (Request $request) {
            $body = $request->body();

            return $request->url() === 'https://ai.example.test/chat'
                && str_contains($request->header('Authorization')[0] ?? '', 'super-secret-key')
                && ! str_contains($body, 'super-secret-key')
                && ! str_contains($body, 'github.com/alecz2303')
                && ! str_contains($body, 'hostlat.atlassian.net');
        });
    }

    public function test_remote_provider_failure_degrades_to_local_reply(): void
    {
        config()->set('chatbot.provider', 'remote');
        config()->set('chatbot.remote.url', 'https://ai.example.test/chat');
        config()->set('chatbot.remote.key', 'secret');
        config()->set('chatbot.remote.model', 'portfolio-model');

        Http::fake([
            'https://ai.example.test/chat' => Http::response(['error' => 'unavailable'], 503),
        ]);

        $this->postJson('/chat', ['message' => 'Necesito biometría para una escuela'])
            ->assertOk()
            ->assertJsonPath('source', 'local')
            ->assertJsonPath('lead_intent', true)
            ->assertJsonFragment(['name' => 'Digital Persona SchoolBio']);
    }

    public function test_remote_reply_with_repository_link_is_rejected(): void
    {
        config()->set('chatbot.provider', 'remote');
        config()->set('chatbot.remote.url', 'https://ai.example.test/chat');
        config()->set('chatbot.remote.key', 'secret');
        config()->set('chatbot.remote.model', 'portfolio-model');

        Http::fake([
            'https://ai.example.test/chat' => Http::response([
                'choices' => [[
                    'message' => ['content' => 'Puedes revisar https://github.com/example/private-repo'],
                ]],
            ]),
        ]);

        $this->postJson('/chat', ['message' => 'Necesito un SaaS'])
            ->assertOk()
            ->assertJsonPath('source', 'local')
            ->assertJsonPath('lead_intent', true)
            ->assertJsonMissingExact(['message' => 'Puedes revisar https://github.com/example/private-repo']);
    }

    public function test_remote_credentials_are_never_rendered_in_the_portfolio_html(): void
    {
        config()->set('chatbot.provider', 'remote');
        config()->set('chatbot.remote.url', 'https://ai.example.test/chat');
        config()->set('chatbot.remote.key', 'do-not-render-this-secret');
        config()->set('chatbot.remote.model', 'private-model-name');

        $this->get('/')
            ->assertOk()
            ->assertSee('data-chat-endpoint', false)
            ->assertDontSee('do-not-render-this-secret')
            ->assertDontSee('https://ai.example.test/chat')
            ->assertDontSee('private-model-name');
    }
}
