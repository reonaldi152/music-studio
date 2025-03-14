<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'MD Music Studio'); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>

<body class="font-sans text-white bg-dark">
    
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
    <footer class="py-12 text-gray-400 bg-dark mt-12">
        <div class="container px-6 mx-auto">
            <div class="flex flex-col items-center justify-between mb-8 md:flex-row md:items-start">
                <div class="mb-6 text-center md:text-left md:mb-0">
                    <h2 class="text-3xl font-bold text-white">MD Studio</h2>
                    <p class="mt-2 text-gray-300">Tempat terbaik untuk rekaman dan latihan musik Anda.</p>
                </div>
                <div class="flex space-x-24">
                    <div class="text-center md:text-left">
                        <h3 class="text-xl font-semibold text-white">Informasi</h3>
                        <ul class="mt-4 space-y-4">
                            <li><a href="#" class="text-gray-400 hover:text-white">FAQ</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Kontak</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between pt-6 mt-6 border-t border-gray-700">
                <p class="text-sm text-center text-gray-400">© MD Studio 2025 all rights reserved</p>
            </div>
        </div>
    </footer>

</body>

</html>
<?php /**PATH /Users/reonaldisaputro/Documents/Reonaldi/Flutter-Project/music-studio/resources/views/layouts/app.blade.php ENDPATH**/ ?>