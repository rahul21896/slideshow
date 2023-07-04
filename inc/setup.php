<?php
/**
 * Setup and create instance for slideshow.
 *
 * @category File
 * @package  my-slideshow
 */

namespace RahulDhamecha\MySlideshow;

/**
 * Plugin loader.
 *
 * @return void
 */
function setup() {
	// Register admin settings page.
	new SlideshowAdmin();
}
