<x-layout-guest>
  <x-slot:title>{{ $title }}</x-slot:title>
  <x-navbar-guest></x-navbar-guest>
  
  <a href="/Beranda" class="block md:hidden mb-0">
    <img src="/imgs/logo-ThreadLoop2-warna-hitam.svg" class="mx-auto" alt="ThreadLoop">
  </a>

  <div class="lg:mt-20 md:mt-20 sm:mt-5 px-4 sm:px-8 md:px-16 lg:px-32 xl:px-64">
    @foreach ($posts as $posting)
      @if ($posting->posting_image || $posting->posting_video)
      <article class="overflow-hidden px-5 my-5 rounded-b-lg transition">
        <div class="flex items-center lg:mx-20 lg:p-3 lg:mb-0 mb-5 justify-between">
            <div class="flex items-center">
                @if ($posting->user->profile_image)
                    <img class="w-8 h-8 rounded-full object-cover mr-4 avatar" data-tippy-content="{{ $posting->user->name }}" src="{{ asset('storage/'. $posting->user->profile_image) }}" alt="{{ $posting->user->username }}">
                @else
                    <img class="w-8 h-8 rounded-full object-cover mr-4 avatar" data-tippy-content="{{ $posting->user->name }}" src="/imgs/avatar.png" alt="{{ $posting->user->username }}">
                @endif
                <a href="/profile-user/{{ $posting->user->username }}" class="font-bold text-gray-700 cursor-pointer" tabindex="0" role="link">{{ $posting->user->username }}</a>
            </div>
            <p class="text-black text-xs md:text-sm">{{ $posting->created_at->diffForHumans() }}</p>
        </div>
    
        <div class="flex items-center justify-center">
            @if (Str::endsWith($posting->posting_image, ['.jpg', '.jpeg', '.png']))
                <img
                    alt=""
                    src="{{ asset('storage/'. $posting->posting_image) }}"
                    class="h-2/5 w-full lg:w-2/5 rounded-lg object-cover"
                />
            @elseif (Str::endsWith($posting->posting_video, '.mp4'))
                <video
                    controls
                    class="h-2/5 w-full lg:w-2/5 rounded-lg"
                >
                    <source src="{{ asset('storage/'. $posting->posting_video) }}" type="video/mp4">
                </video>
            @endif
        </div>
    
        <div class="bg-white p-4 rounded-b-lg border-b border-black lg:mx-24 sm:p-6">
            <div class="flex mt-5 items-center">
                <button data-modal-target="modal-login" data-modal-toggle="modal-login" class="cursor-pointer text-black mr-3">
                    <svg class="w-6 h-6 fill-current transition duration-500 ease-in-out transform text-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 6.5 3.5 5 5.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5 18.5 5 20 6.5 20 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                    <span>{{ $posting->likes->count() }}</span>
                </button>
                <a href="/showTeks-guest/{{ $posting->slug }}" class="cursor-pointer text-black text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M7.29117 20.8242L2 22L3.17581 16.7088C2.42544 15.3056 2 13.7025 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C10.2975 22 8.6944 21.5746 7.29117 20.8242ZM7.58075 18.711L8.23428 19.0605C9.38248 19.6745 10.6655 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 13.3345 4.32549 14.6175 4.93949 15.7657L5.28896 16.4192L4.63416 19.3658L7.58075 18.711Z"/>
                    </svg> {{ $posting->comments->count() }}
                </a>
            </div>
    
            <a href="/showTeks-guest/{{ $posting->slug }}" class="mt-2 cursor-pointer line-clamp-3 text-md/relaxed text-gray-500">
                {!! Str::limit($posting->deskripsi, 1000) !!}
            </a>
        </div>
      </article>
      @else
          <article class="overflow-hidden my-5 rounded-b-lg transition lg:mx-40 lg:p-3 lg:mb-0 mb-5">
              <div class="flex items-center justify-between">
                  <div class="flex items-center">
                      @if ($posting->user->profile_image)
                          <img class="w-8 h-8 rounded-full object-cover mr-4 avatar" data-tippy-content="Author Name" src="{{ asset('storage/'. $posting->user->profile_image) }}" alt="{{ $posting->user->username }}">
                      @else
                          <img class="w-8 h-8 rounded-full object-cover mr-4 avatar" data-tippy-content="Author Name" src="/imgs/avatar.png" alt="{{ $posting->user->username }}">
                      @endif
                      <a href="/profile-user-guest/{{ $posting->user->username }}" class="font-bold text-gray-700 cursor-pointer" tabindex="0" role="link">{{ $posting->user->username }}</a>
                  </div>
                  <p class="text-black text-xs md:text-sm">{{ $posting->created_at->diffForHumans() }}</p>
              </div>

              <div class=" p-4 rounded-b-lg border-b border-black sm:p-6">
                  <a href="showTeks-guest/{{ $posting->slug }}" class=" line-clamp-3 text-md/relaxed text-gray-700">
                       {!! Str::limit($posting->deskripsi, 1000) !!}
                  </a>

                  <div class="flex mt-5 items-center">
                    <button data-modal-target="modal-login" data-modal-toggle="modal-login" class="text-black mr-3">
                        <svg class="w-6 h-6 fill-current transition duration-500 ease-in-out transform text-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 6.5 3.5 5 5.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5 18.5 5 20 6.5 20 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        <span>{{ $posting->likes->count() }}</span>
                    </button>
                    <a href="/showTeks-guest/{{ $posting->slug }}" class="text-black text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M7.29117 20.8242L2 22L3.17581 16.7088C2.42544 15.3056 2 13.7025 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C10.2975 22 8.6944 21.5746 7.29117 20.8242ZM7.58075 18.711L8.23428 19.0605C9.38248 19.6745 10.6655 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 13.3345 4.32549 14.6175 4.93949 15.7657L5.28896 16.4192L4.63416 19.3658L7.58075 18.711Z"></path>
                        </svg> {{ $posting->comments->count() }}
                    </a>
                  </div>
              </div>
          </article>
      @endif
  @endforeach
  </div>
    {{-- modal login --}}
    @include('guest.modal-login')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const videos = document.querySelectorAll('video');
    
            videos.forEach(video => {
                video.addEventListener('play', () => {
                    videos.forEach(v => {
                        if (v !== video) {
                            v.pause();
                        }
                    });
                });
            });
    
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        const video = entry.target;
                        if (entry.isIntersecting) {
                            video.play();
                        } else {
                            video.pause();
                        }
                    });
                });
    
                videos.forEach(video => {
                    observer.observe(video);
                });
            } else {
                // Fallback for browsers that do not support IntersectionObserver
                window.addEventListener('scroll', function () {
                    videos.forEach(video => {
                        const rect = video.getBoundingClientRect();
                        if (rect.top >= 0 && rect.bottom <= window.innerHeight) {
                            video.play();
                        } else {
                            video.pause();
                        }
                    });
                });
            }
        });
    </script>
</x-layout-guest>