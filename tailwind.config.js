/** @type {import('tailwindcss').Config} */
module.exports = {
content: ["./**/*.php"],
  theme: {
    
    extend: {
        fontFamily: {
            sans: ['Outfit', 'sans-serif'],
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

