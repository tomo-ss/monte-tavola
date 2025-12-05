/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./resources/views/**/*.blade.php"
  ],
  safelist: [
    "w-[1248px]",
    "shadow-[0_4px_4px_rgba(0,0,0,0.5)]",
    "space-x-9",
    "min-w-[600px]",
    "inline-block",
    "bg-[#F1ECEB]",
    "bg-[#F8F8F8]",

    // Aboutセクション用
    "w-[640px]",
    "h-[427px]",
    "w-[444px]",
    "h-[296px]",
    "w-[360px]",
    "h-[240px]",
    "max-w-[640px]",
    "max-w-[360px]",

    // Menuセクション用
    { pattern: /space-x-(\d+)/ },
    "flex",
    "justify-center"
  ],

  theme: {
    extend: {
      spacing: {
        '8': '2rem',
        '12': '3rem',
      },
    },
  },

  plugins: [],
}
