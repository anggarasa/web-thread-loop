<!-- Main modal -->
<div id="modal-login" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-gray-800 bg-opacity-50">
    <div class="relative p-4 w-full max-w-md">
        <!-- Modal content -->
        <div class="relative mx-auto p-5 border w-full shadow-lg rounded-md bg-white">
            <!-- Close button (optional) -->
            <div class="flex justify-end">
                <button type="button" data-modal-toggle="modal-login" class="text-black close-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal header -->
            <div class="text-center">
                <h3 class="text-lg font-bold">Login Terlebih Dahulu</h3>
            </div>

            <!-- Modal body -->
            <div class="mt-4">
                <!-- Login form -->
                <form method="POST" action="/login">
                    @csrf
                    <!-- Username/email input -->
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="mt-1 block w-full px-3 py-2 border border-gray-500 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-black focus:border-black" value="{{ old('email') }}" required autocomplete="username" />

                    <!-- Password input -->
                    <label for="password" class="block text-sm font-medium text-gray-700 mt-4">Kata Sandi</label>
                    <input type="password" id="password" name="password"
                        class="mt-1 block w-full px-3 py-2 border border-gray-500 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-black focus:border-black"
                        required
                        autocomplete="new-password" />

                    <!-- Submit button -->
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-black hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black mt-4">
                        Login
                    </button>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="text-center mt-4">
                <p class="text-sm text-black">Don't have an account yet?, <a href="/register" class="text-black hover:underline font-semibold">register now</a></p>
            </div>
        </div>
    </div>
</div>
