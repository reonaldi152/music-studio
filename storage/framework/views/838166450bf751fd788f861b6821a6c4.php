<?php $__env->startSection('title', 'Login - MD Music Studio'); ?>

<?php $__env->startSection('content'); ?>

<div class="flex items-center justify-center min-h-screen bg-dark px-4">
    <div class="w-full max-w-md p-8 bg-gray-900 rounded-lg shadow-md">
        <h2 class="mb-6 text-3xl font-bold text-center text-white">Login</h2>

        <?php if(session('error')): ?>
            <div class="p-2 mb-4 text-sm text-white bg-red-500 rounded"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <!-- Form -->
        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>
            
            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                <input type="email" id="email" name="email" required
                    class="w-full px-4 py-2 mt-1 text-black bg-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2 mt-1 text-black bg-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center text-sm text-gray-300">
                    <input type="checkbox" name="remember" class="mr-2 text-red-500">
                    Ingat Saya
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full px-4 py-2 text-lg font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 transition duration-300">
                Login
            </button>
        </form>

        <!-- Register Link -->
        <p class="mt-4 text-center text-gray-400">
            Belum punya akun? <a href="<?php echo e(route('register')); ?>" class="text-red-400 hover:underline">Daftar di sini</a>
        </p>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u327867218/domains/staging-limbah.my.id/laravel/resources/views/auth/login.blade.php ENDPATH**/ ?>