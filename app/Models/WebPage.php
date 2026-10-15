<?php

/**
 * WebPage model represents a page that works like a WordPress page.
 * These pages accept editing using Mason (content blocks system).
 * Each page has a unique slug for URL routing.
 *
 * @class WebPage
 *
 * @see https://wordpress.org/pages/
 *
 * This model stores page content as an array of Mason bricks,
 * where each brick has a type and configuration for the editable areas.
 * The slug field is used for generating SEO-friendly URLs.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebPage extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
    ];

    protected $casts = [
        'content' => 'array',
        'slug' => 'string',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the content blocks for the page.
     *
     * This method returns the Mason content blocks that make up this page.
     * The content field stores an array of Mason bricks, each with a type
     * and attributes defining the editable area.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getContentBlocks(): array
    {
        return $this->content ?? [];
    }

    /**
     * Get the default Mason content for a new page.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function defaultContentBlocks(): array
    {
        return [
            [
                'type' => 'masonBrick',
                'attrs' => [
                    'id' => 'main-content',
                    'config' => [
                        'title' => '',
                        'body' => '',
                    ],
                ],
            ],
        ];
    }

    /**
     * Get the attributes that should be cast to native types.
     */
    protected function casts(): array
    {
        return [
            'content' => 'array',
            'slug' => 'string',
        ];
    }
}
