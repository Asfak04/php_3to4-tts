<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-3xl font-bold text-gray-900">Welcome Back!</h2>
        <p class="text-gray-500 mt-2">Login to track your 10-minute deliveries 🚀</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
            <input id="email" 
                   class="block w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-green-500 focus:ring-0 transition-colors bg-gray-50 font-medium" 
                   type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                   placeholder="e.g. alex@clickit.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between mb-2">
                <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-green-600 hover:text-green-700 transition" href="{{ route('password.request') }}">
                        Forgot?
                    </a>
                @endif
            </div>

            <input id="password" 
                   class="block w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-green-500 focus:ring-0 transition-colors bg-gray-50 font-medium"
                   type="password"
                   name="password"
                   required autocomplete="current-password" 
                   placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="w-4 h-4 rounded border-gray-300 text-green-600 focus:ring-green-500 shadow-sm" name="remember">
            <span class="ml-2 text-sm text-gray-500 font-medium">Keep me logged in</span>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full bg-green-600 text-white py-4 rounded-2xl text-lg font-bold hover:bg-green-700 transition transform hover:scale-[1.02] shadow-lg shadow-green-100">
                Log In
            </button>
        </div>

        <!-- Register Link -->
        <div class="text-center mt-6">
            <p class="text-sm text-gray-500">
                New to ClickIT? 
                <a href="{{ route('register') }}" class="text-green-600 font-bold hover:underline">Create an account</a>
            </p>
        </div>
    </form>
</x-guest-layout>
