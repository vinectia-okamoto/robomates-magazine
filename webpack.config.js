const path = require('path');
const webpack = require('webpack');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const RemoveEmptyScriptsPlugin = require('webpack-remove-empty-scripts');


// [定数] webpack の出力オプションを指定します
// 'production' か 'development' を指定
const MODE = "production";

// ソースマップの利用有無(productionのときはソースマップを利用しない)
const enabledSourceMap = MODE === "development";

module.exports = {
    // モード値を production に設定すると最適化された状態で、
    // development に設定するとソースマップ有効でJSファイルが出力される
    mode: MODE,

    // source-map 方式
    //devtool: "source-map",

    // メインとなるJavaScriptファイル（エントリーポイント）
    entry: {
        'main': './src/js/main.js',
        'top': './src/js/top.js',
        'function-adminonly': './src/js/function-adminonly.js',
        'function-form': './src/js/function-form.js',
        'editor-script-block': './src/js/editor-script-block.js',

        'style.css': path.resolve(__dirname, "./src/scss/style.scss"),
        'top.css': path.resolve(__dirname, "./src/scss/top.scss"),
        'page.css': path.resolve(__dirname, "./src/scss/page.scss"),
        'editor_preview.css': path.resolve(__dirname, "./src/scss/editor_preview.scss"),
    },
    // ファイルの出力設定
    output: {
        //  出力ファイルのディレクトリ名
        path: path.resolve(__dirname, './assets/'), // 出力先フォルダを絶対パスで指定
        publicPath: '/',
        // 出力ファイル名
        filename: 'js/[name].js', // [name]にはentry:で指定したキーが入る
        //clean: true, //CleanWebpackPluginと同じ
        clean: {
            keep:/images|fonts|videos/,
    },
    },
    // キャッシュ機能
    cache: {
        type: 'filesystem',
        buildDependencies: {
            config: [__filename]
        }
    },
    // warningを調整
    performance: {
        maxEntrypointSize: 500000,
        maxAssetSize: 500000,
    },

    // ローカル開発用環境を立ち上げる
    // 実行時にブラウザが自動的に localhost を開く
    devServer: {

        port: 8080,
        open: true,
        hot: true,
        static: {
            directory: path.join(__dirname, "./"),
            serveIndex: true,
            watch: true
        },
    },

    module: {
        rules: [
            // JSファイルの読み込みとコンパイル
            {
                // 拡張子 .js の場合
                test: /\.js$/,
                // IE対応 除外設定にSwiperを含めない
                exclude: /node_modules\/(?!(dom7|ssr-window|swiper)\/).*/,
                use: [{
                    // Babel を利用する
                    loader: 'babel-loader',
                    // Babel のオプションを指定する
                    options: {
                        presets: [
                            // プリセットを指定することで、ES2020 を ES5 に変換
                            '@babel/preset-env',
                        ]
                    }
                }],

            },
            // Sassファイルの読み込みとコンパイル
            {
                test: /\.css/,
                use: [
                    "style-loader",
                    {
                        loader: "css-loader",
                        options: {
                            url: false
                        }
                    }
                ]
            },
            // Sassファイルの読み込みとコンパイル
            {
                test: /\.scss$/, // 対象となるファイルの拡張子
                use: [
                    // CSSファイルを書き出すオプションを有効にする
                    MiniCssExtractPlugin.loader,
                    // Sassをバンドルするための機能
                    // CSSをバンドルするための機能
                    {
                        loader: "css-loader",
                        options: {
                            // オプションでCSS内のurl()メソッドの取り込みを禁止する
                            url: false,
                            // 0 => no loaders (default);
                            // 1 => postcss-loader;
                            // 2 => postcss-loader, sass-loader
                            // Sass+PostCSSの場合は2を指定
                            importLoaders: 2,
                        },
                    },
                    // PostCSSのための設定
                    {
                        loader: "postcss-loader",
                        options: {
                            // PostCSS側でもソースマップを有効にする
                            // sourceMap: true,
                            postcssOptions: {
                                plugins: [
                                    // Autoprefixerを有効化
                                    // ベンダープレフィックスを自動付与する
                                    ["autoprefixer", {
                                        grid: true
                                    }],
                                ],
                            },
                        },
                    },
                    // Sass を CSS へ変換するローダー
                    {
                        loader: "sass-loader",
                        options: {
                            webpackImporter: false,

                            // dart-sass を優先
                            implementation: require('sass'),
                            sassOptions: {

                            },
                            // ソースマップを有効に
                            //sourceMap: true,
                        },
                    },
                ],
            },
        ],
    },
  //wordpressのときはwpのjqueryを使うのでこれ消す
    externals: {
       jquery: 'jQuery'
   },
    plugins: [
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery'
        }),

        // CSS別出力時の不要JSファイルを削除
        new RemoveEmptyScriptsPlugin(),
        // CSSファイルを外だしにするプラグイン
        new MiniCssExtractPlugin({
            filename: "css/[name]", // ファイル名を設定します
        }),



    ],


    // ES5(IE11等)向けの指定
    target: ["web", "es5"],
    // node_modules を監視（watch）対象から除外
    watchOptions: {
        ignored: /node_modules/
    }
};
