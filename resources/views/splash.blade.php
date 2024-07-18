<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/imgs/logo-ThreadLoop2-aplikasi.svg" type="image/svg+xml">

  <title>ThreadLoop</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

  <!-- Main Content -->
  <main class="flex-grow flex items-center justify-center">
      <img src="imgs/logo-ThreadLoop2-warna-hitam.svg" alt="Centered Image" class="block w-auto h-36">
  </main>

  <!-- Footer -->
  <footer class="text-center p-4">
      <p>&copy; 2024 ThreadLoop. All rights reserved.</p>
  </footer>
  <script>
      // Mengarahkan ke halaman utama setelah beberapa detik
      setTimeout(function() {
          window.location.href = "{{ url('/Beranda') }}";
      }, 1500); // Sesuaikan waktu dalam milidetik (3000 ms = 3 detik)
  </script>
</body>
</html>
