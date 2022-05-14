/**
 * Webpack configuration file
 */

import path, { dirname } from 'node:path';
import { fileURLToPath } from 'node:url';

const __dirname = dirname( fileURLToPath( import.meta.url ) );

export default {
	entry: {
		'scripts': path.resolve( __dirname, './src/js/scripts.js' ),
	},
	mode: 'production',
	devtool: 'cheap-module-source-map',
	output: {
		path: path.resolve( __dirname, './dist/' ),
		filename: '[name].min.js',
	},
	module: {
		rules: [
			{
				test: /\.(js)$/,
				exclude: /(node_modules)/,
				use: {
					loader: 'babel-loader',
				},
			},
			{
				test: /\.css$/,
				use: [ 'style-loader', 'css-loader' ],
			},
		],
	},
	resolve: {
		extensions: [
			'.js',
		],
	},
}
