<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Portfolio extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'single-portfolio',
        'archive-portfolio',
    ];

    /**
     * Retrieve the portfolio category terms for the current project.
     */
    public function categories(): array
    {
        if (! is_singular('portfolio')) {
            return [];
        }

        return get_the_terms(get_the_ID(), 'portfolio_category') ?: [];
    }

    /**
     * Retrieve other projects related to the current one.
     */
    public function related(): array
    {
        if (! is_singular('portfolio')) {
            return [];
        }

        return get_posts([
            'post_type' => 'portfolio',
            'posts_per_page' => 3,
            'post__not_in' => [get_the_ID()],
            'orderby' => 'rand',
        ]);
    }

    /**
     * Retrieve all portfolio category terms, for the archive filter.
     */
    public function allCategories(): array
    {
        if (! is_post_type_archive('portfolio')) {
            return [];
        }

        return get_terms([
            'taxonomy' => 'portfolio_category',
            'hide_empty' => true,
        ]) ?: [];
    }
}
