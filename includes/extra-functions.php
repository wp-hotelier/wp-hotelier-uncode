<?php
/**
 * Extra functions.
 *
 * @author   Benito Lopez <hello@lopezb.com>
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Append a special class to the body when there are no room rates.
 */
function htl_uncode_add_room_rates_not_found_class( $classes ) {
	if ( is_room() ) {
		$room_id = get_the_ID();

		if ( $room_id > 0 ) {
			$room = htl_get_room( $room_id );

			if ( ! $room->is_variable_room() ) {
				$classes[] = 'no-room-rates';
			}
		}
	}

	return $classes;
}
add_filter( 'body_class', 'htl_uncode_add_room_rates_not_found_class' );

/**
 * When using dynamic headings, set the default title for
 * the reservation received page and the pay for reservation page
 */
function htl_uncode_dynamic_endpoint_titles( $title, $auto_text ) {
	if ( $auto_text ) {
		global $wp;

		if ( ! empty( $wp->query_vars['pay-reservation'] ) || isset( $wp->query_vars['reservation-received'] ) ) {
			$endpoint = HTL()->query->get_current_endpoint();
			$title    = HTL()->query->get_endpoint_title( $endpoint );
		}
	}

	return $title;
}
add_filter( 'uncode_vc_custom_heading_content', 'htl_uncode_dynamic_endpoint_titles', 10, 2 );

/**
 * Get room facilities as a list
 */
function htl_uncode_get_room_facilities_list( $room ) {
	$facilities = array();

	// Get room categories
	$terms = get_the_terms( $room->id, 'room_facilities' );

	if ( $terms && ! is_wp_error( $terms ) ) {
		foreach ( $terms as $term ) {
			$facilities[] = $term->name;
		}
	}

	return $facilities;
}
