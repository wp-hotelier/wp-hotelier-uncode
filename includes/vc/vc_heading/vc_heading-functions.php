<?php
/**
 * VC Heading functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Add room price to vc_heading auto text.
 */
function htl_uncode_add_vc_heading_room_price() {
	$param = WPBMap::getParam( 'vc_custom_heading', 'auto_text' );

	if ( $param ) {
		$param['value'][esc_html__( 'Get the Price for Single Room (WP Hotelier)', 'wp-hotelier-uncode' )] = 'room_price';
		vc_update_shortcode_param( 'vc_custom_heading', $param );
	}
}
add_action( 'admin_init', 'htl_uncode_add_vc_heading_room_price', 1000 );

/**
 * Filter the ouput of VC Heading.
 */
function htl_uncode_vc_custom_heading_content( $content, $auto_text, $is_header ) {
	if ( $is_header !== 'yes' && $auto_text === 'room_price' ) {
		$post_type = uncode_get_current_post_type();

		if ( $post_type === 'room' ) {
			global $room;
			$content = $room->get_min_price_html();
		}
	}

	return $content;
}
add_filter( 'uncode_vc_custom_heading_content', 'htl_uncode_vc_custom_heading_content', 10, 3 );
