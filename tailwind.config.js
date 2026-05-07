/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        dark: "#184F45",       // darker version
        primary: "#2FA084",
        accent: "#6FCF97",
        light: "#E6E6E6",      // slightly muted
        soft: "#ccefdb",       // background tone like your image
        bolb:"#56a666",
      }
    },
  },
  plugins: [],
}