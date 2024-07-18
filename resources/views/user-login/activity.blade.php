<x-layout-auth>
  <x-slot:title>{{ $title }}</x-slot:title>
  <div class="max-w-2xl lg:max-w-4xl text-gray-900 mx-auto mt-10 p-4">
    <h1 class="font-bold text-xl text-center">Aktivitas Terbaru</h1>
    <div class="bg-white rounded-lg p-4 shadow-md">
      <div class="space-y-4">
        @foreach ($activities as $activity)
            <div class="flex items-center border-b border-black justify-between {{ $activity->is_read ? 'bg-white' : 'bg-gray-100' }} p-4 rounded-lg">
                <div class="flex items-center">
                    @if ($activity->user->profile_image)
                        <img src="{{ asset('storage/'. $activity->user->profile_image) }}" alt="{{ $activity->user->username }}" class="w-10 h-10 rounded-full">
                    @else
                        <img src="/imgs/avatar.png" alt="{{ $activity->user->profile_image }}" class="w-10 h-10 rounded-full">
                    @endif
                    <div class="ml-3">
                        @if ($activity->type == 'follow')
                            <a href="{{ route('kunjungan-profile', $activity->user->username ?? $activity->post->id) }}">
                                <div class="text-sm font-medium">{{ $activity->user->username }}</div>
                                <div class="text-sm mt-1">Mengikuti Anda {{ $activity->user->username }}</div>
                            </a>
                        @elseif ($activity->type == 'unfollow')
                            <a href="{{ route('kunjungan-profile', $activity->user->username ?? $activity->post->id) }}">
                                <div class="text-sm font-medium">{{ $activity->user->username }}</div>
                                <div class="text-sm mt-1">Berhenti Mengikuti {{ $activity->receiver->name }}</div>
                            </a>
                        @elseif ($activity->type == 'upload_post')
                            <a href="/showTeks/{{ $activity->post->slug }}">
                                <div class="text-sm font-medium">{{ $activity->user->username }}</div>
                                <div class="text-sm mt-1">Telah Mengupload Postingan Baru</div>
                            </a>
                        @elseif ($activity->type == 'like')
                            <a href="/showTeks/{{ $activity->post->slug }}">
                                <div class="text-sm font-medium">{{ $activity->user->username }}</div>
                                <div class="text-sm mt-1">Menyukai Postingan Anda {{ $activity->post->user->name }}</div>
                            </a>
                        @elseif ($activity->type == 'comment')
                            <a href="/showTeks/{{ $activity->post->slug }}">
                                <div class="text-sm font-medium">{{ $activity->user->username }}</div>
                                <div class="text-sm mt-1">Mengomentari Postingan Anda {{ $activity->post->user->name }}: "{{ $activity->content }}"</div>
                            </a>
                        @endif
                        <div class="text-xs text-gray-400">{{ $activity->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                @if ($activity->type == 'follow')
                    @if (auth()->user()->isFollowing($activity->user->id))
                        <button class="unfollow-btn text-white bg-black hover:bg-gray-600 px-4 py-1 rounded" data-id="{{ $activity->user->id }}" data-username="{{ $activity->user->username }}">Diikuti</button>
                    @else
                        <button class="follow-btn text-white bg-blue-500 hover:bg-blue-400 px-4 py-1 rounded" data-id="{{ $activity->user->id }}" data-username="{{ $activity->user->username }}">Ikuti balik</button>
                    @endif
                @endif
            </div>
        @endforeach
      </div>
    </div>
  </div>
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
                      $('.follow-btn[data-id="' + userId + '"]').removeClass('follow-btn text-white bg-blue-500 hover:bg-blue-400').addClass('unfollow-btn text-white bg-black hover:bg-gray-600').text('Diikuti');
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
                              $('.unfollow-btn[data-id="' + userId + '"]').removeClass('unfollow-btn text-white bg-black hover:bg-gray-600').addClass('follow-btn text-white bg-blue-500 hover:bg-blue-400').text('Ikuti');
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