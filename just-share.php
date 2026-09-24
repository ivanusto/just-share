<?php
/**
 * Plugin Name:       Just Share
 * Plugin URI:        https://github.com/ivanusto/just-share
 * Description:       Share buttons and related posts that ad blockers leave alone: plain server-rendered links through a same-site redirect, inline SVG icons, no third-party requests, no tracking.
 * Version:           0.1.0
 * Requires at least: 6.4
 * Requires PHP:      7.4
 * Author:            Ivan Lin
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       just-share
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'JUST_SHARE_VERSION', '0.1.0' );
define( 'JUST_SHARE_FILE', __FILE__ );
define( 'JUST_SHARE_DIR', plugin_dir_path( __FILE__ ) );
define( 'JUST_SHARE_URL', plugin_dir_url( __FILE__ ) );
define( 'JUST_SHARE_OPTION', 'just_share_settings' );

require_once JUST_SHARE_DIR . 'includes/networks.php';
require_once JUST_SHARE_DIR . 'includes/settings.php';
require_once JUST_SHARE_DIR . 'includes/frontend.php';

if ( is_admin() ) {
	require_once JUST_SHARE_DIR . 'includes/admin.php';
}

add_action( 'init', 'just_share_load_textdomain', 0 );

/**
 * Load translations shipped with the plugin.
 */
function just_share_load_textdomain() {
	load_plugin_textdomain( 'just-share', false, dirname( plugin_basename( JUST_SHARE_FILE ) ) . '/languages' );
}
