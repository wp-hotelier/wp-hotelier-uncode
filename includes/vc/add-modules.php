<?php
/**
 * Add custom Visual Composer modules.
 *
 * @author   Benito Lopez <hello@lopezb.com>
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $uncode_colors, $uncode_colors_flat, $uncode_colors_w_transp;

if ( function_exists( 'uncode_core_vc_params_get_button_sizes' ) ) {
	$size_arr                      = uncode_core_vc_params_get_button_sizes();
	$heading_size                  = uncode_core_vc_params_get_heading_font_sizes();
	$fonts                         = uncode_core_vc_params_get_fonts();
	$button_font                   = uncode_core_vc_params_get_button_fonts( $fonts );
	$button_weight                 = uncode_core_vc_params_get_button_font_weights();
	$font_spacings                 = uncode_core_vc_params_get_font_spacings();
	$btn_letter_spacing            = uncode_core_vc_params_get_button_spacings( $font_spacings );
	$button_options                = uncode_core_vc_params_get_button_options( $uncode_colors, $size_arr, $heading_size, $button_font, $button_weight, $btn_letter_spacing );
	$heading_font                  = uncode_core_vc_params_get_heading_fonts( $fonts );
	$heading_weight                = uncode_core_vc_params_get_heading_font_weights();
	$font_heights                  = uncode_core_vc_params_get_font_heights();
	$heading_height                = uncode_core_vc_params_get_font_heading_heights( $font_heights );
	$heading_space                 = uncode_core_vc_params_get_heading_spacings( $font_spacings );
	$wc_heading_options            = uncode_core_vc_params_get_wc_heading_options( $heading_font, $heading_size, $heading_weight, $heading_height, $heading_space );

	include_once HTL_UNCODE_PLUGIN_DIR . 'includes/vc/datepicker/datepicker.php';
	include_once HTL_UNCODE_PLUGIN_DIR . 'includes/vc/listing/listing.php';
	include_once HTL_UNCODE_PLUGIN_DIR . 'includes/vc/booking/booking.php';
	include_once HTL_UNCODE_PLUGIN_DIR . 'includes/vc/room-details/room-details.php';
	include_once HTL_UNCODE_PLUGIN_DIR . 'includes/vc/room-rates/room-rates.php';
}
