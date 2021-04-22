const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
  purge: [
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./vendor/laravel/jetstream/**/*.blade.php",
    "./storage/framework/views/*.php",
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.vue",
    "./node_modules/vue-tailwind/dist/*.js"
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: [...defaultTheme.fontFamily.sans]
      }
    }
  },

  variants: {
    extend: {
      opacity: ["disabled"],
      cursor: ["disabled"]
    }
  },

  plugins: [require("@tailwindcss/forms"), require("@tailwindcss/typography")]
};
