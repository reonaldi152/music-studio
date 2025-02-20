<?php $__env->startSection('title', 'Tentang Kami - MD Music Studio'); ?>

<?php $__env->startSection('content'); ?>

    <section class="py-12 text-white bg-gray-900">
        <div class="container px-6 mx-auto">

            <!-- Flexbox Container -->
            <div class="flex flex-col items-start justify-between gap-6 md:flex-row">

                <!-- Kiri: Judul & Deskripsi -->
                <div class="md:w-1/2">
                    <h2 class="text-4xl font-extrabold md:mb-4">Tentang Kami</h2>
                    <p class="text-lg leading-relaxed text-gray-300">
                        MD Music Studio bukan sekadar tempat latihan, tetapi juga ruang kreativitas bagi musisi dari
                        berbagai genre untuk mengeksplorasi bakat mereka. Kami percaya bahwa musik adalah ekspresi seni yang
                        harus didukung dengan fasilitas terbaik, suasana inspiratif, dan tim yang berdedikasi. Bergabunglah
                        dengan kami dan rasakan pengalaman bermusik yang lebih profesional, nyaman, dan berkualitas tinggi.
                    </p>
                </div>

                <!-- Kanan: Video YouTube -->
                <div class="w-full md:w-1/2">
                    <iframe class="w-full rounded-lg shadow-lg h-52 md:h-72 lg:h-80"
                        src="https://www.youtube.com/embed/Gqrv_WfdY6U?si=Bz_8n6FA9to7cKg1" title="YouTube video player"
                        frameborder="0" allowfullscreen
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin">
                    </iframe>
                </div>
            </div>

            <!-- Google Maps -->
            <div class="mt-12 text-center">
                <h3 class="text-2xl font-bold">Lokasi Kami</h3>
                <p class="mt-2 text-lg text-gray-300">Kunjungi studio kami di lokasi berikut:</p>
                <div class="flex justify-center mt-6">
                    <iframe class="w-full h-64 rounded-lg shadow-lg md:w-3/4 lg:w-1/2 md:h-96"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.100054885422!2d106.56059157455648!3d-6.250545393737871!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fd94e39d720b%3A0x9a3bf90f491b94f2!2sMD%20STUDIO%20%26%20RECORDING%20CURUG!5e0!3m2!1sid!2sid!4v1739973021393!5m2!1sid!2sid"
                        style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\music-studio\resources\views/about.blade.php ENDPATH**/ ?>