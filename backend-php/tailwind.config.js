const plugin = require("tailwindcss/plugin");
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{php,html,js}",
    "./template/**/*.{php,html,js}",
    "./motorMVC/**/*.php",
    "./element/**/*.{php,html,js}",
    "./public_html/**/*.{php,html,js,svg}",
    "./node_modules/flowbite/**/*.js",
  ],
  safelist: [
    ...[...Array(100).keys()].flatMap(i => [`w-[${i * 1}%]`])
  ],
  theme: {
    extend: {
      backgroundImage: {
        'basket-light': "url('/assets/images/basket-light.svg')",
        'basket-dark': "url('/assets/images/basket-dark.svg')",
      },
      keyframes: {
        "opacity-show": {
          from: { opacity: 1 },
          to: { opacity: 0 }
        }
      },
      animation: {
        "opacity-show": 'opacity-show 10s 1',
      },
      textShadow: {
        sm: "0 1px 2px var(--tw-shadow-color)",
        DEFAULT: "0 2px 4px var(--tw-shadow-color)",
        md: "1px 3px 2px var(--tw-shadow-color)",
        lg: "0 8px 4px var(--tw-shadow-color)",
      },
    },
  },
  plugins: [
    plugin(function ({ matchUtilities, theme }) {
      matchUtilities(
        {
          "text-shadow": (value) => ({
            textShadow: value,
          }),
        },
        { values: theme("textShadow") }
      );
    }), require("flowbite/plugin")],
};
