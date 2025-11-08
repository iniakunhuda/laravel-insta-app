<x-layouts.app-simple>
    <div class="max-w-2xl mx-auto px-4 pt-20 pb-20">

        {{-- Post Content --}}
        <div class="pb-20"
            x-data="{
                liked: {{ $post->isLikedBy(auth()->id()) ? 'true' : 'false' }},
                bookmarked: {{ $post->isBookmarkedBy(auth()->id()) ? 'true' : 'false' }},
                likesCount: {{ $post->likes_count }},
                commentsCount: {{ $post->comments->count() }},
                comments: @js($post->comments->map(fn($c) => [
                    'id' => $c->id,
                    'user_name' => $c->user->name,
                    'user_initials' => $c->user->initials(),
                    'user_username' => $c->user->username,
                    'content' => $c->content,
                    'created_at' => $c->created_at->diffForHumans(),
                    'can_delete' => auth()->user()?->can('delete', $c) ?? false
                ])),
                content: '',
                async toggleLike() {
                    const url = this.liked ? '{{ route('likes.destroy', $post) }}' : '{{ route('likes.store', $post) }}';
                    const method = this.liked ? 'DELETE' : 'POST';
                    try {
                        const response = await fetch(url, {
                            method: method,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        });
                        if (response.ok) {
                            this.liked = !this.liked;
                            this.likesCount = this.liked ? this.likesCount + 1 : this.likesCount - 1;
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                },
                async toggleBookmark() {
                    const url = this.bookmarked ? '{{ route('bookmarks.destroy', $post) }}' : '{{ route('bookmarks.store', $post) }}';
                    const method = this.bookmarked ? 'DELETE' : 'POST';
                    try {
                        const response = await fetch(url, {
                            method: method,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        });
                        if (response.ok) {
                            this.bookmarked = !this.bookmarked;
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                },
                async submitComment() {
                    if (!this.content.trim()) return;

                    try {
                        const response = await fetch('{{ route('comments.store', $post) }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ content: this.content })
                        });

                        if (response.ok) {
                            const data = await response.json();
                            this.content = '';
                            this.commentsCount++;
                            if (data.comment) {
                                this.comments.push(data.comment);
                            }
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                },
                async deleteComment(commentId, index) {
                    if (!confirm('Are you sure you want to delete this comment?')) return;

                    try {
                        const response = await fetch(`/comments/${commentId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        });

                        if (response.ok) {
                            this.comments.splice(index, 1);
                            this.commentsCount--;
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                }
            }">
            <div class="bg-white border border-gray-200 rounded-lg">
                {{-- Post Header --}}
                <div class="flex items-center justify-between px-4 py-3">
                    <a href="{{ route('profile', $post->user) }}" class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center">
                            <span class="text-sm font-semibold text-gray-700">{{ $post->user->initials() }}</span>
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
                    <img src="{{ $post->post_image_url }}" alt="" class="w-full h-full object-cover">
                </div>

                {{-- Post Actions --}}
                <div class="px-4 py-3">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-start gap-4">
                            <button @click="toggleLike()" type="button" class="p-0">
                                <svg class="w-7 h-7" :class="liked ? 'fill-red-500 text-red-500' : 'fill-none'" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </button>
                            <button>
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </button>
                        </div>
                        <button @click="toggleBookmark()" type="button">
                            <svg class="w-7 h-7" :class="bookmarked ? 'fill-black' : 'fill-none'" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                            </svg>
                        </button>
                    </div>

                    <template x-if="likesCount > 0">
                        <div class="font-semibold mb-2" x-text="`${likesCount.toLocaleString()} likes`"></div>
                    </template>

                    @if($post->caption)
                        <div class="mb-2">
                            <a href="{{ route('profile', $post->user) }}" class="font-semibold">{{ $post->user->name }}</a>
                            <span class="ml-2">{{ $post->caption }}</span>
                        </div>
                    @endif

                    <div class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</div>
                </div>

                {{-- Comments Section --}}
                <template x-if="comments.length > 0">
                    <div class="border-t border-gray-200">
                        <template x-for="(comment, index) in comments" :key="comment.id">
                            <div class="px-4 py-3 flex items-start justify-between">
                                <div class="flex items-start gap-3 flex-1">
                                    <a :href="`/profile/${comment.user_username}`" class="flex-shrink-0">
                                        <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center">
                                            <div class="w-full h-full rounded-full bg-white flex items-center justify-center text-xs font-semibold text-gray-700" x-text="comment.user_initials">
                                            </div>
                                        </div>
                                    </a>
                                    <div class="flex-1">
                                        <div>
                                            <a :href="`/profile/${comment.user_username}`" class="font-semibold" x-text="comment.user_name"></a>
                                            <span class="ml-2" x-text="comment.content"></span>
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1" x-text="comment.created_at"></div>
                                    </div>
                                </div>
                                <template x-if="comment.can_delete">
                                    <button @click="deleteComment(comment.id, index)" type="button" class="text-red-500 text-xs font-semibold ml-2">Delete</button>
                                </template>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        </div>

        @auth
        <div class="left-0 right-0 bg-white border-t border-gray-200 pb-safe" x-data="{ content: '', commentsCount: {{ $post->comments->count() }}, comments: [], async submitComment() { if (!this.content.trim()) return; try { const response = await fetch('{{ route('comments.store', $post) }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json', 'Content-Type': 'application/json' }, body: JSON.stringify({ content: this.content }) }); if (response.ok) { const data = await response.json(); this.content = ''; this.commentsCount++; if (data.comment) { this.comments.push(data.comment); } } } catch (error) { console.error('Error:', error); } } }">
            <form @submit.prevent="submitComment" class="flex items-center px-4 py-3 gap-3">
                <a href="{{ route('profile', auth()->user()) }}" class="flex-shrink-0">
                    <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center">
                        <span class="text-sm font-semibold text-gray-700">
                            {{ auth()->user()->initials() }}
                        </span>
                    </div>
                </a>
                <input type="text" x-model="content" placeholder="Add a comment..." class="flex-1 border-0 focus:ring-0 p-0" required>
                <button type="submit" class="text-blue-500 font-semibold">Post</button>
            </form>
        </div>
        @endauth
    </div>
</x-layouts.app-simple>
