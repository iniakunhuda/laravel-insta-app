<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Instagram</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <!-- Back Button -->
        <div class="w-full max-w-sm mb-8">
            <a href="{{ url('/') }}" class="inline-block">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
        </div>

        <!-- Login Card -->
        <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg p-8">
            <!-- Instagram Logo -->
            <div class="text-center mb-8">
                <h1 class="text-5xl mb-8" style="font-family: 'Billabong', cursive;">Instagram</h1>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 text-sm text-green-600 text-center">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email/Username -->
                <div>
                    <input
                        type="text"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Phone number, username, or email"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm bg-gray-50 focus:bg-white focus:border-gray-400 focus:outline-none @error('email') border-red-500 @enderror"
                        required
                        autofocus
                    >
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm bg-gray-50 focus:bg-white focus:border-gray-400 focus:outline-none @error('password') border-red-500 @enderror"
                        required
                    >
                    @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Forgot Password -->
                @if (Route::has('password.request'))
                    <div class="text-right">
                        <a href="{{ route('password.request') }}" class="text-xs text-blue-500 hover:text-blue-700">
                            Forgot password?
                        </a>
                    </div>
                @endif

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full bg-blue-400 hover:bg-blue-500 text-white font-semibold py-2 rounded-lg text-sm transition duration-200"
                >
                    Log in
                </button>
            </form>

            <!-- Facebook Login -->
            <div class="mt-6">
                <button class="w-full flex items-center justify-center gap-2 text-blue-600 font-semibold text-sm py-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    Log in with Facebook
                </button>
            </div>

            <!-- Divider -->
            <div class="flex items-center my-6">
                <div class="flex-1 border-t border-gray-300"></div>
                <div class="px-4 text-sm text-gray-500 font-semibold">OR</div>
                <div class="flex-1 border-t border-gray-300"></div>
            </div>

            <!-- Sign Up Link -->
            <div class="text-center text-sm">
                <span class="text-gray-600">Don't have an account?</span>
                <a href="{{ route('register') }}" class="text-blue-500 font-semibold hover:text-blue-700">Sign up.</a>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-center text-xs text-gray-500">
            Instagram or Facebook
        </div>
    </div>
</body>
</html>
