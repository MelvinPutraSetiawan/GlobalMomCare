<?php $__env->startSection('title', $forum->title); ?>

<?php $__env->startSection('content'); ?>
    <div class="container p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-0"><?php echo e($forum->title); ?></h1>
        <div class="flex gap-2 items-center">
            <p class="text-sm text-gray-600 mb-6">Posted by: <span class="font-semibold"><?php echo e($forum->account->name); ?></span></p>
            <?php if($forum->account->role == "professional"): ?>
                <p class="text-xs text-white mb-6 bg-red-500 p-1 rounded-md">Professional</p>
            <?php endif; ?>
        </div>

        <?php if($forum->pictures->isNotEmpty()): ?>
            <div id="carouselExample" class="carousel slide mb-6" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php if($forum->pictures->isNotEmpty()): ?>
                        <?php $__currentLoopData = $forum->pictures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $picture): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="carousel-item <?php echo e($index === 0 ? 'active' : ''); ?>">
                                <img src="data:image/jpeg;base64,<?php echo e(base64_encode($picture->pictureLink)); ?>" alt="<?php echo e($forum->title); ?>" class="d-block w-100 object-cover rounded-lg shadow-md">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div class="carousel-item active">
                            <img src="https://via.placeholder.com/800x400?text=No+Images" alt="No images" class="d-block w-100">
                        </div>
                    <?php endif; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        <?php endif; ?>


        <p class="text-gray-700 mb-6"><?php echo e($forum->content); ?></p>

        <h2 class="text-xl font-semibold text-gray-800 mb-4">Comments</h2>

        <?php if($forum->comments->isNotEmpty()): ?>
            <div class="space-y-4">
                <?php $__currentLoopData = $forum->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                        <div class="flex gap-2 items-center ">
                            <p class="text-base text-gray-600 mb-2"><span class="font-bold"><?php echo e($comment->account->name); ?></span></p>
                            <?php if($comment->account->role == "professional"): ?>
                                <p class="text-xs text-white mb-2 bg-red-500 p-1 rounded-md">Professional</p>
                            <?php endif; ?>
                        </div>
                        <p class="text-gray-800 text-sm mb-0"><?php echo e($comment->content); ?></p>
                        <?php if(auth()->check() && auth()->user()->id === $comment->account->id): ?>
                            <form method="POST" action="<?php echo e(route('comment.delete', ['id' => $comment->id, 'forumid' => $forum->id])); ?>" onsubmit="return confirm('Are you sure you want to delete this comment?')" class="mt-2">
                                <?php echo csrf_field(); ?>
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <p class="text-gray-500">No comments yet. Be the first to comment!</p>
        <?php endif; ?>

        <?php if(auth()->check()): ?>
            <form method="POST" action="<?php echo e(route('comment.store', $forum->id)); ?>" class="mt-6">
                <?php echo csrf_field(); ?>
                <textarea name="comment" placeholder="Add your comment" class="w-full p-3 rounded-lg border border-gray-300 focus:ring focus:ring-blue-300" rows="3"></textarea>
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition mt-2">
                    Submit
                </button>
            </form>
        <?php else: ?>
            <p class="text-gray-500 mt-6">You must login to comment.</p>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Melvin\Documents\GitHub\GlobalMomsCare\resources\views\forum\detail.blade.php ENDPATH**/ ?>