<?php

/**
 * Post UUID plugin for WordPress
 *
 * Plugin Name:       Post UUID
 * Description:       Use a UUID instead of a URI as a Post GUID.
 * Version:           1.0.0
 * Plugin URI:        https://github.com/wp-jazz/wp-post-uuid
 * Author:            WP Jazz.
 * Author URI:        https://github.com/wp-jazz/
 * License:           MIT
 * Text Domain:       wp-jazz-post-uuid
 * Requires PHP:      7.2.0
 * Requires at least: 4.7.0
 * Tested up to:      6.0.2
 */

declare( strict_types=1 );

namespace Jazz\PostUUID;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/includes/namespace.php';

add_action( 'plugins_loaded', __NAMESPACE__ . '\\bootstrap' );
