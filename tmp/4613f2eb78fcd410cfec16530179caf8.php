<?php $__env->startSection('title', $article->title); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <!-- Article Title -->
    <h1 class="text-3xl font-bold text-gray-800 mb-4"><?php echo e($article->title); ?></h1>

    <!-- Article Content -->
    <div class="text-gray-700 mb-6">
        <p><?php echo e($article->content); ?></p>
    </div>

    <!-- Display Associated Images -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php $__currentLoopData = $article->pictures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $picture): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="mb-4">
                <img src="data:image/jpeg;base64,<?php echo e(base64_encode($picture->pictureLink)); ?>" alt="Article Image" class="w-full h-auto rounded-lg shadow-md">
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Back to Home Button -->
    <a href="<?php echo e(route('home')); ?>" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
        Back to Home
    </a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Melvin\Documents\GitHub\GlobalMomsCare\resources\views\article\detail.blade.php ENDPATH**/ ?>