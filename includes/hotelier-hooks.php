<?php
/**
 * WP Hotelier hooks.
 *
 * @author   Benito Lopez <hello@lopezb.com>
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Always return false when checking if room lightbox is active.
 */
add_filter( 'hotelier_get_option_room_lightbox', '__return_false' );

/**
 * Don't print Photoswipe markup
 */
remove_action( 'wp_footer', 'htl_photoswipe_markup' );

/**
 * Gallery is disabled in room list
 */
remove_action( 'hotelier_room_list_item_images', 'hotelier_template_loop_room_thumbnails', 20 );

/**
 * Add label to address2 field
 */
function htl_uncode_booking_default_address_fields( $fields ) {
	if ( isset( $fields['address2'] ) ) {
		$fields['address2']['label'] = esc_html__( 'Address 2 (optional)', 'wp-hotelier-uncode' );
	}

	return $fields;
}
add_filter( 'hotelier_booking_default_address_fields', 'htl_uncode_booking_default_address_fields' );

/**
 * Add special button classes to AJAX Room Booking button
 */
function htl_uncode_widget_ajax_room_booking_html( $html ) {
	$html = str_replace( 'button--widget-ajax-room-booking', 'button--widget-ajax-room-booking btn-default btn-block', $html );

	return $html;
}
add_filter( 'hotelier_widget_ajax_room_booking_html', 'htl_uncode_widget_ajax_room_booking_html' );
