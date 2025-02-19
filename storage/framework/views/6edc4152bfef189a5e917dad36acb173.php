<?php $__env->startSection('title', 'Buat Pemesanan'); ?>

<?php $__env->startSection('content'); ?>

    <section class="py-20 bg-gray-900">
        <div class="container px-6 mx-auto text-center">
            <h2 class="text-4xl font-extrabold text-white">Pemesanan Studio <?php echo e($studio->name); ?></h2>
            <p class="max-w-2xl mx-auto mt-4 text-lg text-gray-300">
                Silakan lakukan pemesanan untuk melanjutkan ke pembayaran.
            </p>

            <div class="inline-block p-6 mt-8 text-left bg-gray-800 rounded-lg shadow-lg">
                <form action="<?php echo e(route('booking.store')); ?>" method="POST" id="booking-form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="studio_id" value="<?php echo e($studio->id); ?>">
                    <input type="hidden" name="total_price" id="total_price_input" value="<?php echo e($studio->price_per_hour); ?>">

                    <div class="text-lg font-semibold text-white">
                        Harga Studio per Jam:
                        <span id="studio-price">
                            Rp <?php echo e(number_format($studio->price_per_hour, 0, ',', '.')); ?>

                        </span>
                    </div>

                    <div class="mt-4 space-y-4">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="add_recording" id="add_recording" value="200000"
                                class="text-red-600 form-checkbox">
                            <span class="text-gray-300">Tambahkan Rekaman (Rp 200.000)</span>
                        </label>

                        <div class="text-gray-300">Pilih Alat Musik (Rp 50.000 per alat)</div>
                        <div class="grid grid-cols-2 gap-2">
                            <?php
                                $equipmentList = ['Gitar', 'Ampli', 'Keyboard'];
                            ?>
                            <?php $__currentLoopData = $equipmentList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="music_equipment[]" value="50000"
                                        class="text-red-600 form-checkbox equipment">
                                    <span class="text-gray-300"><?php echo e($equipment); ?></span>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <div class="mt-6 text-lg font-bold text-white">
                        Total Harga:
                        <span id="total-price">Rp <?php echo e(number_format($studio->price_per_hour, 0, ',', '.')); ?></span>
                    </div>

                    <button type="submit"
                        class="px-6 py-3 mt-6 text-lg font-semibold transition duration-300 bg-red-600 rounded-lg hover:bg-red-700">
                        Lanjut ke Checkout
                    </button>
                </form>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addRecording = document.getElementById('add_recording');
            const equipmentCheckboxes = document.querySelectorAll('.equipment');
            const totalPriceElement = document.getElementById('total-price');
            const totalPriceInput = document.getElementById('total_price_input');

            if (!addRecording || !totalPriceElement || !totalPriceInput) return;

            let basePrice = parseFloat(<?php echo e($studio->price_per_hour); ?>);

            function calculateTotal() {
                let total = basePrice;

                if (addRecording.checked) {
                    total += parseFloat(addRecording.value);
                }

                equipmentCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        total += parseFloat(checkbox.value);
                    }
                });

                totalPriceElement.textContent = `Rp ${total.toLocaleString('id-ID')}`;
                totalPriceInput.value = total;
            }

            addRecording.addEventListener('change', calculateTotal);
            equipmentCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', calculateTotal);
            });

            calculateTotal();
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\music-studio\resources\views/booking/create.blade.php ENDPATH**/ ?>