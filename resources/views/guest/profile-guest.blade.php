<x-layout-guest>
  <x-slot:title>{{ $title }}</x-slot:title>
  <x-navbar-guest></x-navbar-guest>
<div class="container mx-auto px-4 py-20 lg:px-44">
    <!-- Header profil -->
    <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-4">
        <!-- Gambar profil -->
        @if ($user->profile_image)
            <img src="{{ asset('storage/'. $user->profile_image) }}" alt="Gambar Profil" class="w-20 h-20 rounded-full border-2 border-gray-300">
        @else
            <img src="/imgs/avatar.png" alt="Gambar Profil" class="w-20 h-20 rounded-full border-2 border-gray-300">
        @endif
    
        <!-- Informasi profil dan tombol edit -->
        <div class="flex-grow flex flex-col sm:flex-row justify-between items-center w-full sm:w-auto">
            <div class="flex flex-col sm:flex-row items-center sm:space-x-3 w-full sm:w-auto">
                <h1 class="text-2xl font-bold">{{ $user->username }}</h1>
            </div>
        </div>
    </div>
    
    <div class="px-4 sm:px-24">
        <i class="fas fa-cog"></i>
        <!-- Statistik -->
        <div class="flex flex-col sm:flex-row mt-2 space-y-2 sm:space-y-0 sm:space-x-4">
            <div data-modal-target="modal-followers" data-modal-toggle="modal-followers" class="cursor-pointer"><span class="font-bold">{{ $user->followers->count() }}</span> pengikut</div>
            <div data-modal-target="modal-following" data-modal-toggle="modal-following" class="cursor-pointer"><span class="font-bold">{{ $user->following->count() }}</span> diikuti</div>
        </div>

        {{-- modal followers --}}
        <div id="modal-followers" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                            Followers
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-followers">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 overflow-y-scroll max-h-80 space-y-4">
                        @foreach($user->followers as $follower)
                        <div class="flex items-center border-b border-black justify-between bg-white p-4 rounded-lg">
                            <div class="flex items-center">
                                @if ($follower->profile_image)
                                    <img src="{{ asset('storage/'. $follower->profile_image) }}" alt="{{ $follower->username }}" class="w-10 h-10 rounded-full">
                                @else
                                    <img src="/imgs/avatar.png" alt="{{ $follower->profile_image }}" class="w-10 h-10 rounded-full">
                                @endif
                                <div class="ml-3">
                                    <a href="{{ route('kunjungan-profile', $follower->username) }}">
                                        <div class="text-sm font-medium">{{ $follower->username }}</div>
                                        <div class="text-sm mt-1">{{ $follower->name }}</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        {{-- modal following --}}
        <div id="modal-following" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                            Following
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-following">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 overflow-y-scroll max-h-80 space-y-4">
                        @foreach($user->following as $follower)
                        <div class="flex items-center border-b border-black justify-between bg-white p-4 rounded-lg">
                            <div class="flex items-center">
                                @if ($follower->profile_image)
                                    <img src="{{ asset('storage/'. $follower->profile_image) }}" alt="{{ $follower->username }}" class="w-10 h-10 rounded-full">
                                @else
                                    <img src="/imgs/avatar.png" alt="{{ $follower->profile_image }}" class="w-10 h-10 rounded-full">
                                @endif
                                <div class="ml-3">
                                    <a href="{{ route('kunjungan-profile', $follower->username) }}">
                                        <div class="text-sm font-medium">{{ $follower->username }}</div>
                                        <div class="text-sm mt-1">{{ $follower->name }}</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Bio -->
        <p class="mt-4 font-bold">{{ $user->name }}</p>
        <p class="mt-2">{{ $user->email }}<br>{{ $user->nohp }}</p>
    </div>
    

    <div class="w-full border-t mt-20">
      <nav class="flex justify-center space-x-8 mt-4">
          <a href="#" id="postingan-tab" class="nav-tab flex flex-col items-center text-gray-600 hover:text-black">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" viewBox="0 0 24 24" fill="currentColor"><path d="M14 10H10V14H14V10ZM16 10V14H19V10H16ZM14 19V16H10V19H14ZM16 19H19V16H16V19ZM14 5H10V8H14V5ZM16 5V8H19V5H16ZM8 10H5V14H8V10ZM8 19V16H5V19H8ZM8 5H5V8H8V5ZM4 3H20C20.5523 3 21 3.44772 21 4V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V4C3 3.44772 3.44772 3 4 3Z"></path></svg>
              <span>POSTINGAN</span>
          </a>
          <a href="#" id="teks-tab" class="nav-tab flex flex-col items-center text-gray-600 hover:text-black">
              <ion-icon class="h-6 w-6 mb-1" name="document-text"></ion-icon>
              <span>TEKS</span>
          </a>
      </nav>
    </div>
  
    <!-- Area utama untuk konten -->
    @if($posts->isEmpty())
    <div class="text-center p-10 border-t mt-4">
        <p class="text-lg font-semibold">Berbagi Foto</p>
        <p>Saat Anda membagikan foto, ini akan muncul di profil Anda.</p>
        <button type="button" data-modal-toggle="modalPosting" data-modal-target="modalPosting" class="bg-abu-tua text-white py-2 px-4 rounded mt-4">Bagikan foto pertama Anda</button>
    </div>
    @else
    <div id="content" class="container mx-auto py-8">
      <!-- Cards will be loaded here -->
    </div>
    @endif
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      const tabs = document.querySelectorAll('.nav-tab');
      const content = document.getElementById('content');

      tabs.forEach(tab => {
          tab.addEventListener('click', function (event) {
              event.preventDefault();
              tabs.forEach(t => t.classList.remove('active'));
              tab.classList.add('active');
              loadContent(tab.id);
          });
      });

      function loadContent(tabId) {
          content.innerHTML = ''; // Clear current content
          if (tabId === 'postingan-tab') {
              content.innerHTML = `
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($posts as $post)
                        @if (Str::endsWith($post->posting_image, ['.jpg', '.jpeg', '.png']))
                            <button type="button" data-modal-target="showUser{{ $post->id }}" data-modal-toggle="showUser{{ $post->id }}" class="group relative block w-full h-72 cursor-pointer bg-black rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/'. $post->posting_image) }}" alt="{{ $post->user->username }}" class="absolute inset-0 w-full h-full object-cover opacity-75 transition-opacity group-hover:opacity-50">
                                <div class="absolute inset-0 flex items-center justify-center transition-opacity opacity-0 group-hover:opacity-100">
                                    <p class="text-2xl font-semibold text-white mr-3"><ion-icon name="heart"></ion-icon> {{ $post->likes->count() }}</p>
                                    <p class="text-2xl font-semibold text-white"><ion-icon name="chatbubble"></ion-icon> {{ $post->comments->count() }}</p>
                                </div>
                            </button>
                        @elseif (Str::endsWith($post->posting_video, '.mp4'))
                            <a href="/showTeks-guest/{{ $post->slug }}" class="group relative block w-full h-72 cursor-pointer bg-black rounded-lg overflow-hidden">
                                <video class="absolute inset-0 w-full h-full object-cover opacity-75 transition-opacity group-hover:opacity-50" controls>
                                    <source src="{{ asset('storage/'. $post->posting_video) }}" type="video/mp4">
                                </video>
                                <div class="absolute inset-0 flex items-center justify-center transition-opacity opacity-0 group-hover:opacity-100">
                                    <p class="text-2xl font-semibold text-white mr-3"><ion-icon name="heart"></ion-icon> {{ $post->likes->count() }}</p>
                                    <p class="text-2xl font-semibold text-white"><ion-icon name="chatbubble"></ion-icon> {{ $post->comments->count() }}</p>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
              `;
          } else if (tabId === 'teks-tab') {
              content.innerHTML = `
                <div class="grid grid-cols-1 gap-6">
                    @foreach($teks as $tek)
                        <div class="max-w-4xl min-w-full px-2 md:px-10 lg:px-16 py-5 bg-white border border-black rounded-lg shadow-md dark:bg-gray-800 mx-auto">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    @if ($tek->user->profile_image)
                                        <img class="object-cover mr-4 w-10 h-10 rounded-full" src="{{ asset('storage/'. $tek->user->profile_image) }}" alt="{{ $tek->user->username }}">
                                    @else
                                        <img class="object-cover mr-4 w-10 h-10 rounded-full" src="/imgs/avatar.png" alt="{{ $tek->user->username }}">
                                    @endif
                                    <a class="font-bold text-gray-700 cursor-pointer dark:text-gray-200" tabindex="0" role="link">{{ $tek->user->username }}</a>
                                </div>
                                <span class="text-sm font-light text-gray-600 dark:text-gray-400">{{ $tek->created_at->diffForHumans() }}</span>
                            </div>

                            <a href="/showTeks-guest/{{ $tek->slug }}" class="mb-5 pb-1 dark:border-gray-600">
                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                    {{ $tek->deskripsi }}
                                </p>
                            </a>

                            <div class="flex items-center justify-between mt-6">
                                <div class="flex ml-5 items-center">
                                    <a href="/showTeks-guest/{{ $tek->slug }}" class="text-black mr-3">
                                        <svg class="w-6 h-6 fill-current transition duration-500 ease-in-out transform text-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 6.5 3.5 5 5.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5 18.5 5 20 6.5 20 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                        <span>{{ $tek->likes->count() }}</span>
                                    </a>
                                    <a href="/showTeks-guest/{{ $tek->slug }}" class="text-black text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M7.29117 20.8242L2 22L3.17581 16.7088C2.42544 15.3056 2 13.7025 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C10.2975 22 8.6944 21.5746 7.29117 20.8242ZM7.58075 18.711L8.23428 19.0605C9.38248 19.6745 10.6655 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 13.3345 4.32549 14.6175 4.93949 15.7657L5.28896 16.4192L4.63416 19.3658L7.58075 18.711Z"></path>
                                        </svg> {{ $tek->comments->count() }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
              `;
          }
      }

      // Load default content
      loadContent('postingan-tab');
  });
</script>
{{-- modal login --}}
@include('guest.modal-login')
</x-layout-guest>