<?php
/**
 * Remove the plugin's option on uninstall.
 *
 * @package JustShare
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option( 'just_share_settings' );
