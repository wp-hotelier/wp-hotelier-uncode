<?php
/**
 * Templates markup.
 *
 * @author   Benito Lopez <hello@lopezb.com>
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Get room facilities and wrap them in columns.
 */
function htl_uncode_get_room_facilities() {
	global $room;

	?>

	<?php if ( $facilities = $room->get_facilities() ) : ?>

	<div class="room__facilities room__facilities--single">

		<?php if ( apply_filters( 'hotelier_single_room_facilities_show_title', true ) ) : ?>
			<h3 class="room__facilities-title room__facilities-title--single"><?php esc_html_e( 'Facilities', 'wp-hotelier' ); ?></h3>
		<?php endif; ?>

		<?php if ( apply_filters( 'hotelier_uncode_single_room_facilities_as_list', false ) ) : ?>
			<?php $facilities = htl_uncode_get_room_facilities_list( $room ); ?>
			<div class="room__facilities-content room__facilities-content--single">
				<?php if ( is_array( $facilities ) ) : ?>
					<ul class="room__facilities-list room__facilities-list--columns-<?php echo ( apply_filters( 'hotelier_uncode_single_room_facilities_list_columns', 1 ) ); ?>">
					<?php foreach ($facilities as $facility ) : ?>
						<li class="room__facilities-list__item"><?php echo $facility; ?></li>
					<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		<?php else : ?>
			<p class="room__facilities-content room__facilities-content--single"><?php echo $facilities; ?></p>
		<?php endif; ?>

	</div>

	<?php endif;
}
