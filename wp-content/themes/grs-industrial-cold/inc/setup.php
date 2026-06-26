<?php
/** Theme setup helpers. */
declare(strict_types=1);
if (! defined('ABSPATH')) { exit; }

add_action('after_setup_theme', function (): void {
    load_theme_textdomain('grs-industrial-cold', GRS_THEME_DIR . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('custom-logo', ['height' => 72, 'width' => 220, 'flex-width' => true]);
    add_theme_support('responsive-embeds');
    add_theme_support('automatic-feed-links');
    add_image_size('grs-hero', 1920, 900, true);
    add_image_size('grs-card', 720, 480, true);
    register_nav_menus([
        'primary' => __('Primary menu', 'grs-industrial-cold'),
        'footer_services' => __('Footer services', 'grs-industrial-cold'),
        'footer_brands' => __('Footer brands', 'grs-industrial-cold'),
    ]);
});

add_filter('upload_mimes', function (array $mimes): array {
    $mimes['webp'] = 'image/webp';
    $mimes['avif'] = 'image/avif';
    $mimes['pdf'] = 'application/pdf';
    return $mimes;
});
