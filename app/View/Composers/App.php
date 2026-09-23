<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class App extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        '*',
    ];

    /**
     * Retrieve the site name.
     */
    public function siteName(): string
    {
        return get_bloginfo('name', 'display');
    }

    /**
     * Build the breadcrumb trail for the current request.
     *
     * @return array<int, array{label: string, url: ?string}>
     */
    public function breadcrumbs(): array
    {
        if (is_front_page()) {
            return [];
        }

        $trail = [
            ['label' => __('Home', 'sage'), 'url' => home_url('/')],
        ];

        if (is_singular('portfolio')) {
            $trail[] = ['label' => __('Work', 'sage'), 'url' => get_post_type_archive_link('portfolio')];
            $trail[] = ['label' => get_the_title(), 'url' => null];
        } elseif (is_post_type_archive('portfolio') || is_tax('portfolio_category')) {
            $trail[] = ['label' => __('Work', 'sage'), 'url' => is_tax() ? get_post_type_archive_link('portfolio') : null];
            if (is_tax()) {
                $trail[] = ['label' => single_term_title('', false), 'url' => null];
            }
        } elseif (is_singular('client')) {
            $trail[] = ['label' => __('Clients', 'sage'), 'url' => get_post_type_archive_link('client')];
            $trail[] = ['label' => get_the_title(), 'url' => null];
        } elseif (is_post_type_archive('client')) {
            $trail[] = ['label' => __('Clients', 'sage'), 'url' => null];
        } elseif (is_singular('post')) {
            $trail[] = ['label' => __('Blog', 'sage'), 'url' => get_permalink((int) get_option('page_for_posts'))];
            $trail[] = ['label' => get_the_title(), 'url' => null];
        } elseif (is_home()) {
            $trail[] = ['label' => __('Blog', 'sage'), 'url' => null];
        } elseif (is_search()) {
            $trail[] = ['label' => __('Search results', 'sage'), 'url' => null];
        } elseif (is_404()) {
            $trail[] = ['label' => __('Page not found', 'sage'), 'url' => null];
        } elseif (is_page()) {
            $trail[] = ['label' => get_the_title(), 'url' => null];
        } else {
            $trail[] = ['label' => get_the_title() ?: __('Page', 'sage'), 'url' => null];
        }

        return $trail;
    }
}
