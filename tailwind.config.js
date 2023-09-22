/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
    "./node_modules/tw-elements/dist/js/**/*.js"
  ],
  theme: {
    extend: {},
    colors: {
        transparent: 'transparent',
        current: 'currentColor',
        'background2': '#E6F3FE',
        'primary2': '#F27C0F',
        'secondary2': '#B9DDFD',
        'accent': '#0679E5',
        'texte': '#00050A',
    },
      fontFamily: {
          'bree': ['Bree Serif', 'sans-serif'],
      },
  },
  plugins: [
      require('tw-elements/dist/plugin.cjs')
  ],
}

