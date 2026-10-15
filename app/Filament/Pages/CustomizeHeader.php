<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Mason\Bricks\HeaderBricks;
use App\Models\LayoutSetting;
use Awcodes\Mason\Mason;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\Concerns\InteractsWithHeaderActions;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class CustomizeHeader extends Page
{
    use InteractsWithFormActions;
    use InteractsWithHeaderActions;

    protected static string|UnitEnum|null $navigationGroup = 'Site Layout';

    protected static ?string $navigationLabel = 'Header';

    protected static ?string $title = 'Customize Site Header';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Bars3;

    protected static ?int $navigationSort = 1;

    protected static ?string $slug = 'layout/header';

    protected string $view = 'filament-panels::pages.page';

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $setting = LayoutSetting::current();

        $this->form->fill([
            'header_content' => $setting->header_content ?? LayoutSetting::defaultHeaderBlocks(),
        ]);
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([EmbeddedSchema::make('form')])
                    ->id('form')
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make($this->getFormActions())
                            ->alignment($this->getFormActionsAlignment())
                            ->key('header-form-actions'),
                    ]),
            ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Mason::make('header_content')
                    ->label('Header Builder Canvas')
                    ->helperText('Drag and drop blocks to assemble the site header. Click a block to configure its content.')
                    ->bricks(HeaderBricks::all())
                    ->previewLayout('layouts.mason-preview')
                    ->colorModeToggle()
                    ->defaultColorMode('light')
                    ->extraInputAttributes(['style' => 'min-height: 40rem;']),
            ])
            ->statePath('data');
    }

    /**
     * @return array<Action>
     */
    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Header')
                ->submit('save')
                ->color('primary')
                ->keyBindings(['mod+s']),

            Action::make('loadStarterTemplate')
                ->label('Load Starter Template')
                ->color('gray')
                ->icon(Heroicon::ArrowPath)
                ->requiresConfirmation()
                ->modalHeading('Load Starter Header Template')
                ->modalDescription('This will replace the current editor canvas with the default Protofoly header navigation.')
                ->action(function () {
                    $this->form->fill([
                        'header_content' => LayoutSetting::defaultHeaderBlocks(),
                    ]);

                    Notification::make()
                        ->title('Starter template loaded')
                        ->body('Click "Save Header" when you are ready to publish.')
                        ->info()
                        ->send();
                }),

            Action::make('resetToDefault')
                ->label('Reset to Default')
                ->color('danger')
                ->icon(Heroicon::Trash)
                ->requiresConfirmation()
                ->modalHeading('Reset Header')
                ->modalDescription('This will clear custom header blocks and revert the site to the original static header.')
                ->action(function () {
                    $setting = LayoutSetting::current();
                    $setting->update([
                        'header_content' => null,
                    ]);
                    LayoutSetting::clearCache();

                    $this->form->fill([
                        'header_content' => null,
                    ]);

                    Notification::make()
                        ->title('Header reset')
                        ->body('Custom header cleared. Site will use the default static header.')
                        ->warning()
                        ->send();
                }),
        ];
    }

    /**
     * @return array<Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('viewSite')
                ->label('View Live Site')
                ->url(route('home'))
                ->openUrlInNewTab()
                ->icon(Heroicon::ArrowTopRightOnSquare)
                ->color('gray'),
        ];
    }

    public function save(): void
    {
        $state = $this->form->getState();

        $setting = LayoutSetting::current();
        $setting->update([
            'header_content' => $state['header_content'] ?? null,
        ]);
        LayoutSetting::clearCache();

        Notification::make()
            ->title('Header saved')
            ->body('Site header configuration has been successfully updated.')
            ->success()
            ->send();
    }
}
