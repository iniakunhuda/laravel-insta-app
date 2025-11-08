<x-layouts.app-simple>
    <div class="max-w-2xl mx-auto px-4 pt-18 pb-20">

        <div class="mb-6">
            <h1 class="text-2xl font-bold">Notifications</h1>
            <p class="text-gray-600 text-sm mt-1">
                Here are recent likes on your posts
            </p>
        </div>

        <div class="bg-white rounded-lg shadow">

            {{-- Likes List --}}
            <div class="divide-y">
                @forelse($likes as $like)
                    <a href="{{ route('posts.show', $like->post) }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50">
                        <div class="flex-shrink-0">
                            <div class="w-11 h-11 rounded-full  p-0.5">
                                <div class="w-full h-full rounded-full bg-gray-300 flex items-center justify-center text-sm font-semibold text-gray-700">
                                    {{ $like->user->initials() }}
                                </div>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm">
                                <span class="font-semibold">{{ $like->user->username }}</span>
                                <span class="text-gray-600"> liked your post.</span>
                                <span class="text-gray-400 text-xs"> {{ $like->created_at->diffForHumans() }}</span>
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <img src="{{ $like->post->post_image_url }}" alt="" class="w-11 h-11 object-cover">
                        </div>
                    </a>
                @empty
                    <div class="px-4 py-8 text-center text-gray-500">
                        No notifications yet
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.app-simple>
