<?php

/**
 * One-time placeholder content seeder, run on theme activation.
 */

namespace App;

add_action('after_switch_theme', __NAMESPACE__.'\\seed_content');

/**
 * Find a post by its exact title and post type, without relying on the
 * deprecated get_page_by_title() helper.
 *
 * @return int|null
 */
function find_post_by_title(string $title, string $postType): ?int
{
    $posts = get_posts([
        'title' => $title,
        'post_type' => $postType,
        'post_status' => 'any',
        'posts_per_page' => 1,
        'fields' => 'ids',
    ]);

    return $posts[0] ?? null;
}

/**
 * Seed pages, menu, and placeholder CPT content.
 *
 * @return void
 */
function seed_content()
{
    if (get_option('cinq_theme_seeded')) {
        return;
    }

    $pages = seed_pages();
    seed_front_page($pages['home'] ?? null);
    seed_menu($pages);
    seed_services();
    $clients = seed_clients();
    seed_portfolio($clients);
    seed_testimonials($clients);

    update_option('cinq_theme_seeded', true);
}

/**
 * Create the theme's standard pages if they don't already exist.
 *
 * @return array<string, int>
 */
function seed_pages(): array
{
    $definitions = [
        'home' => [
            'post_title' => __('Home', 'sage'),
            'post_content' => '',
        ],
        'about' => [
            'post_title' => __('About', 'sage'),
            'post_content' => "CINQ is a WordPress design and development studio, built around a simple idea: your website should work as hard as you do.\n\nWe design and build custom WordPress sites — clean code, considered design, and a build that's easy to maintain long after launch.",
            'page_template' => 'page-about.blade.php',
        ],
        'contact' => [
            'post_title' => __('Contact', 'sage'),
            'post_content' => __("Got a project in mind? Tell us about it and we'll get back to you.", 'sage'),
            'page_template' => 'page-contact.blade.php',
        ],
        'cookie-policy' => [
            'post_title' => __('Cookie Policy', 'sage'),
            'post_content' => "<p><em>".__('Placeholder text generated as part of the site build — replace with copy reviewed by a qualified legal professional before publishing.', 'sage')."</em></p>\n<p>".__('This site uses cookies to store essential preferences and, where enabled, to understand how visitors use the site. You can control cookies through your browser settings at any time.', 'sage').'</p>',
        ],
        'terms-and-conditions' => [
            'post_title' => __('Terms & Conditions', 'sage'),
            'post_content' => "<p><em>".__('Placeholder text generated as part of the site build — replace with copy reviewed by a qualified legal professional before publishing.', 'sage')."</em></p>\n<p>".__('By using this website, you agree to these terms. Content is provided for general information only and may change without notice.', 'sage').'</p>',
        ],
    ];

    $ids = [];

    foreach ($definitions as $slug => $definition) {
        $existing = get_page_by_path($slug);

        if ($existing) {
            $ids[$slug] = $existing->ID;

            continue;
        }

        $id = wp_insert_post([
            'post_title' => $definition['post_title'],
            'post_name' => $slug,
            'post_content' => $definition['post_content'],
            'post_status' => 'publish',
            'post_type' => 'page',
        ]);

        if (! is_wp_error($id) && $id) {
            if (! empty($definition['page_template'])) {
                update_post_meta($id, '_wp_page_template', $definition['page_template']);
            }

            $ids[$slug] = $id;
        }
    }

    return $ids;
}

/**
 * Set the seeded Home page as the site's static front page.
 *
 * @return void
 */
function seed_front_page(?int $homeId)
{
    if (! $homeId) {
        return;
    }

    update_option('show_on_front', 'page');
    update_option('page_on_front', $homeId);
}

/**
 * Create the primary navigation menu.
 *
 * @param  array<string, int>  $pages
 * @return void
 */
function seed_menu(array $pages)
{
    if (wp_get_nav_menu_object('Primary')) {
        return;
    }

    $menuId = wp_create_nav_menu('Primary');

    if (is_wp_error($menuId)) {
        return;
    }

    $items = [
        ['title' => __('Home', 'sage'), 'url' => home_url('/')],
        ['title' => __('Work', 'sage'), 'url' => get_post_type_archive_link('portfolio') ?: home_url('/work')],
        ['title' => __('Clients', 'sage'), 'url' => get_post_type_archive_link('client') ?: home_url('/clients')],
        ['title' => __('About', 'sage'), 'url' => ! empty($pages['about']) ? get_permalink($pages['about']) : home_url('/about')],
        ['title' => __('Contact', 'sage'), 'url' => ! empty($pages['contact']) ? get_permalink($pages['contact']) : home_url('/contact')],
    ];

    foreach ($items as $position => $item) {
        wp_update_nav_menu_item($menuId, 0, [
            'menu-item-title' => $item['title'],
            'menu-item-url' => $item['url'],
            'menu-item-status' => 'publish',
            'menu-item-position' => $position + 1,
        ]);
    }

    $locations = get_theme_mod('nav_menu_locations');
    $locations['primary_navigation'] = $menuId;
    set_theme_mod('nav_menu_locations', $locations);
}

/**
 * Seed the single real service.
 *
 * @return void
 */
function seed_services()
{
    if (find_post_by_title('WordPress Design & Development', 'service')) {
        return;
    }

    $id = wp_insert_post([
        'post_title' => 'WordPress Design & Development',
        'post_content' => "Custom-built WordPress themes and sites, designed with intent and built to last — from first sketch through to launch and beyond.",
        'post_status' => 'publish',
        'post_type' => 'service',
    ]);

    if (! is_wp_error($id) && $id && function_exists('update_field')) {
        update_field('summary', 'Custom-built WordPress themes and sites, designed with intent and built to last.', $id);
        update_field('featured', 1, $id);
    }
}

/**
 * Seed placeholder clients.
 *
 * @return array<string, int>
 */
function seed_clients(): array
{
    $definitions = [
        'Alderton & Rowe' => 'Professional Services',
        'Meridian Wines' => 'Food & Drink',
        'Harbourline Retail' => 'Retail',
    ];

    $ids = [];

    foreach ($definitions as $title => $industry) {
        $existing = find_post_by_title($title, 'client');

        if ($existing) {
            $ids[$title] = $existing;

            continue;
        }

        $id = wp_insert_post([
            'post_title' => $title,
            'post_status' => 'publish',
            'post_type' => 'client',
        ]);

        if (! is_wp_error($id) && $id) {
            if (function_exists('update_field')) {
                update_field('industry', $industry, $id);
                update_field('featured', 1, $id);
            }

            $ids[$title] = $id;
        }
    }

    return $ids;
}

/**
 * Seed placeholder portfolio projects, linked to the placeholder clients.
 *
 * @param  array<string, int>  $clients
 * @return void
 */
function seed_portfolio(array $clients)
{
    $definitions = [
        [
            'title' => 'Alderton & Rowe — Brand Website',
            'client' => 'Alderton & Rowe',
            'summary' => 'A clean, content-led rebuild focused on clarity and fast page speed.',
            'services' => 'Design, Development',
        ],
        [
            'title' => 'Meridian Wines — E-commerce Rebuild',
            'client' => 'Meridian Wines',
            'summary' => 'A bespoke WooCommerce build with a streamlined checkout and product browsing experience.',
            'services' => 'Design, Development, E-commerce',
        ],
        [
            'title' => 'Harbourline Retail — Store Locator Platform',
            'client' => 'Harbourline Retail',
            'summary' => 'A custom store locator and multi-location content system built on WordPress.',
            'services' => 'Development',
        ],
    ];

    foreach ($definitions as $definition) {
        if (find_post_by_title($definition['title'], 'portfolio')) {
            continue;
        }

        $id = wp_insert_post([
            'post_title' => $definition['title'],
            'post_content' => $definition['summary'],
            'post_status' => 'publish',
            'post_type' => 'portfolio',
        ]);

        if (! is_wp_error($id) && $id && function_exists('update_field')) {
            update_field('summary', $definition['summary'], $id);
            update_field('services_used', $definition['services'], $id);
            update_field('featured', 1, $id);

            if (! empty($clients[$definition['client']])) {
                update_field('client', $clients[$definition['client']], $id);
            }
        }
    }
}

/**
 * Seed placeholder testimonials, linked to the placeholder clients.
 *
 * @param  array<string, int>  $clients
 * @return void
 */
function seed_testimonials(array $clients)
{
    $definitions = [
        [
            'title' => 'Testimonial — Alderton & Rowe',
            'client' => 'Alderton & Rowe',
            'quote' => "CINQ took the time to understand how we work before writing a line of code. The result is a site that's actually easy for us to keep up to date.",
            'author_name' => 'Placeholder Name',
            'author_role' => 'Partner, Alderton & Rowe',
        ],
        [
            'title' => 'Testimonial — Meridian Wines',
            'client' => 'Meridian Wines',
            'quote' => 'Fast, clear communication throughout, and a site that loads noticeably quicker than our old one.',
            'author_name' => 'Placeholder Name',
            'author_role' => 'Owner, Meridian Wines',
        ],
    ];

    foreach ($definitions as $definition) {
        if (find_post_by_title($definition['title'], 'testimonial')) {
            continue;
        }

        $id = wp_insert_post([
            'post_title' => $definition['title'],
            'post_status' => 'publish',
            'post_type' => 'testimonial',
        ]);

        if (! is_wp_error($id) && $id && function_exists('update_field')) {
            update_field('quote', $definition['quote'], $id);
            update_field('author_name', $definition['author_name'], $id);
            update_field('author_role', $definition['author_role'], $id);

            if (! empty($clients[$definition['client']])) {
                update_field('client', $clients[$definition['client']], $id);
            }
        }
    }
}
