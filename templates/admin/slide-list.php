<?php
/**
 * Slide list for ajax template.
 *
 * @package my-slideshow
 */

$slideshow = $slideshow_details['slideshow'] ?? '';
$slides    = $slideshow_details['slides'] ?? [];
?>
<?php if ( count( $slides ) > 0 ) : ?>
	<div class="form-row mt-4 mb-4">
		<div class="col-md-12" id="slideshow_slides">
			<ul class="d-flex align-items-center list-none">
				<?php foreach ( $slides as $slide ) : ?>
					<li data-id="<?php echo esc_attr( $slide->ID ); ?>">
						<img src="<?php echo esc_url( $slide->slide_image ); ?>" alt="<?php echo esc_attr( $slide->slide_text ); ?>" />
						<button data-id="<?php echo esc_attr( $slide->ID ); ?>" onclick="delete_slide(this)" type="button" class="btn btn-danger btn-xs">&#10005;</button>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
<?php endif; ?>
