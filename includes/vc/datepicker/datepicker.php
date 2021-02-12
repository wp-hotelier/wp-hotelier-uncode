<?php
/**
 * Datepicker config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $uncode_colors;

$datepicker_params = array(
	array(
		"type"        => "textfield",
		"heading"     => esc_html__("Label", 'wp-hotelier-uncode'),
		"param_name"  => "datepicker_label",
		"description" => esc_html__("Optional datepicker label.", 'wp-hotelier-uncode'),
		"dependency"  => array(
			'element'  => "inputs_style",
			'is_empty' => true
		) ,
	),
	array(
		"type"        => "dropdown",
		"heading"     => esc_html__("Layout", 'wp-hotelier-uncode'),
		"param_name"  => "datepicker_layout",
		"description" => esc_html__("Specify the datepicker layout.", 'wp-hotelier-uncode'),
		'value'       => array(
			esc_html__( 'Default', 'uncode-core' )  => 'default',
			esc_html__( 'Vertical', 'uncode-core' ) => 'vertical',
		) ,
	),
	array(
		"type"        => "dropdown",
		"heading"     => esc_html__("Dropdown skin", 'wp-hotelier-uncode'),
		"param_name"  => "datepicker_dropdown_skin",
		"description" => esc_html__("Specify the skin of the datepicker dropdown.", 'wp-hotelier-uncode'),
		'value'       => array(
			esc_html__( 'Light', 'uncode-core' ) => 'light',
			esc_html__( 'Dark', 'uncode-core' )  => 'dark',
		) ,
	),
	array(
		'type' => 'iconpicker',
		'heading' => esc_html__('Icon', 'wp-hotelier-uncode') ,
		'param_name' => 'icon',
		'description' => esc_html__('Specify icon from library.', 'wp-hotelier-uncode') ,
		'settings' => array(
			'emptyIcon' => true,
			'iconsPerPage' => 1100,
			'type' => 'uncode'
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Button color", 'wp-hotelier-uncode') ,
		"param_name" => "datepicker_button_color",
		"description" => esc_html__("Specify the color of the datepicker button.", 'wp-hotelier-uncode') ,
		"value" => $uncode_colors,
	) ,
	array(
		"type"        => "dropdown",
		"heading"     => esc_html__("Button hover effect", 'wp-hotelier-uncode'),
		"param_name"  => "datepicker_button_hover_effect",
		"description" => esc_html__("Specify an effect on hover state.", 'wp-hotelier-uncode'),
		'value'       => array(
			esc_html__( 'Inherit', 'wp-hotelier-uncode' )  => '',
			esc_html__( 'Outlined', 'wp-hotelier-uncode' ) => 'outlined',
			esc_html__( 'Flat', 'wp-hotelier-uncode' )     => 'full-colored',
		) ,
	),
	array(
		"type"        => "checkbox",
		"heading"     => esc_html__("Buttons Custom Typography", 'wp-hotelier-uncode'),
		"param_name"  => "datepicker_button_custom_typo",
		"description" => esc_html__("Define custom font settings.", 'wp-hotelier-uncode'),
		"value"       => array(
			esc_html__("Yes, please", 'wp-hotelier-uncode') => 'yes'
		) ,
	),
	array(
		'type'        => 'dropdown',
		'param_name'  => 'datepicker_button_font_family',
		'heading'     => esc_html__('Font family', 'wp-hotelier-uncode') ,
		'description' => esc_html__('Specify the button font family.', 'wp-hotelier-uncode') ,
		'std'         => '',
		'value'       => $button_font,
		'dependency'  => array(
			'element'   => 'datepicker_button_custom_typo',
			'not_empty' => true,
		),
	) ,
	array(
		'type'        => 'dropdown',
		'param_name'  => 'datepicker_button_font_weight',
		'heading'     => esc_html__('Font weight', 'wp-hotelier-uncode') ,
		'description' => esc_html__('Specify the button font weight.', 'wp-hotelier-uncode') ,
		'std'         => '',
		'value'       => $button_weight,
		'dependency'  => array(
			'element'   => 'datepicker_button_custom_typo',
			'not_empty' => true,
		),
	) ,
	array(
		'type'        => 'dropdown',
		'param_name'  => 'datepicker_button_text_transform',
		'heading'     => esc_html__('Text transform', 'wp-hotelier-uncode') ,
		'description' => esc_html__('Specify the button text transform.', 'wp-hotelier-uncode') ,
		'std'         => '',
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
			'element' => 'datepicker_button_custom_typo',
			'not_empty' => true,
		),
	) ,
	array(
		'type'        => 'dropdown',
		'param_name'  => 'datepicker_button_letter_spacing',
		'heading'     => esc_html__('Letter spacing', 'wp-hotelier-uncode') ,
		'description' => esc_html__('Specify the letter spacing value.', 'wp-hotelier-uncode') ,
		'value'       => $btn_letter_spacing,
		'dependency'  => array(
			'element'   => 'datepicker_button_custom_typo',
			'not_empty' => true,
		),
	) ,

);

$datepicker_params[] = array(
	'type'        => 'textfield',
	'heading'     => esc_html__('Element ID', 'wp-hotelier-uncode'),
	'param_name'  => 'el_id',
	'description' => esc_html__('This value has to be unique. Change it in case it\'s needed.', 'wp-hotelier-uncode'),
	"group"       => esc_html__("Extra", 'wp-hotelier-uncode'),
);

$datepicker_params[] = array(
	'type'        => 'textfield',
	'heading'     => esc_html__('Extra class name', 'wp-hotelier-uncode'),
	'param_name'  => 'el_class',
	'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'wp-hotelier-uncode'),
	"group"       => esc_html__("Extra", 'wp-hotelier-uncode'),
);

vc_map(
	array(
		'name'                    => esc_html__( 'Datepicker', 'wp-hotelier-uncode' ),
		'base'                    => 'hotelier_datepicker',
		'weight'                  => -50,
		'show_settings_on_create' => true,
		'icon'                    => 'fa fa-calender-outline',
		'category'                => array(
			esc_html__( 'WP Hotelier', 'wp-hotelier-uncode' ),
		),
		'description'             => esc_html__( 'WP Hotelier Datepicker', 'wp-hotelier-uncode' ),
		'params'                  => $datepicker_params,
	)
);
