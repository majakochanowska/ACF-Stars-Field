<?php // phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols
/**
 * Plugin Name: Stars field
 * Version: 1.0.0
 * Author: Maja Kochanowska
 * Description: ACF stars rating field
 * Text Domain: stars-field
 *
 * @package stars-field
 */

namespace Maja\StarsField;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// phpcs:enable PSR1.Files.SideEffects.FoundWithSymbols

require_once __DIR__ . '/vendor/autoload.php';

const MAIN_FILE = __FILE__;
const MAIN_DIR  = __DIR__;
const VERSION   = '1.0.0';

Modules\General::register();
