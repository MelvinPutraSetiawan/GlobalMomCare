<?php $__env->startSection('title', 'Profile Page'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1 class="font-extrabold text-4xl mt-9 mb-0"><?php echo e($user->name); ?></h1>
        <p class="mb-0"><?php echo e($user->email); ?></p>
        <?php if($user->description != null): ?>
            <p><?php echo e($user->description); ?></p>
        <?php else: ?>
            <p>No description</p>
        <?php endif; ?>

        
        <div class="btn-group mb-4 flex" role="group" aria-label="Profile Toggle Button Group">
            <?php if($user->role === "professional"): ?>
                <input type="radio" class="hidden" name="btnradio" id="btnradio1" autocomplete="off" checked>
                <label for="btnradio1" onclick="toggleSection('articles')"
                    class="cursor-pointer bg-red-500 text-white px-4 py-2 rounded-l-lg hover:bg-red-600 transition">
                    Articles
                </label>
            <?php endif; ?>

            <input type="radio" class="hidden" name="btnradio" id="btnradio2" autocomplete="off">
            <?php if($user->role === "professional"): ?>
                <label for="btnradio2" onclick="toggleSection('forums')"
                class="cursor-pointer bg-red-500 text-white px-4 py-2 hover:bg-red-600 transition">
            <?php else: ?>
                <label for="btnradio2" onclick="toggleSection('forums')"
                class="cursor-pointer bg-red-500 text-white px-4 py-2 hover:bg-red-600 transition rounded-l-lg">
            <?php endif; ?>
                Forums
            </label>

            <input type="radio" class="hidden" name="btnradio" id="btnradio3" autocomplete="off">
            <label for="btnradio3" onclick="toggleSection('comments')"
                class="cursor-pointer bg-red-500 text-white px-4 py-2 rounded-r-lg hover:bg-red-600 transition">
                Comments
            </label>
        </div>

        
        <?php if($user->role === "professional"): ?>
            <div id="articles" class="toggle-section active">
                <h3>Articles</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="card bg-white shadow-lg rounded-lg overflow-hidden flex flex-col">
                        <?php

                        ?>
                        <?php if($article->pictures->isNotEmpty()): ?>
                            <img src="data:image/jpeg;base64,<?php echo e(base64_encode($picture->pictureLink)); ?>" alt="<?php echo e($article->title); ?>" class="w-full h-48 object-cover">
                        <?php else: ?>
                            <img src="<?php echo e(asset('images/default.jpg')); ?>" alt="<?php echo e($article->title); ?>" class="w-full h-48 object-cover">
                        <?php endif; ?>
                        <div class="flex flex-col justify-between flex-1 p-6">
                            <div>
                                <h5 class="text-xl font-bold text-red-600 mb-4"><?php echo e(Str::words($article->title, 5)); ?></h5>
                                <p class="text-gray-700 mb-4"><?php echo e(Str::words($article->content, 20)); ?></p>
                            </div>
                            <div class="flex flex-wrap justify-start items-center mb-2 gap-2">
                                <?php $__currentLoopData = $article->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <p class="text-white text-xs p-1 px-2 bg-red-500 inline-block rounded-lg"><?php echo e($category->name); ?></p>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="flex justify-center items-center gap-2">
                                <a href="<?php echo e(route('articles.show', $article->id)); ?>" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded transition duration-300 self-start" style="text-decoration: none;">
                                    Learn More
                                </a>
                                <a href="/article/update/<?php echo e($article->id); ?>">
                                    <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                        Update
                                    </button>
                                </a>
                                <form method="POST" action="<?php echo e(route('articles.delete', $article->id)); ?>" onsubmit="return confirm('Are you sure you want to delete this article?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-gray-500">No articles found.</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        
        <?php if($user->role === "professional"): ?>
            <div id="forums" class="toggle-section">
        <?php else: ?>
            <div id="forums" class="toggle-section active">
        <?php endif; ?>
            <h3>Forums</h3>
            <?php $__currentLoopData = $forums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $forum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-gray-50 shadow-md rounded-lg mb-6 p-4 flex flex-col md:flex-row items-start md:items-center hover:bg-gray-200">
                    <div class="w-full md:w-1/6 flex-shrink-0">
                        <?php if($forum->pictures && $forum->pictures->isNotEmpty()): ?>
                            <img src="data:image/jpeg;base64,<?php echo e(base64_encode($picture->pictureLink)); ?>" alt="<?php echo e($forum->title); ?>" class="w-48 h-32 object-cover rounded">
                        <?php else: ?>
                            <div class="bg-gray-200 w-48 h-32 flex items-center justify-center rounded">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="flex-1 ml-4">
                        <h2 class="text-xl font-bold text-gray-800 mb-0"><?php echo e($forum->title); ?></h2>
                        <h6 class="text-sm font-semibold text-gray-500">By <?php echo e($forum->account->name); ?></h6>
                        <p class="text-gray-600 mt-2"><?php echo e(Str::limit($forum->content, 150, '...')); ?></p>
                        <div class="flex justify-start items-center gap-3 mt-3">
                            <form method="POST" action="<?php echo e(route('forums.delete', $forum->id)); ?>" onsubmit="return confirm('Are you sure you want to delete this forum?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </form>
                            <a href="/forums/update/<?php echo e($forum->id); ?>" class="inline-block">
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                    Update
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if($forums->isEmpty()): ?>
                <p class="text-gray-500">Haven't posted any forum yet...</p>
            <?php endif; ?>
        </div>

        
        <div id="comments" class="toggle-section">
            <h3>Comments</h3>
            <?php if($comments->isNotEmpty()): ?>
                <div class="space-y-4">
                    <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                            <div class="flex gap-2 items-center">
                                <p class="text-base text-gray-600 mb-2"><span class="font-bold"><?php echo e($comment->account->name); ?></span></p>
                                <?php if($comment->account->role == "professional"): ?>
                                    <p class="text-xs text-white mb-2 bg-red-500 p-1 rounded-md">Professional</p>
                                <?php endif; ?>
                            </div>
                            <p class="text-gray-800 text-sm mb-0"><?php echo e($comment->content); ?></p>
                            <form method="POST" action="<?php echo e(route('comment.delete.profile', $comment->id)); ?>" onsubmit="return confirm('Are you sure you want to delete this comment?')" class="mt-2">
                                <?php echo csrf_field(); ?>
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <p class="text-gray-500">No comments yet. Be the first to comment!</p>
            <?php endif; ?>
        </div>
    </div>
    <script>
        function toggleSection(sectionId) {
            const sections = document.querySelectorAll(".toggle-section");
            sections.forEach((section) => {
                if (section.id === sectionId) {
                    section.classList.add("active");
                } else {
                    section.classList.remove("active");
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Melvin\Documents\GitHub\GlobalMomsCare\resources\views\profile.blade.php ENDPATH**/ ?>