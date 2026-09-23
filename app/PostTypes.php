<?php

/**
 * Custom post types & taxonomies.
 */

namespace App;

/**
 * Register the Portfolio post type and its category taxonomy.
 *
 * @return void
 */
add_action('init', function () {
    register_post_type('portfolio', [
        'labels' => [
            'name' => __('Portfolio', 'sage'),
            'singular_name' => __('Project', 'sage'),
            'add_new_item' => __('Add New Project', 'sage'),
            'edit_item' => __('Edit Project', 'sage'),
            'all_items' => __('Portfolio', 'sage'),
        ],
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'rewrite' => ['slug' => 'work', 'with_front' => false],
    ]);

    register_taxonomy('portfolio_category', 'portfolio', [
        'labels' => [
            'name' => __('Portfolio Categories', 'sage'),
            'singular_name' => __('Portfolio Category', 'sage'),
        ],
        'hierarchical' => true,
        'public' => true,
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'work-category', 'with_front' => false],
    ]);
});

/**
 * Register the Client post type.
 *
 * @return void
 */
add_action('init', function () {
    register_post_type('client', [
        'labels' => [
            'name' => __('Clients', 'sage'),
            'singular_name' => __('Client', 'sage'),
            'add_new_item' => __('Add New Client', 'sage'),
            'edit_item' => __('Edit Client', 'sage'),
            'all_items' => __('Clients', 'sage'),
        ],
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-groups',
        'supports' => ['title', 'thumbnail'],
        'rewrite' => ['slug' => 'clients', 'with_front' => false],
    ]);
});

/**
 * Register the Service post type.
 *
 * @return void
 */
add_action('init', function () {
    register_post_type('service', [
        'labels' => [
            'name' => __('Services', 'sage'),
            'singular_name' => __('Service', 'sage'),
            'add_new_item' => __('Add New Service', 'sage'),
            'edit_item' => __('Edit Service', 'sage'),
            'all_items' => __('Services', 'sage'),
        ],
        'public' => false,
        'show_ui' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-admin-tools',
        'supports' => ['title', 'editor', 'thumbnail'],
    ]);
});

/**
 * Register the Testimonial post type.
 *
 * @return void
 */
add_action('init', function () {
    register_post_type('testimonial', [
        'labels' => [
            'name' => __('Testimonials', 'sage'),
            'singular_name' => __('Testimonial', 'sage'),
            'add_new_item' => __('Add New Testimonial', 'sage'),
            'edit_item' => __('Edit Testimonial', 'sage'),
            'all_items' => __('Testimonials', 'sage'),
        ],
        'public' => false,
        'show_ui' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-format-quote',
        'supports' => ['title'],
    ]);
});
