/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'gold': '#D4AF37', // Theme 1
                
                // Theme 2 (Rustic) Updated Palette
                'sage': '#8DA399',
                'sage-dark': '#4A5D46',
                'cream': '#F9F9F2',     // Lebih terang dikit
                'sand': '#E6E2DD',
                'charcoal': '#2F3E32',
                'terracotta': '#C87964' // Tambah warna aksen bata dikit biar hidup
            },
            fontFamily: {
                'royal': ['Cinzel', 'serif'],
                'rustic-serif': ['Playfair Display', 'serif'],
                'rustic-script': ['Pinyon Script', 'cursive'],
            },
            backgroundImage: {
                'paper-texture': "url('https://www.transparenttextures.com/patterns/cream-paper.png')",
                'leaf-pattern': "url('https://www.transparenttextures.com/patterns/cubes.png')" // Pola halus
            },
            animation: {
                'float': 'float 6s ease-in-out infinite',
                'float-delayed': 'float 6s ease-in-out 3s infinite',
                'spin-slow': 'spin 12s linear infinite',
            },
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-20px)' },
                }
            }
        },
    },
    plugins: [],
};