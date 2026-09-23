<?php

/**
 * Contact form submission handler.
 */

namespace App;

add_action('admin_post_nopriv_cinq_contact', __NAMESPACE__.'\\handle_contact_form');
add_action('admin_post_cinq_contact', __NAMESPACE__.'\\handle_contact_form');

/**
 * Handle the contact form submission.
 *
 * @return void
 */
function handle_contact_form()
{
    $redirect = wp_get_referer() ?: home_url('/contact');

    if (! isset($_POST['cinq_contact_nonce']) || ! wp_verify_nonce($_POST['cinq_contact_nonce'], 'cinq_contact')) {
        wp_safe_redirect(esc_url_raw(add_query_arg('error', '1', $redirect)));
        exit;
    }

    // Honeypot: real visitors never fill this field in.
    if (! empty($_POST['website'])) {
        wp_safe_redirect(esc_url_raw(add_query_arg('sent', '1', $redirect)));
        exit;
    }

    $name = sanitize_text_field(wp_unslash($_POST['name'] ?? ''));
    $email = sanitize_email(wp_unslash($_POST['email'] ?? ''));
    $message = sanitize_textarea_field(wp_unslash($_POST['message'] ?? ''));

    if (! $name || ! is_email($email) || ! $message) {
        wp_safe_redirect(esc_url_raw(add_query_arg('error', '1', $redirect)));
        exit;
    }

    $to = function_exists('get_field') ? get_field('contact_email', 'option') : null;
    $to = $to ?: get_option('admin_email');

    $sent = wp_mail(
        $to,
        sprintf(__('New enquiry from %s', 'sage'), $name),
        $message,
        [
            'Reply-To: '.$name.' <'.$email.'>',
        ]
    );

    wp_safe_redirect(esc_url_raw(add_query_arg($sent ? 'sent' : 'error', '1', $redirect)));
    exit;
}
