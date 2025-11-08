<x-layouts.app-simple>
    <div class="max-w-5xl mx-auto px-4 pt-18 pb-20">
        {{-- Profile Section --}}
        <div class="px-4 py-6">
            <div class="flex items-start gap-6 mb-6">
                <div class="flex-shrink-0">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-purple-400 via-pink-500 to-orange-400 p-0.5">
                        <div class="w-full h-full rounded-full bg-white flex items-center justify-center text-2xl font-semibold text-gray-700">
                            {{ $user->initials() }}
                        </div>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="flex justify-around text-center mb-4">
                        <div>
                            <div class="text-xl font-semibold">{{ $user->posts()->count() }}</div>
                            <div class="text-sm text-gray-500">Posts</div>
                        </div>
                        <div>
                            <div class="text-xl font-semibold">0</div>
                            <div class="text-sm text-gray-500">Followers</div>
                        </div>
                        <div>
                            <div class="text-xl font-semibold">0</div>
                            <div class="text-sm text-gray-500">Following</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <div class="font-semibold">{{ $user->name }}</div>
                <div class="text-sm text-gray-600">Profile Description</div>
                <div class="text-sm text-gray-600">Everything is designed.</div>
            </div>

            @if(auth()->id() === $user->id)
                {{-- <a href="{{ route('settings') }}" class="block w-full py-2 text-center font-semibold border border-gray-300 rounded-lg hover:bg-gray-50">
                    Edit Profile
                </a> --}}
            @endif
        </div>

        {{-- Story Highlights --}}
        <div class="px-4 mb-6">
            <div class="flex gap-4 overflow-x-auto pb-2">
                <div class="flex flex-col items-center gap-2 flex-shrink-0">
                    <div class="w-16 h-16 rounded-full border-2 border-gray-300 flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <span class="text-xs">New</span>
                </div>
                <div class="flex flex-col items-center gap-2 flex-shrink-0">
                    <div class="w-16 h-16 rounded-full border-2 border-gray-300 overflow-hidden">
                        <div class="w-full h-full bg-gray-200"></div>
                    </div>
                    <span class="text-xs">Friends</span>
                </div>
                <div class="flex flex-col items-center gap-2 flex-shrink-0">
                    <div class="w-16 h-16 rounded-full border-2 border-gray-300 overflow-hidden">
                        <div class="w-full h-full bg-gray-200"></div>
                    </div>
                    <span class="text-xs">Sport</span>
                </div>
                <div class="flex flex-col items-center gap-2 flex-shrink-0">
                    <div class="w-16 h-16 rounded-full border-2 border-gray-300 overflow-hidden">
                        <div class="w-full h-full bg-gray-200"></div>
                    </div>
                    <span class="text-xs">Design</span>
                </div>
            </div>
        </div>

        {{-- Tab Navigation --}}
        <div class="border-t border-gray-200">
            <div class="flex">
                <button class="flex-1 py-3 border-t-2 border-black">
                    <svg class="w-6 h-6 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 4h7v7H4V4zm0 9h7v7H4v-7zm9-9h7v7h-7V4zm0 9h7v7h-7v-7z"/>
                    </svg>
                </button>
                <button class="flex-1 py-3 border-t-2 border-transparent text-gray-400">
                    <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Photo Grid --}}
        <div class="grid grid-cols-3 gap-1">
            @foreach($posts as $post)
                <a href="{{ route('posts.show', $post) }}" class="aspect-square relative group">
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-6 text-white">
                        <div class="flex items-center gap-2">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            <span class="font-semibold">{{ $post->likes_count }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/>
                            </svg>
                            <span class="font-semibold">{{ $post->comments_count }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-layouts.app>
