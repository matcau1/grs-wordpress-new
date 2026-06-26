<?php
/** Custom post types and taxonomies for SEO-scalable architecture. */
declare(strict_types=1);
if (! defined('ABSPATH')) { exit; }

add_action('init', function (): void {
    $types = [
        'grs_service' => ['name' => 'Услуги', 'single' => 'Услуга', 'slug' => 'services', 'icon' => 'dashicons-hammer'],
        'grs_brand' => ['name' => 'Бренды', 'single' => 'Бренд', 'slug' => 'brands', 'icon' => 'dashicons-awards'],
        'grs_equipment' => ['name' => 'Оборудование', 'single' => 'Оборудование', 'slug' => 'equipment', 'icon' => 'dashicons-admin-tools'],
        'grs_project' => ['name' => 'Проекты', 'single' => 'Проект', 'slug' => 'projects', 'icon' => 'dashicons-portfolio'],
        'grs_review' => ['name' => 'Отзывы', 'single' => 'Отзыв', 'slug' => 'reviews', 'icon' => 'dashicons-format-quote'],
        'grs_faq' => ['name' => 'FAQ', 'single' => 'Вопрос', 'slug' => 'faq', 'icon' => 'dashicons-editor-help'],
        'grs_employee' => ['name' => 'Сотрудники', 'single' => 'Сотрудник', 'slug' => 'team', 'icon' => 'dashicons-groups'],
        'grs_certificate' => ['name' => 'Сертификаты', 'single' => 'Сертификат', 'slug' => 'certificates', 'icon' => 'dashicons-media-document'],
        'grs_fault' => ['name' => 'Неисправности', 'single' => 'Неисправность', 'slug' => 'faults', 'icon' => 'dashicons-warning'],
        'grs_fault_code' => ['name' => 'Коды ошибок', 'single' => 'Код ошибки', 'slug' => 'fault-codes', 'icon' => 'dashicons-search'],
        'grs_document' => ['name' => 'Документация PDF', 'single' => 'Документ', 'slug' => 'documentation', 'icon' => 'dashicons-pdf'],
    ];

    foreach ($types as $post_type => $data) {
        register_post_type($post_type, [
            'labels' => ['name' => $data['name'], 'singular_name' => $data['single'], 'add_new_item' => 'Добавить: ' . $data['single']],
            'public' => true,
            'show_in_rest' => true,
            'menu_icon' => $data['icon'],
            'has_archive' => $data['slug'],
            'rewrite' => ['slug' => $data['slug'], 'with_front' => false],
            'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields', 'author'],
        ]);
    }

    register_taxonomy('equipment_category', ['grs_equipment'], [
        'labels' => ['name' => 'Категории оборудования'],
        'public' => true,
        'show_in_rest' => true,
        'hierarchical' => true,
        'rewrite' => ['slug' => 'equipment-category', 'with_front' => false],
    ]);

    register_taxonomy('knowledge_category', ['post'], [
        'labels' => ['name' => 'Категории базы знаний'],
        'public' => true,
        'show_in_rest' => true,
        'hierarchical' => true,
        'rewrite' => ['slug' => 'knowledge', 'with_front' => false],
    ]);
});
