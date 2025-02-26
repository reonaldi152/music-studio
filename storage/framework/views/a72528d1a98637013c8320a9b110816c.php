<?php $__env->startSection('title', 'Pemesanan - MD Music Studio'); ?>

<?php $__env->startSection('content'); ?>

<!-- Pilih Layanan Section -->
<section class="py-16 bg-lightDark">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold text-white">Pilih Layanan</h2>
        <p class="mt-4 text-lg text-gray-300">Kami menyediakan berbagai layanan untuk kebutuhan rekaman dan latihan musik</p>
        <div class="grid grid-cols-1 gap-8 mt-12 md:grid-cols-3">
            
            <!-- Loop Studio -->
            <?php $__currentLoopData = $studios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $studio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="relative overflow-hidden bg-gray-800 rounded-lg shadow-lg group">
                <img src="<?php echo e(asset('storage/public/' . $studio->image)); ?>" alt="Studio Musik"
                    class="object-cover w-full h-64 transition duration-300 group-hover:scale-105 group-hover:opacity-80">
                <div class="absolute inset-0 bg-black opacity-40"></div>
                <div class="absolute text-white bottom-6 left-6">
                    <h3 class="text-2xl font-bold"><?php echo e($studio->name); ?></h3>
                    <p class="mt-2"><?php echo e($studio->description); ?></p>
                    <a href="<?php echo e(route('booking.create', ['studio' => $studio->id])); ?>"
                        class="inline-block mt-2 text-lg font-medium text-primary hover:underline">
                        Book Now →
                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u327867218/domains/staging-limbah.my.id/laravel/resources/views/booking/index.blade.php ENDPATH**/ ?>