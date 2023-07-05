<?php
/**
 * Slideshow listing template.
 *
 * @package my-slideshow
 */

?>
<div class="container-fluid mt-4">
	<div class="d-flex align-items-center">
		<h3 class="mr-4 m-0 p-0"><?php echo esc_html__( 'Slideshows', 'my-slideshow' ); ?></h3>
		<a class="btn btn-outline-primary" href="<?php echo esc_url( admin_url( 'admin.php?page=add-new-slideshow' ) ); ?>"><?php echo esc_html__( 'Add New', 'my-slideshow' ); ?></a>
	</div>
	<hr />
		<table class="table">
			<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Slideshow Title</th>
				<th scope="col">Slideshow Shortcode</th>
				<th scope="col">Action</th>
			</tr>
			</thead>
			<tbody>
			<?php if ( isset( $slideshows ) && is_array( $slideshows ) && count( $slideshows ) > 0 ) : ?>
				<?php
					$count = 1;
				?>
				<?php foreach ( $slideshows as $slideshow ) : ?>
					<?php
						$shortcode     = get_slideshow_shortcode_by_id( $slideshow->ID );
						$slideshow_url = admin_url( 'admin.php?page=add-new-slideshow&slideshow_id=' . $slideshow->ID );
						$delete_url    = admin_url( 'admin.php?page=add-new-slideshow&slideshow_id=' . $slideshow->ID . '&action=delete' );
					?>
					<tr>
						<th scope="row"><?php echo esc_html( $count ); ?></th>
						<td><?php echo esc_html( $slideshow->slideshow_title ); ?></td>
						<td><code><?php echo esc_html( $shortcode ); ?></code></td>
						<td>
							<button class="btn btn-xs btn-info mr-2" onclick="copyText('<?php echo esc_attr( $shortcode ); ?>')"><?php echo esc_html__( 'Copy Shortcode', 'my-slideshow' ); ?></button>
							<a href="<?php echo esc_url( $slideshow_url ); ?>" class="btn btn-xs btn-dark mr-2"><?php echo esc_html__( 'Edit', 'my-slideshow' ); ?></a>
							<a href="<?php echo esc_url( $delete_url ); ?>" class="btn btn-xs btn-danger mr-2"><?php echo esc_html__( 'Delete', 'my-slideshow' ); ?></a>
						</td>
					</tr>
					<?php
					$count++;
					?>
				<?php endforeach; ?>
			<?php else : ?>
				<tr>
					<th colspan="4" class="bg-warning-light text-center"> No Slideshows Found</th>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
</div>
