<?php // phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols
/**
 * Load scripts, styles and Stars field
 *
 * @package stars-field
 */

namespace Maja\StarsField\Modules;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// phpcs:enable PSR1.Files.SideEffects.FoundWithSymbols

use const \Maja\StarsField\MAIN_FILE;
use const \Maja\StarsField\VERSION;

/**
 * Class definition
 */
class General {

	/**
	 * Register WordPress hooks
	 */
	public static function register() {
		add_action( 'wp_enqueue_scripts', array( get_class(), 'enqueue_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( get_class(), 'enqueue_scripts' ) );
		add_action( 'acf/include_field_types', array( get_class(), 'register_stars_field' ) );
	}

	/**
	 * Enqueue scripts and styles
	 */
	public static function enqueue_scripts() {
		wp_enqueue_script( 'stars-field', plugins_url( '/dist/scripts.min.js', MAIN_FILE ), array(), VERSION, true );
		wp_enqueue_style( 'stars-field', plugins_url( '/dist/style.css', MAIN_FILE ), array(), VERSION );
	}

	/**
	 * Register Stars field
	 */
	public static function register_stars_field() {
		new \Maja\StarsField\Modules\AcfStarsField();
	}
}
