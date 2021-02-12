<?php
/**
 * Listing config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$listing_params = array(
	array(
		"type"        => "textfield",
		"heading"     => esc_html__("Label", 'wp-hotelier-uncode'),
		"param_name"  => "datepicker_label",
		"description" => esc_html__("Optional datepicker label.", 'wp-hotelier-uncode'),
		"dependency"  => array(
			'element'  => "inputs_style",
			'is_empty' => true
		) ,
		"group"       => esc_html__("Datepicker", 'wp-hotelier-uncode'),
	),
	array(
		"type"        => "dropdown",
		"heading"     => esc_html__("Layout", 'wp-hotelier-uncode'),
		"param_name"  => "datepicker_layout",
		"description" => esc_html__("Specify the datepicker layout.", 'wp-hotelier-uncode'),
		'value'       => array(
			esc_html__( 'Default', 'wp-hotelier-uncode' )  => 'default',
			esc_html__( 'Vertical', 'wp-hotelier-uncode' ) => 'vertical',
		) ,
		"group"       => esc_html__("Datepicker", 'wp-hotelier-uncode'),
	),
	array(
		"type"        => "dropdown",
		"heading"     => esc_html__("Dropdown skin", 'wp-hotelier-uncode'),
		"param_name"  => "datepicker_dropdown_skin",
		"description" => esc_html__("Specify the skin of the datepicker dropdown.", 'wp-hotelier-uncode'),
		'value'       => array(
			esc_html__( 'Light', 'wp-hotelier-uncode' ) => 'light',
			esc_html__( 'Dark', 'wp-hotelier-uncode' )  => 'dark',
		) ,
		"group"       => esc_html__("Datepicker", 'wp-hotelier-uncode'),
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
		"group"       => esc_html__("Datepicker", 'wp-hotelier-uncode'),
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Button color", 'wp-hotelier-uncode') ,
		"param_name" => "datepicker_button_color",
		"description" => esc_html__("Specify the color of the datepicker button.", 'wp-hotelier-uncode') ,
		"value" => $uncode_colors,
		"group"       => esc_html__("Datepicker", 'wp-hotelier-uncode'),
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
		"group"       => esc_html__("Datepicker", 'wp-hotelier-uncode'),
	),
	array(
		"type"        => "checkbox",
		"heading"     => esc_html__("Buttons Custom Typography", 'wp-hotelier-uncode'),
		"param_name"  => "datepicker_button_custom_typo",
		"description" => esc_html__("Define custom font settings.", 'wp-hotelier-uncode'),
		"value"       => array(
			esc_html__("Yes, please", 'wp-hotelier-uncode') => 'yes'
		) ,
		"group"       => esc_html__("Datepicker", 'wp-hotelier-uncode'),
	),
	array(
		'type'        => 'dropdown',
		'param_name'  => 'datepicker_button_font_family',
		'heading'     => esc_html__('Font family', 'wp-hotelier-uncode') ,
		'description' => esc_html__('Specify the button font family.', 'wp-hotelier-uncode') ,
		'std'         => '',
		'value'       => $button_font,
		"group"       => esc_html__("Datepicker", 'wp-hotelier-uncode'),
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
		"group"       => esc_html__("Datepicker", 'wp-hotelier-uncode'),
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
		"group"       => esc_html__("Datepicker", 'wp-hotelier-uncode'),
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
		"group"       => esc_html__("Datepicker", 'wp-hotelier-uncode'),
		'dependency'  => array(
			'element'   => 'datepicker_button_custom_typo',
			'not_empty' => true,
		),
	) ,
);

$listing_params = array_merge( $listing_params, uncode_core_vc_params_get_wc_heading_options( $heading_font, $heading_size, $heading_weight, $heading_height, $heading_space ) );

$listing_button_options = array(
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Buttons color", 'wp-hotelier-uncode') ,
		"param_name" => "listing_buttons_color",
		"description" => esc_html__("Specify button color.", 'wp-hotelier-uncode') ,
		"value" => $uncode_colors,
		"group"       => esc_html__("Buttons", 'wp-hotelier-uncode'),
	) ,
	array(
		"type"        => "dropdown",
		"heading"     => esc_html__("Buttons hover effect", 'wp-hotelier-uncode'),
		"param_name"  => "listing_buttons_hover_effect",
		"description" => esc_html__("Specify an effect on hover state.", 'wp-hotelier-uncode'),
		'value'       => array(
			esc_html__( 'Inherit', 'wp-hotelier-uncode' )  => '',
			esc_html__( 'Outlined', 'wp-hotelier-uncode' ) => 'outlined',
			esc_html__( 'Flat', 'wp-hotelier-uncode' )     => 'full-colored',
		) ,
		"group"       => esc_html__("Buttons", 'wp-hotelier-uncode'),
	),
	array(
		"type"        => "checkbox",
		"heading"     => esc_html__("Buttons Custom Typography", 'wp-hotelier-uncode'),
		"param_name"  => "listing_buttons_custom_typo",
		"description" => esc_html__("Define custom font settings.", 'wp-hotelier-uncode'),
		"value"       => array(
			esc_html__("Yes, please", 'wp-hotelier-uncode') => 'yes'
		) ,
		"group"       => esc_html__("Buttons", 'wp-hotelier-uncode'),
	),
	array(
		'type'        => 'dropdown',
		'param_name'  => 'listing_buttons_font_family',
		'heading'     => esc_html__('Font family', 'wp-hotelier-uncode') ,
		'description' => esc_html__('Specify the buttons font family.', 'wp-hotelier-uncode') ,
		'std'         => '',
		'value'       => $button_font,
		"group"       => esc_html__("Buttons", 'wp-hotelier-uncode'),
		'dependency'  => array(
			'element'   => 'listing_buttons_custom_typo',
			'not_empty' => true,
		),
	) ,
	array(
		'type'        => 'dropdown',
		'param_name'  => 'listing_buttons_font_weight',
		'heading'     => esc_html__('Font weight', 'wp-hotelier-uncode') ,
		'description' => esc_html__('Specify the buttons font weight.', 'wp-hotelier-uncode') ,
		'std'         => '',
		'value'       => $button_weight,
		"group"       => esc_html__("Buttons", 'wp-hotelier-uncode'),
		'dependency'  => array(
			'element'   => 'listing_buttons_custom_typo',
			'not_empty' => true,
		),
	) ,
	array(
		'type'        => 'dropdown',
		'param_name'  => 'listing_buttons_text_transform',
		'heading'     => esc_html__('Text transform', 'wp-hotelier-uncode') ,
		'description' => esc_html__('Specify the buttons text transform.', 'wp-hotelier-uncode') ,
		'std'         => '',
		"group"       => esc_html__("Buttons", 'wp-hotelier-uncode'),
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
			'element' => 'listing_buttons_custom_typo',
			'not_empty' => true,
		),
	) ,
	array(
		'type'        => 'dropdown',
		'param_name'  => 'listing_buttons_letter_spacing',
		'heading'     => esc_html__('Letter spacing', 'wp-hotelier-uncode') ,
		'description' => esc_html__('Specify the letter spacing value.', 'wp-hotelier-uncode') ,
		'value'       => $btn_letter_spacing,
		"group"       => esc_html__("Buttons", 'wp-hotelier-uncode'),
		'dependency'  => array(
			'element'   => 'listing_buttons_custom_typo',
			'not_empty' => true,
		),
	) ,
);

$listing_params = array_merge( $listing_params, $listing_button_options );

$listing_style_options = array(
	array(
		"type"        => "checkbox",
		"heading"     => esc_html__("Remove border", 'wp-hotelier-uncode'),
		"param_name"  => "listing_style_remove_border",
		"description" => esc_html__("Activate to remove the default border.", 'wp-hotelier-uncode'),
		"value"       => array(
			esc_html__("Yes, please", 'wp-hotelier-uncode') => 'yes'
		) ,
		"group"       => esc_html__("Style", 'wp-hotelier-uncode'),
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Shadow", 'wp-hotelier-uncode') ,
		"param_name" => "listing_style_shadow",
		"description" => esc_html__("Activate this for the shadow effect.", 'wp-hotelier-uncode') ,
		"value" => array(
			esc_html__("Yes, please", 'wp-hotelier-uncode') => 'yes'
		) ,
		"group" => esc_html__("Style", 'wp-hotelier-uncode') ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Shadow type", 'wp-hotelier-uncode') ,
		"param_name" => "listing_style_shadow_weight",
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
			'element' => 'listing_style_shadow',
			'not_empty' => true
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Shadow Darker", 'wp-hotelier-uncode') ,
		"param_name" => "listing_style_shadow_darker",
		"description" => esc_html__("Activate this for the dark shadow effect.", 'wp-hotelier-uncode') ,
		"value" => array(
			esc_html__("Yes, please", 'wp-hotelier-uncode') => 'yes'
		) ,
		"group" => esc_html__("Style", 'wp-hotelier-uncode') ,
		'dependency' => array(
			'element' => 'listing_style_shadow',
			'not_empty' => true
		) ,
	) ,
);

$listing_params = array_merge( $listing_params, $listing_style_options );

$listing_params[] = array(
	'type'        => 'textfield',
	'heading'     => esc_html__('Element ID', 'wp-hotelier-uncode'),
	'param_name'  => 'el_id',
	'description' => esc_html__('This value has to be unique. Change it in case it\'s needed.', 'wp-hotelier-uncode'),
	"group"       => esc_html__("Extra", 'wp-hotelier-uncode'),
);

$listing_params[] = array(
	'type'        => 'textfield',
	'heading'     => esc_html__('Extra class name', 'wp-hotelier-uncode'),
	'param_name'  => 'el_class',
	'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'wp-hotelier-uncode'),
	"group"       => esc_html__("Extra", 'wp-hotelier-uncode'),
);

vc_map(
	array(
		'name'                    => esc_html__( 'Listing', 'wp-hotelier-uncode' ),
		'base'                    => 'hotelier_listing',
		'weight'                  => -50,
		'show_settings_on_create' => true,
		'icon'                    => 'fa fa-check-square-o',
		'category'                => array(
			esc_html__( 'WP Hotelier', 'wp-hotelier-uncode' ),
		),
		'description'             => esc_html__( 'WP Hotelier Listing', 'wp-hotelier-uncode' ),
		'params'                  => $listing_params,
	)
);
