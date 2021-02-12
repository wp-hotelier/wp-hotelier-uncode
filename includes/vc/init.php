<?php
/**
 * Init Visual Composer integration.
 *
 * @author   Benito Lopez <hello@lopezb.com>
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

include_once HTL_UNCODE_PLUGIN_DIR . 'includes/vc/functions.php';
include_once HTL_UNCODE_PLUGIN_DIR . 'includes/vc/datepicker/datepicker-output.php';
include_once HTL_UNCODE_PLUGIN_DIR . 'includes/vc/listing/listing-output.php';
include_once HTL_UNCODE_PLUGIN_DIR . 'includes/vc/booking/booking-output.php';
include_once HTL_UNCODE_PLUGIN_DIR . 'includes/vc/vc_heading/vc_heading-functions.php';


/**
* Init backend scripts and functions.
*/
function htl_uncode_init_back_custom_vc() {
	if ( ! defined( 'UNCODE_SLIM' ) ) {
		return;
	}

	require_once HTL_UNCODE_PLUGIN_DIR . 'includes/vc/add-modules.php';
}
add_action( 'admin_init', 'htl_uncode_init_back_custom_vc',1000 );

/**
* Init front scripts and functions.
*/
function htl_uncode_init_front_custom_vc() {
	if ( ! defined( 'UNCODE_SLIM' ) ) {
		return;
	}

	require_once HTL_UNCODE_PLUGIN_DIR . 'includes/vc/add-modules.php';
}
add_action( 'init', 'htl_uncode_init_front_custom_vc', 10010 );
