<?php
/** ACF Pro field groups for SEO and technical content. */
declare(strict_types=1);
if (! defined('ABSPATH')) { exit; }
add_action('acf/init', function (): void {
    if (! function_exists('acf_add_local_field_group')) { return; }
    acf_add_local_field_group(['key' => 'group_grs_seo', 'title' => 'GRS SEO', 'fields' => [
        ['key' => 'field_grs_seo_title', 'label' => 'SEO Title', 'name' => '_grs_seo_title', 'type' => 'text'],
        ['key' => 'field_grs_seo_description', 'label' => 'SEO Description', 'name' => '_grs_seo_description', 'type' => 'textarea'],
        ['key' => 'field_grs_h1', 'label' => 'H1', 'name' => '_grs_h1', 'type' => 'text'],
        ['key' => 'field_grs_seo_text', 'label' => 'SEO Text', 'name' => '_grs_seo_text', 'type' => 'wysiwyg'],
        ['key' => 'field_grs_og_title', 'label' => 'OG Title', 'name' => '_grs_og_title', 'type' => 'text'],
        ['key' => 'field_grs_og_description', 'label' => 'OG Description', 'name' => '_grs_og_description', 'type' => 'textarea'],
    ], 'location' => [[['param' => 'post_type', 'operator' => '!=', 'value' => 'attachment']]]]);
});
