<x-layout-auth>
  <x-slot:title>{{ $title }}</x-slot:title>
  <a href="/cari" class="block md:hidden mb-0">
    <img src="/imgs/logo-ThreadLoop2-warna-hitam.svg" class="mx-auto" alt="ThreadLoop">
  </a>
  <div class="p-8">
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
                  <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                      @if ($posting->user->profile_image)
                        <img class="w-8 h-8 rounded-full mr-4 avatar" data-tippy-content="{{ $posting->user->name }}" src="{{ asset('storage/'. $posting->user->profile_image) }}" alt="{{ $posting->user->username }}">
                      @else
                        <img class="w-8 h-8 rounded-full mr-4 avatar" data-tippy-content="{{ $posting->user->name }}" src="/imgs/avatar.png" alt="{{ $posting->user->username }}">
                      @endif
                      <a href="/profile-user/{{ $posting->user->username }}" class="font-bold text-gray-700 cursor-pointer" tabindex="0" role="link">{{ $posting->user->username }}</a>
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
        
                  <div class="bg-white p-4 rounded-b-lg border-b border-black">
                    <div class="flex items-center mb-4">
                      <button id="like-button-{{ $posting->id }}" class="like-button text-black mr-3" data-id="{{ $posting->id }}">
                        <svg class="w-6 h-6 fill-current transition duration-500 ease-in-out transform {{ $posting->isLikedBy(auth()->user()) ? 'text-red-600' : 'text-black' }}" id="like-icon-{{ $posting->id }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                          <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 6.5 3.5 5 5.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5 18.5 5 20 6.5 20 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                        <span id="likes-count-{{ $posting->id }}">{{ $posting->likes->count() }}</span>
                      </button>
                      <button type="button" data-modal-target="showUser{{ $posting->id }}" data-modal-toggle="showUser{{ $posting->id }}" class="cursor-pointer text-black text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor">
                          <path d="M7.29117 20.8242L2 22L3.17581 16.7088C2.42544 15.3056 2 13.7025 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C10.2975 22 8.6944 21.5746 7.29117 20.8242ZM7.58075 18.711L8.23428 19.0605C9.38248 19.6745 10.6655 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 13.3345 4.32549 14.6175 4.93949 15.7657L5.28896 16.4192L4.63416 19.3658L7.58075 18.711Z"></path>
                        </svg> {{ $posting->comments->count() }}
                      </button>
                    </div>
                    <p data-modal-target="showUser{{ $posting->id }}" data-modal-toggle="showUser{{ $posting->id }}" class="cursor-pointer line-clamp-3 text-md/relaxed text-gray-500">
                      {{ Str::limit($posting->deskripsi, 150) }}
                    </p>
                  </div>
                </article>
              @else
                <article class="overflow-hidden px-5 my-5 rounded-lg transition">
                  <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                      @if ($posting->user->profile_image)
                        <img class="w-8 h-8 rounded-full mr-4 avatar" data-tippy-content="{{ $posting->user->name }}" src="{{ asset('storage/'. $posting->user->profile_image) }}" alt="{{ $posting->user->username }}">
                      @else
                        <img class="w-8 h-8 rounded-full mr-4 avatar" data-tippy-content="{{ $posting->user->name }}" src="/imgs/avatar.png" alt="{{ $posting->user->username }}">
                      @endif
                      <a href="/profile-user/{{ $posting->user->username }}" class="font-bold text-gray-700 cursor-pointer" tabindex="0" role="link">{{ $posting->user->username }}</a>
                    </div>
                    <p class="text-black text-xs md:text-sm">{{ $posting->created_at->diffForHumans() }}</p>
                  </div>
        
                  <div class="bg-white p-4 rounded-b-lg border-b border-black">
                    <a href="/showTeks/{{ $posting->slug }}" class="cursor-pointer line-clamp-3 text-md/relaxed text-gray-500">
                      {{ Str::limit($posting->deskripsi, 150) }}
                    </a>
                    <div class="flex items-center mt-4">
                      <button id="like-button-{{ $posting->id }}" class="like-button text-black mr-3" data-id="{{ $posting->id }}">
                        <svg class="w-6 h-6 fill-current transition duration-500 ease-in-out transform {{ $posting->isLikedBy(auth()->user()) ? 'text-red-600' : 'text-black' }}" id="like-icon-{{ $posting->id }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                          <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 6.5 3.5 5 5.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5 18.5 5 20 6.5 20 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                        <span id="likes-count-{{ $posting->id }}">{{ $posting->likes->count() }}</span>
                      </button>
                      <a href="/showTeks/{{ $posting->slug }}" class="cursor-pointer text-black text-center">
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
            @foreach ($users->reject(fn($user) => $user->id == auth()->user()->id) as $user)
              <article class="rounded-xl border my-4 border-gray-400 bg-white">
                <div class="flex items-start gap-4 p-4 sm:p-6 lg:p-8">
                  <a href="/profile-user/{{ $user->username }}" class="block shrink-0">
                    <img
                      alt="{{ $user->username }}"
                      src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : '/imgs/avatar.png' }}"
                      class="size-14 rounded-lg object-cover"
                    />
                  </a>
                  <div>
                    <h3 class="font-medium sm:text-lg">
                      <a href="/profile-user/{{ $user->username }}" class="hover:underline">{{ $user->username }}</a>
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
                  @if (auth()->user()->isFollowing($user->id))
                    <button type="button" class="unfollow-btn px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-black rounded-lg hover:bg-gray-500" data-id="{{ $user->id }}" data-username="{{ $user->username }}">
                    <ion-icon name="checkmark-outline"></ion-icon>
                    DiIkuti
                    </button>
                  @else
                    <button type="button" class="follow-btn px-3 py-2 text-xs font-medium text-center inline-flex border border-black items-center text-black bg-transparent rounded-lg hover:bg-gray-200" data-id="{{ $user->id }}" data-username="{{ $user->username }}">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-black me-2" viewBox="0 0 24 24" fill="currentColor"><path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z"></path></svg>
                      Ikuti
                    </button>
                  @endif
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
  {{-- modal show --}}
  @include('user-login.modals.modal-show-user')
</x-layout-auth>

{{-- fitur follow --}}
<script>
  $(document).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $(document).on('click', '.follow-btn', function(e) {
          e.preventDefault();
          var userId = $(this).data('id');

          $.ajax({
              url: '/follow/' + userId,
              type: 'POST',
              success: function(response) {
                  if (response.success) {
                      // Update UI to change follow button to unfollow button
                      $('.follow-btn[data-id="' + userId + '"]').removeClass('follow-btn border border-black text-black bg-transparent rounded-lg hover:bg-gray-200').addClass('unfollow-btn text-white bg-black rounded-lg hover:bg-gray-500').text('Diikuti');
                  } else {
                      console.log(response.message);
                  }
              },
              error: function(xhr) {
                  console.log('Something went wrong');
              }
          });
      });

      $(document).on('click', '.unfollow-btn', function(e) {
          e.preventDefault();
          var userId = $(this).data('id');
          var username = $(this).data('username');

          // Show SweetAlert confirmation dialog
          Swal.fire({
              title: 'Apakah kamu yakin?',
              text: "Jika Anda berubah pikiran, Anda harus meminta lagi untuk mengikuti " + username + " lagi.",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, unfollow!'
          }).then((result) => {
              if (result.isConfirmed) {
                  // Proceed with unfollow
                  $.ajax({
                      url: '/unfollow/' + userId,
                      type: 'POST',
                      success: function(response) {
                          if (response.success) {
                              // Update UI to change unfollow button to follow button
                              $('.unfollow-btn[data-id="' + userId + '"]').removeClass('unfollow-btn text-white bg-black hover:bg-gray-500').addClass('follow-btn border border-black text-black bg-transparent rounded-lg hover:bg-gray-200').text('Ikuti');
                          } else {
                              console.log(response.message);
                          }
                      },
                      error: function(xhr) {
                          console.log('Something went wrong');
                      }
                  });
              }
          });
      });
  });
</script>

{{-- Fitur Like --}}
<script>
  $(document).ready(function() {
      function handleLikeButtonClick(button) {
          var posting_id = $(button).data('id');
          var likeIcon = $('#like-icon-' + posting_id);
          var likesCount = $('#likes-count-' + posting_id);

          var modalLikeIcon = $('#modal-like-icon-' + posting_id);
          var modalLikesCount = $('#modal-likes-count-' + posting_id);

          if (likeIcon.hasClass('text-black') || modalLikeIcon.hasClass('text-black')) {
              $.ajax({
                  url: '{{ route('like') }}',
                  type: 'POST',
                  data: {
                      posting_id: posting_id,
                      _token: '{{ csrf_token() }}'
                  },
                  success: function(response) {
                      if (response.status == 'liked') {
                          likeIcon.removeClass('text-black').addClass('text-red-600 scale-110');
                          likesCount.text(response.likes_count);

                          modalLikeIcon.removeClass('text-black').addClass('text-red-600 scale-110');
                          modalLikesCount.text(response.likes_count);

                          setTimeout(function() {
                              likeIcon.removeClass('scale-110');
                              modalLikeIcon.removeClass('scale-110');
                          }, 300);
                      }
                  }
              });
          } else {
              $.ajax({
                  url: '{{ route('unlike') }}',
                  type: 'POST',
                  data: {
                      posting_id: posting_id,
                      _token: '{{ csrf_token() }}'
                  },
                  success: function(response) {
                      if (response.status == 'unliked') {
                          likeIcon.removeClass('text-red-600').addClass('text-black scale-110');
                          likesCount.text(response.likes_count);

                          modalLikeIcon.removeClass('text-red-600').addClass('text-black scale-110');
                          modalLikesCount.text(response.likes_count);

                          setTimeout(function() {
                              likeIcon.removeClass('scale-110');
                              modalLikeIcon.removeClass('scale-110');
                          }, 300);
                      }
                  }
              });
          }
      }

      $(document).on('click', '.like-button', function() {
          handleLikeButtonClick(this);
      });
  });
</script>

{{-- menamgani video ketika mengklik komentar --}}
<script>
  document.addEventListener('DOMContentLoaded', function() {
      const videos = document.querySelectorAll('video');

      // Fungsi untuk menghentikan video
      function pauseAllVideos() {
          videos.forEach(video => {
              video.pause();
          });
      }

      // Event listener untuk tombol komentar
      const commentButtons = document.querySelectorAll('[data-modal-toggle^="showUser"]');
      commentButtons.forEach(button => {
          button.addEventListener('click', () => {
              const postId = button.getAttribute('data-modal-toggle').replace('showUser', '');
              const videoInPost = document.querySelector(`#video-${postId}`);

              if (videoInPost) {
                  pauseAllVideos(); // Menghentikan semua video
                  videoInPost.pause(); // Menghentikan video yang terkait dengan postingan tersebut
              }
          });
      });
  });
</script>