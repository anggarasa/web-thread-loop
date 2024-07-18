<div id="modalPosting" tabindex="-1" data-modal-backdrop="static" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
  <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
    <!-- Modal content -->
    <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
      <!-- Modal header -->
      <div class="flex justify-end items-center pb-2 rounded-t sm:mb-5">
        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="modalPosting">
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <!-- Modal body -->
      <form action="{{ route('posting.store') }}" method="POST" enctype="multipart/form-data" class="mb-10">
        @csrf
        <div class="flex justify-center items-center">
          <div class="w-full max-w-md">
            <div class="flex items-center mb-4">
              @if (auth()->user()->profile_image)
              <img src="{{ asset('storage/'. auth()->user()->profile_image) }}" alt="{{ auth()->user()->username }}" class="w-10 h-10 rounded-full">
              @else
              <img src="/imgs/avatar.png" alt="{{ auth()->user()->username }}" class="w-10 h-10 rounded-full">
              @endif
              <a href="/profile-user/{{ auth()->user()->username }}" class="ml-2 font-bold">{{ auth()->user()->username }}</a>
            </div>

            <!-- Preview Section -->
            <div id="preview" class="relative mb-4">
              <button id="cancelPreview" type="button" class="absolute top-2  right-2 p-1 bg-red-500 text-white rounded-full hidden" onclick="cancelPreview()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
              </button>
            </div>

            <textarea name="deskripsi" class="w-full p-2 rounded-lg text-black focus:outline-none focus:ring-2 focus:ring-gray-500" placeholder="Mulai utas..." required></textarea>

            <!-- File Upload Buttons -->
            <div class="flex justify-between items-center mt-2">
              <div class="flex space-x-2">
                <input type="file" id="imageUpload" name="posting_image" accept="image/*" class="hidden" onchange="previewImage(event)">
                <label for="imageUpload" class="p-2 bg-transparent text-black rounded-full border border-black hover:text-gray-600 hover:bg-gray-200 cursor-pointer">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M15 8V4H5V20H19V8H15ZM3 2.9918C3 2.44405 3.44749 2 3.9985 2H16L20.9997 7L21 20.9925C21 21.5489 20.5551 22 20.0066 22H3.9934C3.44476 22 3 21.5447 3 21.0082V2.9918ZM11 9.5C11 10.3284 10.3284 11 9.5 11C8.67157 11 8 10.3284 8 9.5C8 8.67157 8.67157 8 9.5 8C10.3284 8 11 8.67157 11 9.5ZM17.5 17L13.5 10L8 17H17.5Z"></path></svg>
                </label>
                <input type="file" id="videoUpload" name="posting_video" accept="video/*" class="hidden" onchange="previewVideo(event)">
                <label for="videoUpload" class="p-2 bg-transparent text-black rounded-full border border-black hover:text-gray-600 cursor-pointer">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M15 4V8H19V20H5V4H15ZM3.9985 2C3.44749 2 3 2.44405 3 2.9918V21.0082C3 21.5447 3.44476 22 3.9934 22H20.0066C20.5551 22 21 21.5489 21 20.9925L20.9997 7L16 2H3.9985ZM15.0008 11.667L10.1219 8.41435C10.0562 8.37054 9.979 8.34717 9.9 8.34717C9.6791 8.34717 9.5 8.52625 9.5 8.74717V15.2524C9.5 15.3314 9.5234 15.4086 9.5672 15.4743C9.6897 15.6581 9.9381 15.7078 10.1219 15.5852L15.0008 12.3326C15.0447 12.3033 15.0824 12.2656 15.1117 12.2217C15.2343 12.0379 15.1846 11.7895 15.0008 11.667Z"></path></svg>
                </label>
              </div>
            </div>

            <button class="w-full mt-4 py-2 bg-black text-white rounded-lg hover:bg-gray-500">Kirim</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function previewImage(event) {
  const preview = document.getElementById('preview');
  preview.innerHTML = '';

  const file = event.target.files[0];
  const reader = new FileReader();

  // Tangani error jika file bukan gambar
  reader.onerror = function(error) {
    console.error("Error membaca file gambar:", error);
    // Tampilkan pesan error atau lakukan penanganan lain
  };

  reader.onload = function() {
    const img = document.createElement('img');
    img.src = reader.result;
    img.className = 'w-auto h-80 object-cover rounded-lg mt-2';
    preview.appendChild(img);
    document.getElementById('cancelPreview').classList.remove('hidden');
  };

  reader.readAsDataURL(file);
}

function previewVideo(event) {
  const preview = document.getElementById('preview');
  preview.innerHTML = '';

  const file = event.target.files[0];
  const reader = new FileReader();

  // Tangani error jika file bukan video
  reader.onerror = function(error) {
    console.error("Error membaca file video:", error);
    // Tampilkan pesan error atau lakukan penanganan lain
  };

  reader.onload = function() {
    const video = document.createElement('video');
    video.src = reader.result;
    video.controls = true;
    video.className = 'w-auto h-80 rounded-lg mt-2';
    preview.appendChild(video);
    document.getElementById('cancelPreview').classList.remove('hidden');
  };

  reader.readAsDataURL(file);
}

function cancelPreview() {
  const preview = document.getElementById('preview');
  preview.innerHTML = '';
  document.getElementById('imageUpload').value = '';
  document.getElementById('videoUpload').value = '';
  document.getElementById('cancelPreview').classList.add('hidden');
}

</script>
