<?php
/**
 * Core functions.
 *
 * @author   Benito Lopez <hello@lopezb.com>
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Strip text from room price.
 */
function htl_uncode_get_price_amount_whitout_text( $price ) {
	$del = false;
	$ins = false;

	$regex = '/<del\b[^>]*>.*?<\/del>/ms';
	preg_match_all( $regex, $price, $matches, PREG_SET_ORDER, 0 );

	foreach ( $matches as $key => $value ) {
		if ( isset( $value[0] ) ) {
			$del = $value[0];

			$has_sale = true;
		}
	}

	$regex = '/<ins\b[^>]*>.*?<\/ins>/ms';
	preg_match_all( $regex, $price, $matches, PREG_SET_ORDER, 0 );

	foreach ( $matches as $key => $value ) {
		if ( isset( $value[0] ) ) {
			$ins = $value[0];
		}
	}

	if ( $del && $ins ) {
		$price = $del . ' ' . $ins;
	} else {
		$regex = '/<span\b[^>]*>.*?<\/span>/ms';
		preg_match_all( $regex, $price, $matches, PREG_SET_ORDER, 0 );

		foreach ( $matches as $key => $value ) {
			if ( isset( $value[0] ) ) {
				$price = $value[0];
			}
		}
	}

	return $price;
}

/**
 * Get Room CPT labels.
 */
function htl_uncode_change_room_cpt_labels( $labels ) {
	if ( ! function_exists( 'ot_get_option' ) ) {
		return $labels;
	}

	$singular_label = ot_get_option( '_uncode_room_cpt_singular_label' );
	$singular_label = $singular_label ? $singular_label : esc_html_x( 'Room', 'singular room post type name', 'wp-hotelier' );
	$plural_label   = ot_get_option( '_uncode_room_cpt_plural_label' );
	$plural_label   = $plural_label ? $plural_label : esc_html_x( 'Rooms', 'room post type name', 'wp-hotelier' );

	$labels['name']               = $plural_label;
	$labels['singular_name']      = $singular_label;
	$labels['add_new_item']       = sprintf( esc_html__( 'Add New %s', 'wp-hotelier-uncode' ), $singular_label );
	$labels['edit_item']          = sprintf( esc_html__( 'Edit %s', 'wp-hotelier-uncode' ), $singular_label );
	$labels['new_item']           = sprintf( esc_html__( 'New %s', 'wp-hotelier-uncode' ), $singular_label );
	$labels['all_items']          = sprintf( esc_html__( 'All %s', 'wp-hotelier-uncode' ), $plural_label );
	$labels['view_item']          = sprintf( esc_html__( 'All %s', 'wp-hotelier-uncode' ), $singular_label );
	$labels['search_items']       = sprintf( esc_html__( 'Search %s', 'wp-hotelier-uncode' ), $plural_label );
	$labels['not_found']          = sprintf( esc_html__( 'No %s found', 'wp-hotelier-uncode' ), $plural_label );
	$labels['not_found_in_trash'] = sprintf( esc_html__( 'No %s found in Trash', 'wp-hotelier-uncode' ), $plural_label );
	$labels['menu_name']          = $plural_label;

	return $labels;
}
add_filter( 'hotelier_room_labels', 'htl_uncode_change_room_cpt_labels' );

/**
 * Populate room post object.
 */
function uncode_populate_room_object() {
	$room = false;
	$args = array(
		'post_type'      => 'room',
		'post_status'    => 'publish',
		'posts_per_page' => '1',
		'orderby'        => 'id',
		'order'          => 'asc',
	);

	$posts = get_posts( $args );

	if ( empty( $posts ) ) {
		return $room;
	}

	foreach( $posts as $_post ) {
		$post_id = apply_filters( 'uncode_default_frontend_editor_room_id', $_post->ID );
		$room = htl_get_room( $post_id );
	}

	return $room;
}
