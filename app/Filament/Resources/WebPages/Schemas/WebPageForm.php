<?php

namespace App\Filament\Resources\WebPages\Schemas;

use App\Mason\Bricks\AnnouncementBar;
use App\Mason\Bricks\FooterBottom;
use App\Mason\Bricks\FooterColumns;
use App\Mason\Bricks\FooterNewsletter;
use App\Mason\Bricks\HeaderNav;
use App\Mason\Bricks\PageTitle;
use App\Mason\Bricks\Section;
use Awcodes\Mason\BrickGroup;
use Awcodes\Mason\Mason;
use Filament\Schemas\Schema;

class WebPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Mason::make('content')
                    ->label('Page Content')
                    ->helperText('Build the page using Mason content blocks.')
                    ->bricks([
                            // Content
                        PageTitle::class,
                        Section::class,

                        // Header
                        BrickGroup::make('Header')
                            ->bricks([
                                HeaderNav::class,
                                AnnouncementBar::class,
                            ]),

                        // Footer
                        BrickGroup::make('Footer')
                            ->bricks([
                                FooterColumns::class,
                                FooterNewsletter::class,
                                FooterBottom::class,
                            ]),
                    ])
                    ->previewLayout('layouts.mason-preview')
                    ->colorModeToggle()
                    ->defaultColorMode('light'),
            ])
            ->columns(1);
    }
}
