<?php
/** AJAX search across expertise content. */
declare(strict_types=1);
if (! defined('ABSPATH')) { exit; }
add_action('wp_ajax_grs_search', 'grs_ajax_search');
add_action('wp_ajax_nopriv_grs_search', 'grs_ajax_search');
function grs_ajax_search(): void {
    check_ajax_referer('grs_ajax', 'nonce');
    $query = sanitize_text_field((string) ($_GET['q'] ?? ''));
    $posts = get_posts(['s' => $query, 'post_type' => ['post','grs_service','grs_equipment','grs_brand'], 'numberposts' => 8]);
    wp_send_json_success(array_map(fn($post): array => ['title' => get_the_title($post), 'url' => get_permalink($post), 'type' => get_post_type($post)], $posts));
}
