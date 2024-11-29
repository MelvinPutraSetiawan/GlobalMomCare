@extends('layouts.main')

@section('title', 'Update Product')

@section('content')
<div class="container p-8">
    <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Update Product</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method("PUT")

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column -->
            <div>
                <!-- Image Upload -->
                <div class="mb-6">
                    <label for="images" class="block text-lg font-medium text-gray-700 mb-2">ADD Images</label>
                    <input type="file" id="imageInput" name="images[]" multiple class="w-full p-3 border rounded-lg shadow-sm" accept="image/*">
                    <div id="previewContainer" class="flex flex-wrap gap-4 pt-3"></div>
                </div>

                <!-- Category Selection -->
                <div>
                    <label for="categories" class="block text-lg font-medium text-gray-700 mb-2">Select Categories</label>
                    <div class="p-4 border rounded-lg bg-white shadow-sm max-h-80 overflow-y-auto">
                        @foreach($categories as $category)
                            <div class="flex items-center mb-3">
                                <input type="checkbox" id="category{{ $category->id }}" name="categories[]" value="{{ $category->id }}"
                                    class="form-checkbox h-4 w-4 text-blue-500"
                                    {{ in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'checked' : '' }}>
                                <label for="category{{ $category->id }}" class="ml-2 text-gray-700">{{ $category->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-span-2">
                <!-- Name Product Input -->
                <div class="mb-6">
                    <label for="name" class="block text-lg font-medium text-gray-700 mb-2">Product Name</label>
                    <input type="text" name="name" id="name" class="w-full p-3 border rounded-lg shadow-sm" placeholder="Enter the product name" required value="{{ old('content', $product->name) }}">
                </div>

                <!-- Price Product Input -->
                <div class="mb-6">
                    <label for="price" class="block text-lg font-medium text-gray-700 mb-2">Product Price</label>
                    <input type="text" name="price" id="price" class="w-full p-3 border rounded-lg shadow-sm" placeholder="Enter the product price" required value="{{ old('content', $product->price) }}">
                </div>

                <!-- Stock Product Input -->
                <div class="mb-6">
                    <label for="stock" class="block text-lg font-medium text-gray-700 mb-2">Product Stock</label>
                    <input type="number" name="stock" id="stock" class="w-full p-3 border rounded-lg shadow-sm" placeholder="Enter the product stock quantity" required value="{{ old('content', $product->stock) }}">
                </div>

                <!-- Description product Input -->
                <div class="pt-4 h-auto">
                    <label for="description" class="block text-lg font-medium text-gray-700 mb-2">Product Description</label>
                    <textarea name="description" id="description" rows="8" class="w-full p-3 border rounded-lg shadow-sm" placeholder="Write your product description here..." required>{{ old('content', $product->description) }}</textarea>
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
@endsection
