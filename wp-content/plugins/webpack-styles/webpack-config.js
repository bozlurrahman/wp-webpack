const path = require('path');

// include the js minification plugin
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');

// include the css extraction and minification plugins
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");

var glob = require("glob");


module.exports = {
    // entry: ['./js/src/app.js', './css/src/app.scss'],
    // entry: glob.sync("./js/src/*.js"),
    entry: {
    	scripts: glob.sync("./js/src/*.js"),
    	styles: glob.sync("./css/src/*.scss")
    },
    output: {
        filename: './js/build/[name].js',
        path: path.resolve(__dirname)
    },
    module: {
        rules: [
            // perform js babelization on all .js files
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: "babel-loader",
                    options: {
                        presets: ['babel-preset-env']
                    }
                }
            },
            // compile all .scss files to plain old css
            // {
            //     test: /\.(sass|scss)$/,
            //     use: [
            //         MiniCssExtractPlugin.loader, 
            //         'css-loader', 
            //         'sass-loader'
            //     ]
            // }
            {
                test: /\.s?css$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: 'css-loader',
                        options: {
                            sourceMap: true,
                        },
                    },
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: true,
                            importer: glob.sync("./css/src/*.scss"),
                        },
                    },
                ]
            }
        ]
    },
    plugins: [
        // extract css into dedicated file
        new MiniCssExtractPlugin({
            filename: './css/build/[name].css'
        })
    ],
    optimization: {
        minimizer: [
            // enable the js minification plugin
            new UglifyJSPlugin({
                cache: true,
                parallel: true
            }),
            // enable the css minification plugin
            new OptimizeCSSAssetsPlugin({})
        ]
    }
};