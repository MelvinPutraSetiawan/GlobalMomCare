@extends('layouts.main')

@section('title', 'Forum')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex flex-row justify-between items-start mb-6 relative bg-white shadow-md dark:bg-gray-800 sm:rounded-lg w-full p-4">
        <form method="GET" action="{{ route('forums.search') }}" class="w-full flex flex-col justify-start items-start gap-4 lg:justify-between lg:flex-row">
            <div class="w-full flex justify-start items-center">
                <div class="relative w-full lg:w-4/6">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search forums by title..." class="w-full pl-10 pr-10 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-500">
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
                            @foreach($categories as $category)
                            <label class="flex items-center space-x-2 mb-2">
                                <input
                                    type="checkbox"
                                    id="category{{ $category->id }}"
                                    name="categories[]"
                                    value="{{ $category->id }}"
                                    {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}
                                    class="form-checkbox h-4 w-4 text-blue-500"
                                >
                                <span>{{ $category->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                @if(auth()->check())
                <a href="{{ route('forums.new.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded ml-4 no-underline whitespace-nowrap text-sm">
                    + Create Forums
                </a>
                @endif
            </div>

        </form>
    </div>

    <div class="container mx-auto ">
        @if ($forums->isNotEmpty())
            @foreach ($forums as $forum)
                <a href="{{ route('forums.show', $forum->id) }}" class="no-underline">
                    <div class="bg-gray-50 shadow-md rounded-lg mb-6 p-4 flex flex-col md:flex-row items-start md:items-center hover:bg-gray-200">
                        <div class="w-full md:w-1/6">
                            @if($forum->pictures->isNotEmpty())
                                <img src="data:image/jpeg;base64,{{ base64_encode($forum->pictures->first()->pictureLink) }}" alt="{{ $forum->title }}" class="w-48 h-32 object-cover rounded">
                            @else
                                <div class="bg-gray-200 w-full h-32 flex items-center justify-center rounded">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 ml-4">
                            <h2 class="text-xl font-bold text-gray-800 mb-0">{{ $forum->title }}</h2>
                            <h6 class="text-sm font-semibold text-gray-500">By {{ $forum->account->name }}</h6>
                            <p class="text-gray-600 mt-2">{{ Str::limit($forum->content, 150, '...') }}</p>
                            <div class="flex flex-wrap justify-start items-center mb-2 gap-2">
                                @foreach ($forum->categories as $category)
                                    <p class="text-white text-xs p-1 px-2 bg-red-500 inline-block rounded-lg">{{ $category->name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        @else
            <p>No forums found!</p>
        @endif
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
@endsection
