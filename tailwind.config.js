/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      "./resources/**/*.{html,js,php,vue}",
      "./vendor/laravel/framework/src/Illuminate/View/Components/*.php", // For Laravel Blade components
    ],
    theme: {
      extend: {},
    },
    plugins: [],
  };
