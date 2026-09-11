<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductionDeploymentTest extends TestCase
{
    public function test_cpanel_front_controller_targets_private_application_root_and_public_html(): void
    {
        $index = file_get_contents(base_path('deploy/cpanel/public-index.php'));

        $this->assertStringContainsString("dirname(__DIR__).'/alecz-app'", $index);
        $this->assertStringContainsString("/vendor/autoload.php", $index);
        $this->assertStringContainsString("/bootstrap/app.php", $index);
        $this->assertStringContainsString('$app->usePublicPath(__DIR__);', $index);
        $this->assertStringNotContainsString("/home/alecz/public_html", $index);
    }

    public function test_production_environment_example_is_safe_and_targets_public_domain(): void
    {
        $env = file_get_contents(base_path('deploy/cpanel/.env.production.example'));

        $this->assertStringContainsString('APP_ENV=production', $env);
        $this->assertStringContainsString('APP_DEBUG=false', $env);
        $this->assertStringContainsString('APP_URL=https://alecz.dev', $env);
        $this->assertStringContainsString('PORTFOLIO_WHATSAPP=529611120913', $env);
        $this->assertStringContainsString('PORTFOLIO_EMAIL=me@alecz.dev', $env);
        $this->assertStringContainsString('CHATBOT_PROVIDER=local', $env);
        $this->assertMatchesRegularExpression('/^APP_KEY=$/m', $env);
        $this->assertStringNotContainsString('CHATBOT_REMOTE_KEY=sk-', $env);
    }

    public function test_cpanel_deployment_guide_keeps_private_files_outside_public_html(): void
    {
        $guide = file_get_contents(base_path('DEPLOY_CPANEL.md'));

        $this->assertStringContainsString('/home/alecz/alecz-app', $guide);
        $this->assertStringContainsString('/home/alecz/public_html', $guide);
        $this->assertStringContainsString('No usar `777`', $guide);
        $this->assertStringContainsString('public_html` nunca debe contener `.env`', $guide);
    }

    public function test_deployment_workflow_builds_vendor_frontend_and_separate_archives(): void
    {
        $workflow = file_get_contents(base_path('.github/workflows/deploy-package.yml'));

        $this->assertStringContainsString('composer install --no-dev', $workflow);
        $this->assertStringContainsString('npm run build', $workflow);
        $this->assertStringContainsString('public/build/manifest.json', $workflow);
        $this->assertStringContainsString('alecz-app.zip', $workflow);
        $this->assertStringContainsString('public_html.zip', $workflow);
        $this->assertStringContainsString("--exclude='.env'", $workflow);
    }
}
