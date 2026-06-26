<?php
/** Lightweight lead forms with email delivery and stored submissions. */
declare(strict_types=1);
if (! defined('ABSPATH')) { exit; }

add_action('init', function (): void {
    register_post_type('grs_lead', ['labels' => ['name' => 'Заявки'], 'public' => false, 'show_ui' => true, 'supports' => ['title', 'custom-fields'], 'menu_icon' => 'dashicons-email-alt']);
});

function grs_lead_form(string $type = 'consultation'): string {
    $nonce = wp_create_nonce('grs_lead_' . $type);
    return '<form class="lead-form" method="post"><input type="hidden" name="grs_form_type" value="' . esc_attr($type) . '"><input type="hidden" name="grs_nonce" value="' . esc_attr($nonce) . '"><label>Имя<input name="grs_name" required></label><label>Телефон<input name="grs_phone" required></label><label>Комментарий<textarea name="grs_message"></textarea></label><button class="btn btn-accent" type="submit">Отправить заявку</button></form>';
}

add_action('wp', function (): void {
    if ('POST' !== ($_SERVER['REQUEST_METHOD'] ?? '') || empty($_POST['grs_form_type'])) { return; }
    $type = sanitize_key((string) $_POST['grs_form_type']);
    if (! wp_verify_nonce((string) ($_POST['grs_nonce'] ?? ''), 'grs_lead_' . $type)) { wp_die('CSRF validation failed', 403); }
    $name = sanitize_text_field((string) ($_POST['grs_name'] ?? ''));
    $phone = sanitize_text_field((string) ($_POST['grs_phone'] ?? ''));
    $message = sanitize_textarea_field((string) ($_POST['grs_message'] ?? ''));
    $lead_id = wp_insert_post(['post_type' => 'grs_lead', 'post_status' => 'private', 'post_title' => $type . ': ' . $phone]);
    if ($lead_id) { update_post_meta($lead_id, 'name', $name); update_post_meta($lead_id, 'phone', $phone); update_post_meta($lead_id, 'message', $message); }
    wp_mail(get_option('admin_email'), 'Новая заявка: ' . $type, "Имя: $name\nТелефон: $phone\n$message");
    wp_safe_redirect(add_query_arg('lead', 'sent', wp_get_referer() ?: home_url('/'))); exit;
});
