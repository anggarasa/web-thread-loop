@foreach ($posts as $post)
<div id="showUser{{ $post->id }}" data-modal-backdrop="static" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-full max-h-full">
  <div class="relative w-full max-w-6xl max-h-full mx-auto">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow">
      <!-- Modal header -->
      <div class="flex items-center justify-between p-4 border-b rounded-t">
        <h3 class="text-xl font-semibold text-gray-900">
          Detail Postingan
        </h3>
        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="showUser{{ $post->id }}">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
      <!-- Modal body -->
      <div class="flex flex-col md:flex-row p-6">
        <div class="md:w-4/5 md:mb-0 flex justify-center items-center">
          @if (pathinfo($post->posting_video, PATHINFO_EXTENSION) == 'mp4')
            <video id="video-{{ $post->id }}" class="w-full h-auto max-h-[60vh] object-contain rounded-lg" controls>
              <source src="{{ asset('storage/'. $post->posting_video) }}" type="video/mp4">
              Your browser does not support the video tag.
            </video>
          @else
            <img src="{{ asset('storage/'. $post->posting_image) }}" alt="{{ $post->user->username }}" class="w-full h-auto max-h-[60vh] object-contain rounded-lg">
          @endif
        </div>
        <div class="md:w-full mt-4 md:mt-0 md:ml-5">
          <div class="flex items-center justify-between mb-5 border-b pb-4">
            <div class="flex items-center">
              @if ($post->user->profile_image)
              <img class="object-cover mr-4 w-10 h-10 rounded-full" src="{{ asset('storage/'. $post->user->profile_image) }}" alt="{{ $post->user->username }}">
              @else
                <img class="object-cover mr-4 w-10 h-10 rounded-full" src="/imgs/avatar.png" alt="{{ $post->user->username }}">
              @endif
              <a href="/profile-user/{{ $post->user->username }}" class="font-bold text-gray-700 cursor-pointer mr-2" tabindex="0" role="link">{{ $post->user->username }}</a>
            </div>
            @if (Auth::check() && $post->user_id == Auth::id())
            <form action="{{ route('posting.destroy', $post->id) }}" method="POST" onsubmit="return confirmDelete(event)">
              @csrf
              @method('DELETE')
              <button type="submit" class="inline-flex items-center text-white bg-red-600 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                <svg aria-hidden="true" class="w-5 h-5 mr-1.5 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                Delete
              </button>
            </form>
            @endif
          </div>
          <div class="overflow-y-scroll max-h-[30vh]">
            <div class="mb-5 pb-1">
              <p class="text-base leading-relaxed text-gray-500">
                {{ $post->deskripsi }}
              </p>
            </div>
            <!-- Komentar -->
            <div class="mb-5 pb-1">
              <h4 class="text-lg font-semibold text-gray-900">Komentar</h4>
              <div class="comments-container" id="comments-container-{{ $post->id }}">
                  @forelse ($post->comments as $comment)
                      <div class="mt-4">
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
                      </div>
                  @empty
                      <p class="mt-4 text-sm text-gray-500 no-comments">Belum ada komentar.</p>
                  @endforelse
              </div>
            </div>          
          </div>
          <!-- Form Komentar -->
          <div class="border-t pt-4">
            {{-- @php
                $isLiked = $post->isLikedByUser();
            @endphp --}}
            <button id="modal-like-button-{{ $post->id }}" class="like-button text-2xl mr-3" data-id="{{ $post->id }}">
              <svg class="w-6 h-6 fill-current transition duration-500 ease-in-out transform {{ $post->isLikedBy(auth()->user()) ? 'text-red-600' : 'text-black' }}" id="modal-like-icon-{{ $post->id }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 6.5 3.5 5 5.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5 18.5 5 20 6.5 20 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
            </button>
            <label for="content-{{ $post->id }}" class="text-2xl cursor-pointer"><ion-icon name="chatbubble-outline"></ion-icon></label>

            <div class="mt-3">
              <span id="modal-likes-count-{{ $post->id }}" class="font-semibold">{{ $post->likes->count() }} Suka</span>
              <p>{{ $post->created_at->diffForHumans() }}</p>
            </div>
            <form class="comment-form mt-5" data-post-id="{{ $post->id }}">
              @csrf
              <label for="content-{{ $post->id }}" class="sr-only">Your comment</label>
              <div class="flex items-center px-3 py-2 rounded-lg bg-gray-50">
                <input type="hidden" name="posting_id" value="{{ $post->id }}">
                <textarea id="content-{{ $post->id }}" name="content" rows="1" class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-500 focus:ring-black focus:border-black" placeholder="Your comment..." required></textarea>
                <button type="submit" class="inline-flex justify-center p-2 text-black rounded-full cursor-pointer hover:bg-blue-100">
                  <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                    <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z"/>
                  </svg>
                  <span class="sr-only">Send comment</span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>      
    </div>
  </div>
</div>
@endforeach

<script>
  document.addEventListener('submit', async (e) => {
    if (e.target && e.target.matches('.comment-form')) {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);
        const postId = form.getAttribute('data-post-id');
        try {
            const response = await fetch('/comments', {
                method: 'POST',
                body: formData,
            });
            if (response.ok) {
                const data = await response.json();
                const newComment = data.comment;
                const user = data.user;

                const commentsContainer = document.querySelector(`#comments-container-${postId}`);
                const commentDiv = document.createElement('div');
                commentDiv.classList.add('comment', 'mt-4');
                commentDiv.innerHTML = `
                    <div class="flex items-start">
                        <img class="object-cover mr-4 w-10 h-10 rounded-full" src="${user.profile_image ? '/storage/' + user.profile_image : '/imgs/avatar.png'}" alt="${user.username}">
                        <div>
                            <p class="font-bold text-gray-700">${user.username}</p>
                            <p class="text-sm text-gray-500">${newComment.content}</p>
                        </div>
                    </div>
                `;
                commentsContainer.prepend(commentDiv); // Menambahkan komentar baru di atas

                // Menghapus teks "Belum ada komentar" jika ada
                const noCommentsText = commentsContainer.querySelector('.no-comments');
                if (noCommentsText) {
                    noCommentsText.remove();
                }

                // Mengosongkan textarea setelah komentar berhasil ditambahkan
                form.querySelector('textarea').value = ''; 
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to post comment.',
                });
            }
        } catch (error) {
            console.error('Terjadi kesalahan:', error);
        }
    }
});

function confirmDelete(event) {
    event.preventDefault(); // Prevent the form from submitting immediately

    Swal.fire({
        title: 'Apa kamu yakin?',
        text: "Postinganmu akan di hapus secara permanen!",
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

document.addEventListener('click', (event) => {
    const target = event.target.closest('[data-modal-toggle]');
    if (target) {
        const modalId = target.getAttribute('data-modal-target');
        const modal = document.getElementById(modalId);
        if (modal) {
            const video = modal.querySelector('video');
            if (video) {
                video.setAttribute('autoplay', true);
                video.setAttribute('loop', true);
                video.play();
            }
        }
    }
});

document.addEventListener('click', (event) => {
    const target = event.target.closest('[data-modal-hide]');
    if (target) {
        const modalId = target.getAttribute('data-modal-hide');
        const modal = document.getElementById(modalId);
        if (modal) {
            const video = modal.querySelector('video');
            if (video) {
                video.pause();
                video.currentTime = 0;
                video.removeAttribute('autoplay');
                video.removeAttribute('loop');
            }
        }
    }
});

</script>