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

    <!-- Hero Section -->
    <section class="relative flex items-center justify-center h-screen">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <img src="{{ asset('images/hero.png') }}" alt="Studio Musik"
            class="absolute inset-0 object-cover w-full h-full">
        <div class="relative text-center">
            <h1 class="text-4xl font-bold md:text-6xl">Selamat Datang di MD Music Studio</h1>
            <p class="mt-4 text-lg md:text-xl">Tempat terbaik untuk rekaman dan latihan musik Anda</p>
            <a href="booking.html"
                class="inline-block px-6 py-3 mt-6 text-lg font-semibold bg-red-600 rounded-lg hover:bg-red-700">Pesan
                Sekarang</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 bg-dark">
        <div class="container grid items-center grid-cols-1 gap-12 mx-auto md:grid-cols-2">
            <!-- Left Section (Text) -->
            <div class="space-y-6 text-white">
                <h2 class="text-4xl font-bold">Tentang Kami</h2>
                <p class="text-lg text-gray-300">
                    Kami adalah studio musik yang menawarkan layanan profesional seperti rekaman dan produksi musik.
                    Dengan fasilitas terbaik, kami siap membantu mewujudkan karya musik Anda dengan kualitas unggul.
                    Studio kami menawarkan fasilitas rekaman profesional, mixing & mastering, serta produksi musik
                    berkualitas tinggi.
                    Kami menyediakan ruang yang nyaman dan peralatan terbaik untuk membantu Anda menciptakan karya musik
                    yang luar biasa.
                </p>
                <a href="https://www.youtube.com/watch?v=Gqrv_WfdY6U" target="_blank"
                    class="inline-block px-6 py-3 text-lg text-white transition duration-300 ease-in-out rounded-lg bg-primary hover:bg-red-600">
                    Watch Video
                </a>
            </div>

            <!-- Right Section (Image & Video) -->
            <div class="space-y-6">
                <!-- First Image Section -->
                <div class="flex justify-center">
                    <img src="{{ asset('images/tk-1.png') }}" alt="Studio Image"
                        class="w-full h-auto rounded-lg shadow-lg">
                </div>

                <!-- Video Section (Middle) -->
                <div class="flex justify-center">
                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/Gqrv_WfdY6U"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen class="rounded-lg shadow-lg">
                    </iframe>
                </div>

                <!-- Second Image Section -->
                <div class="flex justify-center">
                    <img src="{{ asset('images/tk-2.png') }}" alt="Studio Image"
                        class="w-full h-auto rounded-lg shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-16 bg-lightDark">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-white">Layanan</h2>
            <p class="mt-4 text-lg text-gray-300">Kami menyediakan berbagai layanan dari pemesanan studio musik,
                penyewaan berbagai alat musik, serta studio rekaman</p>

            <div class="grid grid-cols-1 gap-8 mt-12 md:grid-cols-3">
                <!-- Studio Music -->
                <div class="relative overflow-hidden bg-gray-800 rounded-lg shadow-lg group">
                    <img src="{{ asset('images/l-1.png') }}" alt="Studio Musik"
                        class="object-cover w-full h-64 transition duration-300 group-hover:scale-105 group-hover:opacity-80">
                    <div class="absolute inset-0 bg-black opacity-40"></div>
                    <div class="absolute text-white bottom-6 left-6">
                        <h3 class="text-2xl font-bold">Studio Musik</h3>
                        <a href="#"
                            class="inline-block mt-2 text-lg font-medium text-primary hover:underline">view details
                            →</a>
                    </div>
                </div>

                <!-- Music Equipment Rental -->
                <div class="relative overflow-hidden bg-gray-800 rounded-lg shadow-lg group">
                    <img src="{{ asset('images/l-2.png') }}" alt="Sewa Alat Musik"
                        class="object-cover w-full h-64 transition duration-300 group-hover:scale-105 group-hover:opacity-80">
                    <div class="absolute inset-0 bg-black opacity-40"></div>
                    <div class="absolute text-white bottom-6 left-6">
                        <h3 class="text-2xl font-bold">Sewa Alat Musik</h3>
                        <a href="#"
                            class="inline-block mt-2 text-lg font-medium text-primary hover:underline">view details
                            →</a>
                    </div>
                </div>

                <!-- Recording Studio -->
                <div class="relative overflow-hidden bg-gray-800 rounded-lg shadow-lg group">
                    <img src="{{ asset('images/l-3.png') }}" alt="Studio Rekaman"
                        class="object-cover w-full h-64 transition duration-300 group-hover:scale-105 group-hover:opacity-80">
                    <div class="absolute inset-0 bg-black opacity-40"></div>
                    <div class="absolute text-white bottom-6 left-6">
                        <h3 class="text-2xl font-bold">Studio Rekaman</h3>
                        <a href="#"
                            class="inline-block mt-2 text-lg font-medium text-primary hover:underline">view details
                            →</a>
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
