<?php

declare(strict_types=1);

namespace App\Mason\Bricks;

use Awcodes\Mason\Brick;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class FooterBottom extends Brick
{
    public static function getId(): string
    {
        return 'footer-bottom';
    }

    public static function getLabel(): string
    {
        return 'Footer Social & Copyright Bar';
    }

    public static function getIcon(): string|Heroicon|Htmlable|null
    {
        return new HtmlString('<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M15 9.354a4 4 0 1 0 0 5.292"/></svg>');
    }

    public static function getTags(): array
    {
        return ['footer', 'copyright', 'social', 'legal', 'bottom', 'links'];
    }

    public static function getOutlineLabel(array $config): ?string
    {
        return $config['copyright_text'] ?? 'Copyright & Socials';
    }

    public static function toHtml(array $config, ?array $data = null): ?string
    {
        $copyrightText = str_replace(
            '{year}',
            (string) date('Y'),
            $config['copyright_text'] ?? '© {year} '.config('app.name', 'Protofoly').'. All rights reserved.'
        );

        return view('mason.bricks.footer-bottom', [
            'copyright_text' => $copyrightText,
            'social_links' => $config['social_links'] ?? [
                ['platform' => 'github', 'url' => 'https://github.com', 'label' => 'GitHub profile'],
                ['platform' => 'twitter', 'url' => 'https://twitter.com', 'label' => 'Twitter X profile'],
                ['platform' => 'linkedin', 'url' => 'https://linkedin.com', 'label' => 'LinkedIn profile'],
            ],
        ])->render();
    }

    public static function configureBrickAction(Action $action): Action
    {
        return $action
            ->slideOver()
            ->modalHeading('Configure Copyright & Socials')
            ->schema([
                Section::make('Copyright')
                    ->schema([
                        TextInput::make('copyright_text')
                            ->label('Copyright Notice')
                            ->helperText('Use {year} to dynamically show the current year.')
                            ->default('© {year} '.config('app.name', 'Protofoly').'. All rights reserved.')
                            ->required(),
                    ]),

                Section::make('Social Channels')
                    ->schema([
                        Repeater::make('social_links')
                            ->label('Social Links')
                            ->schema([
                                Grid::make(2)->schema([
                                    Select::make('platform')
                                        ->label('Platform')
                                        ->options([
                                            'github' => 'GitHub',
                                            'twitter' => 'Twitter / X',
                                            'linkedin' => 'LinkedIn',
                                            'youtube' => 'YouTube',
                                            'instagram' => 'Instagram',
                                            'dribbble' => 'Dribbble',
                                        ])
                                        ->default('github')
                                        ->required(),
                                    TextInput::make('url')
                                        ->label('Profile URL')
                                        ->required(),
                                ]),
                                TextInput::make('label')
                                    ->label('Accessibility / Hover Label')
                                    ->placeholder('e.g. Follow us on GitHub'),
                            ])
                            ->default([
                                ['platform' => 'github', 'url' => 'https://github.com', 'label' => 'GitHub profile'],
                                ['platform' => 'twitter', 'url' => 'https://twitter.com', 'label' => 'Twitter X profile'],
                                ['platform' => 'linkedin', 'url' => 'https://linkedin.com', 'label' => 'LinkedIn profile'],
                            ])
                            ->collapsible()
                            ->addActionLabel('Add Social Link'),
                    ]),
            ]);
    }
}
