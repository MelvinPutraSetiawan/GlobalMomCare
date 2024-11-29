@extends('layouts.main')

@section('title', $forum->title)

@section('content')
    <div class="container p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-0">{{ $forum->title }}</h1>
        <div class="flex gap-2 items-center">
            <p class="text-sm text-gray-600 mb-6">Posted by: <span class="font-semibold">{{ $forum->account->name }}</span></p>
            @if($forum->account->role == "professional")
                <p class="text-xs text-white mb-6 bg-red-500 p-1 rounded-md">Professional</p>
            @endif
        </div>

        @if($forum->pictures->isNotEmpty())
            <div id="carouselExample" class="carousel slide mb-6" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @if($forum->pictures->isNotEmpty())
                        @foreach ($forum->pictures as $index => $picture)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $picture->pictureLink) }}" alt="{{ $forum->title }}" class="d-block w-100 object-cover rounded-lg shadow-md">
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
        @endif


        <p class="text-gray-700 mb-6">{{ $forum->content }}</p>

        <h2 class="text-xl font-semibold text-gray-800 mb-4">Comments</h2>

        @if($forum->comments->isNotEmpty())
            <div class="space-y-4">
                @foreach ($forum->comments as $comment)
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                        <div class="flex gap-2 items-center ">
                            <p class="text-base text-gray-600 mb-2"><span class="font-bold">{{ $comment->account->name }}</span></p>
                            @if($comment->account->role == "professional")
                                <p class="text-xs text-white mb-2 bg-red-500 p-1 rounded-md">Professional</p>
                            @endif
                        </div>
                        <p class="text-gray-800 text-sm mb-0">{{ $comment->content }}</p>
                        @if(auth()->check() && auth()->user()->id === $comment->account->id)
                            <form method="POST" action="{{ route('comment.delete', ['id' => $comment->id, 'forumid' => $forum->id]) }}" onsubmit="return confirm('Are you sure you want to delete this comment?')" class="mt-2">
                                @csrf
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No comments yet. Be the first to comment!</p>
        @endif

        @if(auth()->check())
            <form method="POST" action="{{ route('comment.store', $forum->id) }}" class="mt-6">
                @csrf
                <textarea name="comment" placeholder="Add your comment" class="w-full p-3 rounded-lg border border-gray-300 focus:ring focus:ring-blue-300" rows="3"></textarea>
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition mt-2">
                    Submit
                </button>
            </form>
        @else
            <p class="text-gray-500 mt-6">You must login to comment.</p>
        @endif
    </div>
@endsection
