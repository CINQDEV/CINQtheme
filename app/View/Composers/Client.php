<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Client extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'single-client',
    ];

    /**
     * Retrieve portfolio projects linked to this client.
     */
    public function projects(): array
    {
        return get_posts([
            'post_type' => 'portfolio',
            'posts_per_page' => -1,
            'meta_query' => [
                [
                    'key' => 'client',
                    'value' => '"'.get_the_ID().'"',
                    'compare' => 'LIKE',
                ],
            ],
        ]);
    }

    /**
     * Retrieve testimonials linked to this client.
     */
    public function testimonials(): array
    {
        return get_posts([
            'post_type' => 'testimonial',
            'posts_per_page' => -1,
            'meta_query' => [
                [
                    'key' => 'client',
                    'value' => '"'.get_the_ID().'"',
                    'compare' => 'LIKE',
                ],
            ],
        ]);
    }
}
