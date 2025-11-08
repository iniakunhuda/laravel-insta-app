<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white">
        <header class="bg-white border-b border-gray-200 fixed top-0 left-0 right-0 z-10">
            <div class="max-w-5xl mx-auto px-4">
                <div class="flex items-center justify-between h-16">
                    <a href="{{ route('home') }}" class="flex items-center gap-4">
                        <img src="{{ asset('svg/instagram.svg') }}" alt="Logo" class="h-8 w-8"/>
                    </a>
                    <div class="flex items-center gap-6">
                        @auth
                        <a href="{{ route('likes.index') }}" class="relative">
                            @if(auth()->user()->unreadLikesCount())
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-semibold rounded-full px-1">{{ auth()->user()->unreadLikesCount() }}</span>
                            @endif
                            <svg class="w-6 h-6 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364 4.318 12.682a4.5 4.5 0 010-6.364z"/>
                            </svg>
                        </a>
                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="p-2 m-0 inline-flex items-center" aria-label="Logout">
                                <svg class="w-6 h-6 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1"/>
                                </svg>
                            </button>
                        </form>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        {{ $slot }}

        <!-- Bottom Navigation -->
        <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200">
            <div class="max-w-5xl mx-auto px-4">
                <div class="flex items-center justify-around h-14">
                    <a href="{{route('home')}}">
                        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </a>
                    <a href="{{ route('posts.create') }}">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                    </a>

                    @auth
                    <a href="{{ route('profile', ['username' => auth()?->user()->username]) }}">
                        <div class="w-7 h-7 rounded-full bg-gray-300 flex items-center justify-center">
                            <span class="text-xs font-semibold">{{ substr(auth()?->user()?->name, 0, 1) ?? 'name' }}</span>
                        </div>
                    </a>
                    @else
                    <a href="{{ route('login') }}">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </a>
                    @endauth
                </div>
            </div>
        </nav>

        @fluxScripts
    </body>
</html>
