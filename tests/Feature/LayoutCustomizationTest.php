<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Filament\Pages\CustomizeFooter;
use App\Filament\Pages\CustomizeHeader;
use App\Models\LayoutSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LayoutCustomizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_renders_with_default_header_and_footer(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Protofoly');
        $response->assertSee('Work');
        $response->assertSee('About');
        $response->assertSee('Contact');
        $response->assertSee('All rights reserved');
        $response->assertDontSee('Studio Panel');
    }

    public function test_guest_is_redirected_when_accessing_customization_pages(): void
    {
        $this->get('/dashboard/layout/header')->assertRedirect('/dashboard/login');
        $this->get('/dashboard/layout/footer')->assertRedirect('/dashboard/login');
    }

    public function test_authenticated_admin_can_access_customization_pages(): void
    {
        $admin = User::factory()->create();

        $this->actingAs($admin)
            ->get('/dashboard/layout/header')
            ->assertSuccessful()
            ->assertSee('Customize Site Header');

        $this->actingAs($admin)
            ->get('/dashboard/layout/footer')
            ->assertSuccessful()
            ->assertSee('Customize Site Footer');
    }

    public function test_header_can_be_customized_via_livewire_page_and_renders_on_frontend(): void
    {
        $admin = User::factory()->create();

        $customHeaderBlocks = [
            [
                'type' => 'masonBrick',
                'attrs' => [
                    'id' => 'announcement-bar',
                    'config' => [
                        'badge' => 'SPECIAL',
                        'message' => 'Limited Edition Case Study Available Now',
                        'link_label' => 'Explore →',
                        'link_url' => '/#case-study',
                        'theme' => 'amber',
                        'is_dismissible' => false,
                    ],
                ],
            ],
            [
                'type' => 'masonBrick',
                'attrs' => [
                    'id' => 'header-nav',
                    'config' => [
                        'brand_name' => 'CustomBrand Studio',
                        'brand_badge' => 'v2.5',
                        'brand_url' => '/',
                        'links' => [
                            ['label' => 'Showcase', 'url' => '/#showcase', 'is_external' => false],
                            ['label' => 'Pricing', 'url' => '/#pricing', 'is_external' => false],
                        ],
                        'show_theme_toggle' => true,
                        'show_cta' => true,
                        'cta_label' => 'Hire Us',
                        'cta_url' => '/#hire',
                        'is_sticky' => true,
                        'is_glassmorphism' => true,
                    ],
                ],
            ],
        ];

        Livewire::actingAs($admin)
            ->test(CustomizeHeader::class)
            ->set('data.header_content', $customHeaderBlocks)
            ->call('save')
            ->assertHasNoErrors()
            ->assertNotified('Header saved');

        // Verify the database record has been persisted
        $setting = LayoutSetting::first();
        $this->assertNotNull($setting);
        $this->assertIsArray($setting->header_content);
        $this->assertEquals('CustomBrand Studio', $setting->header_content[1]['attrs']['config']['brand_name']);

        // Verify frontend displays custom header content
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('CustomBrand Studio');
        $response->assertSee('v2.5');
        $response->assertSee('Showcase');
        $response->assertSee('Pricing');
        $response->assertSee('Hire Us');
        $response->assertSee('Limited Edition Case Study Available Now');
        $response->assertDontSee('Studio Panel');
    }

    public function test_footer_can_be_customized_via_livewire_page_and_renders_on_frontend(): void
    {
        $admin = User::factory()->create();

        $customFooterBlocks = [
            [
                'type' => 'masonBrick',
                'attrs' => [
                    'id' => 'footer-newsletter',
                    'config' => [
                        'heading' => 'Join the Creative Collective',
                        'subheading' => 'Exclusive insights delivered weekly.',
                        'button_label' => 'Subscribe Now',
                        'placeholder' => 'alex@design.studio',
                    ],
                ],
            ],
            [
                'type' => 'masonBrick',
                'attrs' => [
                    'id' => 'footer-bottom',
                    'config' => [
                        'copyright_text' => '© {year} CustomBrand Inc. All rights reserved.',
                        'social_links' => [
                            ['platform' => 'github', 'url' => 'https://github.com/custombrand', 'label' => 'GitHub'],
                        ],
                    ],
                ],
            ],
        ];

        Livewire::actingAs($admin)
            ->test(CustomizeFooter::class)
            ->set('data.footer_content', $customFooterBlocks)
            ->call('save')
            ->assertHasNoErrors()
            ->assertNotified('Footer saved');

        // Verify the database record has been persisted
        $setting = LayoutSetting::first();
        $this->assertNotNull($setting);
        $this->assertIsArray($setting->footer_content);

        // Verify frontend displays custom footer content
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Join the Creative Collective');
        $response->assertSee('Subscribe Now');
        $response->assertSee('CustomBrand Inc. All rights reserved.');
    }

    public function test_load_starter_template_and_reset_actions_work(): void
    {
        $admin = User::factory()->create();

        // 1. Test load starter template in header
        Livewire::actingAs($admin)
            ->test(CustomizeHeader::class)
            ->callAction('loadStarterTemplate')
            ->assertNotified('Starter template loaded')
            ->assertSet('data.header_content', LayoutSetting::defaultHeaderBlocks());

        // 2. Test reset to default clears custom header
        Livewire::actingAs($admin)
            ->test(CustomizeHeader::class)
            ->callAction('resetToDefault')
            ->assertNotified('Header reset')
            ->assertSet('data.header_content', null);

        $this->assertNull(LayoutSetting::first()->header_content);
    }
}
