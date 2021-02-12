<?php
/**
 * Page Options functions.
 *
 * @author   Benito Lopez <hello@lopezb.com>
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Add custom body fields in page options.
 */
function htl_uncode_add_page_options_body_fields( $body_fields ) {
	$post_type = uncode_get_current_post_type();


	if ( $post_type === 'room' ) {
		$new_body_fields  = array();

		$specific_show_room_details = array(
			'id'      => '_uncode_room_show_room_details',
			'label'   => esc_html__('Show Room Details', 'wp-hotelier-uncode') ,
			'desc'    => esc_html__('Override to show the Room Details in the content area.', 'wp-hotelier-uncode') ,
			'std'     => '',
			'type'    => 'select',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Inherit', 'wp-hotelier-uncode') ,
				) ,
				array(
					'value' => 'on',
					'label' => esc_html__('Yes', 'wp-hotelier-uncode') ,
				) ,
				array(
					'value' => 'off',
					'label' => esc_html__('No', 'wp-hotelier-uncode') ,
				) ,
			) ,
		);

		$specific_show_room_rates = array(
			'id'      => '_uncode_room_show_room_rates',
			'label'   => esc_html__('Show Room Rates', 'wp-hotelier-uncode') ,
			'desc'    => esc_html__('Override to show the Room Rates in variable rooms.', 'wp-hotelier-uncode') ,
			'std'     => '',
			'type'    => 'select',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Inherit', 'wp-hotelier-uncode') ,
				) ,
				array(
					'value' => 'on',
					'label' => esc_html__('Yes', 'wp-hotelier-uncode') ,
				) ,
				array(
					'value' => 'off',
					'label' => esc_html__('No', 'wp-hotelier-uncode') ,
				) ,
			) ,
		);

		$specific_media_display = array(
			'id'      => '_uncode_featured_media_display',
			'label'   => esc_html__('Media layout', 'uncode-core') ,
			'desc'    => esc_html__('Specify the layout mode for the images section.','uncode-core'),
			'type'    => 'select',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Inherit', 'uncode-core') ,
				) ,
				array(
					'value' => 'carousel',
					'label' => esc_html__('Carousel', 'uncode-core') ,
				) ,
				array(
					'value' => 'stack',
					'label' => esc_html__('Stack', 'uncode-core') ,
				) ,
				array(
					'value' => 'isotope',
					'label' => esc_html__('Grid', 'uncode-core') ,
				) ,
			),
		);

		foreach ( $body_fields as $body_fields_key => $body_field_value ) {
			if ( isset( $body_field_value['id'] ) ) {
				switch ( $body_field_value['id'] ) {
					case '_uncode_specific_featured_media':
						$new_body_fields[] = run_array_mb( $specific_media_display, '_uncode_specific_media:not(off)' );
						break;

					case '_uncode_specific_share':
						$new_body_fields[] = run_array_mb( $specific_show_room_details );
						$new_body_fields[] = run_array_mb( $specific_show_room_rates );
						break;

					case '_uncode_specific_content_block_after':
						$body_field_value['label'] = esc_html__( 'After Content (Related Rooms)', 'wp-hotelier-uncode' );
						break;
				}
			}

			$new_body_fields[] = $body_field_value;
		}

		$body_fields = $new_body_fields;
	}

	return $body_fields;
}
add_filter( 'uncode_core_page_options_body_fields', 'htl_uncode_add_page_options_body_fields' );

/**
 * Remove navigation fields in page options (rooms only).
 */
function htl_uncode_add_page_options_navigation_fields( $navigation_fields ) {
	$post_type = uncode_get_current_post_type();

	if ( $post_type === 'room' ) {
		$navigation_fields = array();
	}

	return $navigation_fields;
}
add_filter( 'uncode_core_page_options_navigation_fields', 'htl_uncode_add_page_options_navigation_fields' );
