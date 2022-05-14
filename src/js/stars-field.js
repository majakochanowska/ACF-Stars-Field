/**
 * Register Stars field
 */

const { acf } = window;

export const Field = acf.Field.extend( {

	type: 'stars',

	events: {
		'click input[type="radio"]': 'onClick',
	},

	$control() {
		return this.$( '.acf-radio-list' );
	},

	$input() {
		return this.$( 'input:checked' );
	},

	getValue() {
		const value = this.$input().val();
		return value;
	},

	onClick() {},

} );

/**
 * Add active class to stars that should be colored
 *
 * @param {Object} event Event object.
 */
export const colorStars = ( event ) => {
	const target = event.target;
	const choice = target.closest( 'li' );
	const starField = target.closest( '.acf-field.acf-field-stars' );
	const choices = starField.querySelectorAll( '.acf-input li' );

	const targetStarIndex = [ ...choice.parentElement.children ].indexOf( choice );

	for ( const choiceElement of choices ) {
		const starIcon = choiceElement.querySelector( '.star-icon' );
		const starIndex = [ ...choiceElement.parentElement.children ].indexOf( choiceElement );

		if ( starIndex <= targetStarIndex ) {
			starIcon.classList.add( 'star-icon--active' );
		} else {
			starIcon.classList.remove( 'star-icon--active' );
		}
	}
}
