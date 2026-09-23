<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class FrontPage extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'front-page',
    ];

    /**
     * Retrieve the services to display on the homepage.
     */
    public function services(): array
    {
        return get_posts([
            'post_type' => 'service',
            'posts_per_page' => -1,
            'meta_key' => 'featured',
            'meta_value' => '1',
            'orderby' => 'menu_order title',
            'order' => 'ASC',
        ]) ?: get_posts([
            'post_type' => 'service',
            'posts_per_page' => -1,
        ]);
    }

    /**
     * Retrieve the featured (or latest) portfolio projects.
     */
    public function featuredPortfolio(): array
    {
        $featured = get_posts([
            'post_type' => 'portfolio',
            'posts_per_page' => 3,
            'meta_key' => 'featured',
            'meta_value' => '1',
        ]);

        if ($featured) {
            return $featured;
        }

        return get_posts([
            'post_type' => 'portfolio',
            'posts_per_page' => 3,
        ]);
    }

    /**
     * Retrieve the clients to display in the homepage logo strip.
     */
    public function featuredClients(): array
    {
        $featured = get_posts([
            'post_type' => 'client',
            'posts_per_page' => -1,
            'meta_key' => 'featured',
            'meta_value' => '1',
        ]);

        if ($featured) {
            return $featured;
        }

        return get_posts([
            'post_type' => 'client',
            'posts_per_page' => 8,
        ]);
    }

    /**
     * Retrieve a testimonial to spotlight on the homepage.
     */
    public function testimonial(): ?\WP_Post
    {
        $testimonials = get_posts([
            'post_type' => 'testimonial',
            'posts_per_page' => 1,
            'orderby' => 'rand',
        ]);

        return $testimonials[0] ?? null;
    }

    /**
     * Retrieve the latest blog posts to spotlight on the homepage.
     */
    public function latestPosts(): array
    {
        return get_posts([
            'post_type' => 'post',
            'posts_per_page' => 3,
        ]);
    }
}
