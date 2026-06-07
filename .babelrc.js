module.exports = {
  presets: [
    [
      "@babel/preset-env",
      {
        targets: {
          browsers: ["> 1%", "last 2 versions", "not dead", "not ie <= 11"],
        },
        useBuiltIns: "usage",
        corejs: 3,
        modules: false, // Let Webpack handle modules
      },
    ],
  ],
  plugins: [
    // Add any Babel plugins you need here
  ],
};
