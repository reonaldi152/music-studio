<?php $__env->startSection('title', 'Layanan - MD Music Studio'); ?>

<?php $__env->startSection('content'); ?>

    <section class="py-20 bg-gray-900">
        <div class="container px-6 mx-auto text-center">
            <h2 class="text-4xl font-extrabold text-white">Layanan Kami</h2>
            <p class="max-w-2xl mx-auto mt-4 text-lg text-gray-300">
                Kami menyediakan berbagai layanan dari pemesanan studio musik, penyewaan alat musik, hingga rekaman
                profesional.
            </p>

            <div class="grid grid-cols-1 gap-8 mt-10 md:grid-cols-3">
                <div class="p-6 bg-gray-800 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-semibold text-white">Pemesanan Studio</h3>
                    <p class="mt-2 text-gray-400">Sewa studio musik dengan fasilitas terbaik untuk latihan dan rekaman Anda.
                    </p>
                </div>

                <div class="p-6 bg-gray-800 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-semibold text-white">Penyewaan Alat</h3>
                    <p class="mt-2 text-gray-400">Sewa berbagai alat musik berkualitas tinggi untuk kebutuhan musik Anda.
                    </p>
                </div>

                <div class="p-6 bg-gray-800 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-semibold text-white">Rekaman Profesional</h3>
                    <p class="mt-2 text-gray-400">Dapatkan hasil rekaman profesional dengan dukungan teknologi canggih.</p>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\music-studio\resources\views/services.blade.php ENDPATH**/ ?>