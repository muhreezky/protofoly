<?php

declare(strict_types=1);

namespace App\Mason\Bricks;

use Awcodes\Mason\Brick;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class FooterNewsletter extends Brick
{
    public static function getId(): string
    {
        return 'footer-newsletter';
    }

    public static function getLabel(): string
    {
        return 'Footer Newsletter Box';
    }

    public static function getIcon(): string|Heroicon|Htmlable|null
    {
        return new HtmlString('<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>');
    }

    public static function getTags(): array
    {
        return ['footer', 'newsletter', 'email', 'cta', 'subscribe'];
    }

    public static function getOutlineLabel(array $config): ?string
    {
        return $config['heading'] ?? 'Newsletter Box';
    }

    public static function toHtml(array $config, ?array $data = null): ?string
    {
        return view('mason.bricks.footer-newsletter', [
            'heading' => $config['heading'] ?? 'Subscribe to our newsletter',
            'subheading' => $config['subheading'] ?? 'Receive monthly drops featuring cutting-edge prototypes, UI systems, and engineering insights.',
            'button_label' => $config['button_label'] ?? 'Subscribe',
            'placeholder' => $config['placeholder'] ?? 'you@example.com',
        ])->render();
    }

    public static function configureBrickAction(Action $action): Action
    {
        return $action
            ->slideOver()
            ->modalHeading('Configure Newsletter Box')
            ->schema([
                Section::make('Copy')
                    ->schema([
                        TextInput::make('heading')
                            ->label('Heading')
                            ->default('Subscribe to our newsletter')
                            ->required(),
                        TextInput::make('subheading')
                            ->label('Subheading / Explainer')
                            ->default('Receive monthly drops featuring cutting-edge prototypes, UI systems, and engineering insights.'),
                    ]),

                Section::make('Input & Button')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('placeholder')
                                ->label('Input Placeholder')
                                ->default('you@example.com'),
                            TextInput::make('button_label')
                                ->label('Button Label')
                                ->default('Subscribe')
                                ->required(),
                        ]),
                    ]),
            ]);
    }
}
