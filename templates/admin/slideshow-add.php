<?php
/**
 * Slideshow add form template.
 *
 * @package my-slideshow
 */

?>
<div class="container-fluid mt-4">
	<div class="d-flex align-items-center">
		<h1 class="mr-4"><?php echo esc_html__( 'Create Slideshow', 'my-slideshow' ); ?></h1>
	</div>
	<hr />
</div>
<div class="container-fluid p-4">
	<form action="" method="post">
		<?php
			wp_nonce_field( 'slideshow_generate' );
		?>
		<div class="form-row">
			<div class="form-group col-md-4">
				<label for="slideshow_title"><?php echo esc_html__( 'Slideshow Title', 'my-slideshow' ); ?></label>
				<input type="text" name="slideshow_title" class="form-control" id="slideshow_title" placeholder="Slideshow Title">
			</div>
			<div class="form-group col-md-2">
				<label for="slideshow_title"><?php echo esc_html__( 'Show / Hide Title :', 'my-slideshow' ); ?></label>
				<div class="form-group">
					<input type="checkbox" name="show_hide_title" checked data-toggle="toggle" data-on="Show" data-off="Hide" data-onstyle="success" data-offstyle="danger">
				</div>
			</div>
		</div>
		<button type="submit" name="generate_slideshow_submit" class="btn btn-primary"><?php echo esc_html__( 'Generate Shortcode', 'my-slideshow' ); ?></button>
	</form>
</div>
