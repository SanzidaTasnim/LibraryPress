const path = require('path');
const webpack = require('webpack');

module.exports = (env, argv) => {
    return {
        mode: argv.mode || 'development',
        entry: {
            'admin': path.resolve(__dirname, 'spa/admin/src/App.jsx'),
            'public': path.resolve(__dirname, 'spa/public/src/App.jsx'),
            'tailwind': path.resolve(__dirname, 'assets/common/css/tailwind.css')
        },
        output: {
            filename: '[name].bundle.js',
            path: path.resolve(__dirname, 'spa/build')
        },
        module: {
            rules: [
                {
                    test: /\.jsx?$/,
                    exclude: /node_modules/,
                    use: {
                        loader: 'babel-loader',
                        options: {
                            presets: ['@babel/preset-react', '@babel/preset-env']
                        }
                    }
                },
                {
                    test: /\.css$/,
                    use: [
                        'style-loader',
                        'css-loader',
                        {
                            loader: 'postcss-loader',
                            options: {
                                postcssOptions: {
                                    ident: 'postcss',
                                    plugins: [
                                        require('tailwindcss'),
                                        require('autoprefixer'),
                                    ],
                                },
                            },
                        },
                    ],
                }
            ]
        },
        resolve: {
            extensions: ['.js', '.jsx']
        },

        // plugins: [
        //     new webpack.ProvidePlugin({
        //         React: 'react',
        //         ReactDOM: 'react-dom',
        //         wp: '@wordpress/blocks',
        //         wpElement: ['@wordpress/element', 'default'],
        //         wpBlockEditor: ['@wordpress/block-editor', 'default']
        //     })
        // ],
        
        devtool: 'source-map',
    };
};