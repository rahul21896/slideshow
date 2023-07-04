<?php
/**
 * Slideshow admin side settings.
 *
 * @package my-slideshow
 */

namespace RahulDhamecha\MySlideshow;

/**
 * Slideshow database table creation and deletion.
 */
class SlideshowAdmin {

	/**
	 * Plugin version.
	 *
	 * @var string  $version plugin version.
	 */
	protected $version = '1.0';

	/**
	 * Register Admin hooks for creating admin side settings.
	 */
	public function __construct() {
		add_action( 'admin_menu', [ $this, 'register_slideshow_menu' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_scripts' ] );
	}

	/**
	 * Register Slideshow Admin Menu.
	 */
	public function register_slideshow_menu() {
		// Register new "My Slideshow" Main menu in admin menu.
		add_menu_page( __( 'My Slideshow', 'my-slideshow' ), 'My Slideshow', 'manage_options', 'my-slideshow', [ $this, 'render_myslideshow_admin_page' ], 'dashicons-slides', 20 );

		// Register new "Add New" submenu under "My Slideshow".
		add_submenu_page( 'my-slideshow', 'Add New | My Slideshow', 'Add New', 'manage_options', 'add-new-slideshow', [ $this, 'render_add_new_slideshow_page' ] );
	}

	/**
	 * Render slideshow listing menu.
	 */
	public function render_myslideshow_admin_page() {
		// Fetch template and render slideshow listing.
		slideshow_get_template( 'admin/slideshow-list.php' );
	}

	/**
	 * Render add new slideshow page.
	 */
	public function render_add_new_slideshow_page() {
		// Fetch template and render slideshow add new form.
		slideshow_get_template( 'admin/slideshow-add.php' );
	}

	/**
	 * Enqueue admin listing and form script and style for the slideshow pages only.
	 *
	 * @param string $hook page hook.
	 * @return void
	 */
	public function enqueue_admin_scripts( $hook ) {
		$enqueue_hooks = [ 'toplevel_page_my-slideshow', 'my-slideshow_page_add-new-slideshow' ];
		if ( in_array( $hook, $enqueue_hooks, true ) ) {
			$this->enqueue_js_scripts();
			$this->enqueue_css_styles();
		}
	}

	/**
	 * Enqueue javascript files.
	 *
	 * @return void
	 */
	private function enqueue_js_scripts() {
		wp_enqueue_script( 'bootstrap-js', MY_SLIDESHOW_PLUGIN_URL . '/lib/bootstrap/js/bootstrap.min.js', [ 'jquery' ], $this->version, false );
		wp_enqueue_script( 'jquery-ui-js', MY_SLIDESHOW_PLUGIN_URL . '/lib/jqueryui/js/jquery-ui.js', [ 'jquery' ], $this->version, false );
		wp_enqueue_script( 'dropzone-js', MY_SLIDESHOW_PLUGIN_URL . '/lib/dropzone/js/dropzone.min.js', [ 'jquery' ], $this->version, false );
	}

	/**
	 * Enqueue css styles.
	 *
	 * @return void
	 */
	private function enqueue_css_styles() {
		wp_enqueue_style( 'bootstrap-css', MY_SLIDESHOW_PLUGIN_URL . '/lib/bootstrap/css/bootstrap.min.css', [], $this->version, 'all' );
		wp_enqueue_style( 'jquery-ui-css', MY_SLIDESHOW_PLUGIN_URL . '/lib/jqueryui/css/jquery-ui.css', [], $this->version, 'all' );
		wp_enqueue_style( 'dropzone-css', MY_SLIDESHOW_PLUGIN_URL . '/lib/dropzone/css/dropzone.min.css', [], $this->version, 'all' );
	}
}
