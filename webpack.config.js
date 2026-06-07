const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const TerserPlugin = require("terser-webpack-plugin");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");
const CopyWebpackPlugin = require("copy-webpack-plugin");
const { WebpackManifestPlugin } = require("webpack-manifest-plugin");

module.exports = (env, argv) => {
  const isProduction = argv.mode === "production";

  return {
    // Entry points - adjust these based on your current JS files
    entry: {
      main: "./src/js/main.js",
      admin: "./src/js/admin.js",
      // Add more entries as needed for your multiple JS files
    },

    // Output configuration
    output: {
      path: path.resolve(__dirname, "dist"),
      filename: isProduction ? "js/[name].[contenthash].js" : "js/[name].js",
      publicPath: isProduction ? "" : "http://localhost:3000/",
    },

    // Development server configuration
    devServer: {
      static: {
        directory: path.join(__dirname, "dist"),
      },
      compress: true,
      port: 3000,
      host: "0.0.0.0", // Allow external connections
      hot: true,
      open: false,

      // Use HTTP for simpler local development
      https: false,

      // Write files to disk so WordPress can access them during development
      devMiddleware: {
        writeToDisk: true,
      },

      // Client configuration for WebSocket connection
      client: {
        webSocketURL: "ws://localhost:3000/ws",
        overlay: {
          errors: true,
          warnings: false,
        },
      },

      // Headers for CORS and hot reloading
      headers: {
        "Access-Control-Allow-Origin": "*",
        "Access-Control-Allow-Methods":
          "GET, POST, PUT, DELETE, PATCH, OPTIONS",
        "Access-Control-Allow-Headers":
          "X-Requested-With, content-type, Authorization",
      },

      // Allow all hosts for development
      allowedHosts: "all",

      // Disable host checking for local development
      historyApiFallback: false,
    },

    // Module rules for different file types
    module: {
      rules: [
        // JavaScript files
        {
          test: /\.js$/,
          exclude: /node_modules/,
          use: {
            loader: "babel-loader",
            options: {
              presets: ["@babel/preset-env"],
              cacheDirectory: true,
            },
          },
        },

        // SCSS/CSS files
        {
          test: /\.(scss|sass|css)$/,
          use: [
            isProduction ? MiniCssExtractPlugin.loader : "style-loader",
            {
              loader: "css-loader",
              options: {
                sourceMap: !isProduction,
                importLoaders: 2,
              },
            },
            {
              loader: "postcss-loader",
              options: {
                sourceMap: !isProduction,
                postcssOptions: {
                  plugins: [["autoprefixer"]],
                },
              },
            },
            {
              loader: "sass-loader",
              options: {
                sourceMap: !isProduction,
                sassOptions: {
                  quietDeps: true, // Suppress all dependency warnings
                  verbose: false, // Reduce verbosity
                  silenceDeprecations: ["legacy-js-api", "import"],
                  outputStyle: isProduction ? "compressed" : "expanded",
                },
              },
            },
          ],
        },

        // Images
        {
          test: /\.(png|jpe?g|gif|svg|webp)$/i,
          type: "asset/resource",
          generator: {
            filename: "images/[name].[hash][ext]",
            publicPath: isProduction ? "../" : "http://localhost:3000/",
          },
        },

        // Fonts
        {
          test: /\.(woff|woff2|eot|ttf|otf)$/i,
          type: "asset/resource",
          generator: {
            filename: "fonts/[name].[hash][ext]",
          },
        },

        // Videos
        {
          test: /\.(mp4|webm|ogg|mp3|wav|flac|aac)$/i,
          type: "asset/resource",
          generator: {
            filename: "media/[name].[hash][ext]",
          },
        },
      ],
    },

    // Plugins
    plugins: [
      // Clean dist folder before all builds to remove old hashed files
      new CleanWebpackPlugin({
        cleanStaleWebpackAssets: true,
        cleanOnceBeforeBuildPatterns: [
          "**/*",
          "!asset-manifest.json", // Keep manifest temporarily during build
        ],
        protectWebpackAssets: false,
      }),

      // Extract CSS into separate files
      new MiniCssExtractPlugin({
        filename: isProduction
          ? "css/[name].[contenthash].css"
          : "css/[name].css",
        chunkFilename: isProduction
          ? "css/[id].[contenthash].css"
          : "css/[id].css",
      }),

      // Copy static files (adjust paths as needed)
      new CopyWebpackPlugin({
        patterns: [
          {
            from: path.resolve(__dirname, "src/images"),
            to: path.resolve(__dirname, "dist/images"),
            noErrorOnMissing: true,
          },
          {
            from: path.resolve(__dirname, "src/fonts"),
            to: path.resolve(__dirname, "dist/fonts"),
            noErrorOnMissing: true,
          },
        ],
      }),

      // Generate asset manifest for WordPress
      new WebpackManifestPlugin({
        fileName: "asset-manifest.json",
        publicPath: "",
        generate: (seed, files, entrypoints) => {
          const manifestFiles = files.reduce((manifest, file) => {
            manifest[file.name] = file.path;
            return manifest;
          }, seed);
          return manifestFiles;
        },
      }),
    ],

    // Optimization
    optimization: {
      minimize: isProduction,
      minimizer: [
        new TerserPlugin({
          terserOptions: {
            compress: {
              drop_console: isProduction,
            },
          },
        }),
        new CssMinimizerPlugin(),
      ],
      splitChunks: {
        chunks: "all",
        cacheGroups: {
          vendor: {
            test: /[\\/]node_modules[\\/]/,
            name: "vendors",
            chunks: "all",
          },
        },
      },
    },

    // Resolve extensions and aliases
    resolve: {
      extensions: [".js", ".jsx", ".json"],
      alias: {
        "@": path.resolve(__dirname, "src"),
        "@js": path.resolve(__dirname, "src/js"),
        "@scss": path.resolve(__dirname, "src/scss"),
        "@images": path.resolve(__dirname, "src/images"),
      },
    },

    // Development options
    devtool: isProduction ? "source-map" : "eval-source-map",

    // Performance hints
    performance: {
      hints: isProduction ? "warning" : false,
      maxEntrypointSize: 512000,
      maxAssetSize: 512000,
    },

    // Stats configuration
    stats: {
      colors: true,
      hash: false,
      version: false,
      timings: true,
      assets: true,
      chunks: false,
      modules: false,
      reasons: false,
      children: false,
      source: false,
      errors: true,
      errorDetails: true,
      warnings: true,
      publicPath: false,
    },
  };
};
