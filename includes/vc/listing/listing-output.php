<?php
/**
 * Listing output
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Remove default action that prints the datepicker
 */
remove_action( 'hotelier_room_list_datepicker', 'hotelier_template_datepicker', 10 );

/**
 * Print datepicker in room list
 */
function htl_uncode_print_room_list_datepicker( $atts ) {
	$checkin  = HTL()->session->get( 'checkin' );
	$checkout = HTL()->session->get( 'checkout' );

	htl_get_template( 'global/datepicker.php', array( 'checkin' => $checkin, 'checkout' => $checkout, 'shortcode_atts' => $atts ) );
}
add_action( 'hotelier_room_list_datepicker', 'htl_uncode_print_room_list_datepicker', 10 );

/**
 * Run hook before the listing form
 */
function htl_uncode_before_room_list_form( $atts ) {
	// Extra settings
	$el_id          = isset( $atts['el_id'] ) ? $atts['el_id'] : false;
	$el_class       = isset( $atts['el_class'] ) ? $atts['el_class'] : false;
	$no_border      = isset( $atts['listing_style_remove_border'] ) && $atts['listing_style_remove_border'] ? true : false;
	$shadow_enabled = isset( $atts['listing_style_shadow'] ) && $atts['listing_style_shadow'] ? true : false;
	$shadow_weight  = $shadow_enabled && isset( $atts['listing_style_shadow_weight'] ) ? $atts['listing_style_shadow_weight'] : 'xs';
	$shadow_darker  = $shadow_enabled && isset( $atts['listing_style_shadow_darker'] ) && $atts['listing_style_shadow_darker'] ? true : false;

	// Custom ID
	if ( $el_id ) {
		$container_id = ' id="' . esc_attr( trim( $el_id ) ) . '"';
	} else {
		$container_id = '';
	}

	// Custom classes
	$container_classes = array( 'uncode-htl-module', 'uncode-htl-module--listing' );

	if ( $no_border ) {
		$container_classes[] = 'items-list-no-border';
	}

	if ( $shadow_enabled ) {
		$container_classes[] = 'items-list-shadowed';
		$container_classes[] = 'items-list-shadowed--' . $shadow_weight;

		if ( $shadow_darker ) {
			$container_classes[] = 'items-list-shadowed--darker';
		}
	}

	if ( $el_class ) {
		$extra_classes = explode( ' ', $el_class );

		foreach ( $extra_classes as $extra_class ) {
			$container_classes[] = $extra_class;
		}
	}

	echo '<div ' . $container_id . ' class="' . esc_attr( trim( implode( ' ', $container_classes ) ) ) . '">';
}
add_action( 'hotelier_before_room_list_form', 'htl_uncode_before_room_list_form' );

/**
 * Run hook after the listing form
 */
function htl_uncode_after_room_list_form( $atts ) {
	echo '</div>';
}
add_action( 'hotelier_after_room_list_form', 'htl_uncode_after_room_list_form' );
