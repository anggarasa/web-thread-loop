<!-- Large Modal -->
<div id="modalKomenTeks{{ $tek->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative w-full max-w-4xl max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <!-- Modal header -->
          <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <div class="flex items-center">
              @if ($tek->user->profile_image)
              <img class="object-cover mr-4 w-10 h-10 rounded-full" src="{{ asset('storage/'. $tek->user->profile_image) }}" alt="{{ $tek->user->username }}">
              @else
                <img class="object-cover mr-4 w-10 h-10 rounded-full" src="/imgs/avatar.png" alt="{{ $tek->user->username }}">
              @endif
              <a class="font-bold text-gray-700 cursor-pointer dark:text-gray-200 mr-2" tabindex="0" role="link">{{ $tek->user->username }}</a> -
              <a class="text-gray-700 cursor-pointer hover:text-gray-400 ml-2">ikuti</a>
            </div>
              <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modalKomenTeks{{ $tek->id }}">
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                  </svg>
                  <span class="sr-only">Close modal</span>
              </button>
          </div>
          <!-- Modal body -->
          <div class="p-4 md:p-5 overflow-y-scroll max-h-80 space-y-4">
              <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                {{ $tek->deskripsi }}
              </p>
          </div>
          <!-- Modal footer -->
          <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
              <form action="/comments-teks" method="POST" class=" flex items-center w-full">
                @csrf
                <label for="content" class="sr-only">Your comment</label>
                <input type="hidden" name="posting_id" value="{{ $tek->id }}">
                <textarea id="content" name="content" rows="1" class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-abu-muda focus:ring-abu-tua focus:border-abu-tua" placeholder="Your comment..." autofocus required></textarea>
                <button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                  <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                    <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z"/>
                  </svg>
                  <span class="sr-only">Send comment</span>
                </button>
              </form>
          </div>
      </div>
  </div>
</div>