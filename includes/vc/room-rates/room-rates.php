<?php
/**
 * Room Rates config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function htl_uncode_room_rates_settings() {
	$room_rates_params = array(
		array(
			"type"        => "checkbox",
			"heading"     => esc_html__("Remove border", 'wp-hotelier-uncode'),
			"param_name"  => "room_rates_style_remove_border",
			"description" => esc_html__("Activate to remove the default border.", 'wp-hotelier-uncode'),
			"value"       => array(
				esc_html__("Yes, please", 'wp-hotelier-uncode') => 'yes'
			) ,
			"group"       => esc_html__("Style", 'wp-hotelier-uncode'),
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Shadow", 'wp-hotelier-uncode') ,
			"param_name" => "room_rates_style_shadow",
			"description" => esc_html__("Activate this for the shadow effect.", 'wp-hotelier-uncode') ,
			"value" => array(
				esc_html__("Yes, please", 'wp-hotelier-uncode') => 'yes'
			) ,
			"group" => esc_html__("Style", 'wp-hotelier-uncode') ,
		) ,
		array(
			"type" => "dropdown",
			"heading" => esc_html__("Shadow type", 'wp-hotelier-uncode') ,
			"param_name" => "room_rates_style_shadow_weight",
			"description" => esc_html__("Specify the shadow option preset.", 'wp-hotelier-uncode') ,
			"group" => esc_html__("Style", 'wp-hotelier-uncode') ,
			"value" => array(
				esc_html__('Extra Small', 'wp-hotelier-uncode') => 'xs',
				esc_html__('Small', 'wp-hotelier-uncode') => 'sm',
				esc_html__('Standard', 'wp-hotelier-uncode') => 'std',
				esc_html__('Large', 'wp-hotelier-uncode') => 'lg',
				esc_html__('Extra Large', 'wp-hotelier-uncode') => 'xl',
			) ,
			'dependency' => array(
				'element' => 'room_rates_style_shadow',
				'not_empty' => true
			) ,
		) ,
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Shadow Darker", 'wp-hotelier-uncode') ,
			"param_name" => "room_rates_style_shadow_darker",
			"description" => esc_html__("Activate this for the dark shadow effect.", 'wp-hotelier-uncode') ,
			"value" => array(
				esc_html__("Yes, please", 'wp-hotelier-uncode') => 'yes'
			) ,
			"group" => esc_html__("Style", 'wp-hotelier-uncode') ,
			'dependency' => array(
				'element' => 'room_rates_style_shadow',
				'not_empty' => true
			) ,
		) ,
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__('Element ID', 'wp-hotelier-uncode'),
			'param_name'  => 'el_id',
			'description' => esc_html__('This value has to be unique. Change it in case it\'s needed.', 'wp-hotelier-uncode'),
			"group"       => esc_html__("Extra", 'wp-hotelier-uncode'),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__('Extra class name', 'wp-hotelier-uncode'),
			'param_name'  => 'el_class',
			'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'wp-hotelier-uncode'),
			"group"       => esc_html__("Extra", 'wp-hotelier-uncode'),
		)
	);

	return array(
		'name'                    => esc_html__( 'Room Rates', 'wp-hotelier-uncode' ),
		'description'             => esc_html__( 'WP Hotelier Room Rates (Single Room)', 'wp-hotelier-uncode' ),
		'base'                    => 'htl_uncode_room_rates_shortcode',
		'show_settings_on_create' => false,
		'icon'                    => 'fa fa-tasks',
		'category'                => array(
			esc_html__( 'WP Hotelier', 'wp-hotelier-uncode' ),
		),
		'weight'                  => -50,
		'params'                  => $room_rates_params,
	);

}

vc_lean_map( 'htl_uncode_room_rates_shortcode',	'htl_uncode_room_rates_settings' );
