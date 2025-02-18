<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MD Music Studio</title>
    @vite('resources/css/app.css')
</head>

<body class="font-sans text-white bg-dark">

    <!-- Navbar -->
    <nav class="fixed top-0 z-50 flex items-center justify-between w-full px-6 py-4 bg-black shadow-md">
        <div class="text-xl font-bold">MD MUSIC STUDIO</div>
        <div class="hidden space-x-6 md:flex">
            <a href="index.html" class="hover:text-gray-400">Beranda</a>
            <a href="about.html" class="hover:text-gray-400">Tentang Kami</a>
            <a href="services.html" class="hover:text-gray-400">Layanan</a>
            <a href="booking.html" class="hover:text-gray-400">Pemesanan</a>
        </div>
        <div class="space-x-4">
            <a href="login.html" class="px-4 py-2 bg-red-600 rounded hover:bg-red-700">Login</a>
            <a href="register.html" class="px-4 py-2 bg-red-700 rounded hover:bg-red-800">Register</a>
        </div>
    </nav>

    <!-- Pilih Layanan Section -->
    <section class="py-16 bg-lightDark">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-white">Pilih Layanan</h2>
            <p class="mt-4 text-lg text-gray-300">Kami menyediakan berbagai layanan untuk kebutuhan rekaman dan latihan
                musik</p>
            <div class="grid grid-cols-1 gap-8 mt-12 md:grid-cols-3">
                <!-- Studio Musik -->
                <div class="relative overflow-hidden bg-gray-800 rounded-lg shadow-lg group">
                    <img src="{{ asset('images/hero.png') }}" alt="Studio Musik"
                        class="object-cover w-full h-64 transition duration-300 group-hover:scale-105 group-hover:opacity-80">
                    <div class="absolute inset-0 bg-black opacity-40"></div>
                    <div class="absolute text-white bottom-6 left-6">
                        <h3 class="text-2xl font-bold">Studio Musik</h3>
                        <p class="mt-2">Studio Musik ini menjadi tempat untuk Latihan, Aransemen, dan Mastering lagu
                            sebelum rilis</p>
                        <a href="#"
                            class="inline-block mt-2 text-lg font-medium text-primary hover:underline">Book Now →</a>
                    </div>
                </div>

                <!-- Sewa Alat Musik -->
                <div class="relative overflow-hidden bg-gray-800 rounded-lg shadow-lg group">
                    <img src="{{ asset('images/hero.png') }}" alt="Sewa Alat Musik"
                        class="object-cover w-full h-64 transition duration-300 group-hover:scale-105 group-hover:opacity-80">
                    <div class="absolute inset-0 bg-black opacity-40"></div>
                    <div class="absolute text-white bottom-6 left-6">
                        <h3 class="text-2xl font-bold">Sewa Alat Musik</h3>
                        <p class="mt-2">Alat musik ada beberapa jenis, seperti gitar, drum, dll. Anda bisa menyewanya
                            dengan mudah.</p>
                        <a href="#"
                            class="inline-block mt-2 text-lg font-medium text-primary hover:underline">Book Now →</a>
                    </div>
                </div>

                <!-- Studio Rekaman -->
                <div class="relative overflow-hidden bg-gray-800 rounded-lg shadow-lg group">
                    <img src="{{ asset('images/hero.png') }}" alt="Studio Rekaman"
                        class="object-cover w-full h-64 transition duration-300 group-hover:scale-105 group-hover:opacity-80">
                    <div class="absolute inset-0 bg-black opacity-40"></div>
                    <div class="absolute text-white bottom-6 left-6">
                        <h3 class="text-2xl font-bold">Studio Rekaman</h3>
                        <p class="mt-2">Anda bisa menyewa studio rekaman untuk kebutuhan rekaman anda</p>
                        <a href="#"
                            class="inline-block mt-2 text-lg font-medium text-primary hover:underline">Book Now →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="py-12 text-gray-400 bg-dark">
        <div class="container px-6 mx-auto">
            <!-- Top Footer -->
            <div class="flex flex-col items-center justify-between mb-8 md:flex-row md:items-start">
                <!-- Left Section (Social Media) -->
                <div class="mb-6 text-center md:text-left md:mb-0">
                    <h2 class="text-3xl font-bold text-white">MD Studio</h2>
                    <p class="mt-2 text-gray-300">It is easier to entrust the work to the experts because they are able
                        to provide</p>
                    <div class="flex justify-center mt-4 space-x-6 md:justify-start">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-facebook-f"></i> <!-- Facebook Icon -->
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-twitter"></i> <!-- Twitter Icon -->
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-instagram"></i> <!-- Instagram Icon -->
                        </a>
                    </div>
                </div>

                <!-- Right Sections (Links) -->
                <div class="flex space-x-24">
                    <!-- About Section -->
                    <div class="text-center md:text-left">
                        <h3 class="text-xl font-semibold text-white">About</h3>
                        <ul class="mt-4 space-y-4">
                            <li><a href="#" class="text-gray-400 hover:text-white">My History</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Blogs</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Newsletter</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Pricing List</a></li>
                        </ul>
                    </div>

                    <!-- Information Section -->
                    <div class="text-center md:text-left">
                        <h3 class="text-xl font-semibold text-white">Information</h3>
                        <ul class="mt-4 space-y-4">
                            <li><a href="#" class="text-gray-400 hover:text-white">Sitemap</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">FAQ</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Contact Me</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Community</a></li>
                        </ul>
                    </div>

                    <!-- Get In Touch Section -->
                    <div class="text-center md:text-left">
                        <h3 class="text-xl font-semibold text-white">Get In Touch</h3>
                        <p class="mt-4 text-gray-300">Stay connected with me and let's know more about my service</p>
                        <a href="contact.html"
                            class="inline-block px-6 py-3 mt-6 text-lg font-semibold text-white rounded-lg bg-primary hover:bg-red-600">
                            Contact Us
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="flex items-center justify-between pt-6 mt-6 border-t border-gray-700">
                <p class="text-sm text-center text-gray-400">© MD Studio 2025 all rights reserved</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-white">Term & Services</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
