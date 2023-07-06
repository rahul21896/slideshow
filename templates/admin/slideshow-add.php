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
$arrows             = isset( $slideshow_settings['arrows'] ) && $slideshow_settings['arrows'] === 'on' ? 'checked' : '';
$dots               = isset( $slideshow_settings['dots'] ) && $slideshow_settings['dots'] === 'on' ? 'checked' : '';
$infinite           = isset( $slideshow_settings['infinite'] ) && $slideshow_settings['infinite'] === 'on' ? 'checked' : '';
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
				<label for="slideshow_title"><?php echo esc_html__( 'Slideshow Title', 'my-slideshow' ); ?><span class="text-danger"><?php echo esc_html__( ' *', 'my-slideshow' ); ?></span></label>
				<input type="text" name="slideshow_title" class="form-control" value="<?php echo esc_attr( $slideshow_title ); ?>" id="slideshow_title" placeholder="<?php echo esc_attr__( 'Slideshow Title', 'my-slideshow' ); ?>" required>
			</div>
			<div class="form-group col-md-2">
				<label for="slideshow_title"><?php echo esc_html__( 'Show / Hide Title', 'my-slideshow' ); ?></label>
				<div class="form-group">
					<input type="checkbox" name="show_hide_title" data-toggle="toggle" data-on="Show" data-off="Hide" data-onstyle="success" data-offstyle="danger" <?php echo esc_html( $show_title ); ?>>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<h4><?php echo esc_html__( 'Slider Settings', 'my-slideshow' ); ?></h4>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-4">
				<label for="slide_to_show_desktop"><?php echo esc_html__( 'Slide To Show ( Desktop )', 'my-slideshow' ); ?></label>
				<select class="form-control" name="slide_to_show_desktop" id="slide_to_show_desktop">
					<option value="1" <?php echo isset( $slideshow_settings['show_desktop'] ) && $slideshow_settings['show_desktop'] === '1' ? 'selected' : ''; ?>><?php echo esc_html__( '1', 'my-slideshow' ); ?></option>
					<option value="2" <?php echo isset( $slideshow_settings['show_desktop'] ) && $slideshow_settings['show_desktop'] === '2' ? 'selected' : ''; ?>><?php echo esc_html__( '2', 'my-slideshow' ); ?></option>
					<option value="3" <?php echo isset( $slideshow_settings['show_desktop'] ) && $slideshow_settings['show_desktop'] === '3' ? 'selected' : ''; ?>><?php echo esc_html__( '3', 'my-slideshow' ); ?></option>
					<option value="4" <?php echo isset( $slideshow_settings['show_desktop'] ) && $slideshow_settings['show_desktop'] === '4' ? 'selected' : ''; ?>><?php echo esc_html__( '4', 'my-slideshow' ); ?></option>
				</select>
			</div>
			<div class="form-group col-md-4">
				<label for="slide_to_show_tab"><?php echo esc_html__( 'Slide To Show ( Tablet )', 'my-slideshow' ); ?></label>
				<select class="form-control" name="slide_to_show_tab" id="slide_to_show_tab">
					<option value="1" <?php echo isset( $slideshow_settings['show_tab'] ) && $slideshow_settings['show_tab'] === '1' ? 'selected' : ''; ?>><?php echo esc_html__( '1', 'my-slideshow' ); ?></option>
					<option value="2" <?php echo isset( $slideshow_settings['show_tab'] ) && $slideshow_settings['show_tab'] === '2' ? 'selected' : ''; ?>><?php echo esc_html__( '2', 'my-slideshow' ); ?></option>
					<option value="3" <?php echo isset( $slideshow_settings['show_tab'] ) && $slideshow_settings['show_tab'] === '3' ? 'selected' : ''; ?>><?php echo esc_html__( '3', 'my-slideshow' ); ?></option>
					<option value="4" <?php echo isset( $slideshow_settings['show_tab'] ) && $slideshow_settings['show_tab'] === '4' ? 'selected' : ''; ?>><?php echo esc_html__( '4', 'my-slideshow' ); ?></option>
				</select>
			</div>
			<div class="form-group col-md-4">
				<label for="slide_to_show_mobile"><?php echo esc_html__( 'Slide To Show ( Mobile )', 'my-slideshow' ); ?></label>
				<select class="form-control" name="slide_to_show_mobile" id="slide_to_show_mobile">
					<option value="1" <?php echo isset( $slideshow_settings['show_mobile'] ) && $slideshow_settings['show_mobile'] === '1' ? 'selected' : ''; ?>><?php echo esc_html__( '1', 'my-slideshow' ); ?></option>
					<option value="2" <?php echo isset( $slideshow_settings['show_mobile'] ) && $slideshow_settings['show_mobile'] === '2' ? 'selected' : ''; ?>><?php echo esc_html__( '2', 'my-slideshow' ); ?></option>
					<option value="3" <?php echo isset( $slideshow_settings['show_mobile'] ) && $slideshow_settings['show_mobile'] === '3' ? 'selected' : ''; ?>><?php echo esc_html__( '3', 'my-slideshow' ); ?></option>
					<option value="4" <?php echo isset( $slideshow_settings['show_mobile'] ) && $slideshow_settings['show_mobile'] === '4' ? 'selected' : ''; ?>><?php echo esc_html__( '4', 'my-slideshow' ); ?></option>
				</select>
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-4">
				<label for="slide_to_scroll_desktop"><?php echo esc_html__( 'Slide To Scroll ( Desktop )', 'my-slideshow' ); ?></label>
				<select class="form-control" name="slide_to_scroll_desktop" id="slide_to_scroll_desktop">
					<option value="1" <?php echo isset( $slideshow_settings['scroll_desktop'] ) && $slideshow_settings['scroll_desktop'] === '1' ? 'selected' : ''; ?>><?php echo esc_html__( '1', 'my-slideshow' ); ?></option>
					<option value="2" <?php echo isset( $slideshow_settings['scroll_desktop'] ) && $slideshow_settings['scroll_desktop'] === '2' ? 'selected' : ''; ?>><?php echo esc_html__( '2', 'my-slideshow' ); ?></option>
					<option value="3" <?php echo isset( $slideshow_settings['scroll_desktop'] ) && $slideshow_settings['scroll_desktop'] === '3' ? 'selected' : ''; ?>><?php echo esc_html__( '3', 'my-slideshow' ); ?></option>
					<option value="4" <?php echo isset( $slideshow_settings['scroll_desktop'] ) && $slideshow_settings['scroll_desktop'] === '4' ? 'selected' : ''; ?>><?php echo esc_html__( '4', 'my-slideshow' ); ?></option>
				</select>
			</div>
			<div class="form-group col-md-4">
				<label for="slide_to_scroll_tab"><?php echo esc_html__( 'Slide To Scroll ( Tablet )', 'my-slideshow' ); ?></label>
				<select class="form-control" name="slide_to_scroll_tab" id="slide_to_scroll_tab">
					<option value="1" <?php echo isset( $slideshow_settings['scroll_tab'] ) && $slideshow_settings['scroll_tab'] === '1' ? 'selected' : ''; ?>><?php echo esc_html__( '1', 'my-slideshow' ); ?></option>
					<option value="2" <?php echo isset( $slideshow_settings['scroll_tab'] ) && $slideshow_settings['scroll_tab'] === '2' ? 'selected' : ''; ?>><?php echo esc_html__( '2', 'my-slideshow' ); ?></option>
					<option value="3" <?php echo isset( $slideshow_settings['scroll_tab'] ) && $slideshow_settings['scroll_tab'] === '3' ? 'selected' : ''; ?>><?php echo esc_html__( '3', 'my-slideshow' ); ?></option>
					<option value="4" <?php echo isset( $slideshow_settings['scroll_tab'] ) && $slideshow_settings['scroll_tab'] === '4' ? 'selected' : ''; ?>><?php echo esc_html__( '4', 'my-slideshow' ); ?></option>
				</select>
			</div>
			<div class="form-group col-md-4">
				<label for="slide_to_scroll_mobile"><?php echo esc_html__( 'Slide To Scroll ( Mobile )', 'my-slideshow' ); ?></label>
				<select class="form-control" name="slide_to_scroll_mobile" id="slide_to_scroll_mobile">
					<option value="1" <?php echo isset( $slideshow_settings['scroll_mobile'] ) && $slideshow_settings['scroll_mobile'] === '1' ? 'selected' : ''; ?>><?php echo esc_html__( '1', 'my-slideshow' ); ?></option>
					<option value="2" <?php echo isset( $slideshow_settings['scroll_mobile'] ) && $slideshow_settings['scroll_mobile'] === '2' ? 'selected' : ''; ?>><?php echo esc_html__( '2', 'my-slideshow' ); ?></option>
					<option value="3" <?php echo isset( $slideshow_settings['scroll_mobile'] ) && $slideshow_settings['scroll_mobile'] === '3' ? 'selected' : ''; ?>><?php echo esc_html__( '3', 'my-slideshow' ); ?></option>
					<option value="4" <?php echo isset( $slideshow_settings['scroll_mobile'] ) && $slideshow_settings['scroll_mobile'] === '4' ? 'selected' : ''; ?>><?php echo esc_html__( '4', 'my-slideshow' ); ?></option>
				</select>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-4">
				<label for="slideshow_arrows"><?php echo esc_html__( 'Show / Hide Arrows', 'my-slideshow' ); ?></label>
				<div class="form-group">
					<input type="checkbox" id="slideshow_arrows" name="slideshow_arrows" data-toggle="toggle" data-on="Show" data-off="Hide" data-onstyle="success" data-offstyle="danger" <?php echo esc_attr( $arrows ); ?> />
				</div>
			</div>

			<div class="form-group col-md-4">
				<label for="slideshow_dots"><?php echo esc_html__( 'Show / Hide Dots', 'my-slideshow' ); ?></label>
				<div class="form-group">
					<input type="checkbox" id="slideshow_dots" name="slideshow_dots" data-toggle="toggle" data-on="Show" data-off="Hide" data-onstyle="success" data-offstyle="danger" <?php echo esc_attr( $dots ); ?> />
				</div>
			</div>

			<div class="form-group col-md-4">
				<label for="slideshow_scroll"><?php echo esc_html__( 'Infinite Scroll', 'my-slideshow' ); ?></label>
				<div class="form-group">
					<input type="checkbox" id="slideshow_scroll" name="slideshow_scroll" data-toggle="toggle" data-on="Show" data-off="Hide" data-onstyle="success" data-offstyle="danger" <?php echo esc_attr( $infinite ); ?> />
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
		<button type="submit" name="generate_slideshow_submit" class="btn btn-primary mt-4">
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
