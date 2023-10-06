/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./app/Views/**/*.php"],
  theme: {
    extend: {
      colors: {
        'primary': '#ededed',
        'secondary': '#2f2f30',
        'accent': '#69c545',
        'anchor': '#468630',
      }
    },
    fontFamily: {
      'serif': ['Noto Serif', 'serif'],
      'mono': ['Ubuntu Mono', 'monospace'],
    }
  },
  plugins: [],
  safelist: [
    {
      pattern: /grid-cols-\d/,
      variants: ['md']
    }
  ],
  darkMode: 'class',
}

