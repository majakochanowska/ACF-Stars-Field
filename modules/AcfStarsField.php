<?php // phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols
/**
 * Create Stars field
 *
 * @package stars-field
 */

namespace Maja\StarsField\Modules;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// phpcs:enable PSR1.Files.SideEffects.FoundWithSymbols

use const \Maja\StarsField\MAIN_FILE;

/**
 * Class definition
 */
class AcfStarsField extends \acf_field_button_group {

	/**
	 * Initialize the field type
	 */
	public function __construct() {
		\acf_field::__construct();
	}

	/**
	 * Setup the field type data
	 */
	public function initialize() {
		parent::initialize();
		$this->name     = 'stars';
		$this->label    = __( 'Stars', 'stars-field' );
		$this->defaults = array(
			'allow_null' => 1,
		);
	}

	/**
	 * Create HTML for the field
	 *
	 * @param array $field Field being rendered.
	 */
	public function render_field( $field ) {

		// vars.
		$e  = '';
		$ul = array(
			'class'           => 'acf-radio-list',
			'data-allow_null' => $field['allow_null'],
		);

		// append to class.
		$ul['class'] .= ' ' . ( 'horizontal' === $field['layout'] ? 'acf-hl' : 'acf-bl' );
		$ul['class'] .= ' ' . $field['class'];

		// Determine selected value.
		$value = (string) $field['value'];

			// 1. Selected choice.
		if ( isset( $field['choices'][ $value ] ) ) {
			$checked = (string) $value;

			// 2. Empty choice.
		} elseif ( $field['allow_null'] ) {
			$checked = '';

			// 3. Default to first choice.
		} else {
			$checked = (string) key( $field['choices'] );
		}

		// Bail early if no choices.
		if ( empty( $field['choices'] ) ) {
			return;
		}

		// Hiden input.
		$e .= acf_get_hidden_input( array( 'name' => $field['name'] ) );

		// Open <ul>.
		$e .= '<ul ' . acf_esc_attr( $ul ) . '>';

		// Loop through choices.
		foreach ( $field['choices'] as $value => $label ) {

			// Ensure value is a string.
			$value = (string) $value;

			// Define input attrs.
			$attrs = array(
				'type'  => 'radio',
				'id'    => sanitize_title( $field['id'] . '-' . $value ),
				'name'  => $field['name'],
				'value' => $value,
			);

			// Check if selected.
			if ( esc_attr( $value ) === esc_attr( $checked ) ) {
				$attrs['checked'] = 'checked';
			}

			// Check if is disabled.
			if ( isset( $field['disabled'] ) && acf_in_array( $value, $field['disabled'] ) ) {
				$attrs['disabled'] = 'disabled';
			}

			$star = wp_remote_get( plugins_url( '/src/svg/star.svg', MAIN_FILE ) );

			// append.
			$e .= '<li><label>' . $star['body'] . '<input ' . acf_esc_attr( $attrs ) . '/>' . acf_esc_html( $label ) . '</label></li>';
		}

		// Close <ul>.
		$e .= '</ul>';

		// Output HTML.
		echo $e; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
