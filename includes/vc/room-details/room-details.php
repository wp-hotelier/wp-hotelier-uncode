<?php
/**
 * Room Details config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function htl_uncode_room_details_settings() {
	$room_details_params = array(
		array(
			"type"        => "checkbox",
			"heading"     => esc_html__("Hide Room Price", 'wp-hotelier-uncode'),
			"param_name"  => "hide_room_price",
			"description" => esc_html__("Activate to hide the room price.", 'wp-hotelier-uncode'),
			"value"       => array(
				esc_html__("Yes, please", 'wp-hotelier-uncode') => 'yes'
			) ,
			"group"       => esc_html__("Room Price", 'wp-hotelier-uncode'),
		),
		array(
			"type"        => "checkbox",
			"heading"     => esc_html__("Hide Room Infos", 'wp-hotelier-uncode'),
			"param_name"  => "hide_room_infos",
			"description" => esc_html__("Activate to hide the room infos (deposit, additional inofs, etc).", 'wp-hotelier-uncode'),
			"value"       => array(
				esc_html__("Yes, please", 'wp-hotelier-uncode') => 'yes'
			) ,
			"group"       => esc_html__("Room Infos", 'wp-hotelier-uncode'),
		),
		array(
			"type"        => "checkbox",
			"heading"     => esc_html__("Hide Room Details", 'wp-hotelier-uncode'),
			"param_name"  => "hide_room_details",
			"description" => esc_html__("Activate to hide the room details.", 'wp-hotelier-uncode'),
			"value"       => array(
				esc_html__("Yes, please", 'wp-hotelier-uncode') => 'yes'
			) ,
			"group"       => esc_html__("Room Details", 'wp-hotelier-uncode'),
		),
		array(
			"type"        => "checkbox",
			"heading"     => esc_html__("Hide Title", 'wp-hotelier-uncode'),
			"param_name"  => "hide_room_details_titles",
			"description" => esc_html__("Activate to hide the default title.", 'wp-hotelier-uncode'),
			"value"       => array(
				esc_html__("Yes, please", 'wp-hotelier-uncode') => 'yes'
			) ,
			"group"       => esc_html__("Room Details", 'wp-hotelier-uncode'),
			'dependency'  => array(
				'element'   => 'hide_room_details',
				'is_empty' => true,
			),
		),
		array(
			"type"        => "checkbox",
			"heading"     => esc_html__("Hide Room Facilities", 'wp-hotelier-uncode'),
			"param_name"  => "hide_room_facilities",
			"description" => esc_html__("Activate to hide the room facilities.", 'wp-hotelier-uncode'),
			"value"       => array(
				esc_html__("Yes, please", 'wp-hotelier-uncode') => 'yes'
			) ,
			"group"       => esc_html__("Room Facilities", 'wp-hotelier-uncode'),
		),
		array(
			"type"        => "checkbox",
			"heading"     => esc_html__("Hide Title", 'wp-hotelier-uncode'),
			"param_name"  => "hide_room_facilities_titles",
			"description" => esc_html__("Activate to hide the default title.", 'wp-hotelier-uncode'),
			"value"       => array(
				esc_html__("Yes, please", 'wp-hotelier-uncode') => 'yes'
			) ,
			"group"       => esc_html__("Room Facilities", 'wp-hotelier-uncode'),
			'dependency'  => array(
				'element'   => 'hide_room_facilities',
				'is_empty' => true,
			),
		),
		array(
			"type"        => "checkbox",
			"heading"     => esc_html__("Display as list", 'wp-hotelier-uncode'),
			"param_name"  => "room_facilities_as_list",
			"description" => esc_html__("Activate to display the Room Facilities as a list.", 'wp-hotelier-uncode'),
			"value"       => array(
				esc_html__("Yes, please", 'wp-hotelier-uncode') => 'yes'
			) ,
			"group"       => esc_html__("Room Facilities", 'wp-hotelier-uncode'),
			'dependency'  => array(
				'element'   => 'hide_room_facilities',
				'is_empty' => true,
			),
		),
		array(
			"type"        => "dropdown",
			"heading"     => esc_html__("Number of columns", 'wp-hotelier-uncode'),
			"param_name"  => "room_facilities_list_columns",
			"description" => esc_html__("Select the number of columns.", 'wp-hotelier-uncode'),
			"group"       => esc_html__("Room Facilities", 'wp-hotelier-uncode'),
			'value' => array(
				esc_html__('1 columnn', 'uncode-core')  => 1,
				esc_html__('2 columnns', 'uncode-core') => 2,
				esc_html__('3 columnns', 'uncode-core') => 3,
				esc_html__('4 columnns', 'uncode-core') => 4,
				esc_html__('5 columnns', 'uncode-core') => 5,
			) ,
			'dependency'  => array(
				'element' => 'room_facilities_as_list',
				'value'   => 'yes',
			),
		),
		array(
			"type"        => "checkbox",
			"heading"     => esc_html__("Hide Room Conditions", 'wp-hotelier-uncode'),
			"param_name"  => "hide_room_conditions",
			"description" => esc_html__("Activate to hide the room conditions.", 'wp-hotelier-uncode'),
			"value"       => array(
				esc_html__("Yes, please", 'wp-hotelier-uncode') => 'yes'
			) ,
			"group"       => esc_html__("Room Conditions", 'wp-hotelier-uncode'),
		),
		array(
			"type"        => "checkbox",
			"heading"     => esc_html__("Hide Title", 'wp-hotelier-uncode'),
			"param_name"  => "hide_room_conditions_titles",
			"description" => esc_html__("Activate to hide the default title.", 'wp-hotelier-uncode'),
			"value"       => array(
				esc_html__("Yes, please", 'wp-hotelier-uncode') => 'yes'
			) ,
			"group"       => esc_html__("Room Conditions", 'wp-hotelier-uncode'),
			'dependency'  => array(
				'element'   => 'hide_room_conditions',
				'is_empty' => true,
			),
		),
	);

	$room_details_params[] = array(
		'type'        => 'textfield',
		'heading'     => esc_html__('Element ID', 'wp-hotelier-uncode'),
		'param_name'  => 'el_id',
		'description' => esc_html__('This value has to be unique. Change it in case it\'s needed.', 'wp-hotelier-uncode'),
		"group"       => esc_html__("Extra", 'wp-hotelier-uncode'),
	);

	$room_details_params[] = array(
		'type'        => 'textfield',
		'heading'     => esc_html__('Extra class name', 'wp-hotelier-uncode'),
		'param_name'  => 'el_class',
		'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'wp-hotelier-uncode'),
		"group"       => esc_html__("Extra", 'wp-hotelier-uncode'),
	);

	return array(
		'name'                    => esc_html__( 'Room Details', 'wp-hotelier-uncode' ),
		'description'             => esc_html__( 'WP Hotelier Room Details (Single Room)', 'wp-hotelier-uncode' ),
		'base'                    => 'htl_uncode_room_details_shortcode',
		'show_settings_on_create' => true,
		'icon'                    => 'fa fa-list',
		'category'                => array(
			esc_html__( 'WP Hotelier', 'wp-hotelier-uncode' ),
		),
		'weight'                  => -50,
		'params'                  => $room_details_params,
	);
}

vc_lean_map( 'htl_uncode_room_details_shortcode',	'htl_uncode_room_details_settings' );
