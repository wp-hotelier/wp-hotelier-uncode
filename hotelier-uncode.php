<?php
/**
 * Plugin Name:       WP Hotelier - Uncode Integration
 * Plugin URI:        https://github.com/wp-hotelier/wp-hotelier-uncode
 * Description:       Advanced integration for the Uncode theme.
 * Version:           1.4.1
 * Author:            WP Hotelier
 * Author URI:        https://wphotelier.com/
 * Requires at least: 4.4
 * Tested up to:      5.4
 * License:           GPLv3
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       wp-hotelier-uncode
 * Domain Path:       languages
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Hotelier_Uncode' ) ) :

/**
 * Main Hotelier_Uncode Class
 */
final class Hotelier_Uncode {

	/**
	 * @var string
	 */
	public $version = '1.4.1';

	/**
	 * @var Hotelier_Uncode The single instance of the class
	 */
	private static $_instance = null;

	/**
	 * Main Hotelier_Uncode Instance
	 *
	 * Insures that only one instance of Hotelier_Uncode exists in memory at any one time.
	 *
	 * @static
	 * @see HTL_UNCODE()
	 * @return Hotelier_Uncode - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'wp-hotelier-uncode' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'wp-hotelier-uncode' ), '1.0.0' );
	}

	/**
	 * Hotelier_Uncode Constructor.
	 */
	public function __construct() {
		$this->setup_constants();
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Setup plugin constants
	 *
	 * @access private
	 * @return void
	 */
	private function setup_constants() {
		$upload_dir = wp_upload_dir();

		// Plugin version
		if ( ! defined( 'HTL_UNCODE_VERSION' ) ) {
			define( 'HTL_UNCODE_VERSION', $this->version );
		}

		// Plugin Folder Path
		if ( ! defined( 'HTL_UNCODE_PLUGIN_DIR' ) ) {
			define( 'HTL_UNCODE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Plugin Folder URL
		if ( ! defined( 'HTL_UNCODE_PLUGIN_URL' ) ) {
			define( 'HTL_UNCODE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		// Plugin Root File
		if ( ! defined( 'HTL_UNCODE_PLUGIN_FILE' ) ) {
			define( 'HTL_UNCODE_PLUGIN_FILE', __FILE__ );
		}

		// Plugin Basename
		if ( ! defined( 'HTL_UNCODE_PLUGIN_BASENAME' ) ) {
			define( 'HTL_UNCODE_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		}

		// Get Uncode options
		$uncode_option_id = apply_filters( 'ot_options_id', 'uncode' );
		$options          = get_option( $uncode_option_id, array() );

		// Room slug
		if ( isset( $options['_uncode_room_cpt_slug'] ) && '' != $options['_uncode_room_cpt_slug'] ) {
			define( 'HTL_SLUG', $options['_uncode_room_cpt_slug'] );
		}

		// Romm tax slug
		if ( isset( $options['_uncode_room_tax_slug'] ) && '' != $options['_uncode_room_tax_slug'] ) {
			define( 'HTL_ROOM_CAT_SLUG', $options['_uncode_room_tax_slug'] );
		}
	}

	/**
	 * Hook into actions and filters
	 */
	public function init() {
		if ( ! class_exists( 'Hotelier' ) ) {
			return;
		}

		// Include required files
		$this->includes();

		// Set up localisation
		$this->load_textdomain();
	}

	/**
	 * Include required files.
	 *
	 * @access private
	 * @return void
	 */
	private function includes() {
		include_once HTL_UNCODE_PLUGIN_DIR . 'includes/class-htl-uncode-scripts.php';
		include_once HTL_UNCODE_PLUGIN_DIR . 'includes/core-functions.php';
		include_once HTL_UNCODE_PLUGIN_DIR . 'includes/template-functions.php';
		include_once HTL_UNCODE_PLUGIN_DIR . 'includes/vc/init.php';
		include_once HTL_UNCODE_PLUGIN_DIR . 'includes/hotelier-hooks.php';
		include_once HTL_UNCODE_PLUGIN_DIR . 'includes/shortcode-functions.php';
		include_once HTL_UNCODE_PLUGIN_DIR . 'includes/conditional-functions.php';
		include_once HTL_UNCODE_PLUGIN_DIR . 'includes/dynamic-css.php';
		include_once HTL_UNCODE_PLUGIN_DIR . 'includes/markup-functions.php';
		include_once HTL_UNCODE_PLUGIN_DIR . 'includes/extra-functions.php';
		include_once HTL_UNCODE_PLUGIN_DIR . 'includes/templates.php';

		if ( is_admin() ) {
			include_once HTL_UNCODE_PLUGIN_DIR . 'includes/hotelier-settings.php';
			include_once HTL_UNCODE_PLUGIN_DIR . 'includes/theme-options.php';
			include_once HTL_UNCODE_PLUGIN_DIR . 'includes/page-options.php';
		}
	}

	/**
	 * Loads the plugin language files
	 *
	 * @access public
	 * @return void
	 */
	public function load_textdomain() {
		// Set filter for plugin's languages directory
		$hotelier_uncode_lang_dir = dirname( HTL_UNCODE_PLUGIN_BASENAME ) . '/languages/';
		$hotelier_uncode_lang_dir = apply_filters( 'hotelier_uncode_languages_directory', $hotelier_uncode_lang_dir );

		// Traditional WordPress plugin locale filter
		$locale = apply_filters( 'plugin_locale', get_locale(), 'wp-hotelier-uncode' );
		$mofile = sprintf( '%1$s-%2$s.mo', 'wp-hotelier-uncode', $locale );

		// Setup paths to current locale file
		$mofile_local  = $hotelier_uncode_lang_dir . $mofile;
		$mofile_global = WP_LANG_DIR . '/wp-hotelier-uncode/' . $mofile;

		if ( file_exists( $mofile_global ) ) {
			// Look in global /wp-content/languages/wp-hotelier-uncode folder
			load_textdomain( 'wp-hotelier-uncode', $mofile_global );
		} elseif ( file_exists( $mofile_local ) ) {
			// Look in local /wp-content/plugins/wp-hotelier-uncode/languages/ folder
			load_textdomain( 'wp-hotelier-uncode', $mofile_local );
		} else {
			// Load the default language files
			load_plugin_textdomain( 'wp-hotelier-uncode', false, $hotelier_uncode_lang_dir );
		}
	}
}

endif;

/**
 * Returns the main instance of HTL_UNCODE to prevent the need to use globals.
 *
 * @return Hotelier_Uncode
 */
function HTL_UNCODE() {
	return Hotelier_Uncode::instance();
}

// Get HTL_UNCODE Running
HTL_UNCODE();
