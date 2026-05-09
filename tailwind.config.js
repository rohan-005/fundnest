/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],

  theme: {
    extend: {

      colors: {

        dark: "#0F3D35",
        primary: "#1F7A67",
        accent: "#39B68D",

        soft: "#EAF7F2",
        muted: "#A7B8B3",

        card: "#FFFFFF",

        sidebar: "#123F37",

        borderc: "#D7E7E1",

        success: "#1DB954",
        warning: "#F59E0B",
        danger: "#EF4444",
      },

      boxShadow: {
        soft: "0 10px 35px rgba(0,0,0,0.08)",
        dark: "0 8px 30px rgba(0,0,0,0.25)",
      },
    },
  },

  plugins: [],
}