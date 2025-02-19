<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'MD Music Studio'); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="font-sans text-white bg-gray-900">

    <!-- Navbar -->
    <nav class="fixed top-0 z-50 flex items-center justify-between w-full px-6 py-4 bg-black shadow-md">
        <div class="text-xl font-bold"><a href="/">MD MUSIC STUDIO</a></div>
        <div class="hidden space-x-6 md:flex">
            <a href="<?php echo e(route('home')); ?>" class="hover:text-gray-400">Beranda</a>
            <a href="<?php echo e(route('about')); ?>" class="hover:text-gray-400">Tentang Kami</a>
            <a href="<?php echo e(route('services')); ?>" class="hover:text-gray-400">Layanan</a>
            <a href="<?php echo e(route('booking.index')); ?>" class="hover:text-gray-400">Pemesanan</a>
        </div>

        <div class="space-x-4">
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('profile')); ?>" class="px-4 py-2 bg-blue-600 rounded hover:bg-blue-700">
                    Profile (<?php echo e(Auth::user()->name); ?>)
                </a>
                <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="px-4 py-2 bg-red-700 rounded hover:bg-red-800">Logout</button>
                </form>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="px-4 py-2 bg-red-600 rounded hover:bg-red-700">Login</a>
                <a href="<?php echo e(route('register')); ?>" class="px-4 py-2 bg-red-700 rounded hover:bg-red-800">Register</a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Content -->
    <main class="pt-20">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="py-16 mt-12 text-gray-300 bg-gray-800">
        <div class="container px-6 mx-auto">
            <div class="grid grid-cols-1 gap-8 text-center md:grid-cols-3 md:text-left">
                <div>
                    <h2 class="text-3xl font-bold text-white">MD Studio</h2>
                    <p class="mt-2 text-gray-400">Tempat terbaik untuk rekaman dan latihan musik Anda.</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-white">Navigasi</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="#" class="hover:text-white">Beranda</a></li>
                        <li><a href="#" class="hover:text-white">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white">Layanan</a></li>
                        <li><a href="#" class="hover:text-white">Pemesanan</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-white">Kontak</h3>
                    <p class="mt-2 text-gray-400">Jl. Curug Gang AMD, Tangerang 15810</p>
                    <p class="text-gray-400">Email: mdmusicstudio409@gmail.com</p>
                    <p class="text-gray-400">Telepon: +62 812-3456-7890</p>
                    <div class="flex justify-center mt-4 space-x-4 md:justify-start">
                        <a href="https://www.instagram.com/md_musicstudio?igsh=MzVhcXd4NjFteTgy"
                            class="text-gray-400 hover:text-white">
                            <i class="text-xl fa-brands fa-instagram"></i>
                        </a>
                        <a href="https://www.youtube.com/@MDSTUDIOPROJECT" class="text-gray-400 hover:text-white">
                            <i class="text-xl fa-brands fa-youtube"></i>
                        </a>
                    </div>

                </div>
            </div>
            <div class="pt-6 mt-8 text-center border-t border-gray-700">
                <p class="text-sm">© 2025 MD Studio. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>

</html>
<?php /**PATH C:\laragon\www\music-studio\resources\views/layouts/app.blade.php ENDPATH**/ ?>