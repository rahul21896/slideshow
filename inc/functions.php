<?php
/**
 * Slideshows common functions.
 *
 * @package my-slideshow
 */

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
