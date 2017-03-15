var path = require('path');
var webpack = require('webpack');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');
var HtmlWebpackPlugin = require('html-webpack-plugin');
var BrowserSyncPlugin = require('browser-sync-webpack-plugin');

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
            },
            {
                test: /\.(png|jpg)$/,
                use: {
                    loader: 'url-loader',
                    query: {
                        limit: "8192",
                        name: "images/[hash:8].[name].[ext]"
                    }
                }
            },
            {
                test: /\.html$/,
                use: [
                    "html-withimg-loader"
                ]
            },
            {
                test: /\.svg/,
                use: {
                    loader: 'svg-url-loader',
                    options: {}
                }
            }
        ]
    },
    plugins: [
        new webpack.ProvidePlugin({
            $: path.resolve(__dirname, "node_modules/jquery/dist/jquery"),
            jQuery: path.resolve(__dirname, "node_modules/jquery/dist/jquery")
        }),
        new UglifyJSPlugin({
            except: ['$super', '$', 'exports', 'require']
        }),
        new HtmlWebpackPlugin({
            filename: '../build/index.html',
            template: './index.html',
            hash:true,
            minify: {
                removeComments:true,
                collapseWhitespace:true
            }
        }),
        new BrowserSyncPlugin(
            {
                host: 'localhost',
                port: 3000,
                proxy: 'http://localhost:8080/'
            },
            {
                reload: false
            }
        )
    ],
    devServer: {
        contentBase:'./build',
        proxy: {
            '/api.php/*': {
                target: 'http://localhost:9090/swzl',
                secure: false,
                changeOrigin: true,
                pathRewrite: {
                    '/api.php': ''
                }
            }
        }
    }
};
