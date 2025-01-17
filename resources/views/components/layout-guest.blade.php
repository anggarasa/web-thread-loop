<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="/imgs/logo-ThreadLoop2-aplikasi.svg" type="image/svg+xml">

        <title>ThreadLoop | {{ $title }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {{-- <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />

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
                            abu-tua: "#2c3e50",
                            abu-muda: "#95a5a6",
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
        </script> --}}

        <style>
            .active {
                color: black;
                border-bottom: 2px solid black;
            }
            .inactive {
                color: gray;
            }
        </style>
    </head>
    <body class="bg-white">
        
        {{ $slot }}

        <!-- ====== ionicons ======= -->
      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
      {{-- <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script> --}}
    </body>
</html>
