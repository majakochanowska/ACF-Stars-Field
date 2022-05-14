/**
 * Automated tasks for website build and tests
 */

import gulp from 'gulp';
import stylus from 'gulp-stylus';
import postcss from 'gulp-postcss';
import autoprefixer from 'autoprefixer';
import footer from 'gulp-footer';
import concatCss from 'gulp-concat-css';
import stripCssComments from 'gulp-strip-css-comments';
import cleanCSS from 'gulp-clean-css';
import path, { dirname } from 'node:path';
import { fileURLToPath } from 'node:url';

const __dirname = dirname( fileURLToPath( import.meta.url ) );

/**
 * Compile plugin styles
 *
 * @param {string} targetPath  Path to directory or file that needs to be compiled.
 * @param {string} pathPattern Pattern added to the end of targetPath ( ex. glob pattern ).
 * @param {string} outputName  Output filename.
 * @param {Array}  exclude     Exclude selected paths from compiling.
 */
const compileStyl = ( targetPath, pathPattern = '', outputName = 'style', exclude = [] ) => (

	gulp.src( [ path.resolve( __dirname, `${ targetPath }${ pathPattern }` ), ...exclude ] )
		.pipe( stylus() )
		.pipe( concatCss( `${ outputName }.css` ) )
		.pipe( postcss( [ autoprefixer() ] ) )
		.pipe( stripCssComments() )
		.pipe(
			cleanCSS(
				{
					compatibility: 'ie11'
				}
			)
		)
		.pipe( footer( '\n' ) )
);

/**
 * Handle all plugins styles
 */
gulp.task(
	'style',
	() => (
		compileStyl( './src/styl/style.styl', '', 'style' )
			.pipe( gulp.dest( './dist/' ) )
	),
);

/**
 * Gulp task for build
 */
gulp.task( 'build', gulp.parallel( 'style' ) );

/**
 * Gulp task for watch
 */
 gulp.task(
	'watch',
	() => {
		gulp.watch(
			[ './src/styl/**/*.styl' ],
			gulp.parallel( 'build' ),
		);
	}
);
