<x-layout-auth>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-white w-full flex flex-col justify-center gap-5 px-3 md:px-16 lg:px-28 text-[#161931]">
    <!-- Back to Home Button -->
    <div class="absolute top-4 left-4 lg:left-64 p-4">
        <a href="{{ url()->previous() }}" class="text-black font-bold hover:text-gray-800">
          ← Kembali
        </a>
    </div>
    <main class="w-full min-h-screen py-1 md:w-2/3 lg:w-3/4 mx-auto">
        <div class="p-2 md:p-4">
            <div class="w-full pb-8 mt-8 sm:max-w-xl sm:rounded-lg mx-auto">
                <h2 class="pl-3 text-2xl font-bold sm:text-xl">Profile Edit</h2>
    
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>
                
                <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="grid max-w-2xl mx-auto mt-8">
                    <div class="flex flex-col items-center space-y-5 sm:flex-row sm:space-y-0 sm:space-x-8">
    
                        @if ($user->profile_image)
                            <img class="img-profile object-cover w-40 h-40 p-1 rounded-full ring-2 ring-indigo-300 dark:ring-indigo-500"
                            src="{{ asset('storage/' . $user->profile_image) }}"
                            alt="Bordered avatar">
                        @else
                            <img class="img-profile object-cover w-40 h-40 p-1 rounded-full ring-2 ring-indigo-300 dark:ring-indigo-500"
                            src="/imgs/avatar.png"
                            alt="Bordered avatar">
                        @endif
    
                        <div class="flex flex-col space-y-5">
                            <input type="file" id="profile-gambar" name="profile_image" class="py-3.5 px-2 text-base font-medium text-indigo-100 focus:outline-none bg-black rounded-lg border border-indigo-200 hover:bg-gray-900 focus:z-10 focus:ring-4 focus:ring-indigo-200" onchange="previewProfile()">
                        </div>
                    </div>
    
                    <div class="items-center mt-8 sm:mt-14 text-black">
    
                        <div class="flex flex-col w-full mb-2 space-y-2 sm:flex-row sm:space-y-0 sm:space-x-4 sm:mb-6">
                            <div class="w-full">
                                <label for="name" class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Name Lengkap</label>
                                <input type="text" id="name" name="name" class="bg-indigo-50 border border-black text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5" placeholder="Your name" value="{{ old('name', $user->name) }}" required>
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
    
                            <div class="w-full">
                                <label for="username" class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Username</label>
                                <input type="text" id="username" name="username" class="bg-indigo-50 border border-black text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5" placeholder="Username" value="{{ old('username', $user->username) }}" required>
                                <x-input-error class="mt-2" :messages="$errors->get('username')" />
                            </div>
                        </div>
    
                        <div class="mb-2 sm:mb-6">
                            <label for="email" class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Email</label>
                            <input type="email" id="email" name="email" class="bg-indigo-50 border border-black text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5" placeholder="your.email@mail.com" value="{{ old('email', $user->email) }}" required>
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
    
                        <div class="mb-2 sm:mb-6">
                            <label for="nohp" class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Nomber Handphone</label>
                            <input type="text" id="nohp" name="nohp" class="bg-indigo-50 border border-black text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5" placeholder="+62 " value="{{ old('nohp', $user->nohp) }}">
                            <x-input-error class="mt-2" :messages="$errors->get('nohp')" />
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="text-white bg-black hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-black dark:focus:ring-gray-800">Save</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="p-4 mb-10 border border-black sm:p-8 bg-white shadow sm:rounded-lg mx-auto">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </main>
</div>


    <script>
        function previewProfile() {
                const image = document.querySelector('#profile-gambar');
                const imgPreview = document.querySelector('.img-profile');
        
                imgPreview.style.display = 'block';
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);
        
                oFReader.onload = function (oFREvent) {
                    imgPreview.src = oFREvent.target.result;
                }
            }
    </script>
</x-layout-auth>