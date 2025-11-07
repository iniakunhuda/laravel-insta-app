{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Instagram</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-8">
        <!-- Back Button -->
        <div class="w-full max-w-sm mb-8">
            <a href="{{ url('/') }}" class="inline-block">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
        </div>

        <!-- Register Card -->
        <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg p-8">
            <!-- Instagram Logo -->
            <div class="text-center mb-6">
                <h1 class="text-5xl mb-4" style="font-family: 'Billabong', cursive;">Instagram</h1>
                <p class="text-gray-500 text-sm font-semibold px-8">
                    Sign up to see photos and videos from your friends.
                </p>
            </div>

            <!-- Facebook Signup -->
            <button class="w-full flex items-center justify-center gap-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold text-sm py-2 rounded-lg mb-4">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
                Log in with Facebook
            </button>

            <!-- Divider -->
            <div class="flex items-center my-6">
                <div class="flex-1 border-t border-gray-300"></div>
                <div class="px-4 text-sm text-gray-500 font-semibold">OR</div>
                <div class="flex-1 border-t border-gray-300"></div>
            </div>

            <!-- Register Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-3">
                @csrf

                <!-- Email -->
                <div>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Email"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm bg-gray-50 focus:bg-white focus:border-gray-400 focus:outline-none @error('email') border-red-500 @enderror"
                        required
                    >
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Name -->
                <div>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Full Name"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm bg-gray-50 focus:bg-white focus:border-gray-400 focus:outline-none @error('name') border-red-500 @enderror"
                        required
                    >
                    @error('name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Username -->
                <div>
                    <input
                        type="text"
                        name="username"
                        value="{{ old('username') }}"
                        placeholder="Username"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm bg-gray-50 focus:bg-white focus:border-gray-400 focus:outline-none @error('username') border-red-500 @enderror"
                    >
                    @error('username')
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

                <!-- Confirm Password -->
                <div>
                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirm Password"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm bg-gray-50 focus:bg-white focus:border-gray-400 focus:outline-none"
                        required
                    >
                </div>

                <!-- Terms -->
                <div class="text-center text-xs text-gray-500 py-2">
                    <p>People who use our service may have uploaded your contact information to Instagram. <a href="#" class="text-blue-900">Learn More</a></p>
                    <p class="mt-3">By signing up, you agree to our <a href="#" class="text-blue-900">Terms</a>, <a href="#" class="text-blue-900">Privacy Policy</a> and <a href="#" class="text-blue-900">Cookies Policy</a>.</p>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full bg-blue-400 hover:bg-blue-500 text-white font-semibold py-2 rounded-lg text-sm transition duration-200"
                >
                    Sign up
                </button>
            </form>
        </div>

        <!-- Login Link -->
        <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg p-6 mt-4 text-center text-sm">
            <span class="text-gray-600">Have an account?</span>
            <a href="{{ route('login') }}" class="text-blue-500 font-semibold hover:text-blue-700">Log in</a>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-center text-xs text-gray-500">
            Instagram or Facebook
        </div>
    </div>
</body>
</html>
