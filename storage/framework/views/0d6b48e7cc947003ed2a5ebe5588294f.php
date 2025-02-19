<?php $__env->startSection('title', 'Beranda - MD Music Studio'); ?>

<?php $__env->startSection('content'); ?>

<!-- Hero Section -->
<section class="relative flex items-center justify-center h-screen">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <img src="<?php echo e(asset('images/hero.png')); ?>" alt="Studio Musik"
        class="absolute inset-0 object-cover w-full h-full">
    <div class="relative text-center">
        <h1 class="text-4xl font-bold md:text-6xl">Selamat Datang di MD Music Studio</h1>
        <p class="mt-4 text-lg md:text-xl">Tempat terbaik untuk rekaman dan latihan musik Anda</p>
        <a href="<?php echo e(route('booking.index')); ?>"
            class="inline-block px-6 py-3 mt-6 text-lg font-semibold bg-red-600 rounded-lg hover:bg-red-700">
            Pesan Sekarang
        </a>
        
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/reonaldisaputro/Documents/Reonaldi/Flutter-Project/music-studio/resources/views/home.blade.php ENDPATH**/ ?>