@extends('layouts.main')

@section('title', $article->title)

@section('content')
<div class="container mx-auto p-6">
    <!-- Article Title -->
    <h1 class="text-4xl font-extrabold text-gray-800 mb-6 leading-tight">{{ $article->title }}</h1>

    <!-- Article Metadata (optional, e.g., author, date) -->
    <div class="text-sm text-gray-500 mb-4">
        <span>By {{ $article->account->name ?? 'Unknown' }}</span> &middot;
        <span>{{ $article->created_at->format('F d, Y') }}</span>
    </div>

        <!-- Image gallery -->
    <div class="container">
        <div class="px-8">
            @if($article->pictures->isNotEmpty())
                <div id="carouselExample" class="carousel slide mb-6" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @if($article->pictures->isNotEmpty())
                            @foreach ($article->pictures as $index => $picture)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="data:image/jpeg;base64,{{ base64_encode($picture->pictureLink) }}" alt="Article Image" class="d-block w-100 object-cover rounded-lg shadow-md">
                                </div>
                            @endforeach
                        @else
                            <div class="carousel-item active">
                                <img src="https://via.placeholder.com/800x400?text=No+Images" alt="No images" class="d-block w-100">
                            </div>
                        @endif
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
            @else
                <p class="text-gray-500 italic">No images available for this article.</p>
            @endif
        </div>
    </div>

    <!-- Article Content -->
    <div class="prose prose-lg max-w-none text-gray-700 mb-8">
        <!-- Format article content to preserve new lines -->
        @foreach (explode("\n", $article->content) as $paragraph)
            <p>{{ $paragraph }}</p>
        @endforeach
    </div>

    <!-- Back to Home Button -->
    <div class="mt-6">
        <a href="{{ route('home') }}" class="inline-block bg-blue-500 text-white py-3 px-6 rounded-lg text-lg font-semibold hover:bg-blue-600 transition">
            &larr; Back to Home
        </a>
    </div>
</div>
@endsection
