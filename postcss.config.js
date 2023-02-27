module.exports = {
  plugins: [
    require("tailwindcss"),
    require("tailwindcss/nesting")(require("postcss-nesting")),
    require("autoprefixer"),
    require("postcss-import"),
  ],
};
