const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CopyPlugin = require("copy-webpack-plugin");

module.exports = (env) => {
	return {
		mode: env.WEBPACK_WATCH ? 'development' : 'production',
		entry: {
			main: './scripts/index.js',
			not_critical: ['./styles/not-critical.scss'],
		},
		module: {
			rules: [{
				test: /\.s[ac]ss$/i,
				use: [
					MiniCssExtractPlugin.loader,
					"css-loader",
					"sass-loader",
					"import-glob-loader",
				],
			},
			{
				test: /\.(js)$/,
				exclude: /node_modules/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: ['@babel/preset-env']
					}
				}
			},
			{
				test: /\.css$/,
				// use: [MiniCssExtractPlugin.loader, 'css-loader']
				use: ['style-loader', 'css-loader']
			}
			],
		},
		resolve: {
			extensions: ['*', '.js'],
			fallback: {
				"buffer": false,
				"stream": false,
			}
		},
		output: {
			filename: '[name].bundle.js',
			path: path.resolve(__dirname, '../dist'),
			clean: true,
		},
		plugins: [
			new MiniCssExtractPlugin({
				filename: "[name].css",
				chunkFilename: "[id].css",
			}),
			new CopyPlugin({
				patterns: [{
					from: "fonts",
					to: "../dist"
				}, {
					from: "images",
					to: "../dist"
				}],
			}),
		]
	};
};