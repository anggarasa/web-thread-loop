<x-layout-guest>
  <x-slot:title>{{ $title }}</x-slot:title>
  <section class="bg-white">
    <div class="lg:grid lg:min-h-screen lg:grid-cols-12">
        <!-- Back to Home Button -->
        <div class="absolute top-0 left-0 p-4 z-20">
            <a href="/Beranda" class="text-white font-bold hover:text-gray-200">
                ← Back to Home
            </a>
        </div>
        <!-- Left Section (Image and Welcome Text) -->
        <section class="relative flex h-32 items-end bg-gray-900 lg:col-span-5 lg:h-full xl:col-span-6">
            <img
                alt=""
                src="imgs/bg-login-threadloop-hitam.png"
                class="absolute inset-0 h-full w-full object-cover"
            />
            <div class="hidden lg:relative lg:block lg:p-12">
                <a class="block text-white" href="#">
                    <span class="sr-only">Home</span>
                    <img src="assets/imgs/mezzi-logo-1.svg" class="h-10" alt="">
                </a>
                <h2 class="mt-6 text-2xl font-bold text-white sm:text-3xl md:text-4xl">
                    Selamat datang di ThreadLoop📲
                </h2>
                <p class="mt-4 leading-relaxed text-white/90">
                    ThreadLoop adalah website sosial media untuk berbagi foto, video, cerita dan lain-lainya.
                </p>
            </div>
        </section>
        <!-- Right Section (Form) -->
        <main class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6">
            <div class="max-w-xl lg:max-w-3xl">
                <!-- Mobile Welcome Text and Logo -->
                <div class="relative -mt-16 block lg:hidden">
                    <a
                        class="inline-flex size-16 items-center justify-center rounded-full bg-white text-blue-600 sm:size-20"
                        href="#"
                    >
                        <span class="sr-only">Home</span>
                        <img src="/imgs/logo-ThreadLoop2-aplikasi.svg" class="h-8 sm:h-10" alt="">
                    </a>
                    <h1 class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">
                        Selamat datang di ThreadLoop📲
                    </h1>
                    <p class="mt-4 leading-relaxed text-gray-500">
                        ThreadLoop adalah website sosial media untuk berbagi foto, video, cerita dan lain-lainya.
                    </p>
                </div>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <!-- Login Form -->
                <form method="POST" action="/login" class="mt-8 grid grid-cols-6 gap-6">
                    @csrf
                    <!-- Email Address -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="mt-1 w-full rounded-md border-black bg-white text-sm focus:ring-black text-gray-700 shadow-sm"
                            value="{{ old('email') }}"
                            required
                            autocomplete="username"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <!-- Password -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password </label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="mt-1 w-full rounded-md border-black focus:ring-black bg-white text-sm text-gray-700 shadow-sm"
                            required
                            autocomplete="new-password"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <!-- Remember Me -->
                    {{-- <div class="col-span-6">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-black text-black shadow-sm focus:ring-abu-muda" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div> --}}
                    <!-- Terms and Conditions -->
                    <div class="col-span-6">
                        <p class="text-sm text-gray-500">
                            By creating an account, you agree to our
                            <a href="#" class="text-gray-700 underline">terms and conditions</a>
                            and
                            <a href="#" class="text-gray-700 underline">privacy policy</a>.
                        </p>
                    </div>
                    <!-- Submit Button -->
                    <div class="col-span-6 sm:flex sm:items-center sm:gap-4">
                        <button
                            type="submit"
                            class="inline-block shrink-0 rounded-md border border-black bg-black px-12 py-3 text-sm font-medium text-white transition hover:bg-gray-500 hover:text-white focus:outline-none focus:ring active:text-gray-500"
                        >
                            Log in
                        </button>
                        <p class="mt-4 text-sm text-gray-500 sm:mt-0">
                            Don't have an account yet?
                            <a href="{{ route('register') }}" class="text-black underline font-semibold">Registrasi</a>.
                        </p>
                    </div>
                </form>
            </div>
        </main>
    </div>
  </section>
    
</x-layout-guest>