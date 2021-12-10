<?php
/**
 * Template functions.
 *
 * @author   Benito Lopez <hello@lopezb.com>
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Get the list of the overriden templates
 */
function htl_uncode_get_overriden_templates_list() {
	$templates = array(
		'archive/content-room.php',
		'loop/loop-start.php',
		'loop/loop-end.php',
		'global/datepicker.php',
		'single-room/rate/rate-button.php',
		'room-list/content/toggle-rates-button.php',
		'room-list/content/add-to-cart.php',
		'room-list/content/image.php',
		'room-list/content/title.php',
		'room-list/content/rate/rate-add-to-cart.php',
		'room-list/content/rate/rate-name.php',
		'room-list/reserve-button.php',
		'booking/received.php',
		'widgets/room-searchform.php',
	);

	return $templates;
}

/**
 * Override default WP Hotelier templates when using htl_get_template()
 */
function htl_uncode_get_template( $located, $template_name, $args, $template_path, $default_path ) {
	if ( ! function_exists( 'ot_get_option' ) ) {
		return $located;
	}

	if ( in_array( $template_name, htl_uncode_get_overriden_templates_list() ) ) {
		// Look within passed path within the theme - this is priority
		$located = locate_template(
			array(
				trailingslashit( 'hotelier/' ) . $template_name,
				$template_name
			)
		);

		// Get default template
		if ( ! $located || HTL_TEMPLATE_DEBUG_MODE ) {
			$located = HTL_UNCODE_PLUGIN_DIR . 'templates/' . $template_name;
		}
	}

	return $located;
}
add_filter( 'hotelier_get_template', 'htl_uncode_get_template', 10, 5 );

/**
 * Override default WP Hotelier templates when using htl_get_template_part()
 */
function htl_uncode_get_template_part( $template, $slug, $name ) {
	if ( ! function_exists( 'ot_get_option' ) ) {
		return $template;
	}

	$template_name = $slug . '-' . $name . '.php';

	if ( in_array( $template_name, htl_uncode_get_overriden_templates_list() ) ) {
		$template = HTL_UNCODE_PLUGIN_DIR . 'templates/' . $template_name;
	}

	return $template;
}
add_filter( 'hotelier_get_template_part', 'htl_uncode_get_template_part', 10, 3 );

/**
 * Override real WP templates
 */
function htl_uncode_template_loader( $template ) {
	if ( ! function_exists( 'ot_get_option' ) ) {
		return $template;
	}

	$find = array();
	$file = '';

	if ( is_single() && get_post_type() == 'room' ) {

		$file 	= 'single-room/single-room.php';
		$find[] = $file;
		$find[] = HTL()->template_path() . $file;

	} elseif ( is_post_type_archive( 'room' ) || is_room_category() ) {

		$file 	= 'archive/archive-room.php';
		$find[] = $file;
		$find[] = HTL()->template_path() . $file;
	}

	if ( $file ) {
		$template = locate_template( array_unique( $find ) );

		if ( ! $template || HTL_TEMPLATE_DEBUG_MODE ) {
			$template = HTL_UNCODE_PLUGIN_DIR . 'templates/' . $file;
		}
	}

	return $template;
}
add_filter( 'template_include', 'htl_uncode_template_loader' );
