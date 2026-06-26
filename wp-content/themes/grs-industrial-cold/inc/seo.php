<?php
/** Native SEO meta tags, breadcrumbs, schema and XML sitemap. */
declare(strict_types=1);
if (! defined('ABSPATH')) { exit; }

function grs_meta(string $key, int $post_id = 0): string {
    $post_id = $post_id ?: (int) get_queried_object_id();
    return trim((string) get_post_meta($post_id, $key, true));
}

add_action('wp_head', function (): void {
    if (is_admin()) { return; }
    $title = grs_meta('_grs_seo_title') ?: wp_get_document_title();
    $description = grs_meta('_grs_seo_description') ?: get_bloginfo('description');
    $canonical = is_singular() ? get_permalink() : home_url(add_query_arg([], $GLOBALS['wp']->request ?? ''));
    echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
    echo '<link rel="canonical" href="' . esc_url($canonical) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr(grs_meta('_grs_og_title') ?: $title) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr(grs_meta('_grs_og_description') ?: $description) . '">' . "\n";
    echo '<meta property="og:type" content="' . (is_singular('post') ? 'article' : 'website') . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($canonical) . '">' . "\n";
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<script type="application/ld+json">' . wp_json_encode(grs_schema_graph(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
});

function grs_schema_graph(): array {
    $site = home_url('/');
    $graph = [[
        '@type' => ['Organization', 'LocalBusiness'], '@id' => $site . '#organization', 'name' => get_bloginfo('name'), 'url' => $site,
        'contactPoint' => [['@type' => 'ContactPoint', 'telephone' => get_theme_mod('grs_phone', '+7'), 'contactType' => 'sales and service', 'areaServed' => 'RU']],
    ], [
        '@type' => 'WebSite', '@id' => $site . '#website', 'url' => $site, 'name' => get_bloginfo('name'),
        'potentialAction' => ['@type' => 'SearchAction', 'target' => $site . '?s={search_term_string}', 'query-input' => 'required name=search_term_string'],
    ]];
    if (is_singular()) {
        $id = get_queried_object_id();
        $type = match (get_post_type($id)) { 'grs_service' => 'Service', 'grs_equipment' => 'Product', 'post' => 'Article', default => 'Article' };
        $graph[] = ['@type' => $type, '@id' => get_permalink($id) . '#schema', 'headline' => get_the_title($id), 'description' => get_the_excerpt($id), 'url' => get_permalink($id)];
    }
    $graph[] = ['@type' => 'BreadcrumbList', 'itemListElement' => grs_breadcrumb_items()];
    return ['@context' => 'https://schema.org', '@graph' => $graph];
}

function grs_breadcrumb_items(): array {
    $items = [['@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => home_url('/')]];
    if (is_singular()) { $items[] = ['@type' => 'ListItem', 'position' => 2, 'name' => get_the_title(), 'item' => get_permalink()]; }
    return $items;
}

function grs_breadcrumbs(): void {
    echo '<nav class="breadcrumbs" aria-label="Хлебные крошки"><a href="' . esc_url(home_url('/')) . '">Главная</a>';
    if (is_singular()) { echo '<span>›</span><span>' . esc_html(get_the_title()) . '</span>'; }
    echo '</nav>';
}

add_action('init', function (): void { add_rewrite_rule('^sitemap.xml$', 'index.php?grs_sitemap=1', 'top'); });
add_filter('query_vars', fn(array $vars): array => array_merge($vars, ['grs_sitemap']));
add_action('template_redirect', function (): void {
    if (! get_query_var('grs_sitemap')) { return; }
    header('Content-Type: application/xml; charset=utf-8');
    $posts = get_posts(['post_type' => ['page','post','grs_service','grs_brand','grs_equipment','grs_project','grs_fault','grs_fault_code'], 'numberposts' => 1000, 'post_status' => 'publish']);
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?><urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";
    foreach ($posts as $post) { echo '<url><loc>' . esc_url(get_permalink($post)) . '</loc><lastmod>' . esc_html(get_the_modified_date('c', $post)) . '</lastmod></url>'; }
    echo '</urlset>'; exit;
});
