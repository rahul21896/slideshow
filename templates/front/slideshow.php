<?php
/**
 * Slideshow slider template..
 *
 * @package my-slideshow
 */

$slideshow_settings = isset( $slideshow->slideshow_settings ) ? json_decode( $slideshow->slideshow_settings, true ) : [];
$attr_array         = [];
if ( count( $slideshow_settings ) > 0 ) {
	foreach ( $slideshow_settings as $key => $value ) {
		if ( ! empty( $value ) ) {
			$attr_array[] = 'data-' . $key . '=' . $value;
		} else {
			$attr_array[] = 'data-' . $key . '=off';
		}
	}
}
$data_attributes = implode( ' ', $attr_array );
?>

<div class="myslideshow-container">
	<?php if ( isset( $slideshow->slideshow_title ) && ! empty( $slideshow->slideshow_title ) && $slideshow_settings['show_title'] === 'on' ) : ?>
	<div class="slideshow_title">
		<h2><?php echo esc_html( $slideshow->slideshow_title ); ?></h2>
	</div>
	<?php endif; ?>
	<?php if ( isset( $slides ) && count( $slides ) > 0 ) : ?>
		<div class="slideshow_slider" id="myslideshow_<?php echo esc_attr( $slideshow->ID ); ?>" <?php echo esc_attr( $data_attributes ); ?>>
			<?php foreach ( $slides as $slide ) : ?>
				<div class="slide">
					<img src="<?php echo esc_url( $slide->slide_image ); ?>" alt="" />
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>

