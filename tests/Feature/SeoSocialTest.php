<?php

namespace Tests\Feature;

use Tests\TestCase;

class SeoSocialTest extends TestCase
{
    public function test_home_exposes_bilingual_social_metadata_and_profile_schema(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('property="og:image"', false)
            ->assertSee('/media/social/alecz-social-card-v2.png', false)
            ->assertSee('property="og:image:width" content="1200"', false)
            ->assertSee('property="og:image:height" content="630"', false)
            ->assertSee('twitter:card" content="summary_large_image"', false)
            ->assertSee('twitter:image', false)
            ->assertSee('Alecz — Software Developer · Product Builder. Portafolio de productos digitales reales.')
            ->assertSee('application/ld+json', false)
            ->assertSee('"@type":"ProfilePage"', false)
            ->assertSee('"@type":"Person"', false)
            ->assertSee('"jobTitle":"Software Developer · Product Builder"', false)
            ->assertDontSee('github.com/alecz2303');

        $this->get('/en')
            ->assertOk()
            ->assertSee('property="og:locale" content="en_US"', false)
            ->assertSee('Alecz — Software Developer · Product Builder. Portfolio of real digital products.')
            ->assertSee('"inLanguage":"en"', false)
            ->assertSee('hreflang="es"', false)
            ->assertSee('hreflang="en"', false);
    }

    public function test_case_study_exposes_creative_work_schema_and_social_card(): void
    {
        $this->get('/proyectos/citas-crit')
            ->assertOk()
            ->assertSee('property="og:type" content="article"', false)
            ->assertSee('/media/social/alecz-social-card-v2.png', false)
            ->assertSee('"@type":"CreativeWork"', false)
            ->assertSee('"name":"Citas CRIT · Case Study"', false)
            ->assertSee('"author":{"@type":"Person"', false)
            ->assertSee('rel="canonical" href="http://localhost/proyectos/citas-crit"', false)
            ->assertSee('hreflang="en" href="http://localhost/en/projects/citas-crit"', false);
    }

    public function test_social_card_asset_exists_and_has_expected_dimensions(): void
    {
        $path = public_path(config('seo.social.image'));

        $this->assertFileExists($path);
        [$width, $height] = getimagesize($path);
        $this->assertSame(1200, $width);
        $this->assertSame(630, $height);
        $this->assertSame('image/png', mime_content_type($path));
        $this->assertSame('image/png', config('seo.social.type'));
    }
}
