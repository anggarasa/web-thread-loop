<x-layout-auth>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mx-auto flex flex-wrap justify-center">
        <a href="/Home" class="block md:hidden mb-0">
            <img src="/imgs/logo-ThreadLoop2-warna-hitam.svg" class="mx-auto" alt="ThreadLoop">
        </a>
        <!-- Main Content -->
        <div class="w-full lg:w-2/3">
                <!-- Articles -->
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
                                <button id="like-button-{{ $posting->id }}" class="like-button text-black mr-3" data-id="{{ $posting->id }}">
                                    <svg class="w-6 h-6 fill-current transition duration-500 ease-in-out transform {{ $posting->isLikedBy(auth()->user()) ? 'text-red-600' : 'text-black' }}" id="like-icon-{{ $posting->id }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 6.5 3.5 5 5.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5 18.5 5 20 6.5 20 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                    </svg>
                                    <span id="likes-count-{{ $posting->id }}">{{ $posting->likes->count() }}</span>
                                </button>
                                <button type="button" data-modal-target="showUser{{ $posting->id }}" data-modal-toggle="showUser{{ $posting->id }}" class="cursor-pointer text-black text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M7.29117 20.8242L2 22L3.17581 16.7088C2.42544 15.3056 2 13.7025 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C10.2975 22 8.6944 21.5746 7.29117 20.8242ZM7.58075 18.711L8.23428 19.0605C9.38248 19.6745 10.6655 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 13.3345 4.32549 14.6175 4.93949 15.7657L5.28896 16.4192L4.63416 19.3658L7.58075 18.711Z"/>
                                    </svg> {{ $posting->comments->count() }}
                                </button>
                            </div>
                    
                            <button data-modal-target="showUser{{ $posting->id }}" data-modal-toggle="showUser{{ $posting->id }}" class="mt-2 cursor-pointer line-clamp-3 text-md/relaxed text-gray-500">
                                {!! Str::limit($posting->deskripsi, 1000) !!}
                            </button>
                        </div>
                    </article>
                    @else
                        <article class="overflow-hidden px-5 my-5 rounded-b-lg transition lg:mx-20 lg:p-3 lg:mb-0 mb-5">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    @if ($posting->user->profile_image)
                                        <img class="w-8 h-8 rounded-full object-cover mr-4 avatar" data-tippy-content="Author Name" src="{{ asset('storage/'. $posting->user->profile_image) }}" alt="{{ $posting->user->username }}">
                                    @else
                                        <img class="w-8 h-8 rounded-full object-cover mr-4 avatar" data-tippy-content="Author Name" src="/imgs/avatar.png" alt="{{ $posting->user->username }}">
                                    @endif
                                    <a href="/profile-user/{{ $posting->user->username }}" class="font-bold text-gray-700 cursor-pointer" tabindex="0" role="link">{{ $posting->user->username }}</a>
                                </div>
                                <p class="text-black text-xs md:text-sm">{{ $posting->created_at->diffForHumans() }}</p>
                            </div>

                            <div class="bg-white p-4 rounded-b-lg border-b border-black sm:p-6">
                                <a href="/showTeks/{{ $posting->slug }}" class=" line-clamp-3 text-md/relaxed text-gray-500">
                                    {!! Str::limit($posting->deskripsi, 1000) !!}
                                </a>

                                <div class="flex mt-5 items-center">
                                    <button id="like-button-{{ $posting->id }}" class="like-button text-black mr-3" data-id="{{ $posting->id }}">
                                        <svg class="w-6 h-6 fill-current transition duration-500 ease-in-out transform {{ $posting->isLikedBy(auth()->user()) ? 'text-red-600' : 'text-black' }}" id="like-icon-{{ $posting->id }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 6.5 3.5 5 5.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5 18.5 5 20 6.5 20 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                        <span id="likes-count-{{ $posting->id }}">{{ $posting->likes->count() }}</span>
                                    </button>
                                    <a href="/showTeks/{{ $posting->slug }}" class="text-black text-center">
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
        <!-- Sidebar -->
        <div class="hidden lg:block lg:w-1/3">
            <div class="flex flex-col items-center">
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="flex items-center mb-4">
                        @if (auth()->user()->profile_image)
                            <img class="w-10 h-10 rounded-full object-cover mr-3" src="{{ asset('storage/'. auth()->user()->profile_image) }}" alt="{{ auth()->user()->username }}">
                        @else
                        <img class="w-10 h-10 rounded-full object-cover mr-3" src="/imgs/avatar.png" alt="{{ auth()->user()->username }}">
                        @endif
                        <div class="flex-1">
                            <p class="font-bold text-gray-700">{{ auth()->user()->username }}</p>
                            <a href="/profile-user" class="text-blue-500 text-sm ml-auto">{{ auth()->user()->name }}</a>
                        </div>
                    </div>
                    <h2 class="font-bold text-lg mb-2">Disarankan untuk Anda</h2>
                    <ul>
                        @foreach ($users as $user)
                            <li class="flex items-center mb-2 relative">
                                <div class="bg-gray-300 w-10 h-10 rounded-full mr-3">
                                    @if ($user->profile_image)
                                        <img src="{{ asset('storage/'. $user->profile_image) }}" data-popover-target="detail-user-modal{{ $user->id }}" class="w-full h-full rounded-full object-cover cursor-pointer profile-image" alt="{{ $user->username }}">
                                    @else
                                        <img src="/imgs/avatar.png" data-popover-target="detail-user-modal{{ $user->id }}" class="w-full h-full rounded-full object-cover cursor-pointer profile-image" alt="{{ $user->username }}">
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <a href="/profile-user/{{ $user->username }}" class="text-gray-700 font-bold hover:underline">{{ $user->username }}</a>
                                    -
                                    @if (auth()->user()->isFollowing($user->id))
                                        <button class="unfollow-btn text-gray-700 text-sm ml-auto" data-id="{{ $user->id }}" data-username="{{ $user->username }}">Diikuti</button>
                                    @else
                                        <button class="follow-btn text-blue-500 text-sm ml-auto" data-id="{{ $user->id }}" data-username="{{ $user->username }}">Ikuti</button>
                                    @endif
                                </div>
                            </li>
                            <div data-popover id="detail-user-modal{{ $user->id }}" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0">
                                <div class="p-3">
                                    <div class="flex items-center justify-between mb-2">
                                        <a href="/profile-user/{{ $user->username }}">
                                            @if ($user->profile_image)
                                            <img class="w-10 h-10 rounded-full object-cover" src="{{ asset('storage/'. $user->profile_image) }}" alt="{{ $user->username }}">
                                            @else
                                            <img class="w-10 h-10 rounded-full object-cover" src="/imgs/avatar.png" alt="{{ $user->username }}">
                                            @endif
                                        </a>
                                        <div>
                                            @if (auth()->user()->isFollowing($user->id))
                                            <button type="button" class="unfollow-btn text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 focus:outline-none" data-id="{{ $user->id }}" data-username="{{ $user->username }}">Diikuti</button>
                                            @else
                                            <button type="button" class="follow-btn text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 focus:outline-none"data-id="{{ $user->id }}" data-username="{{ $user->username }}">Ikuti</button>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="text-base font-semibold leading-none text-gray-900">
                                        <a href="/profile-user/{{ $user->username }}">{{ $user->name }}</a>
                                    </p>
                                    <p class="mb-3 text-sm font-normal">
                                        <a href="/profile-user/{{ $user->username }}" class="hover:underline">{{ $user->username }}</a>
                                    </p>
                                    <p class="mb-4 text-sm">{{ $user->email }} <p class="text-blue-600 hover:underline">{{ $user->nohp }}</p></p>
                                    <ul class="flex text-sm">
                                        <li class="me-2">
                                            <div>
                                                <span class="font-semibold text-gray-900">{{ $user->followers->count() }}</span>
                                                <span>Pengikut</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <span class="font-semibold text-gray-900">{{ $user->following->count() }}</span>
                                                <span>Diikuti</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div data-popper-arrow></div>
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
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
                        $('.follow-btn[data-id="' + userId + '"]').removeClass('follow-btn text-blue-500').addClass('unfollow-btn text-gray-700').text('Diikuti');
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
                                $('.unfollow-btn[data-id="' + userId + '"]').removeClass('unfollow-btn text-gray-700').addClass('follow-btn text-blue-500').text('Ikuti');
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


{{-- script popper --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profileImages = document.querySelectorAll('.profile-image');

        profileImages.forEach(image => {
            const popoverId = image.getAttribute('data-popover-target');
            const popover = document.getElementById(popoverId);

            const popperInstance = Popper.createPopper(image, popover, {
                placement: 'top',
                modifiers: [
                    {
                        name: 'offset',
                        options: {
                            offset: [0, 8],
                        },
                    },
                ],
            });

            image.addEventListener('mouseenter', () => {
                popover.classList.remove('invisible', 'opacity-0');
                popover.classList.add('visible', 'opacity-100');
            });

            image.addEventListener('mouseleave', () => {
                popover.classList.remove('visible', 'opacity-100');
                popover.classList.add('invisible', 'opacity-0');
            });
        });
    });
</script>

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