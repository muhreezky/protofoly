<?php

declare(strict_types=1);

namespace App\Mason\Bricks;

use Awcodes\Mason\Brick;
use Awcodes\Mason\Bricks\Section;

class HeaderBricks
{
    /**
     * @return array<class-string<Brick>>
     */
    public static function all(): array
    {
        return [
            HeaderNav::class,
            AnnouncementBar::class,
            Section::class,
        ];
    }
}
