<?php $__env->startSection('title', 'Create Article'); ?>

<?php $__env->startSection('content'); ?>
<div class="container p-8">
    <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Create a New Article</h2>

    <?php if(session('success')): ?>
        <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('articles.store')); ?>" enctype="multipart/form-data" class="space-y-8">
        <?php echo csrf_field(); ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div>
                <div class="mb-6">
                    <label for="images" class="block text-lg font-medium text-gray-700 mb-2">Upload Images</label>
                    <input type="file" id="imageInput" name="images[]" multiple class="w-full p-3 border rounded-lg shadow-sm" accept="image/*">
                    <div id="previewContainer" class="flex flex-wrap gap-4 pt-3"></div>
                </div>

                <div>
                    <label for="categories" class="block text-lg font-medium text-gray-700 mb-2">Select Categories</label>
                    <div class="p-4 border rounded-lg bg-white shadow-sm max-h-80 overflow-y-auto">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center mb-3">
                                <input type="checkbox" id="category<?php echo e($category->id); ?>" name="categories[]" value="<?php echo e($category->id); ?>" class="form-checkbox h-4 w-4 text-blue-500">
                                <label for="category<?php echo e($category->id); ?>" class="ml-2 text-gray-700"><?php echo e($category->name); ?></label>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <div class="col-span-2">
                <div class="mb-6">
                    <label for="title" class="block text-lg font-medium text-gray-700 mb-2">Title</label>
                    <input type="text" name="title" id="title" class="w-full p-3 border rounded-lg shadow-sm" placeholder="Enter the article title" required>
                </div>

                <div class="pt-4 h-auto">
                    <label for="content" class="block text-lg font-medium text-gray-700 mb-2">Content</label>
                    <textarea name="content" id="content" rows="8" class="w-full p-3 border rounded-lg shadow-sm" placeholder="Write your article here..." required></textarea>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-lg shadow-lg text-lg">
                Submit
            </button>
        </div>
    </form>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const imageInput = document.getElementById('imageInput');
        const previewContainer = document.getElementById('previewContainer');
        imageInput.addEventListener('change', function () {
            const files = Array.from(imageInput.files);
            previewContainer.innerHTML = '';

            files.forEach(file => {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const preview = document.createElement('div');
                    preview.className = 'relative';
                    preview.innerHTML = `
                        <img src="${e.target.result}" alt="Preview" class="w-24 h-24 object-cover rounded-lg shadow">
                        <button type="button" class="w-8 h-8 absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 hover:bg-red-700">X</button>
                    `;
                    previewContainer.appendChild(preview);
                    preview.querySelector('button').addEventListener('click', function () {
                        removeFile(file);
                        previewContainer.removeChild(preview);
                    });
                };

                reader.readAsDataURL(file);
            });
        });
        function removeFile(fileToRemove) {
            const files = Array.from(imageInput.files).filter(file => file !== fileToRemove);

            const dataTransfer = new DataTransfer();
            files.forEach(file => dataTransfer.items.add(file));

            imageInput.files = dataTransfer.files;
        }
        document.querySelector('form').addEventListener('submit', function () {
            console.log("Submitting with files: ", imageInput.files);
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Melvin\Documents\GitHub\GlobalMomsCare\resources\views\article\create.blade.php ENDPATH**/ ?>