<?php

namespace App\Filament\Resources\WebPages;

use App\Filament\Resources\WebPages\Pages\CreateWebPage;
use App\Filament\Resources\WebPages\Pages\EditWebPage;
use App\Filament\Resources\WebPages\Pages\ListWebPages;
use App\Filament\Resources\WebPages\Schemas\WebPageForm;
use App\Filament\Resources\WebPages\Tables\WebPagesTable;
use App\Models\WebPage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WebPageResource extends Resource
{
    protected static ?string $model = WebPage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return WebPageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WebPagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWebPages::route('/'),
            'create' => CreateWebPage::route('/create'),
            'edit' => EditWebPage::route('/{record}/edit'),
        ];
    }
}
