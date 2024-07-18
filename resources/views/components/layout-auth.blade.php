<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="/imgs/logo-ThreadLoop2-aplikasi.svg" type="image/svg+xml">
  <title>ThreadLoop | {{ $title }}</title>
  
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  {{-- sweetalert --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  {{-- Jquery --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <style>
    .active {
        color: black;
        border-bottom: 2px solid black;
    }
    .inactive {
        color: gray;
    }
</style>

{{-- SweetAlert --}}
@include('sweetalert::alert')
</head>
<body>

    <x-sidebar-auth></x-sidebar-auth>
    <div class="sm:ml-64">
        <div class="rounded-lg">
           {{ $slot }}
        </div>
      </div>

      {{-- Alert Error --}}
      @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: '{!! implode('<br>', $errors->all()) !!}'
            });
        </script>
      @endif

      @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}'
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}'
                });
            </script>
        @endif
      
      <!-- ====== ionicons ======= -->
      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

      {{-- popper --}}
      <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>

</body>
</html>
{{-- <a href="{{ route('profile.show', ['id' => auth()->id()]) }}" class="text-blue-500">Lihat</a> --}}
