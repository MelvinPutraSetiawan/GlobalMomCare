@extends('layouts.main')

@section('title', 'Profile Page')

@section('content')
    <div class="container">
        <div class="mt-10 bg-red-500 text-white p-6 rounded-lg shadow-md flex items-center gap-4 mb-6">
            <div>
                <h1 class="font-extrabold text-4xl mb-1">{{ $user->name }}</h1>
                <p class="text-sm">{{ $user->email }}</p>
                <p class="mt-2">{{ $user->description ?? 'No description available.' }}</p>
            </div>
        </div>

        {{-- Button Group --}}
        <div class="btn-group mb-4 flex" role="group" aria-label="Profile Toggle Button Group">
            @if ($user->role === "professional")
                <input type="radio" class="hidden" name="btnradio" id="btnradio1" autocomplete="off" checked>
                <label for="btnradio1" onclick="toggleSection('articles')"
                    class="cursor-pointer bg-red-500 text-white px-4 py-2 rounded-l-lg hover:bg-red-600 transition">
                    Articles
                </label>
            @endif

            <input type="radio" class="hidden" name="btnradio" id="btnradio2" autocomplete="off">
            @if ($user->role === "professional")
                <label for="btnradio2" onclick="toggleSection('forums')"
                class="cursor-pointer bg-red-500 text-white px-4 py-2 hover:bg-red-600 transition">
            @else
                <label for="btnradio2" onclick="toggleSection('forums')"
                class="cursor-pointer bg-red-500 text-white px-4 py-2 hover:bg-red-600 transition rounded-l-lg">
            @endif
                Forums
            </label>

            <input type="radio" class="hidden" name="btnradio" id="btnradio3" autocomplete="off">
            <label for="btnradio3" onclick="toggleSection('comments')"
                class="cursor-pointer bg-red-500 text-white px-4 py-2 rounded-r-lg hover:bg-red-600 transition">
                Comments
            </label>
        </div>

        {{-- Articles Section --}}
        @if ($user->role === "professional")
            <div id="articles" class="toggle-section active">
                <h3>Articles</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($articles as $article)
                    <div class="card bg-white shadow-lg rounded-lg overflow-hidden flex flex-col">
                        @php

                        @endphp
                        @if ($article->pictures->isNotEmpty())
                            <img src="data:image/jpeg;base64,{{ base64_encode($article->pictures->first()->pictureLink) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                        @else
                            <img src="{{ asset('images/default.jpg') }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="flex flex-col justify-between flex-1 p-6">
                            <div>
                                <h5 class="text-xl font-bold text-red-600 mb-4">{{ Str::words($article->title, 5) }}</h5>
                                <p class="text-gray-700 mb-4">{{ Str::words($article->content, 20) }}</p>
                            </div>
                            <div class="flex flex-wrap justify-start items-center mb-2 gap-2">
                                @foreach ($article->categories as $category)
                                    <p class="text-white text-xs p-1 px-2 bg-red-500 inline-block rounded-lg">{{ $category->name }}</p>
                                @endforeach
                            </div>
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('articles.show', $article->id) }}" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded transition duration-300 self-start" style="text-decoration: none;">
                                    Learn More
                                </a>
                                <a href="/article/update/{{ $article->id }}">
                                    <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                        Update
                                    </button>
                                </a>
                                <form method="POST" action="{{ route('articles.delete', $article->id) }}" onsubmit="return confirm('Are you sure you want to delete this article?')">
                                    @csrf
                                    @method('DELETE')
                                    <button id="deleteButton" data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                        Delete
                                    </button>
                                </form>

                                <div id="deleteModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                        <!-- Modal content -->
                                        <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                            <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="deleteModal">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                            <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this item?</p>
                                            <div class="flex justify-center items-center space-x-4">
                                                <button data-modal-toggle="deleteModal" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                    No, cancel
                                                </button>
                                                <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                    Yes, I'm sure
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500">No articles found.</p>
                    @endforelse
                </div>
            </div>
        @endif

        {{-- Forums Section --}}
        @if ($user->role === "professional")
            <div id="forums" class="toggle-section">
        @else
            <div id="forums" class="toggle-section active">
        @endif
            <h3>Forums</h3>
            @foreach ($forums as $forum)
                <div class="bg-gray-50 shadow-md rounded-lg mb-6 p-4 flex flex-col md:flex-row items-start md:items-center hover:bg-gray-200">
                    <div class="w-full md:w-1/6 flex-shrink-0">
                        @if($forum->pictures && $forum->pictures->isNotEmpty())
                            <img src="data:image/jpeg;base64,{{ base64_encode($forum->pictures->first()->pictureLink) }}" alt="{{ $forum->title }}" class="w-48 h-32 object-cover rounded">
                        @else
                            <div class="bg-gray-200 w-48 h-32 flex items-center justify-center rounded">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 ml-4">
                        <h2 class="text-xl font-bold text-gray-800 mb-0">{{ $forum->title }}</h2>
                        <h6 class="text-sm font-semibold text-gray-500">By {{ $forum->account->name }}</h6>
                        <p class="text-gray-600 mt-2">{{ Str::limit($forum->content, 150, '...') }}</p>
                        <div class="flex justify-start items-center gap-3 mt-3">
                            <form method="POST" action="{{ route('forums.delete', $forum->id) }}" onsubmit="return confirm('Are you sure you want to delete this forum?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </form>
                            <a href="/forums/update/{{ $forum->id }}" class="inline-block">
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                    Update
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            @if ($forums->isEmpty())
                <p class="text-gray-500">Haven't posted any forum yet...</p>
            @endif
        </div>

        {{-- Comments Section --}}
        <div id="comments" class="toggle-section">
            <h3>Comments</h3>
            @if($comments->isNotEmpty())
                <div class="space-y-4">
                    @foreach ($comments as $comment)
                        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                            <div class="flex gap-2 items-center">
                                <p class="text-base text-gray-600 mb-2"><span class="font-bold">{{ $comment->account->name }}</span></p>
                                @if($comment->account->role == "professional")
                                    <p class="text-xs text-white mb-2 bg-red-500 p-1 rounded-md">Professional</p>
                                @endif
                            </div>
                            <p class="text-gray-800 text-sm mb-0">{{ $comment->content }}</p>
                            <form method="POST" action="{{ route('comment.delete.profile', $comment->id) }}" onsubmit="return confirm('Are you sure you want to delete this comment?')" class="mt-2">
                                @csrf
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No comments yet. Be the first to comment!</p>
            @endif
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

        document.addEventListener("DOMContentLoaded", function(event) {
        document.getElementById('deleteButton').click();
        });
    </script>
@endsection
