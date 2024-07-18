<x-layout-guest>
  <x-slot:title>{{ $title }}</x-slot:title>
  <x-navbar-guest></x-navbar-guest>

  <a href="/search" class="block md:hidden mb-0">
    <img src="/imgs/logo-ThreadLoop2-warna-hitam.svg" class="mx-auto" alt="ThreadLoop">
  </a>
  
  <div class="p-8 lg:mt-20 md:mt-20 sm:mt-5">
      {{-- Fitur Search --}}
      <form class="flex items-center max-w-sm mx-auto">
          <label for="simple-search" class="sr-only">Search</label>
          <div class="relative w-full">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <ion-icon name="person-outline" class="w-4 h-4 text-gray-500"></ion-icon>
              </div>
              <input type="search" id="simple-search" name="query" class="bg-gray-50 border border-gray-800 text-gray-900 text-sm rounded-lg focus:ring-black focus:border-black block w-full pl-10 py-2.5" placeholder="Search..." value="{{ request('query') }}" autocomplete="off" />
          </div>
          <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-black rounded-lg border border-black hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-600">
              <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
              </svg>
              <span class="sr-only">Search</span>
          </button>
      </form>

      @if ($posts->count() > 0 || $users->count() > 0)
        <div class="grid grid-cols-1 gap-8 mt-8 md:mt-16 md:grid-cols-2 lg:grid-cols-3" id="search-results">
          {{-- Post Display --}}
          @if ($posts->count() > 0)
            @foreach ($posts as $posting)
              @if ($posting->posting_image || $posting->posting_video)
                <article class="overflow-hidden px-5 my-5 rounded-lg transition">
                  <div class="flex items-center justify-between my-4">
                    <div class="flex items-center">
                      @if ($posting->user->profile_image)
                        <img class="w-8 h-8 rounded-full mr-4 avatar" data-tippy-content="{{ $posting->user->name }}" src="{{ asset('storage/'. $posting->user->profile_image) }}" alt="{{ $posting->user->username }}">
                      @else
                        <img class="w-8 h-8 rounded-full mr-4 avatar" data-tippy-content="{{ $posting->user->name }}" src="/imgs/avatar.png" alt="{{ $posting->user->username }}">
                      @endif
                      <a href="/profile-user-guest/{{ $posting->user->username }}" class="font-bold text-gray-700 cursor-pointer" tabindex="0" role="link">{{ $posting->user->username }}</a>
                    </div>
                    <p class="text-black text-xs md:text-sm">{{ $posting->created_at->diffForHumans() }}</p>
                  </div>
        
                  <div class="flex items-center justify-center mb-4">
                    @if ($posting->posting_image)
                      <img alt="" src="{{ asset('storage/'. $posting->posting_image) }}" class="h-40 w-full object-cover rounded-lg">
                    @elseif ($posting->posting_video)
                      <video controls muted class="h-40 w-full rounded-lg">
                        <source src="{{ asset('storage/'. $posting->posting_video) }}" type="video/mp4">
                      </video>
                    @endif
                  </div>
        
                  <div class="p-4 border-b border-black rounded-b-lg">
                    <div class="flex items-center mb-4">
                      <button data-modal-target="modal-login" data-modal-toggle="modal-login" class="text-black mr-3">
                        <svg class="w-6 h-6 fill-current transition duration-500 ease-in-out transform text-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                          <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 6.5 3.5 5 5.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5 18.5 5 20 6.5 20 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                        <span>{{ $posting->likes->count() }}</span>
                      </button>
                      <a href="/showTeks-guest/{{ $posting->slug }}" class="cursor-pointer text-black text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor">
                          <path d="M7.29117 20.8242L2 22L3.17581 16.7088C2.42544 15.3056 2 13.7025 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C10.2975 22 8.6944 21.5746 7.29117 20.8242ZM7.58075 18.711L8.23428 19.0605C9.38248 19.6745 10.6655 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 13.3345 4.32549 14.6175 4.93949 15.7657L5.28896 16.4192L4.63416 19.3658L7.58075 18.711Z"></path>
                        </svg> {{ $posting->comments->count() }}
                      </a>
                    </div>
                    <a href="/showTeks-guest/{{ $posting->slug }}" class="cursor-pointer line-clamp-3 text-md/relaxed text-gray-500">
                      {{ Str::limit($posting->deskripsi, 150) }}
                    </a>
                  </div>
                </article>
              @else
                <article class="overflow-hidden px-5 my-5 rounded-lg transition">
                  <div class="flex items-center justify-between my-4">
                    <div class="flex items-center">
                      @if ($posting->user->profile_image)
                        <img class="w-8 h-8 rounded-full mr-4 avatar" data-tippy-content="{{ $posting->user->name }}" src="{{ asset('storage/'. $posting->user->profile_image) }}" alt="{{ $posting->user->username }}">
                      @else
                        <img class="w-8 h-8 rounded-full mr-4 avatar" data-tippy-content="{{ $posting->user->name }}" src="/imgs/avatar.png" alt="{{ $posting->user->username }}">
                      @endif
                      <a href="/profile-user-guest/{{ $posting->user->username }}" class="font-bold text-gray-700 cursor-pointer" tabindex="0" role="link">{{ $posting->user->username }}</a>
                    </div>
                    <p class="text-black text-xs md:text-sm">{{ $posting->created_at->diffForHumans() }}</p>
                  </div>
        
                  <div class="p-4 border-b border-black rounded-b-lg">
                    <a href="/showTeks-guest/{{ $posting->slug }}" class="cursor-pointer line-clamp-3 text-md/relaxed text-gray-500">
                      {{ Str::limit($posting->deskripsi, 150) }}
                    </a>
                    <div class="flex items-center mt-4">
                      <button data-modal-target="modal-login" data-modal-toggle="modal-login" class="text-black mr-3">
                        <svg class="w-6 h-6 fill-current transition duration-500 ease-in-out transform text-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                          <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 6.5 3.5 5 5.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5 18.5 5 20 6.5 20 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                        <span>{{ $posting->likes->count() }}</span>
                      </button>
                      <a href="/showTeks-guest/{{ $posting->slug }}" class="cursor-pointer text-black text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor">
                          <path d="M7.29117 20.8242L2 22L3.17581 16.7088C2.42544 15.3056 2 13.7025 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C10.2975 22 8.6944 21.5746 7.29117 20.8242ZM7.58075 18.711L8.23428 19.0605C9.38248 19.6745 10.6655 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 13.3345 4.32549 14.6175 4.93949 15.7657L5.28896 16.4192L4.63416 19.3658L7.58075 18.711Z"></path>
                        </svg> {{ $posting->comments->count() }}
                      </a>
                    </div>
                  </div>
                </article>
              @endif
            @endforeach
          @endif
        </div>
        <div class="grid grid-cols-1 gap-8 mt-8 md:mt-16 md:grid-cols-2 lg:grid-cols-3" id="search-results">
          {{-- User Information --}}
          @if ($users->count() > 0)
            @foreach ($users as $user)
              <article class="rounded-xl border my-4 border-gray-400 bg-white">
                <div class="flex items-start gap-4 p-4 sm:p-6 lg:p-8">
                  <a href="/profile-user-guest/{{ $user->username }}" class="block shrink-0">
                    <img
                      alt="{{ $user->username }}"
                      src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : '/imgs/avatar.png' }}"
                      class="size-14 rounded-lg object-cover"
                    />
                  </a>
                  <div>
                    <h3 class="font-medium sm:text-lg">
                      <a href="/profile-user-guest/{{ $user->username }}" class="hover:underline">{{ $user->username }}</a>
                    </h3>
                    <p class="line-clamp-2 text-sm text-gray-700">
                      {{ $user->name }}
                    </p>
                    <div class="mt-2 sm:flex sm:items-center sm:gap-2">
                      <div class="flex items-center gap-1 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M14 14.252V16.3414C13.3744 16.1203 12.7013 16 12 16C8.68629 16 6 18.6863 6 22H4C4 17.5817 7.58172 14 12 14C12.6906 14 13.3608 14.0875 14 14.252ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11ZM18 17V14H20V17H23V19H20V22H18V19H15V17H18Z"></path></svg>
                        <p class="text-xs">{{ $user->followers->count() }} Pengikut</p>
                      </div>
                      <span class="hidden sm:block" aria-hidden="true">&middot;</span>
                      <p class="hidden sm:block sm:text-xs sm:text-gray-500">
                        Postingan
                        <a href="#" class="font-medium underline hover:text-gray-700">{{ $user->postings->count() }}</a>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="flex justify-center mb-5">
                  <button type="button" data-modal-target="modal-login" data-modal-toggle="modal-login" class="px-3 py-2 text-xs font-medium text-center inline-flex border border-black items-center text-black bg-transparent rounded-lg hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-black me-2" viewBox="0 0 24 24" fill="currentColor"><path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z"></path></svg>
                    Ikuti
                  </button>
                </div>
              </article>
            @endforeach
          @endif
        </div>
      @else
        <section class="flex items-center justify-center mt-20 h-full">
          <div class="text-center">
              <h1 class="mb-2 text-2xl font-bold">404</h1>
              <p class="text-xl font-semibold md:text-2xl">Hasil Tidak Ditemukan</p>
              <p class="mb-8">Sepertinya kami tidak menemukan hasil yang anda cari</p>
          </div>
        </section>
      @endif
  </div>
  {{-- modal login --}}
  @include('guest.modal-login')
</x-layout-guest>