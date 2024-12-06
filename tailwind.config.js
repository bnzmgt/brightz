/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');
module.exports = {
    purge: {
        content: ['./**/*.php', './**/*.html', './src/**/*.js'],
        options: {
            safelist: ['dynamic-font'], // Add your dynamic classes here
        },
    },
  theme: {
    
    extend: {
        fontFamily: {
            //sans: ['Outfit', 'sans-serif'],
            sans: ['Roboto', ...defaultTheme.fontFamily.sans],
        },
        colors: {
            'primary': '#182955',
            'orange': '#E9A41C',
            'blue-light': '#27AAE1',
        },
    },
  },
  plugins: [],
}

