<?php
/**
 * Class MySlideshow Admin
 *
 * @package Myslideshow
 */

use RahulDhamecha\MySlideshow\SlideshowAdmin;
/**
 * Class Myslideshow Admin hook.
 */
class Test_Slideshow_Admin extends WP_UnitTestCase {

	/**
	 * Check Admin menu hook.
	 */
	public function test_admin_menu_hook() {
		$slideshowObject = new SlideshowAdmin();
		$check_hook = has_action('admin_menu',[$slideshowObject,'register_slideshow_menu']);
		$is_registered = (10 === $check_hook);
		$this->assertTrue( $is_registered );
	}

	/**
	 * Check Admin Enqueue scripts.
	 */
	public function test_admin_enqueue_scripts() {
		$slideshowObject = new SlideshowAdmin();
		$check_hook = has_action('admin_enqueue_scripts',[$slideshowObject,'enqueue_admin_scripts']);
		$is_registered = (10 === $check_hook);
		$this->assertTrue( $is_registered );
	}

	/**
	 * Check Wp loaded hook.
	 */
	public function test_wp_loaded() {
		$slideshowObject = new SlideshowAdmin();
		$check_hook = has_action('wp_loaded',[$slideshowObject,'slideshow_submit_form_action']);
		$is_registered = (10 === $check_hook);
		$this->assertTrue( $is_registered );
	}

	/**
	 * Check Wp Ajax upload slideshow image action.
	 */
	public function test_upload_slideshow_image() {
		$slideshowObject = new SlideshowAdmin();
		$check_hook = has_action('wp_ajax_upload_slideshow_image',[$slideshowObject,'slideshow_upload_slide_image']);
		$is_registered = (10 === $check_hook);
		$this->assertTrue( $is_registered );
	}

	/**
	 * Check WP Ajax slide order update hook.
	 */
	public function test_slide_order_update() {
		$slideshowObject = new SlideshowAdmin();
		$check_hook = has_action('wp_ajax_slide_order_update',[$slideshowObject,'slideshow_slide_order_update']);
		$is_registered = (10 === $check_hook);
		$this->assertTrue( $is_registered );
	}

	/**
	 * Check WP Ajax update slide list hook.
	 */
	public function test_update_slides_list() {
		$slideshowObject = new SlideshowAdmin();
		$check_hook = has_action('wp_ajax_update_slides_list',[$slideshowObject,'slideshow_slide_list_update']);
		$is_registered = (10 === $check_hook);
		$this->assertTrue( $is_registered );
	}

	/**
	 * Check WP Ajax delete slide hook.
	 */
	public function test_delete_slide() {
		$slideshowObject = new SlideshowAdmin();
		$check_hook = has_action('wp_ajax_delete_slide',[$slideshowObject,'slideshow_slide_delete']);
		$is_registered = (10 === $check_hook);
		$this->assertTrue( $is_registered );
	}

}
