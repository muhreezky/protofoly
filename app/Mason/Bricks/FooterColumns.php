<?php

declare(strict_types=1);

namespace App\Mason\Bricks;

use Awcodes\Mason\Brick;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class FooterColumns extends Brick
{
    public static function getId(): string
    {
        return 'footer-columns';
    }

    public static function getLabel(): string
    {
        return 'Footer Columns & Info';
    }

    public static function getIcon(): string|Heroicon|Htmlable|null
    {
        return new HtmlString('<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M12 3v18"/><path d="M3 12h18"/></svg>');
    }

    public static function getTags(): array
    {
        return ['footer', 'columns', 'links', 'branding', 'status'];
    }

    public static function getOutlineLabel(array $config): ?string
    {
        return $config['brand_name'] ?? 'Footer Columns';
    }

    public static function toHtml(array $config, ?array $data = null): ?string
    {
        return view('mason.bricks.footer-columns', [
            'brand_name' => $config['brand_name'] ?? config('app.name', 'Protofoly'),
            'tagline' => $config['tagline'] ?? 'A showcase of modern web engineering, bespoke design systems, and resilient full-stack applications. Crafted with Laravel 13, Filament v5, and Tailwind CSS.',
            'show_status_indicator' => $config['show_status_indicator'] ?? true,
            'status_text' => $config['status_text'] ?? 'All systems operating normally',
            'columns' => $config['columns'] ?? [
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
        ])->render();
    }

    public static function configureBrickAction(Action $action): Action
    {
        return $action
            ->slideOver()
            ->modalHeading('Configure Footer Columns')
            ->schema([
                Section::make('Brand & Summary')
                    ->schema([
                        TextInput::make('brand_name')
                            ->label('Brand Name')
                            ->default(config('app.name', 'Protofoly'))
                            ->required(),
                        Textarea::make('tagline')
                            ->label('Tagline / Description')
                            ->rows(3)
                            ->default('A showcase of modern web engineering, bespoke design systems, and resilient full-stack applications. Crafted with Laravel 13, Filament v5, and Tailwind CSS.'),
                        Grid::make(2)->schema([
                            Toggle::make('show_status_indicator')
                                ->label('Show Live Status Indicator')
                                ->default(true)
                                ->live(),
                            TextInput::make('status_text')
                                ->label('Status Indicator Text')
                                ->default('All systems operating normally')
                                ->visible(fn ($get): bool => (bool) ($get('show_status_indicator') ?? true)),
                        ]),
                    ]),

                Section::make('Navigation Columns')
                    ->schema([
                        Repeater::make('columns')
                            ->label('Columns')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Column Title')
                                    ->required(),
                                Repeater::make('links')
                                    ->label('Links')
                                    ->schema([
                                        TextInput::make('label')
                                            ->label('Link Label')
                                            ->required(),
                                        TextInput::make('url')
                                            ->label('Destination URL')
                                            ->required(),
                                        Toggle::make('is_external')
                                            ->label('Open in new tab')
                                            ->default(false),
                                    ])
                                    ->collapsible()
                                    ->addActionLabel('Add Link'),
                            ])
                            ->collapsible()
                            ->default([
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
                            ])
                            ->addActionLabel('Add Navigation Column'),
                    ]),
            ]);
    }
}
