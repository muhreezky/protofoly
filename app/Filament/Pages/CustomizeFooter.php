<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Mason\FooterBricks;
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

class CustomizeFooter extends Page
{
    use InteractsWithFormActions;
    use InteractsWithHeaderActions;

    protected static string|UnitEnum|null $navigationGroup = 'Site Layout';

    protected static ?string $navigationLabel = 'Footer';

    protected static ?string $title = 'Customize Site Footer';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::QueueList;

    protected static ?int $navigationSort = 2;

    protected static ?string $slug = 'layout/footer';

    protected string $view = 'filament-panels::pages.page';

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $setting = LayoutSetting::current();

        $this->form->fill([
            'footer_content' => $setting->footer_content ?? LayoutSetting::defaultFooterBlocks(),
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
                            ->key('footer-form-actions'),
                    ]),
            ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Mason::make('footer_content')
                    ->label('Footer Builder Canvas')
                    ->helperText('Drag and drop blocks to assemble the site footer. Click a block to configure its content.')
                    ->bricks(FooterBricks::all())
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
                ->label('Save Footer')
                ->submit('save')
                ->color('primary')
                ->keyBindings(['mod+s']),

            Action::make('loadStarterTemplate')
                ->label('Load Starter Template')
                ->color('gray')
                ->icon(Heroicon::ArrowPath)
                ->requiresConfirmation()
                ->modalHeading('Load Starter Footer Template')
                ->modalDescription('This will replace the current editor canvas with the default Protofoly footer columns & social bar.')
                ->action(function () {
                    $this->form->fill([
                        'footer_content' => LayoutSetting::defaultFooterBlocks(),
                    ]);

                    Notification::make()
                        ->title('Starter template loaded')
                        ->body('Click "Save Footer" when you are ready to publish.')
                        ->info()
                        ->send();
                }),

            Action::make('resetToDefault')
                ->label('Reset to Default')
                ->color('danger')
                ->icon(Heroicon::Trash)
                ->requiresConfirmation()
                ->modalHeading('Reset Footer')
                ->modalDescription('This will clear custom footer blocks and revert the site to the original static footer.')
                ->action(function () {
                    $setting = LayoutSetting::current();
                    $setting->update([
                        'footer_content' => null,
                    ]);
                    LayoutSetting::clearCache();

                    $this->form->fill([
                        'footer_content' => null,
                    ]);

                    Notification::make()
                        ->title('Footer reset')
                        ->body('Custom footer cleared. Site will use the default static footer.')
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
            'footer_content' => $state['footer_content'] ?? null,
        ]);
        LayoutSetting::clearCache();

        Notification::make()
            ->title('Footer saved')
            ->body('Site footer configuration has been successfully updated.')
            ->success()
            ->send();
    }
}
