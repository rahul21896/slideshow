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
	 * Register Admin hooks for creating admin side settings.
	 */
	public function __construct() {
		add_action( 'admin_menu', [ $this, 'register_slideshow_menu' ] );
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
}
