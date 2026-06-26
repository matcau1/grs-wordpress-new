<?php
/** Asset loading and performance hints. */
declare(strict_types=1);
if (! defined('ABSPATH')) { exit; }

add_action('wp_enqueue_scripts', function (): void {
    wp_enqueue_style('grs-critical', GRS_THEME_URI . '/assets/css/critical.css', [], GRS_THEME_VERSION);
    wp_enqueue_style('grs-theme', GRS_THEME_URI . '/assets/css/theme.css', ['grs-critical'], GRS_THEME_VERSION);
    wp_enqueue_script('grs-theme', GRS_THEME_URI . '/assets/js/theme.js', [], GRS_THEME_VERSION, ['strategy' => 'defer', 'in_footer' => true]);
    wp_localize_script('grs-theme', 'grsSite', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('grs_ajax'),
    ]);
});

add_filter('wp_resource_hints', function (array $urls, string $relation_type): array {
    if ('preload' === $relation_type) {
        $urls[] = ['href' => GRS_THEME_URI . '/assets/css/critical.css', 'as' => 'style'];
        $urls[] = ['href' => GRS_THEME_URI . '/assets/fonts/inter-var.woff2', 'as' => 'font', 'type' => 'font/woff2', 'crossorigin' => 'anonymous'];
    }
    return $urls;
}, 10, 2);

add_filter('wp_get_attachment_image_attributes', function (array $attr): array {
    $attr['loading'] = $attr['loading'] ?? 'lazy';
    $attr['decoding'] = 'async';
    return $attr;
});
