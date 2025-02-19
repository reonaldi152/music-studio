<?php $__env->startSection('title', 'Beranda - MD Music Studio'); ?>

<?php $__env->startSection('content'); ?>

    <!-- Hero Section -->
    <section class="relative flex items-center justify-center h-screen bg-black">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <img src="<?php echo e(asset('images/hero.png')); ?>" alt="Latar belakang studio musik MD Music Studio"
            class="absolute inset-0 object-cover w-full h-full">

        <div class="relative z-10 px-6 text-center text-white md:px-12">
            <h1 class="text-4xl font-bold leading-tight md:text-6xl">
                Selamat Datang di <span class="text-red-500">MD Music Studio</span>
            </h1>
            <p class="max-w-2xl mx-auto mt-4 text-lg md:text-xl">
                Tempat terbaik untuk rekaman dan latihan musik Anda dengan fasilitas terbaik.
            </p>
            <a href="<?php echo e(route('booking.index')); ?>"
                class="inline-block px-8 py-3 mt-6 text-lg font-semibold text-white transition duration-300 bg-red-600 rounded-lg shadow-lg hover:bg-red-700">
                Pesan Sekarang
            </a>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\music-studio\resources\views/home.blade.php ENDPATH**/ ?>