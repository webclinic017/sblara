<?php
/**
 *
 * @package   WP_Share
 * @author    Alex Ilie <me@wpshare.co>
 * @license   GPL-2.0+
 * @link      http://wpshare.com
 * @copyright 2014 Alex Ilie
 *
 * @wordpress-plugin
 * Plugin Name:       WP Share
 * Plugin URI:        http://wpshare.com
 * Description:       Social sharing plugin
 * Version:           1.0.0
 * Author:            Alex Ilie
 * Author URI:        http://wpshare.com
 * Text Domain:       wp-share
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

require_once( plugin_dir_path( __FILE__ ) . 'includes/class-wp-share-service.php' );
require_once( plugin_dir_path( __FILE__ ) . 'public/class-wp-share.php' );


/*
 * Load the plugin
 */
add_action( 'plugins_loaded', array( 'WP_Share', 'get_instance' ) );


/**
 * Calls the shortcode function
 *
 * @since 1.0.0
 *
 * @return echoes the html markup for the sharing buttons
 */
function wps_sharing() {
	$wp_share = WP_Share::get_instance();
	echo $wp_share->sharing_buttons();
}


/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-wp-share-admin.php' );
	add_action( 'plugins_loaded', array( 'WP_Share_Admin', 'get_instance' ) );

}
