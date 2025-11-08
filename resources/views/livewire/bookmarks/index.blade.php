<x-layouts.app-simple>
    <div class="max-w-2xl mx-auto px-4 pt-16 pb-20">
        <div class="mb-6">
            <h1 class="text-2xl font-bold">Saved Posts</h1>
            <p class="text-gray-600 text-sm mt-1">Only you can see what you've saved</p>
        </div>

        @if($posts->isEmpty())
            <div class="text-center py-12">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No saved posts yet</h3>
                <p class="text-gray-500">Start saving posts to see them here</p>
            </div>
        @else
            <div class="space-y-8">
                @foreach($posts as $post)
                    <article class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                        {{-- Post Header --}}
                        <div class="flex items-center justify-between p-4">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('profile', $post->user->username) }}" class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br p-0.5">
                                        <div class="w-full h-full rounded-full bg-gray-300 flex items-center justify-center text-sm font-semibold text-gray-700">
                                            {{ $post->user->initials() }}
                                        </div>
                                    </div>
                                </a>
                                <div>
                                    <a href="{{ route('profile', $post->user->username) }}" class="font-semibold hover:text-gray-600">
                                        {{ $post->user->username }}
                                    </a>
                                    <div class="text-xs text-gray-500">
                                        {{ $post->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Post Image --}}
                        <a href="{{ route('posts.show', $post) }}">
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post image" class="w-full">
                        </a>

                        {{-- Post Actions --}}
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-4">
                                    @auth
                                        @if($post->bookmarks->isNotEmpty())
                                            <form action="{{ route('bookmarks.destroy', $post) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="hover:text-gray-600">
                                                    <svg class="w-7 h-7 fill-current" viewBox="0 0 24 24">
                                                        <path d="M17 3H7c-1.1 0-1.99.9-1.99 2L5 21l7-3 7 3V5c0-1.1-.9-2-2-2z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('bookmarks.store', $post) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="hover:text-gray-600">
                                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>

                            {{-- Likes Count --}}
                            @if($post->likes_count > 0)
                                <div class="font-semibold text-sm mb-2">
                                    {{ number_format($post->likes_count) }} {{ Str::plural('like', $post->likes_count) }}
                                </div>
                            @endif

                            {{-- Caption --}}
                            @if($post->caption)
                                <div class="text-sm mb-2">
                                    <a href="{{ route('profile', $post->user->username) }}" class="font-semibold hover:text-gray-600">
                                        {{ $post->user->username }}
                                    </a>
                                    <span class="ml-2">{{ $post->caption }}</span>
                                </div>
                            @endif

                            {{-- View Comments --}}
                            @if($post->comments_count > 0)
                                <a href="{{ route('posts.show', $post) }}" class="text-sm text-gray-500 hover:text-gray-700">
                                    View all {{ $post->comments_count }} {{ Str::plural('comment', $post->comments_count) }}
                                </a>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($posts->hasPages())
                <div class="mt-8">
                    {{ $posts->links() }}
                </div>
            @endif
        @endif
    </div>
</x-layouts.app-simple>
