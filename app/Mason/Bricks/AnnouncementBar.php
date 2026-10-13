<?php

declare(strict_types=1);

namespace App\Mason\Bricks;

use Awcodes\Mason\Brick;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class AnnouncementBar extends Brick
{
    public static function getId(): string
    {
        return 'announcement-bar';
    }

    public static function getLabel(): string
    {
        return 'Announcement Bar';
    }

    public static function getIcon(): string|Heroicon|Htmlable|null
    {
        return new HtmlString('<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 11 18-5v12L3 13v-2z"></path><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"></path></svg>');
    }

    public static function getTags(): array
    {
        return ['header', 'announcement', 'banner', 'notice', 'topbar', 'alert'];
    }

    public static function getOutlineLabel(array $config): ?string
    {
        return $config['message'] ?? 'Announcement Bar';
    }

    public static function toHtml(array $config, ?array $data = null): ?string
    {
        return view('mason.bricks.announcement-bar', [
            'badge' => $config['badge'] ?? 'NEW',
            'message' => $config['message'] ?? 'Protofoly v1.0 is officially released! Explore creative digital prototypes.',
            'link_label' => $config['link_label'] ?? 'Learn more →',
            'link_url' => $config['link_url'] ?? '/#work',
            'theme' => $config['theme'] ?? 'amber',
            'is_dismissible' => $config['is_dismissible'] ?? false,
        ])->render();
    }

    public static function configureBrickAction(Action $action): Action
    {
        return $action
            ->slideOver()
            ->modalHeading('Configure Announcement Bar')
            ->schema([
                Section::make('Message & Content')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('badge')
                                ->label('Badge Text')
                                ->default('NEW')
                                ->columnSpan(1),
                            TextInput::make('message')
                                ->label('Announcement Message')
                                ->default('Protofoly v1.0 is officially released! Explore creative digital prototypes.')
                                ->required()
                                ->columnSpan(2),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('link_label')
                                ->label('Link Text')
                                ->default('Learn more →'),
                            TextInput::make('link_url')
                                ->label('Link Destination URL')
                                ->default('/#work'),
                        ]),
                    ]),

                Section::make('Appearance')
                    ->schema([
                        Grid::make(2)->schema([
                            Select::make('theme')
                                ->label('Color Theme')
                                ->options([
                                    'amber' => 'Amber & Orange Gradient',
                                    'emerald' => 'Emerald Green Gradient',
                                    'indigo' => 'Indigo & Violet Gradient',
                                    'dark' => 'Sleek Dark Zinc',
                                ])
                                ->default('amber')
                                ->required(),
                            Toggle::make('is_dismissible')
                                ->label('Dismissible by visitor')
                                ->default(false),
                        ]),
                    ]),
            ]);
    }
}
