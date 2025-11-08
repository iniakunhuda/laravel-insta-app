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

        


    </div>
</body>
</html>
