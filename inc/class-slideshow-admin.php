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
		$this->generate_slideshow_shortcode();
		// Fetch template and render slideshow add new form.
		slideshow_get_template( 'admin/slideshow-add.php' );
	}

	/**
	 * Generate slideshow after form submitted.
	 *
	 * @return false|void
	 */
	private function generate_slideshow_shortcode() {
		$nounce = filter_input( INPUT_POST, '_wpnonce', FILTER_SANITIZE_STRING );
		if ( ! wp_verify_nonce( $nounce, 'slideshow_generate' ) ) {
			return false;
		}
		global $wpdb;
		$table           = $wpdb->prefix . Install::$SLIDESHOW_TABLE;
		$slideshow_title = filter_input( INPUT_POST, 'slideshow_title', FILTER_SANITIZE_STRING );
		$show_title      = filter_input( INPUT_POST, 'show_hide_title', FILTER_SANITIZE_STRING );
		$data            = [
			'slideshow_title'    => $slideshow_title,
			'slideshow_settings' => wp_json_encode( [ 'show_title' => $show_title ] ),
		];
		// @codingStandardsIgnoreStart
		$wpdb->insert( $table, $data );
		$slideshow_id = $wpdb->insert_id;
		$admin_url    = admin_url( 'admin.php?page=add-new-slideshow&slideshow_id=' . $slideshow_id );
		wp_safe_redirect( $admin_url );
		exit;
		// @codingStandardsIgnoreEnd
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
		wp_enqueue_script( 'bootstrap-toggle-js', MY_SLIDESHOW_PLUGIN_URL . '/lib/bootstrap/js/bootstrap-toggle.min.js', [ 'jquery' ], $this->version, false );
		wp_enqueue_script( 'jquery-ui-js', MY_SLIDESHOW_PLUGIN_URL . '/lib/jqueryui/js/jquery-ui.js', [ 'jquery' ], $this->version, false );
		wp_enqueue_script( 'dropzone-js', MY_SLIDESHOW_PLUGIN_URL . '/lib/dropzone/js/dropzone.min.js', [ 'jquery' ], $this->version, false );
		wp_enqueue_style( 'my-slideshow-admin-js', MY_SLIDESHOW_PLUGIN_URL . '/assets/js/admin-scripts.js', [], $this->version, 'all' );
	}

	/**
	 * Enqueue css styles.
	 *
	 * @return void
	 */
	private function enqueue_css_styles() {
		wp_enqueue_style( 'bootstrap-css', MY_SLIDESHOW_PLUGIN_URL . '/lib/bootstrap/css/bootstrap.min.css', [], $this->version, 'all' );
		wp_enqueue_style( 'bootstrap-toggle-css', MY_SLIDESHOW_PLUGIN_URL . '/lib/bootstrap/css/bootstrap-toggle.min.css', [], $this->version, 'all' );
		wp_enqueue_style( 'jquery-ui-css', MY_SLIDESHOW_PLUGIN_URL . '/lib/jqueryui/css/jquery-ui.css', [], $this->version, 'all' );
		wp_enqueue_style( 'dropzone-css', MY_SLIDESHOW_PLUGIN_URL . '/lib/dropzone/css/dropzone.min.css', [], $this->version, 'all' );
		wp_enqueue_style( 'my-slideshow-admin-css', MY_SLIDESHOW_PLUGIN_URL . '/assets/css/admin-style.css', [], $this->version, 'all' );
	}
}
