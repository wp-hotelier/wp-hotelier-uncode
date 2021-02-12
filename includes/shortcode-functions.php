<?php
/**
 * Shortcode related functions.
 *
 * @author   Benito Lopez <hello@lopezb.com>
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Set query vars before to render the room shortcodes.
 */
function htl_uncode_shortcode_before_loop( $columns ) {
	$single_post_width  = htl_uncode_get_col_value( $columns );
	$single_text_length = ot_get_option('_uncode_room_index_single_text_length');
	set_query_var( 'single_post_width', $single_post_width );
	if ($single_text_length !== '') {
		set_query_var( 'single_text_length', $single_text_length );
	}
}
add_action( 'hotelier_shortcode_before_recent_rooms_loop', 'htl_uncode_shortcode_before_loop' );
add_action( 'hotelier_shortcode_before_room_type_loop', 'htl_uncode_shortcode_before_loop' );
add_action( 'hotelier_shortcode_before_rooms_loop', 'htl_uncode_shortcode_before_loop' );

/**
 * Get grid col value based on the number of columns.
 */
function htl_uncode_get_col_value( $columns ) {
	$col     = 12;
	$columns = absint( $columns );

	switch ( $columns ) {
		case 2:
			$col = 6;
			break;

		case 3:
			$col = 4;
			break;

		case 4:
			$col = 3;
			break;

		case 6:
			$col = 2;
			break;

		case 12:
			$col = 1;
			break;
	}

	return $col;
}

/**
 * Add custom shortcodes.
 */
function htl_uncode_add_custom_shortcodes() {
	add_shortcode( 'htl_uncode_room_details_shortcode', 'htl_uncode_room_details_output' );
	add_shortcode( 'htl_uncode_room_rates_shortcode', 'htl_uncode_room_rates_output' );
}
add_action( 'init', 'htl_uncode_add_custom_shortcodes' );

/**
 * Register Room Details shortcode.
 */
function htl_uncode_room_details_output( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'hide_room_price'              => '',
		'hide_room_infos'              => '',
		'hide_room_details'            => '',
		'hide_room_details_titles'     => '',
		'hide_room_facilities'         => '',
		'hide_room_facilities_titles'  => '',
		'room_facilities_as_list'      => '',
		'room_facilities_list_columns' => '',
		'hide_room_conditions'         => '',
		'hide_room_conditions_titles'  => '',
		'el_id'                        => '',
		'el_class'                     => '',
	), $atts ) );

	$hide_room_price              = $hide_room_price === 'yes' ? true : false;
	$hide_room_infos              = $hide_room_infos === 'yes' ? true : false;
	$hide_room_details            = $hide_room_details === 'yes' ? true : false;
	$hide_room_details_titles     = ! $hide_room_details && $hide_room_details_titles === 'yes' ? true : false;
	$hide_room_facilities         = $hide_room_facilities === 'yes' ? true : false;
	$hide_room_facilities_titles  = ! $hide_room_facilities && $hide_room_facilities_titles === 'yes' ? true : false;
	$room_facilities_as_list      = $room_facilities_as_list === 'yes' ? true : false;
	$room_facilities_list_columns = absint( $room_facilities_list_columns );
	$room_facilities_list_columns = $room_facilities_list_columns > 5 || ! $room_facilities_list_columns ? 1 : $room_facilities_list_columns;
	$hide_room_conditions         = $hide_room_conditions === 'yes' ? true : false;
	$hide_room_conditions_titles  = ! $hide_room_conditions && $hide_room_conditions_titles === 'yes' ? true : false;

	// Extra settings
	$el_id    = $el_id ? $el_id : false;
	$el_class = $el_class ? $el_class : false;

	// Custom ID
	if ( $el_id ) {
		$container_id = ' id="' . esc_attr( trim( $el_id ) ) . '"';
	} else {
		$container_id = '';
	}

	// Custom classes
	$container_classes = array( 'uncode-htl-module', 'uncode-htl-module--room-details' );

	if ( $el_class ) {
		$extra_classes = explode( ' ', $el_class );

		foreach ( $extra_classes as $extra_class ) {
			$container_classes[] = $extra_class;
		}
	}

	$output = '<div ' . $container_id . ' class="' . esc_attr( trim( implode( ' ', $container_classes ) ) ) . '">';

	ob_start();

	$post_type = uncode_get_current_post_type();

	if ( ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) || $post_type == 'uncodeblock' ) {
		global $room;
		if ( ! $room ) {
			$room = uncode_populate_room_object();
		}
	}

	remove_action( 'hotelier_single_room_details', 'hotelier_template_single_room_datepicker', 5 );

	// Price
	if ( $hide_room_price ) {
		remove_action( 'hotelier_single_room_details', 'hotelier_template_single_room_price', 10 );
	}

	// Infos
	if ( $hide_room_infos ) {
		remove_action( 'hotelier_single_room_details', 'hotelier_template_single_room_non_cancellable_info', 15 );
		remove_action( 'hotelier_single_room_details', 'hotelier_template_single_room_deposit', 20 );
		remove_action( 'hotelier_single_room_details', 'hotelier_template_single_room_min_max_info', 25 );
	}

	// Details
	if ( $hide_room_details ) {
		remove_action( 'hotelier_single_room_details', 'hotelier_template_single_room_meta', 30 );
	} else if ( $hide_room_details_titles ) {
		add_filter( 'hotelier_single_room_meta_show_title', '__return_false' );
	}

	// Facilities
	if ( $hide_room_facilities || $room_facilities_as_list ) {
		remove_action( 'hotelier_single_room_details', 'hotelier_template_single_room_facilities', 40 );

		if ( $room_facilities_as_list ) {
			add_action( 'hotelier_single_room_details', 'htl_uncode_get_room_facilities', 40 );
			add_filter( 'hotelier_uncode_single_room_facilities_as_list', '__return_true' );
			add_filter( 'hotelier_uncode_single_room_facilities_list_columns', function( $arguments ) use ( $room_facilities_list_columns ) {
				return $room_facilities_list_columns;
			} );

			if ( $hide_room_facilities_titles ) {
				add_filter( 'hotelier_single_room_facilities_show_title', '__return_false' );
			}
		}
	} else if ( $hide_room_facilities_titles ) {
		add_filter( 'hotelier_single_room_facilities_show_title', '__return_false' );
	}

	// Conditions
	if ( $hide_room_conditions ) {
		remove_action( 'hotelier_single_room_details', 'hotelier_template_single_room_conditions', 50 );
	} else if ( $hide_room_conditions_titles ) {
		add_filter( 'hotelier_single_room_conditions_show_title', '__return_false' );
	}

	/**
	 * hotelier_single_room_details hook.
	 *
	 * @hooked hotelier_template_single_room_datepicker - 5
	 * @hooked hotelier_template_single_room_price - 10
	 * @hooked hotelier_template_single_room_non_cancellable_info - 15
	 * @hooked hotelier_template_single_room_deposit - 20
	 * @hooked hotelier_template_single_room_min_max_info - 25
	 * @hooked hotelier_template_single_room_meta - 30
	 * @hooked hotelier_template_single_room_facilities - 40
	 * @hooked hotelier_template_single_room_conditions - 50
	 * @hooked hotelier_template_single_room_sharing - 60
	 */
	do_action( 'hotelier_single_room_details' );

	// Price
	if ( $hide_room_price ) {
		add_action( 'hotelier_single_room_details', 'hotelier_template_single_room_price', 10 );
	}

	// Infos
	if ( $hide_room_infos ) {
		add_action( 'hotelier_single_room_details', 'hotelier_template_single_room_non_cancellable_info', 15 );
		add_action( 'hotelier_single_room_details', 'hotelier_template_single_room_deposit', 20 );
		add_action( 'hotelier_single_room_details', 'hotelier_template_single_room_min_max_info', 25 );
	}

	// Details
	if ( $hide_room_details ) {
		add_action( 'hotelier_single_room_details', 'hotelier_template_single_room_meta', 30 );
	} else if ( $hide_room_details_titles ) {
		remove_filter( 'hotelier_single_room_meta_show_title', '__return_false' );
	}

	// Facilities
	if ( $hide_room_facilities || $room_facilities_as_list ) {
		add_action( 'hotelier_single_room_details', 'hotelier_template_single_room_facilities', 40 );

		if ( $room_facilities_as_list ) {
			remove_action( 'hotelier_single_room_details', 'htl_uncode_get_room_facilities', 40 );
			remove_filter( 'hotelier_uncode_single_room_facilities_as_list', '__return_true' );

			if ( $hide_room_facilities_titles ) {
				remove_filter( 'hotelier_single_room_facilities_show_title', '__return_false' );
			}
		}
	} else if ( $hide_room_facilities_titles ) {
		remove_filter( 'hotelier_single_room_facilities_show_title', '__return_false' );
	}

	// Conditions
	if ( $hide_room_conditions ) {
		add_action( 'hotelier_single_room_details', 'hotelier_template_single_room_conditions', 50 );
	} else if ( $hide_room_conditions_titles ) {
		remove_filter( 'hotelier_single_room_conditions_show_title', '__return_false' );
	}

	$output .= ob_get_clean();

	$output .= '</div>';

	return $output;
}

/**
 * Register Room Rates shortcode.
 */
function htl_uncode_room_rates_output( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'el_id'                          => '',
		'el_class'                       => '',
		'room_rates_style_remove_border' => '',
		'room_rates_style_shadow'        => false,
		'room_rates_style_shadow_weight' => 'xs',
		'room_rates_style_shadow_darker' => false,
	), $atts ) );

	$no_border      = $room_rates_style_remove_border ? true : false;
	$shadow_enabled = $room_rates_style_shadow ? true : false;
	$shadow_weight  = $shadow_enabled && $room_rates_style_shadow_weight ? $room_rates_style_shadow_weight : 'xs';
	$shadow_darker  = $shadow_enabled && $room_rates_style_shadow_darker ? true : false;

	// Extra settings
	$el_id    = $el_id ? $el_id : false;
	$el_class = $el_class ? $el_class : false;

	// Custom ID
	if ( $el_id ) {
		$container_id = ' id="' . esc_attr( trim( $el_id ) ) . '"';
	} else {
		$container_id = '';
	}

	// Custom classes
	$container_classes = array( 'uncode-htl-module', 'uncode-htl-module--room-rates' );

	if ( $el_class ) {
		$extra_classes = explode( ' ', $el_class );

		foreach ( $extra_classes as $extra_class ) {
			$container_classes[] = $extra_class;
		}
	}

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

	$output = '<div ' . $container_id . ' class="' . esc_attr( trim( implode( ' ', $container_classes ) ) ) . '">';

	ob_start();

	$post_type = uncode_get_current_post_type();

	if ( ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) || $post_type == 'uncodeblock' ) {
		global $room;
		if ( ! $room ) {
			$room = uncode_populate_room_object();
		}
	}

	add_filter( 'hotelier_single_room_rates_show_title', '__return_false' );

	hotelier_template_single_room_rates();

	$output .= ob_get_clean();

	$output .= '</div>';

	return $output;
}
