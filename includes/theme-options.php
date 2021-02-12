<?php
/**
 * Theme Options functions.
 *
 * @author   Benito Lopez <hello@lopezb.com>
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Get theme options settings ID.
 */
function htl_uncode_get_ot_settings_id() {
	$ot_settings_id = function_exists( 'ot_settings_id' ) ? ot_settings_id() : 'uncode_settings';

	return $ot_settings_id;
}

/**
 * Add custom theme options.
 */
function htl_uncode_add_theme_options( $theme_options ) {
	$show_room_details = array(
		'id'      => '_uncode_room_show_room_details',
		'label'   => esc_html__( 'Show Room Details', 'wp-hotelier-uncode' ) ,
		'desc'    => esc_html__( 'Activate to show the Room Details in the content area.', 'wp-hotelier-uncode' ) ,
		'std'     => 'on',
		'type'    => 'on-off',
		'section' => 'uncode_room_section',
	);

	$show_room_rates = array(
		'id'      => '_uncode_room_show_room_rates',
		'label'   => esc_html__( 'Show Room Rates', 'wp-hotelier-uncode' ) ,
		'desc'    => esc_html__( 'Activate to show the Room Rates in variable rooms.', 'wp-hotelier-uncode' ) ,
		'std'     => 'on',
		'type'    => 'on-off',
		'section' => 'uncode_room_section',
	);

	$settings = isset( $theme_options['settings'] ) ? $theme_options['settings'] : array();

	$new_settings  = array();
	$media_display = array();

	if ( is_array( $settings ) ) {
		foreach ( $settings as $setting_key => $setting_value ) {
			if ( isset( $setting_value['id'] ) ) {
				switch ( $setting_value['id'] ) {
					case '_uncode_room_comments':
					case '_uncode_room_content_block_after_pre':
					case '_uncode_room_image_layout':
					case '_uncode_room_media_size':
					case '_uncode_room_sticky_desc':
					case '_uncode_room_enable_zoom':
					case '_uncode_room_thumb_cols':
					case '_uncode_room_enable_slider':
					case '_uncode_room_navigation_title':
					case '_uncode_room_navigation_activate':
					case '_uncode_room_navigation_index':
					case '_uncode_room_navigation_index_label':
					case '_uncode_room_navigation_nextprev_title':
						continue 2;
						break;

					case '_uncode_post_featured_media_display':
						$media_display              = $setting_value;
						$media_display['id']        = '_uncode_room_featured_media_display';
						$media_display['section']   = 'uncode_room_section';
						$media_display['condition'] = '_uncode_room_media:is(on)';
						break;

					case '_uncode_room_share':
						$new_settings[] = $media_display;
						$new_settings[] = $show_room_details;
						$new_settings[] = $show_room_rates;
						break;

					case '_uncode_room_content_block_after':
						$setting_value['label'] = esc_html__( 'After Content (Related Rooms)', 'wp-hotelier-uncode' );
						break;
				}
			}

			$new_settings[] = $setting_value;
		}

		$new_settings[] = array(
			'id' => '_uncode_custom_room_block_title',
			'label' => '<i class="fa fa-tag2"></i> ' . esc_html__('Room CPT', 'wp-hotelier-uncode') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_extra_section',
		);

		$new_settings[] = array(
			'id' => '_uncode_room_cpt_singular_label',
			'label' => esc_html__('Room CPT singular label', 'wp-hotelier-uncode') ,
			'desc' => esc_html__('Enter a custom Room Post Type singular label.', 'wp-hotelier-uncode') ,
			'std' => 'Room',
			'type' => 'text',
			'section' => 'uncode_extra_section',
		);

		$new_settings[] = array(
			'id' => '_uncode_room_cpt_plural_label',
			'label' => esc_html__('Room CPT plural label', 'wp-hotelier-uncode') ,
			'desc' => esc_html__('Enter a custom Room Post Type plural label.', 'wp-hotelier-uncode') ,
			'std' => 'Rooms',
			'type' => 'text',
			'section' => 'uncode_extra_section',
		);

		$new_settings[] = array(
			'id' => '_uncode_room_cpt_slug',
			'label' => esc_html__('Room CPT slug', 'wp-hotelier-uncode') ,
			'desc' => esc_html__('Enter a custom Room Post Type slug.', 'wp-hotelier-uncode') ,
			'std' => 'rooms',
			'type' => 'text',
			'section' => 'uncode_extra_section',
		);

		$new_settings[] = array(
			'id' => '_uncode_room_tax_slug',
			'label' => esc_html__('Room Category slug', 'wp-hotelier-uncode') ,
			'desc' => esc_html__('Enter a custom Room Category slug.', 'wp-hotelier-uncode') ,
			'std' => 'room-type',
			'type' => 'text',
			'section' => 'uncode_extra_section',
		);

		$theme_options['settings'] = $new_settings;
	}

	return $theme_options;
}
add_filter( htl_uncode_get_ot_settings_id() . '_args', 'htl_uncode_add_theme_options' );
