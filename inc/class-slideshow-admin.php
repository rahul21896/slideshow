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
		add_action( 'wp_loaded', [ $this, 'slideshow_submit_form_action' ] );
		add_action( 'wp_ajax_upload_slideshow_image', [ $this, 'slideshow_upload_slide_image' ] );
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
		$slideshow_id     = filter_input( INPUT_GET, 'slideshow_id', FILTER_SANITIZE_NUMBER_INT );
		$slideshow_detail = get_slideshows_details_by_id( $slideshow_id );
		slideshow_get_template( 'admin/slideshow-add.php', [ 'slideshow_details' => $slideshow_detail ] );
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
		$slideshow_id    = filter_input( INPUT_POST, 'slideshow_id', FILTER_SANITIZE_NUMBER_INT );
		$slideshow_title = filter_input( INPUT_POST, 'slideshow_title', FILTER_SANITIZE_STRING );
		$show_title      = filter_input( INPUT_POST, 'show_hide_title', FILTER_SANITIZE_STRING );
		$data            = [
			'slideshow_title'    => $slideshow_title,
			'slideshow_settings' => wp_json_encode( [ 'show_title' => $show_title ] ),
		];

		// @codingStandardsIgnoreStart
		if(intval($slideshow_id) > 0){
			$wpdb->update($table,$data,['ID' => $slideshow_id]);
		}else{
			$wpdb->insert( $table, $data );
			$slideshow_id = $wpdb->insert_id;
		}
		// @codingStandardsIgnoreEnd
		return esc_attr( $slideshow_id );
	}

	/**
	 * Submit Slideshow form action.
	 *
	 * @return void
	 */
	public function slideshow_submit_form_action() {
		// Redirect on Edit page with the slideshow id.
		$slideshow_id = $this->generate_slideshow_shortcode();
		if ( intval( $slideshow_id ) > 0 ) {
			$admin_url = admin_url( 'admin.php?page=add-new-slideshow&slideshow_id=' . $slideshow_id );
			wp_safe_redirect( $admin_url );
			exit;
		}
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
		wp_enqueue_script( 'my-slideshow-admin-js', MY_SLIDESHOW_PLUGIN_URL . '/assets/js/admin-scripts.js', [], $this->version, true );
		$this->localize_script();
	}

	/**
	 * Localize script into custom js file.
	 *
	 * @return void
	 */
	private function localize_script() {
		$ajax_url = admin_url( 'admin-ajax.php' );
		$data     = [ 'ajax_url' => $ajax_url ];
		wp_localize_script( 'my-slideshow-admin-js', 'slideshow_admin', $data );
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

	/**
	 * Image upload ajax for the slide image upload.
	 *
	 * @return void
	 */
	public function slideshow_upload_slide_image() {
		$nounce = filter_input( INPUT_POST, '_wpnonce', FILTER_SANITIZE_STRING );
		if ( wp_verify_nonce( $nounce, 'slideshow_generate' ) ) {
			echo wp_json_encode(
				[
					'status'  => 'error',
					'message' => 'Session Expired.',
				] 
			);
			die;
		}
		$slideshow_id = filter_input( INPUT_POST, 'slideshow_id', FILTER_SANITIZE_NUMBER_INT );
		$slide_image = $_FILES['slide_image'] ?? []; // phpcs:ignore
		$upload       = wp_handle_upload(
			$slide_image,
			[ 'test_form' => false ]
		);
		if ( ! empty( $upload['error'] ) ) {
			$error_data = [
				'status'  => 'error',
				'message' => $upload['error'],
			];
			echo wp_json_encode( $error_data );
			die;
		}
		$record_status = $this->slideshow_create_slide_record( $upload, $slideshow_id );
		$success_data  = [
			'status'  => $record_status['status'],
			'message' => $record_status['message'],
		];
		echo wp_json_encode( $success_data );
		die;
	}

	/**
	 * Create slide data into database.
	 *
	 * @param array $upload_data upload_data.
	 * @param int   $slideshow_id slideshow_id.
	 * @return string[]
	 */
	private function slideshow_create_slide_record( $upload_data, $slideshow_id ) {
		global $wpdb;
		$slide_table = $wpdb->prefix . Install::$SLIDE_TABLE;
		$upload_url  = $upload_data['url'] ?? '';
		$data        = [
			'slideshow_id' => $slideshow_id,
			'slide_image'  => $upload_url,
			'slide_text'   => '',
		];
		// @codingStandardsIgnoreStart
		$status       = $wpdb->insert( $slide_table, $data );
		// @codingStandardsIgnoreEnd
		$success_data = [
			'status'  => 'error',
			'message' => 'Oops....something went wrong.',
		];
		if ( boolval( $status ) ) {
			$success_data = [
				'status'  => 'success',
				'message' => 'Slide uploaded successfully.',
			];
		}
		return $success_data;
	}
}
