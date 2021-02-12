<?php
/**
 * Booking config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$booking_params = array(
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Compact layout", 'wp-hotelier-uncode') ,
		"param_name" => "booking_form_compact",
		"description" => esc_html__('Activate this to activate the compact layout.', 'wp-hotelier-uncode') ,
		"value" => array(
			'' => 'yes'
		)
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Vertical align", 'wp-hotelier-') ,
		"param_name" => "booking_vertical_align",
		"value" => array(
			esc_html__('Middle', 'wp-hotelier-') => '',
			esc_html__('Top', 'wp-hotelier-') => 'top',
		) ,
		"description" => esc_html__("Specify the vertical alignment of the contents inside the tables.", 'wp-hotelier-')
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Show thumbnails", 'wp-hotelier-uncode') ,
		"param_name" => "booking_payment_show_thumbs",
		"description" => esc_html__('Activate this to show room thumbnails.', 'wp-hotelier-uncode') ,
		"value" => array(
			'' => 'yes'
		),
	) ,
);

$booking_params = array_merge( $booking_params, uncode_core_vc_params_get_wc_heading_options( $heading_font, $heading_size, $heading_weight, $heading_height, $heading_space ) );

$booking_button_options = array(
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Buttons color", 'wp-hotelier-uncode') ,
		"param_name" => "booking_buttons_color",
		"description" => esc_html__("Specify button color.", 'wp-hotelier-uncode') ,
		"value" => $uncode_colors,
		"group"       => esc_html__("Buttons & Forms", 'wp-hotelier-uncode'),
	) ,
	array(
		"type"        => "dropdown",
		"heading"     => esc_html__("Buttons hover effect", 'wp-hotelier-uncode'),
		"param_name"  => "booking_buttons_hover_effect",
		"description" => esc_html__("Specify an effect on hover state.", 'wp-hotelier-uncode'),
		'value'       => array(
			esc_html__( 'Inherit', 'wp-hotelier-uncode' )  => '',
			esc_html__( 'Outlined', 'wp-hotelier-uncode' ) => 'outlined',
			esc_html__( 'Flat', 'wp-hotelier-uncode' )     => 'full-colored',
		) ,
		"group"       => esc_html__("Buttons & Forms", 'wp-hotelier-uncode'),
	),
	array(
		"type"        => "checkbox",
		"heading"     => esc_html__("Buttons Custom Typography", 'wp-hotelier-uncode'),
		"param_name"  => "booking_buttons_custom_typo",
		"description" => esc_html__("Define custom font settings.", 'wp-hotelier-uncode'),
		"value"       => array(
			esc_html__("Yes, please", 'wp-hotelier-uncode') => 'yes'
		) ,
		"group"       => esc_html__("Buttons & Forms", 'wp-hotelier-uncode'),
	),
	array(
		'type'        => 'dropdown',
		'param_name'  => 'booking_buttons_font_family',
		'heading'     => esc_html__('Font family', 'wp-hotelier-uncode') ,
		'description' => esc_html__('Specify the buttons font family.', 'wp-hotelier-uncode') ,
		'std'         => '',
		'value'       => $button_font,
		"group"       => esc_html__("Buttons & Forms", 'wp-hotelier-uncode'),
		'dependency'  => array(
			'element'   => 'booking_buttons_custom_typo',
			'not_empty' => true,
		),
	) ,
	array(
		'type'        => 'dropdown',
		'param_name'  => 'booking_buttons_font_weight',
		'heading'     => esc_html__('Font weight', 'wp-hotelier-uncode') ,
		'description' => esc_html__('Specify the buttons font weight.', 'wp-hotelier-uncode') ,
		'std'         => '',
		'value'       => $button_weight,
		"group"       => esc_html__("Buttons & Forms", 'wp-hotelier-uncode'),
		'dependency'  => array(
			'element'   => 'booking_buttons_custom_typo',
			'not_empty' => true,
		),
	) ,
	array(
		'type'        => 'dropdown',
		'param_name'  => 'booking_buttons_text_transform',
		'heading'     => esc_html__('Text transform', 'wp-hotelier-uncode') ,
		'description' => esc_html__('Specify the buttons text transform.', 'wp-hotelier-uncode') ,
		'std'         => '',
		"group"       => esc_html__("Buttons & Forms", 'wp-hotelier-uncode'),
		'value'       => array(
			array(
				'value' => '',
				'label' => esc_html__('Initial', 'wp-hotelier-uncode') ,
			) ,
			array(
				'value' => 'uppercase',
				'label' => esc_html__('Uppercase', 'wp-hotelier-uncode') ,
			) ,
			array(
				'value' => 'lowercase',
				'label' => esc_html__('Lowercase', 'wp-hotelier-uncode') ,
			) ,
			array(
				'value' => 'capitalize',
				'label' => esc_html__('Capitalize', 'wp-hotelier-uncode') ,
			) ,
		) ,
		'dependency' => array(
			'element' => 'booking_buttons_custom_typo',
			'not_empty' => true,
		),
	) ,
	array(
		'type'        => 'dropdown',
		'param_name'  => 'booking_buttons_letter_spacing',
		'heading'     => esc_html__('Letter spacing', 'wp-hotelier-uncode') ,
		'description' => esc_html__('Specify the letter spacing value.', 'wp-hotelier-uncode') ,
		'value'       => $btn_letter_spacing,
		"group"       => esc_html__("Buttons & Forms", 'wp-hotelier-uncode'),
		'dependency'  => array(
			'element'   => 'booking_buttons_custom_typo',
			'not_empty' => true,
		),
	) ,
);

$booking_params = array_merge( $booking_params, $booking_button_options );

$booking_params[] = uncode_core_vc_params_get_wc_form_style_option();
$booking_params[] = uncode_core_vc_params_get_wc_bold_text_option();

$booking_params[] = array(
	'type'        => 'textfield',
	'heading'     => esc_html__('Element ID', 'wp-hotelier-uncode'),
	'param_name'  => 'el_id',
	'description' => esc_html__('This value has to be unique. Change it in case it\'s needed.', 'wp-hotelier-uncode'),
	"group"       => esc_html__("Extra", 'wp-hotelier-uncode'),
);

$booking_params[] = array(
	'type'        => 'textfield',
	'heading'     => esc_html__('Extra class name', 'wp-hotelier-uncode'),
	'param_name'  => 'el_class',
	'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'wp-hotelier-uncode'),
	"group"       => esc_html__("Extra", 'wp-hotelier-uncode'),
);

vc_map(
	array(
		'name'                    => esc_html__( 'Booking', 'wp-hotelier-uncode' ),
		'base'                    => 'hotelier_booking',
		'weight'                  => -50,
		'show_settings_on_create' => true,
		'icon'                    => 'fa fa-credit-card',
		'category'                => array(
			esc_html__( 'WP Hotelier', 'wp-hotelier-uncode' ),
		),
		'description'             => esc_html__( 'WP Hotelier Booking', 'wp-hotelier-uncode' ),
		'params'                  => $booking_params,
	)
);
