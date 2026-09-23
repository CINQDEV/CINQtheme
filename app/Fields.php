<?php

/**
 * ACF field groups & options page.
 */

namespace App;

/**
 * Register the theme settings options page.
 *
 * @return void
 */
add_action('acf/init', function () {
    if (! function_exists('acf_add_options_page')) {
        return;
    }

    acf_add_options_page([
        'page_title' => __('Theme Settings', 'sage'),
        'menu_title' => __('Theme Settings', 'sage'),
        'menu_slug' => 'theme-settings',
        'capability' => 'edit_theme_options',
        'icon_url' => 'dashicons-admin-generic',
    ]);
});

/**
 * Register the theme settings field group.
 *
 * @return void
 */
add_action('acf/init', function () {
    if (! function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_theme_settings',
        'title' => __('Contact & Social', 'sage'),
        'fields' => [
            [
                'key' => 'field_contact_email',
                'name' => 'contact_email',
                'label' => __('Contact Email', 'sage'),
                'type' => 'email',
                'default_value' => 'bill@cinq.co.uk',
            ],
            [
                'key' => 'field_contact_phone',
                'name' => 'contact_phone',
                'label' => __('Contact Phone', 'sage'),
                'type' => 'text',
            ],
            [
                'key' => 'field_contact_address',
                'name' => 'contact_address',
                'label' => __('Address', 'sage'),
                'type' => 'textarea',
                'rows' => 3,
            ],
            [
                'key' => 'field_social_facebook',
                'name' => 'social_facebook',
                'label' => __('Facebook URL', 'sage'),
                'type' => 'url',
            ],
            [
                'key' => 'field_social_instagram',
                'name' => 'social_instagram',
                'label' => __('Instagram URL', 'sage'),
                'type' => 'url',
            ],
            [
                'key' => 'field_social_linkedin',
                'name' => 'social_linkedin',
                'label' => __('LinkedIn URL', 'sage'),
                'type' => 'url',
            ],
            [
                'key' => 'field_social_twitter',
                'name' => 'social_twitter',
                'label' => __('X (Twitter) URL', 'sage'),
                'type' => 'url',
            ],
            [
                'key' => 'field_social_youtube',
                'name' => 'social_youtube',
                'label' => __('YouTube URL', 'sage'),
                'type' => 'url',
            ],
            [
                'key' => 'field_footer_blurb',
                'name' => 'footer_blurb',
                'label' => __('Footer Blurb', 'sage'),
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'CINQ is a WordPress design and development studio. We build clean, considered websites for businesses that want their site to actually work — for their customers, and for them.',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'theme-settings',
                ],
            ],
        ],
    ]);
});

/**
 * Register the Portfolio field group.
 *
 * @return void
 */
add_action('acf/init', function () {
    if (! function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_portfolio',
        'title' => __('Project Details', 'sage'),
        'fields' => [
            [
                'key' => 'field_portfolio_client',
                'name' => 'client',
                'label' => __('Client', 'sage'),
                'type' => 'post_object',
                'post_type' => ['client'],
                'return_format' => 'object',
                'ui' => 1,
            ],
            [
                'key' => 'field_portfolio_project_url',
                'name' => 'project_url',
                'label' => __('Project URL', 'sage'),
                'type' => 'url',
            ],
            [
                'key' => 'field_portfolio_services_used',
                'name' => 'services_used',
                'label' => __('Services Used', 'sage'),
                'type' => 'text',
                'instructions' => __('e.g. Design, Development, SEO', 'sage'),
            ],
            [
                'key' => 'field_portfolio_project_date',
                'name' => 'project_date',
                'label' => __('Project Date', 'sage'),
                'type' => 'date_picker',
                'display_format' => 'F Y',
                'return_format' => 'F Y',
            ],
            [
                'key' => 'field_portfolio_summary',
                'name' => 'summary',
                'label' => __('Summary', 'sage'),
                'type' => 'textarea',
                'rows' => 2,
                'instructions' => __('Short summary shown on portfolio cards.', 'sage'),
            ],
            [
                'key' => 'field_portfolio_gallery',
                'name' => 'gallery',
                'label' => __('Gallery', 'sage'),
                'type' => 'gallery',
            ],
            [
                'key' => 'field_portfolio_featured',
                'name' => 'featured',
                'label' => __('Feature on homepage', 'sage'),
                'type' => 'true_false',
                'ui' => 1,
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'portfolio',
                ],
            ],
        ],
    ]);
});

/**
 * Register the Client field group.
 *
 * @return void
 */
add_action('acf/init', function () {
    if (! function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_client',
        'title' => __('Client Details', 'sage'),
        'fields' => [
            [
                'key' => 'field_client_logo',
                'name' => 'logo',
                'label' => __('Logo', 'sage'),
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ],
            [
                'key' => 'field_client_description',
                'name' => 'description',
                'label' => __('Description', 'sage'),
                'type' => 'wysiwyg',
                'toolbar' => 'basic',
                'media_upload' => 0,
            ],
            [
                'key' => 'field_client_website',
                'name' => 'website',
                'label' => __('Website', 'sage'),
                'type' => 'url',
            ],
            [
                'key' => 'field_client_industry',
                'name' => 'industry',
                'label' => __('Industry', 'sage'),
                'type' => 'text',
            ],
            [
                'key' => 'field_client_featured',
                'name' => 'featured',
                'label' => __('Show in homepage client strip', 'sage'),
                'type' => 'true_false',
                'ui' => 1,
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'client',
                ],
            ],
        ],
    ]);
});

/**
 * Register the Testimonial field group.
 *
 * @return void
 */
add_action('acf/init', function () {
    if (! function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_testimonial',
        'title' => __('Testimonial', 'sage'),
        'fields' => [
            [
                'key' => 'field_testimonial_quote',
                'name' => 'quote',
                'label' => __('Quote', 'sage'),
                'type' => 'textarea',
                'rows' => 4,
                'required' => 1,
            ],
            [
                'key' => 'field_testimonial_author_name',
                'name' => 'author_name',
                'label' => __('Author Name', 'sage'),
                'type' => 'text',
            ],
            [
                'key' => 'field_testimonial_author_role',
                'name' => 'author_role',
                'label' => __('Author Role', 'sage'),
                'type' => 'text',
                'instructions' => __('e.g. Managing Director, Acme Ltd', 'sage'),
            ],
            [
                'key' => 'field_testimonial_client',
                'name' => 'client',
                'label' => __('Client', 'sage'),
                'type' => 'post_object',
                'post_type' => ['client'],
                'return_format' => 'object',
                'ui' => 1,
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'testimonial',
                ],
            ],
        ],
    ]);
});

/**
 * Register the Service field group.
 *
 * @return void
 */
add_action('acf/init', function () {
    if (! function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_service',
        'title' => __('Service Details', 'sage'),
        'fields' => [
            [
                'key' => 'field_service_icon',
                'name' => 'icon',
                'label' => __('Icon', 'sage'),
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
            ],
            [
                'key' => 'field_service_summary',
                'name' => 'summary',
                'label' => __('Summary', 'sage'),
                'type' => 'textarea',
                'rows' => 2,
                'instructions' => __('Short summary shown on the homepage services grid.', 'sage'),
            ],
            [
                'key' => 'field_service_featured',
                'name' => 'featured',
                'label' => __('Feature on homepage', 'sage'),
                'type' => 'true_false',
                'ui' => 1,
                'default_value' => 1,
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'service',
                ],
            ],
        ],
    ]);
});

/**
 * Register the About page stats repeater field group.
 *
 * @return void
 */
add_action('acf/init', function () {
    if (! function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_about_stats',
        'title' => __('Stats', 'sage'),
        'fields' => [
            [
                'key' => 'field_about_stats',
                'name' => 'stats',
                'label' => __('Stats', 'sage'),
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => __('Add Stat', 'sage'),
                'sub_fields' => [
                    [
                        'key' => 'field_about_stat_number',
                        'name' => 'number',
                        'label' => __('Number', 'sage'),
                        'type' => 'text',
                        'wrapper' => ['width' => '30'],
                    ],
                    [
                        'key' => 'field_about_stat_label',
                        'name' => 'label',
                        'label' => __('Label', 'sage'),
                        'type' => 'text',
                        'wrapper' => ['width' => '70'],
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-about.blade.php',
                ],
            ],
        ],
    ]);
});
