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

if ( ! defined( 'MY_SLIDESHOW_PLUGIN_DIR' ) ) {
	define( 'MY_SLIDESHOW_PLUGIN_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
}

if ( ! defined( 'MY_SLIDESHOW_PLUGIN_URL' ) ) {
	define( 'MY_SLIDESHOW_PLUGIN_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );
}

require_once MY_SLIDESHOW_PLUGIN_DIR . '/vendor/autoload.php'; // phpcs:ignore WordPressVIPMinimum.Files.IncludingFile.UsingCustomConstant

/**
 * Added all general functions for slideshow.
 */
require MY_SLIDESHOW_PLUGIN_DIR . '/inc/functions.php';

add_action( 'plugins_loaded', __NAMESPACE__ . '\\setup' );

register_activation_hook( __FILE__, [ __NAMESPACE__ . '\\Install', 'activate_slideshow' ] );
