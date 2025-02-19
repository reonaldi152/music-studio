<?php $__env->startSection('title', 'Profile - MD Music Studio'); ?>

<?php $__env->startSection('content'); ?>

<section class="py-16 bg-dark text-white">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold">Profil Saya</h2>
        <p class="mt-4 text-lg text-gray-300">Informasi akun Anda</p>

        <div class="mt-8 bg-gray-800 p-6 rounded-lg shadow-lg w-1/2 mx-auto text-left">
            <p class="text-lg"><strong>Nama:</strong> <?php echo e($user->name); ?></p>
            <p class="text-lg"><strong>Email:</strong> <?php echo e($user->email); ?></p>
            <p class="text-lg"><strong>Bergabung sejak:</strong> <?php echo e($user->created_at->format('d M Y')); ?></p>

            <a href="<?php echo e(route('home')); ?>" class="mt-4 inline-block px-6 py-3 bg-blue-600 rounded-lg hover:bg-blue-700">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u327867218/domains/staging-limbah.my.id/laravel/resources/views/profile/index.blade.php ENDPATH**/ ?>