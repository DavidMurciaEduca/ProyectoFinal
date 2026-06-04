<x-guest-layout>

<div class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

        <!-- LOGO -->
        <div class="text-center mb-6">

            <div class="text-4xl mb-2">
                🍽️
            </div>

            <h1 class="text-2xl font-bold text-gray-800">
                Restaurante App
            </h1>

            <p class="text-sm text-gray-500">
                Acceso al sistema de restaurante
            </p>

        </div>

        <!-- STATUS -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        @if(session('error'))

            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">

                {{ session('error') }}

            </div>

        @endif
        <!-- FORM -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">

            @csrf

            <!-- EMAIL -->
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Email
                </label>

                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus
                       class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">

                <x-input-error :messages="$errors->get('email')" class="mt-2" />

            </div>

            <!-- PASSWORD -->
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Contraseña
                </label>

                <input id="password"
                       type="password"
                       name="password"
                       required
                       class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">

                <x-input-error :messages="$errors->get('password')" class="mt-2" />

            </div>

            <!-- REMEMBER -->
            <div class="flex items-center">

                <input id="remember_me"
                       type="checkbox"
                       name="remember"
                       class="mr-2">

                <label for="remember_me" class="text-sm text-gray-600">
                    Recordarme
                </label>

            </div>

            <!-- BOTÓN LOGIN -->
            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">

                Iniciar sesión

            </button>

            <!-- LINK PASSWORD -->
            @if (Route::has('password.request'))

                <div class="text-center mt-3">

                    <a href="{{ route('password.request') }}"
                       class="text-sm text-blue-600 hover:underline">

                        ¿Olvidaste tu contraseña?

                    </a>

                </div>

            @endif

        </form>

    </div>

</div>

</x-guest-layout>