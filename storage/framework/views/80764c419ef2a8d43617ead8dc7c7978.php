<?php $__env->startSection('title', 'Pemesanan - MD Music Studio'); ?>

<?php $__env->startSection('content'); ?>

    <!-- Pilih Layanan Section -->
    <section class="py-20 bg-gray-900">
        <div class="container px-6 mx-auto text-center">
            <h2 class="text-4xl font-extrabold text-white">Pilih Layanan</h2>
            <p class="max-w-2xl mx-auto mt-4 text-lg text-gray-300">
                Kami menyediakan berbagai layanan untuk kebutuhan rekaman dan latihan musik.
            </p>
            <div class="grid grid-cols-1 gap-8 mt-12 md:grid-cols-3">

                <!-- Loop Studio -->
                <?php $__currentLoopData = $studios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $studio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="relative overflow-hidden bg-gray-800 rounded-lg shadow-lg group">
                        <img src="<?php echo e(asset('storage/' . $studio->image)); ?>" alt="Studio Musik"
                            class="object-cover w-full h-64 transition-transform duration-300 group-hover:scale-105 group-hover:opacity-80">
                        <div
                            class="absolute inset-0 transition-opacity duration-300 bg-black opacity-50 group-hover:opacity-60">
                        </div>
                        <div class="absolute space-y-2 text-white bottom-6 left-6">
                            <h3 class="text-2xl font-bold"><?php echo e($studio->name); ?></h3>
                            <p class="text-gray-300"><?php echo e($studio->description); ?></p>
                            <a href="<?php echo e(route('booking.create', ['studio' => $studio->id])); ?>"
                                class="inline-block px-4 py-2 mt-2 text-lg font-semibold text-white transition duration-300 bg-blue-600 rounded-lg hover:bg-blue-700">
                                Book Now →
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\music-studio\resources\views/booking/index.blade.php ENDPATH**/ ?>