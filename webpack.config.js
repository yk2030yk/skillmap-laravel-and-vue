const glob = require("glob");
const path = require('path');
const VueLoaderPlugin = require('vue-loader/lib/plugin');

/*
 エントリーポイントを作成
 resources/assets/js/entries配下にある
 index.jsがエントリーポイントになる
 フォルダ構成を同じでbudle.jsに出力する
 */
const entries = {};
glob.sync("./resources/assets/js/entries/**/**.js").map(function (file) {
    var key = file;
    key = key.replace('./resources/assets/js/entries', '');
    key = key.replace('.js', '/bundle.js');
    entries[key] = file;
});

module.exports = {
    entry: entries,  
    output: {
        path: __dirname + '/public/js',
        filename: '[name]',
    },
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {
                exclude: /node_modules/,
                test: /\.js$/,
                loader: 'babel-loader',
                query: {
                    presets: ['es2015', 'stage-2'],
                    plugins: ['transform-runtime', 'transform-regenerator']
                }
            },
            {
                test: /\.scss$/,
                use: [
                    'css-loader',
                    'sass-loader',
                    {
                        loader: 'sass-resources-loader',
                        options: {
                            resources: []
                        }
                    }
                ]
            }
        ]
    },
    resolve: {
        modules: [
            path.resolve(__dirname, 'node_modules'),
            path.resolve(__dirname, 'resources/assets/js'),
        ],
        alias: {
            'vue$': 'vue/dist/vue.esm.js'
        },
        extensions: ['.js', '.vue'],
    },
    watchOptions: {
        poll: 500
    },
    plugins: [
        new VueLoaderPlugin()
    ],
    devtool: 'source-map'
    //devtool: false,
}
