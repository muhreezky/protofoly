<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class LayoutSetting extends Model
{
    protected $fillable = [
        'header_content',
        'footer_content',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'header_content' => 'array',
            'footer_content' => 'array',
        ];
    }

    public static function current(): self
    {
        try {
            return Cache::rememberForever('site_layout_settings', function () {
                return static::firstOrCreate([], [
                    'header_content' => null,
                    'footer_content' => null,
                ]);
            });
        } catch (\Throwable) {
            return new static([
                'header_content' => null,
                'footer_content' => null,
            ]);
        }
    }

    public static function clearCache(): void
    {
        Cache::forget('site_layout_settings');
    }

    /**
     * Starter default header blocks matching the initial Protofoly design.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function defaultHeaderBlocks(): array
    {
        return [
            [
                'type' => 'masonBrick',
                'attrs' => [
                    'id' => 'header-nav',
                    'config' => [
                        'brand_name' => 'Protofoly',
                        'brand_badge' => '',
                        'brand_url' => '/',
                        'links' => [
                            ['label' => 'Work', 'url' => '/#work', 'is_external' => false],
                            ['label' => 'About', 'url' => '/#about', 'is_external' => false],
                            ['label' => 'Contact', 'url' => '/#contact', 'is_external' => false],
                        ],
                        'show_theme_toggle' => true,
                        'show_cta' => true,
                        'cta_label' => "Let's Talk",
                        'cta_url' => '/#contact',
                        'is_sticky' => true,
                        'is_glassmorphism' => true,
                    ],
                ],
            ],
        ];
    }

    /**
     * Starter default footer blocks matching the initial Protofoly design.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function defaultFooterBlocks(): array
    {
        return [
            [
                'type' => 'masonBrick',
                'attrs' => [
                    'id' => 'footer-columns',
                    'config' => [
                        'brand_name' => 'Protofoly',
                        'tagline' => 'A showcase of modern web engineering, bespoke design systems, and resilient full-stack applications. Crafted with Laravel 13, Filament v5, and Tailwind CSS.',
                        'show_status_indicator' => true,
                        'status_text' => 'All systems operating normally',
                        'columns' => [
                            [
                                'title' => 'Navigation',
                                'links' => [
                                    ['label' => 'Work', 'url' => '/#work', 'is_external' => false],
                                    ['label' => 'About', 'url' => '/#about', 'is_external' => false],
                                    ['label' => 'Contact', 'url' => '/#contact', 'is_external' => false],
                                ],
                            ],
                            [
                                'title' => 'Workspace',
                                'links' => [
                                    ['label' => 'Filament Dashboard', 'url' => '/dashboard', 'is_external' => false],
                                    ['label' => 'Laravel 13 Ecosystem', 'url' => 'https://laravel.com', 'is_external' => true],
                                    ['label' => 'Filament v5', 'url' => 'https://filamentphp.com', 'is_external' => true],
                                    ['label' => 'Tailwind CSS v4', 'url' => 'https://tailwindcss.com', 'is_external' => true],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'masonBrick',
                'attrs' => [
                    'id' => 'footer-bottom',
                    'config' => [
                        'copyright_text' => '© {year} Protofoly. All rights reserved.',
                        'social_links' => [
                            ['platform' => 'github', 'url' => 'https://github.com', 'label' => 'GitHub profile'],
                            ['platform' => 'twitter', 'url' => 'https://twitter.com', 'label' => 'Twitter X profile'],
                            ['platform' => 'linkedin', 'url' => 'https://linkedin.com', 'label' => 'LinkedIn profile'],
                        ],
                    ],
                ],
            ],
        ];
    }
}
