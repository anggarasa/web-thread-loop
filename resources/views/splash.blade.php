<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/imgs/logo-ThreadLoop2-aplikasi.svg" type="image/svg+xml">

  <title>ThreadLoop</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
<script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: {
                                50: "#eff6ff",
                                100: "#dbeafe",
                                200: "#bfdbfe",
                                300: "#93c5fd",
                                400: "#60a5fa",
                                500: "#3b82f6",
                                600: "#2563eb",
                                700: "#1d4ed8",
                                800: "#1e40af",
                                900: "#1e3a8a",
                                950: "#172554",
                            },
                            abu: { tua: "#2c3e50", muda: "#95a5a6" },
                            putih: "#ecf0f1",
                        },
                        fontFamily: {
                            body: [
                                "Inter",
                                "ui-sans-serif",
                                "system-ui",
                                "-apple-system",
                                "system-ui",
                                "Segoe UI",
                                "Roboto",
                                "Helvetica Neue",
                                "Arial",
                                "Noto Sans",
                                "sans-serif",
                                "Apple Color Emoji",
                                "Segoe UI Emoji",
                                "Segoe UI Symbol",
                                "Noto Color Emoji",
                            ],
                            sans: [
                                "Figtree",
                                "Inter",
                                "ui-sans-serif",
                                "system-ui",
                                "-apple-system",
                                "system-ui",
                                "Segoe UI",
                                "Roboto",
                                "Helvetica Neue",
                                "Arial",
                                "Noto Sans",
                                "sans-serif",
                                "Apple Color Emoji",
                                "Segoe UI Emoji",
                                "Segoe UI Symbol",
                                "Noto Color Emoji",
                            ],
                        },
                    },
                },
                plugins: [require("flowbite/plugin")],
            }
        </script>
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
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
  <script>
      // Mengarahkan ke halaman utama setelah beberapa detik
      setTimeout(function() {
          window.location.href = "{{ url('/Beranda') }}";
      }, 1500); // Sesuaikan waktu dalam milidetik (3000 ms = 3 detik)
  </script>
</body>
</html>
