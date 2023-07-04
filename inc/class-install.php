<?php
/**
 * Slideshow database table activation..
 *
 * @package my-slideshow
 */

namespace RahulDhamecha\MySlideshow;

/**
 * Slideshow database table creation and deletion.
 */
class Install {
	/**
	 * Slideshow table name.
	 *
	 * @var string $SLIDESHOW_TABLE slideshow table name.
	 */
	public static $SLIDESHOW_TABLE = 'slideshows';

	/**
	 * Slideshow slide table name.
	 *
	 * @var string $SLIDE_TABLE slideshow slide table name.
	 */
	public static $SLIDE_TABLE = 'slideshow_slides';

	/**
	 * Create slideshow and slideshow slide table on plugin activation.
	 *
	 * @return void
	 */
	public static function activate_slideshow() {
		self::create_slideshow_table();
		self::create_slideshow_slides_table();
	}

	/**
	 * Create slideshow table on plugin activation.
	 *
	 * @return void
	 */
	public static function create_slideshow_table() {
		global $wpdb;
		if ( ! function_exists( 'dbDelta' ) ) {
			require_once ABSPATH . '/wp-admin/includes/upgrade.php';
		}
		$slideshow_table = $wpdb->prefix . self::$SLIDESHOW_TABLE;         // db call.
		// @codingStandardsIgnoreStart
		$charset_collate      = $wpdb->get_charset_collate();
		$slideshow_table_find = count( $wpdb->get_col( $wpdb->prepare( 'SHOW TABLES LIKE %s', $slideshow_table ) ) );  // db call.
		if ( $slideshow_table_find <= 0 ) {
			$slideshow_query = "CREATE TABLE IF NOT EXISTS $slideshow_table (
    							`ID` bigint(11) AUTO_INCREMENT,
								`slideshow_title` varchar(100) NOT NULL,
								`slideshow_settings` TEXT NULL,
    							`created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    							`updated_at` DATETIME DEFAULT '0000-00-00 00:00:00',
    							PRIMARY KEY (`ID`)
    							) $charset_collate;";
			dbDelta( $slideshow_query ); // phpcs:ignore
		}
		// @codingStandardsIgnoreEnd
	}

	/**
	 * Create slideshow slides table on plugin activation.
	 *
	 * @return void
	 */
	public static function create_slideshow_slides_table() {
		global $wpdb;
		if ( ! function_exists( 'dbDelta' ) ) {
			require_once ABSPATH . '/wp-admin/includes/upgrade.php';
		}
		$slide_table = $wpdb->prefix . self::$SLIDE_TABLE;         // db call.
		// @codingStandardsIgnoreStart
		$charset_collate  = $wpdb->get_charset_collate();
		$slide_table_find = count( $wpdb->get_col( $wpdb->prepare( 'SHOW TABLES LIKE %s', $slide_table ) ) );  // db call.
		if ( $slide_table_find <= 0 ) {
			$slideshow_query = "CREATE TABLE IF NOT EXISTS $slide_table (
    							`ID` bigint(11) AUTO_INCREMENT,
								`slideshow_id` int(10) default 0,
								`slide_image` TEXT NOT NULL,
								`slide_text` TEXT NULL,
    							`created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    							`updated_at` DATETIME DEFAULT '0000-00-00 00:00:00',
    							PRIMARY KEY (`ID`)
    							) $charset_collate;";
			dbDelta( $slideshow_query ); // phpcs:ignore
		}
		// @codingStandardsIgnoreEnd
	}
}
