import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans], // Menambahkan Figtree sebagai font default
            },
            colors: {
                dark: "#0B0B0F", // Latar belakang gelap
                primary: "#E50914", // Warna utama (Merah)
                lightDark: "#16161A", // Warna latar belakang sedikit lebih terang
                grayText: "#B0B0B0", // Warna teks yang lebih soft
            },
            spacing: {
                128: "32rem", // Menambahkan ukuran besar (untuk padding dan margin besar)
            },
            boxShadow: {
                xl: "0 10px 15px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.1)", // Menambahkan shadow besar untuk elemen tertentu
            },
        },
    },
    plugins: [],
};
