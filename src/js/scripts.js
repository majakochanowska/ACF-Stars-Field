/**
 * Call functions
 */

import { Field, colorStars } from './stars-field.js';

const { jQuery, acf } = window;

/**
 * Register Stars field
 */
( function( $ ) {

	acf.registerFieldType( Field );

} )( jQuery );

/**
 * Get Stars fields and color star icons on click
 */
window.addEventListener(
	'DOMContentLoaded',
	() => {

		const starFields = document.querySelectorAll( '.acf-field.acf-field-stars' );

		for ( const starField of starFields ) {
			const choices = starField.querySelectorAll( '.acf-input li' );

			for ( const choice of choices ) {
				choice.addEventListener( 'click', colorStars );
			}
		}
	}
)
