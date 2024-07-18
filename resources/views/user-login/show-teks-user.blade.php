<x-layout-auth>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="absolute top-4 left-4 lg:left-64 p-4">
        <a href="{{ url()->previous() }}" class="text-black font-bold hover:text-gray-800">
            ← Kembali
        </a>
    </div>

    <div class="mt-16 px-2 mb-12 md:px-5 lg:px-12 xl:px-20">
        <div class="max-w-4xl w-full px-2 md:px-10 lg:px-16 py-5 bg-white border-b rounded-lg shadow-md dark:bg-gray-800 mx-auto">
            <div class="flex flex-col md:flex-row items-center justify-between">
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

            <div class="flex items-center justify-center mt-4 md:mt-6">
                @if (Str::endsWith($tek->posting_image, ['.jpg', '.jpeg', '.png']))
                    <img
                        alt=""
                        src="{{ asset('storage/'. $tek->posting_image) }}"
                        class="w-full md:w-3/4 lg:w-2/4 rounded-lg object-cover"
                    />
                @elseif (Str::endsWith($tek->posting_video, '.mp4'))
                    <video
                        controls
                        autoplay
                        class="w-11/12 md:w-1/2 lg:w-1/2 rounded-lg"
                    >
                        <source src="{{ asset('storage/'. $tek->posting_video) }}" type="video/mp4">
                    </video>
                @endif
            </div>

            <div class="mt-4">
                <p class="text-gray-800 text-base md:text-lg dark:text-gray-200">{{ $tek->deskripsi }}</p>
            </div>

            <div class="flex items-center justify-start mt-6">
                <div class="flex items-center">
                    <button id="like-button-{{ $tek->id }}" class="like-button text-black mr-3" data-id="{{ $tek->id }}">
                        <svg class="w-6 h-6 fill-current transition duration-500 ease-in-out transform {{ $tek->isLikedBy(auth()->user()) ? 'text-red-600' : 'text-black' }}" id="like-icon-{{ $tek->id }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 6.5 3.5 5 5.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5 18.5 5 20 6.5 20 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        <span id="likes-count-{{ $tek->id }}">{{ $tek->likes->count() }}</span>
                    </button>
                    <button type="button" data-modal-target="modalKomenTeks{{ $tek->id }}" data-modal-toggle="modalKomenTeks{{ $tek->id }}" class="text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M7.29117 20.8242L2 22L3.17581 16.7088C2.42544 15.3056 2 13.7025 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C10.2975 22 8.6944 21.5746 7.29117 20.8242ZM7.58075 18.711L8.23428 19.0605C9.38248 19.6745 10.6655 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 13.3345 4.32549 14.6175 4.93949 15.7657L5.28896 16.4192L4.63416 19.3658L7.58075 18.711Z"></path>
                        </svg> {{ $tek->comments->count() }}
                    </button>
                </div>
            </div>

            <!-- Komentar -->
            <div id="komentar" class="mt-10 mb-5 pb-1 border-b dark:border-gray-600">
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Komentar</h4>
                <div class="comments-container" id="comments-container-{{ $tek->id }}">
                    @forelse ($tek->comments as $comment)
                        <div class="mt-4">
                            <div class="flex items-start">
                                @if ($comment->user->profile_image)
                                    <img class="object-cover mr-4 w-10 h-10 rounded-full" src="{{ asset('storage/'. $comment->user->profile_image) }}" alt="{{ $comment->user->username }}">
                                @else
                                    <img class="object-cover mr-4 w-10 h-10 rounded-full" src="/imgs/avatar.png" alt="{{ $comment->user->username }}">
                                @endif
                                <div>
                                    <p class="font-bold text-gray-700 dark:text-gray-200">{{ $comment->user->username }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $comment->content }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="mt-4 text-sm text-gray-500 dark:text-gray-400 no-comments">Belum ada komentar.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @include('user-login.modals.modal-koment-teks')
</x-layout-auth>

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