<?php
/**
 * Room thumbnail
 *
 * This template can be overridden by copying it to yourtheme/hotelier/room-list/content/image.php.
 *
 * @author  Benito Lopez <hello@lopezb.com>
 * @package Hotelier/Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $room;

?>

<div class="room__image room__image--listing">

	<?php
		if ( has_post_thumbnail() ) {

			echo get_the_post_thumbnail( $post->ID, 'room_catalog' );

		} else {

			echo htl_placeholder_img( 'room_catalog' );

		}
	?>
</div>
