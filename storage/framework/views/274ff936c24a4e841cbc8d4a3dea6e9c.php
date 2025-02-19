<?php $__env->startSection('title', 'Checkout'); ?>

<?php $__env->startSection('content'); ?>

<section class="py-16 bg-lightDark">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold text-white">Checkout</h2>
        <p class="mt-4 text-lg text-gray-300">Total Pembayaran: Rp <?php echo e(number_format($booking->total_price, 0, ',', '.')); ?></p>

        <button id="pay-button"
            class="px-6 py-3 mt-6 text-lg font-semibold bg-red-600 rounded-lg hover:bg-red-700">
            Bayar Sekarang
        </button>
    </div>
</section>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo e(env('MIDTRANS_CLIENT_KEY')); ?>"></script>
<script>
    document.getElementById('pay-button').onclick = function () {
        fetch("<?php echo e(route('payment.create')); ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
            },
            body: JSON.stringify({ booking_id: <?php echo e($booking->id); ?> })
        })
        .then(response => response.json())
        .then(data => {
            if (data.snap_token) {
                snap.pay(data.snap_token);
            } else {
                alert("Gagal mendapatkan token pembayaran.");
            }
        })
        .catch(error => console.error("Error:", error));
    };
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u327867218/domains/staging-limbah.my.id/laravel/resources/views/booking/checkout.blade.php ENDPATH**/ ?>