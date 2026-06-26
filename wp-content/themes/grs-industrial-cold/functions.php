<?php
/**
 * GRS Industrial Cold theme bootstrap.
 *
 * @package GRSIndustrialCold
 */

declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

define('GRS_THEME_VERSION', '1.0.0');
define('GRS_THEME_DIR', get_template_directory());
define('GRS_THEME_URI', get_template_directory_uri());

require_once GRS_THEME_DIR . '/inc/setup.php';
require_once GRS_THEME_DIR . '/inc/assets.php';
require_once GRS_THEME_DIR . '/inc/cpt.php';
require_once GRS_THEME_DIR . '/inc/seo.php';
require_once GRS_THEME_DIR . '/inc/forms.php';
require_once GRS_THEME_DIR . '/inc/security.php';
require_once GRS_THEME_DIR . '/inc/acf.php';
require_once GRS_THEME_DIR . '/inc/search.php';
require_once GRS_THEME_DIR . '/inc/calculators.php';
