<?php
/**
 * Slideshows common functions.
 *
 * @package my-slideshow
 */

use RahulDhamecha\MySlideshow\Install;

/**
 * Locate Template.
 */
if ( ! function_exists( 'slideshow_locate_template' ) ) {
	/**
	 * Locate template.
	 *
	 * @param  string $template_name  Template to load.
	 * @param  string $template_path  $template_path    Path to templates.
	 * @param  string $default_path  Default path to template files.
	 * @return string Path to the template file.
	 */
	function slideshow_locate_template( $template_name, $template_path = '', $default_path = '' ) {

		if ( ! $template_path ) :
			$template_path = '/templates/';
		endif;

		// Set default plugin templates path.
		if ( ! $default_path ) :
			$default_path = MY_SLIDESHOW_PLUGIN_DIR . '/templates/'; // Path to the template folder.
		endif;

		// Search template file in theme folder.
		$template = locate_template(
			[
				$template_path . $template_name,
				$template_name,
			]
		);

		// Get plugins template file.
		if ( ! $template ) :
			$template = $default_path . $template_name;
		endif;

		return apply_filters( 'slideshow_locate_template', $template, $template_name, $template_path, $default_path );
	}
}

/**
 * Render Template from specified path.
 */
if ( ! function_exists( 'slideshow_get_template' ) ) {
	/**
	 * Get template.
	 *
	 * @param  string $template_name  Template to load.
	 * @param  array  $args  Args passed for the template file.
	 * @param  string $tempate_path  $template_path    Path to templates.
	 * @param  string $default_path  Default path to template files.
	 * @return void
	 */
	function slideshow_get_template( $template_name, $args = [], $tempate_path = '', $default_path = '' ) {

		if ( is_array( $args ) ) :
			extract( $args );
		endif;

		$template_file = slideshow_locate_template( $template_name, $tempate_path, $default_path );

		if ( ! file_exists( $template_file ) ) :
			_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', esc_url( $template_file ) ), '1.0.0' );

			return;
		endif;

		include esc_url( $template_file );

	}
}

/**
 * Return slideshow detains by slideshow id.
 */
if ( ! function_exists( 'get_slideshows_details_by_id' ) ) {
	/**
	 * Return slideshow detains by slideshow id.
	 *
	 * @param int $slideshow_id slideshow_id.
	 * @return array
	 */
	function get_slideshows_details_by_id( $slideshow_id = 0 ) {
		$data = [
			'slideshow' => '',
			'slides'    => [],
		];
		if ( intval( $slideshow_id ) > 0 ) {
			global $wpdb;
			$slideshow_table = $wpdb->prefix . Install::$SLIDESHOW_TABLE;
			$slide_table     = $wpdb->prefix . Install::$SLIDE_TABLE;
			// @codingStandardsIgnoreStart
			$slideshow_query = $wpdb->prepare( "SELECT * FROM $slideshow_table WHERE ID='%d' LIMIT %d", [ $slideshow_id, 1 ] );
			$slideshow       = $wpdb->get_results( $slideshow_query );
			$slide_query = $wpdb->prepare( "SELECT * FROM $slide_table WHERE slideshow_id='%d' order by slide_order asc", [ $slideshow_id ] );
			$slides = $wpdb->get_results( $slide_query );
			// @codingStandardsIgnoreEnd
			if ( is_array( $slideshow ) && count( $slideshow ) > 0 ) {
				$data['slideshow'] = reset( $slideshow );
			}
			if ( is_array( $slides ) && count( $slides ) > 0 ) {
				$data['slides'] = $slides;
			}
		}
		return $data;
	}
}

/**
 * Return slideshow shortcode by slideshow id.
 */
if ( ! function_exists( 'get_slideshow_shortcode_by_id' ) ) {
	/**
	 * Return slideshow shortcode by slideshow id.
	 *
	 * @param int $slideshow_id slideshow_id.
	 * @return string
	 */
	function get_slideshow_shortcode_by_id( $slideshow_id = 0 ) {
		$shortocde = '[' . MY_SLIDESHOW_SHORTCODE . ' ID="' . $slideshow_id . '"]';
		return esc_html( $shortocde );
	}
}
