<x-layouts.app-simple>
    <div class="min-h-screen bg-white">
        {{-- Header --}}
        <div class="sticky top-0 z-10 bg-white border-b border-gray-200">
            <div class="flex items-center justify-between px-4 py-3">
                <a href="{{ url()->previous() }}" class="text-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <span class="font-semibold">Post</span>
                <button class="text-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Post Content --}}
        <div class="pb-20">
            {{-- Post Header --}}
            <div class="flex items-center justify-between px-4 py-3">
                <a href="{{ route('profile', $post->user) }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-400 via-pink-500 to-orange-400 p-0.5">
                        <div class="w-full h-full rounded-full bg-white flex items-center justify-center text-sm font-semibold text-gray-700">
                            {{ $post->user->initials() }}
                        </div>
                    </div>
                    <span class="font-semibold">{{ $post->user->name }}</span>
                </a>
                <button class="p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                    </svg>
                </button>
            </div>

            {{-- Post Image --}}
            <div class="w-full aspect-square bg-gray-100">
                <img src="{{ asset('storage/' . $post->image_path) }}" alt="" class="w-full h-full object-cover">
            </div>

            {{-- Post Actions --}}
            <div class="px-4 py-3">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-4">
                        @if($post->isLikedBy(auth()->id()))
                            <form action="{{ route('likes.destroy', $post) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-0">
                                    <svg class="w-7 h-7 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                    </svg>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('likes.store', $post) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="p-0">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </button>
                            </form>
                        @endif
                        <button>
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </button>
                        <button>
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                        </button>
                    </div>
                    <button>
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                        </svg>
                    </button>
                </div>

                @if($post->likes_count > 0)
                    <div class="font-semibold mb-2">{{ number_format($post->likes_count) }} likes</div>
                @endif

                @if($post->caption)
                    <div class="mb-2">
                        <a href="{{ route('profile', $post->user) }}" class="font-semibold">{{ $post->user->name }}</a>
                        <span class="ml-2">{{ $post->caption }}</span>
                    </div>
                @endif

                <div class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</div>
            </div>

            {{-- Comments Section --}}
            @if($post->comments->count() > 0)
                <div class="border-t border-gray-200">
                    @foreach($post->comments as $comment)
                        <div class="px-4 py-3 flex items-start justify-between">
                            <div class="flex items-start gap-3 flex-1">
                                <a href="{{ route('profile', $comment->user) }}" class="flex-shrink-0">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-400 via-pink-500 to-orange-400 p-0.5">
                                        <div class="w-full h-full rounded-full bg-white flex items-center justify-center text-xs font-semibold text-gray-700">
                                            {{ $comment->user->initials() }}
                                        </div>
                                    </div>
                                </a>
                                <div class="flex-1">
                                    <div>
                                        <a href="{{ route('profile', $comment->user) }}" class="font-semibold">{{ $comment->user->name }}</a>
                                        <span class="ml-2">{{ $comment->content }}</span>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">{{ $comment->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                            @can('delete', $comment)
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 text-xs font-semibold ml-2">Delete</button>
                                </form>
                            @endcan
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Comment Input --}}
        <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 pb-safe">
            <form action="{{ route('comments.store', $post) }}" method="POST" class="flex items-center px-4 py-3 gap-3">
                @csrf
                <a href="{{ route('profile', auth()->user()) }}" class="flex-shrink-0">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-400 via-pink-500 to-orange-400 p-0.5">
                        <div class="w-full h-full rounded-full bg-white flex items-center justify-center text-xs font-semibold text-gray-700">
                            {{ auth()->user()->initials() }}
                        </div>
                    </div>
                </a>
                <input type="text" name="content" placeholder="Add a comment..." class="flex-1 border-0 focus:ring-0 p-0" required>
                <button type="submit" class="text-blue-500 font-semibold">Post</button>
            </form>
        </div>
    </div>
</x-layouts.app>
