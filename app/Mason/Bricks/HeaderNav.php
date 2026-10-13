<?php

declare(strict_types=1);

namespace App\Mason\Bricks;

use Awcodes\Mason\Brick;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class HeaderNav extends Brick
{
    public static function getId(): string
    {
        return 'header-nav';
    }

    public static function getLabel(): string
    {
        return 'Header Navigation';
    }

    public static function getIcon(): string|Heroicon|Htmlable|null
    {
        return new HtmlString('<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"></line><line x1="4" x2="20" y1="6" y2="6"></line><line x1="4" x2="20" y1="18" y2="18"></line></svg>');
    }

    public static function getTags(): array
    {
        return ['header', 'navbar', 'menu', 'navigation', 'branding'];
    }

    public static function getOutlineLabel(array $config): ?string
    {
        return $config['brand_name'] ?? 'Header Navigation';
    }

    public static function toHtml(array $config, ?array $data = null): ?string
    {
        return view('mason.bricks.header-nav', [
            'brand_name' => $config['brand_name'] ?? config('app.name', 'Protofoly'),
            'brand_badge' => $config['brand_badge'] ?? 'v1.0',
            'brand_url' => $config['brand_url'] ?? '/',
            'links' => $config['links'] ?? [
                ['label' => 'Work', 'url' => '/#work', 'is_external' => false],
                ['label' => 'About', 'url' => '/#about', 'is_external' => false],
                ['label' => 'Contact', 'url' => '/#contact', 'is_external' => false],
            ],
            'show_theme_toggle' => $config['show_theme_toggle'] ?? true,
            'show_cta' => $config['show_cta'] ?? true,
            'cta_label' => $config['cta_label'] ?? "Let's Talk",
            'cta_url' => $config['cta_url'] ?? '/#contact',
            'is_sticky' => $config['is_sticky'] ?? true,
            'is_glassmorphism' => $config['is_glassmorphism'] ?? true,
        ])->render();
    }

    public static function configureBrickAction(Action $action): Action
    {
        return $action
            ->slideOver()
            ->modalHeading('Configure Header Navigation')
            ->schema([
                Section::make('Branding')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('brand_name')
                                ->label('Brand Name')
                                ->default(config('app.name', 'Protofoly'))
                                ->required(),
                            TextInput::make('brand_badge')
                                ->label('Badge / Version')
                                ->default('v1.0')
                                ->placeholder('e.g. v1.0 or PRO'),
                        ]),
                        TextInput::make('brand_url')
                            ->label('Brand Link URL')
                            ->default('/')
                            ->required(),
                    ]),

                Section::make('Navigation Links')
                    ->schema([
                        Repeater::make('links')
                            ->label('Menu Items')
                            ->schema([
                                TextInput::make('label')
                                    ->label('Label')
                                    ->required(),
                                TextInput::make('url')
                                    ->label('URL')
                                    ->required(),
                                Toggle::make('is_external')
                                    ->label('Open in new tab')
                                    ->default(false),
                            ])
                            ->default([
                                ['label' => 'Work', 'url' => '/#work', 'is_external' => false],
                                ['label' => 'About', 'url' => '/#about', 'is_external' => false],
                                ['label' => 'Contact', 'url' => '/#contact', 'is_external' => false],
                            ])
                            ->collapsible()
                            ->reorderable()
                            ->addActionLabel('Add Navigation Link'),
                    ]),

                Section::make('Action Buttons & Controls')
                    ->schema([
                        Toggle::make('show_theme_toggle')
                            ->label('Show Dark/Light Mode Switcher')
                            ->default(true),
                        Toggle::make('show_cta')
                            ->label('Show Primary CTA Button')
                            ->default(true)
                            ->live(),
                        Grid::make(2)->schema([
                            TextInput::make('cta_label')
                                ->label('CTA Label')
                                ->default("Let's Talk")
                                ->visible(fn ($get): bool => (bool) ($get('show_cta') ?? true)),
                            TextInput::make('cta_url')
                                ->label('CTA URL')
                                ->default('/#contact')
                                ->visible(fn ($get): bool => (bool) ($get('show_cta') ?? true)),
                        ]),
                    ]),

                Section::make('Header Style')
                    ->schema([
                        Grid::make(2)->schema([
                            Toggle::make('is_sticky')
                                ->label('Sticky Header (Fixed on Scroll)')
                                ->default(true),
                            Toggle::make('is_glassmorphism')
                                ->label('Backdrop Blur / Glass Effect')
                                ->default(true),
                        ]),
                    ]),
            ]);
    }
}
