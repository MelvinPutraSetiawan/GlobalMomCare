@extends('layouts.main')

@section('title', $article->title)

@section('content')
<div class="container mx-auto p-6">
    <!-- Article Title -->
    <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $article->title }}</h1>

    <!-- Article Content -->
    <div class="text-gray-700 mb-6">
        <p>{{ $article->content }}</p>
    </div>

    <!-- Display Associated Images -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($article->pictures as $picture)
            <div class="mb-4">
                <img src="data:image/jpeg;base64,{{ base64_encode($picture->pictureLink) }}" alt="Article Image" class="w-full h-auto rounded-lg shadow-md">
            </div>
        @endforeach
    </div>

    <!-- Back to Home Button -->
    <a href="{{ route('home') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
        Back to Home
    </a>
</div>
@endsection
