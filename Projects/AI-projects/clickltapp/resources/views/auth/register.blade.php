<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-3xl font-bold text-gray-900">Join ClickIT!</h2>
        <p class="text-gray-500 mt-2">Get fresh groceries delivered in 10 minutes 🚀</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
            <input id="name" 
                   class="block w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-green-500 focus:ring-0 transition-colors bg-gray-50 font-medium" 
                   type="text" name="name" :value="old('name')" required autofocus autocomplete="name" 
                   placeholder="e.g. Alex Johnson" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
            <input id="email" 
                   class="block w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-green-500 focus:ring-0 transition-colors bg-gray-50 font-medium" 
                   type="email" name="email" :value="old('email')" required autocomplete="username" 
                   placeholder="e.g. alex@clickit.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
            <input id="password" 
                   class="block w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-green-500 focus:ring-0 transition-colors bg-gray-50 font-medium"
                   type="password"
                   name="password"
                   required autocomplete="new-password" 
                   placeholder="At least 8 characters" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
            <input id="password_confirmation" 
                   class="block w-full px-4 py-3 rounded-2xl border-2 border-gray-100 focus:border-green-500 focus:ring-0 transition-colors bg-gray-50 font-medium"
                   type="password"
                   name="password_confirmation" required autocomplete="new-password" 
                   placeholder="Re-type password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full bg-green-600 text-white py-4 rounded-2xl text-lg font-bold hover:bg-green-700 transition transform hover:scale-[1.02] shadow-lg shadow-green-100">
                Register Now
            </button>
        </div>

        <div class="text-center mt-6 border-t border-gray-100 pt-6">
            <p class="text-sm text-gray-500">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-green-600 font-bold hover:underline">Log in instead</a>
            </p>
        </div>
    </form>
</x-guest-layout>
