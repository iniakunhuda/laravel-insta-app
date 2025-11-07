<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed - Instagram Clone</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white border-b border-gray-200 fixed top-0 left-0 right-0 z-10">
            <div class="max-w-5xl mx-auto px-4">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center gap-4">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3H7m5.5 4A2.5 2.5 0 0 1 15 10.5a2.5 2.5 0 0 1-2.5 2.5A2.5 2.5 0 0 1 10 10.5A2.5 2.5 0 0 1 12.5 8M7 18v-1.5c0-1.4 2.2-2.5 5-2.5s5 1.1 5 2.5V18H7z"/>
                        </svg>
                        <h1 class="text-2xl font-semibold" style="font-family: 'Billabong', cursive;">Instagram</h1>
                    </div>
                    <div class="flex items-center gap-6">
                        <svg class="w-6 h-6 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <svg class="w-6 h-6 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </header>

        <!-- Stories -->
        {{-- <div class="max-w-5xl mx-auto px-4 pt-20 pb-4">
            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <div class="flex gap-4 overflow-x-auto scrollbar-hide">
                    <div class="flex flex-col items-center gap-1 flex-shrink-0">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-tr from-yellow-400 to-pink-600 p-0.5">
                            <div class="bg-white rounded-full p-0.5">
                                <div class="w-14 h-14 rounded-full bg-gray-300 flex items-center justify-center">
                                    <span class="text-xl font-semibold text-gray-700">{{ substr(auth()?->user()?->name, 0, 1) ?? 'name' }}</span>
                                </div>
                            </div>
                        </div>
                        <span class="text-xs">Your Story</span>
                    </div>
                    @for ($i = 1; $i <= 10; $i++)
                    <div class="flex flex-col items-center gap-1 flex-shrink-0">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-tr from-yellow-400 to-pink-600 p-0.5">
                            <div class="bg-white rounded-full p-0.5">
                                <div class="w-14 h-14 rounded-full bg-gray-200"></div>
                            </div>
                        </div>
                        <span class="text-xs">user{{ $i }}</span>
                    </div>
                    @endfor
                </div>
            </div>
        </div> --}}

        <!-- Posts Feed -->
        <div class="max-w-5xl mx-auto px-4 pt-20 pb-20">
            @foreach ($posts as $post)
            <article class="bg-white border border-gray-200 rounded-lg mb-4">
                <!-- Post Header -->
                <div class="flex items-center justify-between p-3">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center">
                            <span class="text-sm font-semibold text-gray-700">{{ $post->user->initials() }}</span>
                        </div>
                        <div>
                            <p class="font-semibold text-sm">{{ $post->user->name }}</p>
                            <p class="text-xs text-gray-500">Tokyo, Japan</p>
                        </div>
                    </div>
                    <button class="text-gray-600">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="5" r="2"/>
                            <circle cx="12" cy="12" r="2"/>
                            <circle cx="12" cy="19" r="2"/>
                        </svg>
                    </button>
                </div>

                <!-- Post Image -->
                <div class="relative">
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post" class="w-full">
                    <div class="absolute top-3 right-3 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                        1/3
                    </div>
                </div>

                <!-- Post Actions -->
                <div class="p-3">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-4">
                            <form method="POST" action="{{ $post->isLikedBy(auth()->id()) ? route('likes.destroy', $post) : route('likes.store', $post) }}">
                                @csrf
                                @if ($post->isLikedBy(auth()->id()))
                                    @method('DELETE')
                                @endif
                                <button type="submit">
                                    <svg class="w-7 h-7 {{ $post->isLikedBy(auth()->id()) ? 'fill-red-500' : 'fill-none' }} stroke-current" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </button>
                            </form>
                            <button>
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </button>
                            <button>
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                            </button>
                        </div>
                        <button>
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Likes Count -->
                    <p class="font-semibold text-sm mb-2">
                        {{ number_format($post->likes_count) }} likes
                    </p>

                    <!-- Caption -->
                    <div class="text-sm mb-2">
                        <span class="font-semibold">{{ $post->user->name }}</span>
                        <span class="ml-1">{{ $post->caption }}</span>
                    </div>

                    <!-- View Comments -->
                    @if ($post->comments_count > 0)
                    <button class="text-sm text-gray-500 mb-2">
                        View all {{ number_format($post->comments_count) }} comments
                    </button>
                    @endif

                    <!-- Recent Comments -->
                    @foreach ($post->comments->take(2) as $comment)
                    <div class="text-sm mb-1">
                        <span class="font-semibold">{{ $comment->user->name }}</span>
                        <span class="ml-1">{{ $comment->content }}</span>
                    </div>
                    @endforeach

                    <!-- Post Time -->
                    <p class="text-xs text-gray-400 uppercase mt-2">
                        {{ $post->created_at->diffForHumans() }}
                    </p>
                </div>

                <!-- Add Comment -->
                <form method="POST" action="{{ route('comments.store', $post) }}" class="border-t border-gray-200 p-3">
                    @csrf
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <input type="text" name="content" placeholder="Add a comment..." class="flex-1 outline-none text-sm" required>
                        <button type="submit" class="font-semibold text-blue-500 text-sm">Post</button>
                    </div>
                </form>
            </article>
            @endforeach

            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>

        <!-- Bottom Navigation -->
        <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200">
            <div class="max-w-5xl mx-auto px-4">
                <div class="flex items-center justify-around h-14">
                    <button>
                        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </button>
                    <button>
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                    <button>
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                    </button>
                    <button>
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>
                    <button>
                        <div class="w-7 h-7 rounded-full bg-gray-300 flex items-center justify-center">
                            <span class="text-xs font-semibold">{{ substr(auth()?->user()?->name, 0, 1) ?? 'name' }}</span>
                        </div>
                    </button>
                </div>
            </div>
        </nav>
    </div>
</body>
</html>
