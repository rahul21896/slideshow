<?php
/**
 * Slideshow listing template.
 *
 * @package my-slideshow
 */

?>
<div class="container-fluid mt-4">
	<div class="d-flex align-items-center">
		<h1 class="mr-4"><?php echo esc_html__( 'Slideshows', 'my-slideshow' ); ?></h1>
		<a class="btn btn-outline-primary" href="<?php echo esc_url( admin_url( 'admin.php?page=add-new-slideshow' ) ); ?>"><?php echo esc_html__( 'Add New', 'my-slideshow' ); ?></a>
	</div>
	<hr />
</div>
