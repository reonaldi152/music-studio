<?php $__env->startSection('title', 'Buat Pemesanan'); ?>

<?php $__env->startSection('content'); ?>

<section class="py-16 bg-lightDark">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold text-white">Pemesanan Studio <?php echo e($studio->name); ?></h2>
        <p class="mt-4 text-lg text-gray-300">Silakan lakukan pemesanan untuk melanjutkan ke pembayaran.</p>

        <form action="<?php echo e(route('booking.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="studio_id" value="<?php echo e($studio->id); ?>">
            <button type="submit"
                class="px-6 py-3 mt-6 text-lg font-semibold bg-red-600 rounded-lg hover:bg-red-700">
                Lanjut ke Checkout
            </button>
        </form>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u327867218/domains/staging-limbah.my.id/laravel/resources/views/booking/create.blade.php ENDPATH**/ ?>