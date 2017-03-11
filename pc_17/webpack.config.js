var path = require('path');
var webpack = require('webpack');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');
var HtmlWebpackPlugin = require('html-webpack-plugin');

module.exports = {
    entry: {
        app: path.resolve(__dirname, 'src/main.js')
    },
    output: {
        path: path.resolve(__dirname, 'build'),
        filename: '[name].js'
    },
    module : {
        rules: [
            {
                test: /\.js$/,
                use: [
                    "babel-loader"
                ],
                exclude: /node_modules/
            },
            {
                test: /\.less$/,
                use: [
                    "style-loader",
                    "css-loader",
                    "less-loader"
                ]
            },
            {
                test: /\.css$/,
                use: [
                    "style-loader",
                    "css-loader"
                ]
            }
        ]
    },
    plugins: [
        new webpack.ProvidePlugin({
            $: path.resolve(__dirname, "node_modules/jquery/dist/jquery"),
            jQuery: path.resolve(__dirname, "node_modules/jquery/dist/jquery")
        }),
        new UglifyJSPlugin(),
        new HtmlWebpackPlugin({
            filename: '../build/index.html',
            template: './index.html',
            hash:true,
            minify: {
                removeComments:true,
                collapseWhitespace:true
            }
        })
    ]
};
