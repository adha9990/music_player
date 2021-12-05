const plugin = require("tailwindcss/plugin");
// import plugin from 'tailwindcss/plugin'

module.exports = {
    purge: [],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {},
    },
    variants: {
        extend: {},
    },
    plugins: [
        plugin(function ({ addUtilities }) {
            const newUtilities = {
                ".overflow-none-scoll": {
                    overflow: "auto",
                },
                ".overflow-none-scoll::-webkit-scrollbar": {
                    display: "none",
                },
                ".animate-spin": {
                    animation: "spin 10s linear infinite",
                },
            };

            addUtilities(newUtilities);
        }),
    ],
};
