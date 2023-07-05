<?php
/**
 * Slideshow add form template.
 *
 * @package my-slideshow
 */

$slideshow          = $slideshow_details['slideshow'] ?? '';
$slides             = $slideshow_details['slides'] ?? [];
$slideshow_title    = $slideshow->slideshow_title ?? '';
$slideshow_settings = isset( $slideshow->slideshow_settings ) ? json_decode( $slideshow->slideshow_settings, true ) : [];
$show_title         = isset( $slideshow_settings['show_title'] ) && $slideshow_settings['show_title'] === 'on' ? 'checked' : '';
$slideshow_id       = $slideshow->ID ?? 0;
$shortcode          = get_slideshow_shortcode_by_id( $slideshow_id );
?>
<div class="container-fluid mt-4">
	<div class="d-flex align-items-center">
		<h3 class="mr-4 m-0 p-0">
			<?php
			if ( ! empty( $slideshow_title ) ) {
				echo esc_html__( 'Edit Slideshow', 'my-slideshow' );
			} else {
				echo esc_html__( 'Create Slideshow', 'my-slideshow' );
			}
			?>
			<?php if ( intval( $slideshow_id ) > 0 ) : ?>
				<code id="edit_shortcode" onclick="copyText('<?php echo esc_html( $shortcode ); ?>')"><?php echo esc_html( $shortcode ); ?></code>
			<?php endif; ?>
		</h3>
		<a class="btn btn-outline-secondary" href="<?php echo esc_url( admin_url( 'admin.php?page=my-slideshow' ) ); ?>"><?php echo esc_html__( 'Back', 'my-slideshow' ); ?></a>

	</div>
	<hr />
</div>
<div class="container-fluid p-4">
	<form action="" method="post">
		<?php
			wp_nonce_field( 'slideshow_generate' );
		?>
		<input type="hidden" name="slideshow_id" id="slideshow_id" value="<?php echo esc_attr( $slideshow_id ); ?>" />
		<div class="form-row">
			<div class="form-group col-md-4">
				<label for="slideshow_title"><?php echo esc_html__( 'Slideshow Title', 'my-slideshow' ); ?></label>
				<input type="text" name="slideshow_title" class="form-control" value="<?php echo esc_attr( $slideshow_title ); ?>" id="slideshow_title" placeholder="Slideshow Title">
			</div>
			<div class="form-group col-md-2">
				<label for="slideshow_title"><?php echo esc_html__( 'Show / Hide Title :', 'my-slideshow' ); ?></label>
				<div class="form-group">
					<input type="checkbox" name="show_hide_title" data-toggle="toggle" data-on="Show" data-off="Hide" data-onstyle="success" data-offstyle="danger" <?php echo esc_html( $show_title ); ?>>
				</div>
			</div>
		</div>
		<div id="slideshow_slide_section">

		</div>
		<?php if ( intval( $slideshow_id ) > 0 ) : ?>
		<div class="form-row">
			<div class="col-md-12">
				<div id="slide_upload_form" class="dropzone"></div>
			</div>
		</div>
		<?php endif; ?>
		<button type="submit" name="generate_slideshow_submit" class="btn btn-primary">
			<?php
			if ( intval( $slideshow_id ) > 0 ) {
				echo esc_html__( 'Update', 'my-slideshow' );
			} else {
				echo esc_html__( 'Save', 'my-slideshow' );
			}
			?>
		</button>
	</form>
</div>
