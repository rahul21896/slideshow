<?php
/**
 * Plugin Name: My Slideshow
 * Plugin URI: https://www.linkedin.com/in/rahul-dhamecha
 * Description: The Plugin for slideshow.
 * Author: Rahul Dhamecha
 * Author URI: https://www.linkedin.com/in/rahul-dhamecha
 * Version: 1.0.0
 * Text Domain: my-slideshow
 *
 * @package my-slideshow
 */

namespace RahulDhamecha\MySlideshow;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Define plugin directory constant for use globally in plugin.
 */
if ( ! defined( 'MY_SLIDESHOW_PLUGIN_DIR' ) ) {
	define( 'MY_SLIDESHOW_PLUGIN_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
}

/**
 * Define plugin url constant for use globally in plugin.
 */
if ( ! defined( 'MY_SLIDESHOW_PLUGIN_URL' ) ) {
	define( 'MY_SLIDESHOW_PLUGIN_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );
}

/**
 * Require autoload.php file to access class using namespace.
 */
if(file_exists(MY_SLIDESHOW_PLUGIN_DIR . '/vendor/autoload.php')){ // phpcs:ignore
	require_once MY_SLIDESHOW_PLUGIN_DIR . '/vendor/autoload.php'; // phpcs:ignore
}

/**
 * Added all general functions for slideshow.
 */
if ( file_exists( MY_SLIDESHOW_PLUGIN_DIR . '/inc/functions.php' ) ) {
	require MY_SLIDESHOW_PLUGIN_DIR . '/inc/functions.php';
}

/**
 * Load admin and front hooks on plugin loaded action.
 */
add_action( 'plugins_loaded', __NAMESPACE__ . '\\setup' );

/**
 * Create database tables on plugin activation.
 */
register_activation_hook( __FILE__, [ __NAMESPACE__ . '\\Install', 'activate_slideshow' ] );
