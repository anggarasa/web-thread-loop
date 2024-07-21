<x-layout-auth>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="absolute top-4 left-4 lg:left-64 p-4">
        <a href="{{ url()->previous() }}" class="text-black font-bold hover:text-gray-800">
            ← Kembali
        </a>
    </div>

    <div class="mt-16 px-2 mb-12 md:px-5 lg:px-12 xl:px-20">
        <div class="max-w-4xl w-full px-2 md:px-10 lg:px-16 py-5 bg-white border-b rounded-lg shadow-md mx-auto">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center">
                    @if ($tek->user->profile_image)
                        <img class="object-cover mr-4 w-10 h-10 rounded-full" src="{{ asset('storage/'. $tek->user->profile_image) }}" alt="{{ $tek->user->username }}">
                    @else
                        <img class="object-cover mr-4 w-10 h-10 rounded-full" src="/imgs/avatar.png" alt="{{ $tek->user->username }}">
                    @endif
                    <a href="/profile-user/{{ $tek->user->username }}" class="font-bold text-gray-700 cursor-pointer" tabindex="0" role="link">{{ $tek->user->username }}</a>
                </div>
                <span class="text-sm font-light text-gray-600">{{ $tek->created_at->diffForHumans() }}</span>
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
                <p class="text-gray-800 text-base md:text-lg">{!! $tek->deskripsi !!}</p>
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
            <div id="komentar" class="mt-10 mb-5 pb-1 border-b">
                <h4 class="text-lg font-semibold text-gray-900">Komentar</h4>
                <div class="comments-container" id="comments-container-{{ $tek->id }}">
                    @forelse ($tek->comments as $comment)
                        <div class="mt-4 flex justify-between items-center" id="comment-{{ $comment->id }}">
                            <div class="flex items-start">
                                @if ($comment->user->profile_image)
                                    <img class="object-cover mr-4 w-10 h-10 rounded-full" src="{{ asset('storage/'. $comment->user->profile_image) }}" alt="{{ $comment->user->username }}">
                                @else
                                    <img class="object-cover mr-4 w-10 h-10 rounded-full" src="/imgs/avatar.png" alt="{{ $comment->user->username }}">
                                @endif
                                <div>
                                    <a href="/profile-user/{{ $comment->user->username }}" class="font-bold text-gray-700">{{ $comment->user->username }}</a>
                                    <p class="text-sm text-gray-500">{{ $comment->content }}</p>
                                </div>
                            </div>
                            <form action="{{ route('comment.destroy.teks', ['posting' => $comment->posting_id, 'comment' => $comment->id]) }}" method="POST" onsubmit="return confirmDeleteComment(event)">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-white bg-black mr-4 hover:bg-gray-600 px-2 py-1 rounded">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="mt-4 text-sm text-gray-500 no-comments">Belum ada komentar.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @include('user-login.modals.modal-koment-teks')
</x-layout-auth>

<script>
      function confirmDeleteComment(event) {
        event.preventDefault(); // Prevent the form from submitting immediately

        Swal.fire({
            title: 'Apa kamu yakin?',
            text: "Komentarmu akan di hapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit(); // Submit the form if confirmed
            }
        });
    }
    
    
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
