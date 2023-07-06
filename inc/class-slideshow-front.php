<?php
/**
 * Slideshow front shortcode generation.
 *
 * @package my-slideshow
 */

namespace RahulDhamecha\MySlideshow;

/**
 * Slideshow front shortocde manager.
 */
class SlideshowFront {
	/**
	 * Register shortocde and other actions.
	 */
	public function __construct() {
		add_shortcode( 'myslideshow', [ $this, 'slideshow_generate_shortcode' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'slideshow_enqueue_scripts' ] );
	}

	/**
	 * Slideshow shortcode attributes passed
	 *
	 * @param array $atts shortcode attributes.
	 * @return false|string
	 */
	public function slideshow_generate_shortcode( $atts ) {
		ob_start();
		$atts              = shortcode_atts(
			[
				'id' => 0,
			],
			$atts
		);
		$slideshow_details = get_slideshows_details_by_id( $atts['id'] );
		slideshow_get_template( 'front/slideshow.php', $slideshow_details );
		return ob_get_clean();
	}

	/**
	 * Slideshow enqueue scripts.
	 *
	 * @return void
	 */
	public function slideshow_enqueue_scripts() {
		global $post;
		$check_shortcode = strpos( $post->post_content, '[' . MY_SLIDESHOW_SHORTCODE );
		if ( $check_shortcode !== false ) {
			$this->enqueue_js_scripts();
			$this->enqueue_css_styles();
		}
	}

	/**
	 * Enqueue front javascript files.
	 *
	 * @return void
	 */
	private function enqueue_js_scripts() {
		wp_enqueue_script( 'jquery', MY_SLIDESHOW_PLUGIN_URL . '/lib/jquery/jquery-1.11.0.min.js', '', $this->version, false );
		wp_enqueue_script( 'jquery-migrate', MY_SLIDESHOW_PLUGIN_URL . '/lib/jquery/jquery-migrate-1.2.1.min.js', [ 'jquery' ], $this->version, false );
		wp_enqueue_script( 'slick-js', MY_SLIDESHOW_PLUGIN_URL . '/lib/slick/slick.js', [ 'jquery' ], $this->version, false );
		wp_enqueue_script( 'slick-js', MY_SLIDESHOW_PLUGIN_URL . '/lib/slick/slick.js', [ 'jquery' ], $this->version, false );
		wp_enqueue_script( 'my-slideshow-front-js', MY_SLIDESHOW_PLUGIN_URL . '/assets/js/front-scripts.js', [], $this->version, false );
	}

	/**
	 * Enqueue front css files.
	 *
	 * @return void
	 */
	private function enqueue_css_styles() {
		wp_enqueue_style( 'slick-css', MY_SLIDESHOW_PLUGIN_URL . '/lib/slick/slick.css', [], $this->version, 'all' );
		wp_enqueue_style( 'slick-theme-css', MY_SLIDESHOW_PLUGIN_URL . '/lib/slick/slick-theme.css', [], $this->version, 'all' );
		wp_enqueue_style( 'my-slideshow-front-css', MY_SLIDESHOW_PLUGIN_URL . '/assets/css/front-style.css', [], $this->version, 'all' );
	}
}
