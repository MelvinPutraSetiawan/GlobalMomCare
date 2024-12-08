<?php $__env->startSection('title', 'Product'); ?>

<?php $__env->startSection('content'); ?>
    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 pb-8 pt-2 sm:px-6 sm:py-16 lg:max-w-7xl lg:px-8">
            
            <div class="flex flex-row justify-between items-start mb-6 relative bg-white shadow-md dark:bg-gray-800 sm:rounded-lg w-full p-4">
                <form method="GET" action="<?php echo e(route('products.search')); ?>" class="w-full flex flex-col justify-start items-start gap-4 lg:justify-between lg:flex-row">
                    <div class="w-full flex justify-start items-center">
                        <div class="relative w-full lg:w-4/6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search products..." class="w-full pl-10 pr-10 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                        <div class="ml-8">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded text-sm">
                                Search
                            </button>
                        </div>
                    </div>

                    <div class="w-full flex justify-end items-center">
                        <div class="w-full lg:w-3/6 relative">
                            <button
                                type="button"
                                id="dropdownToggle"
                                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-500 text-left text-nowrap text-sm"
                            >
                                Select Categories
                                <span class="float-right">▼</span>
                            </button>

                            <!-- Dropdown Menu -->
                            <div
                                id="dropdownMenu"
                                class="absolute mt-2 w-full bg-white border border-gray-300 rounded shadow-lg hidden z-10"
                            >
                                <div class="max-h-60 overflow-y-auto p-3 text-sm">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="flex items-center space-x-2 mb-2">
                                        <input
                                            type="checkbox"
                                            id="category<?php echo e($category->id); ?>"
                                            name="categories[]"
                                            value="<?php echo e($category->id); ?>"
                                            <?php echo e(in_array($category->id, request('categories', [])) ? 'checked' : ''); ?>

                                            class="form-checkbox h-4 w-4 text-blue-500"
                                        >
                                        <span><?php echo e($category->name); ?></span>
                                    </label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>

                        <?php if(auth()->check() && auth()->user()->role === 'admin'): ?>
                        <a href="<?php echo e(route('products.create')); ?>" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded ml-4 no-underline whitespace-nowrap text-sm">
                            + Create Product
                        </a>
                        <?php endif; ?>
                    </div>

                </form>
            </div>

            <div class="flex justify-between items-center mb-2">
                <h2 class="font-extrabold">Products</h2>
            </div>

            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex flex-col justify-center items-center mt-0 bg-gray-50 pb-4 rounded-lg hover:bg-gray-200">
                        <a href="<?php echo e(route('products.show', $product->id)); ?>" class="no-underline p-4 rounded-lg">
                            <img src="data:image/jpeg;base64,<?php echo e(base64_encode($picture->pictureLink)); ?>" alt="<?php echo e($product->name); ?>" class="w-64 h-64 object-cover rounded-lg">
                            <h3 class="mt-4 text-base text-gray-700"><?php echo e($product->name); ?></h3>
                            <p class="mt-1 text-base font-bold text-gray-900 mb-2">Rp. <?php echo e($product->price); ?></p>
                            <?php $__currentLoopData = $product->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p class="text-white text-xs p-1 px-2 bg-red-500 inline-block rounded-lg"><?php echo e($category->name); ?></p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </a>
                        <?php if(auth()->check() && auth()->user()->role == "admin"): ?>
                            <div class="flex justify-start items-center gap-3 mt-0">
                                <form method="POST" action="<?php echo e(route('products.delete', $product->id)); ?>" onsubmit="return confirm('Are you sure you want to delete this forum?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                        Delete
                                    </button>
                                </form>
                                <a href="<?php echo e(route('products.update.page', $product->id)); ?>" class="inline-block">
                                    <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                        Update
                                    </button>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownToggle = document.getElementById('dropdownToggle');
        const dropdownMenu = document.getElementById('dropdownMenu');
        dropdownToggle.addEventListener('click', function () {
            dropdownMenu.classList.toggle('hidden');
        });
        document.addEventListener('click', function (e) {
            if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Melvin\Documents\GitHub\GlobalMomsCare\resources\views\product\product.blade.php ENDPATH**/ ?>