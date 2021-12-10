<?php
/**
 * WP Hotelier settings and meta boxes.
 *
 * @author   Benito Lopez <hello@lopezb.com>
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Remove WP Hotelier gallery.
 */
function htl_uncode_remove_hotelier_gallery( $settings ) {
	if ( isset( $settings[ 'room_lightbox' ] ) ) {
		unset( $settings[ 'room_lightbox' ] );
	}

	if ( isset( $settings[ 'room_single_image_size' ] ) ) {
		unset( $settings[ 'room_single_image_size' ] );
	}

	if ( isset( $settings[ 'room_hide_gallery' ] ) ) {
		unset( $settings[ 'room_hide_gallery' ] );
	}

	if ( isset( $settings[ 'room_hide_rates' ] ) ) {
		unset( $settings[ 'room_hide_rates' ] );
	}

	if ( isset( $settings[ 'room_hide_related' ] ) ) {
		unset( $settings[ 'room_hide_related' ] );
	}

	return $settings;
}
add_filter( 'hotelier_settings_rooms_and_reservations', 'htl_uncode_remove_hotelier_gallery' );

/**
 * Remove room gallery metaboxes.
 */
function htl_uncode_remove_room_gallery_meta_boxes() {
    remove_meta_box( 'hotelier-room-images', 'room' , 'side' );
}
add_action( 'admin_head', 'htl_uncode_remove_room_gallery_meta_boxes' );
