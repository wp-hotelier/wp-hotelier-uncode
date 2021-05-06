<?php
/**
 * Load assets.
 *
 * @author   Benito Lopez <hello@lopezb.com>
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'HTL_Uncode_Scripts' ) ) :

/**
 * HTL_Uncode_Scripts Class
 */
class HTL_Uncode_Scripts {
	/**
	 * Construct.
	 */
	public function __construct() {
		add_filter( 'hotelier_enqueue_styles', '__return_false' );
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ) );
	}

	/**
	 * Enqueue frontend styles
	 *
	 * @access public
	 * @return void
	 */
	public function frontend_styles() {
		wp_enqueue_style( 'hotelier-uncode-css', HTL_UNCODE_PLUGIN_URL . 'assets/css/style.css', array(), HTL_UNCODE_VERSION );
	}

	/**
	 * Enqueue frontend scripts
	 *
	 * @access public
	 * @return void
	 */
	public function frontend_scripts() {
		// Use minified libraries if SCRIPT_DEBUG is turned off
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_enqueue_script( 'hotelier-uncode-js', HTL_UNCODE_PLUGIN_URL . 'assets/js/main' . $suffix . '.js', array( 'jquery' ), HTL_UNCODE_VERSION, true );
	}

	/**
	 * Enqueue admin scripts
	 *
	 * @access public
	 * @return void
	 */
	public function admin_styles() {
		wp_enqueue_style( 'hotelier-uncode-admin-css', HTL_UNCODE_PLUGIN_URL . 'assets/css/admin.css', array(), HTL_UNCODE_VERSION );
	}
}

endif;

return new HTL_Uncode_Scripts();
