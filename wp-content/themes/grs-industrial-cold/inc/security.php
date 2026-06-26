<?php
/** Security hardening. */
declare(strict_types=1);
if (! defined('ABSPATH')) { exit; }
add_filter('xmlrpc_enabled', '__return_false');
add_filter('rest_authentication_errors', function ($result) { return (! is_user_logged_in() && ! is_null($result)) ? $result : $result; });
add_action('send_headers', function (): void {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
});
