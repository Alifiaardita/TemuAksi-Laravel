<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'TemuAksi')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="min-h-screen flex flex-col bg-canvas text-gray-800">

    @include('layouts.navbar')

    <main class="flex-grow">

        @if(session('success'))
            <div class="max-w-7xl mx-auto px-6 pt-4">
                <div class="bg-green-50 border border-green-200 text-green-800 rounded-xl px-4 py-3 text-sm">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-6 pt-4">
                <div class="bg-red-50 border border-red-200 text-red-800 rounded-xl px-4 py-3 text-sm">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @yield('content')

    </main>

    @include('layouts.footer')

    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        lucide.createIcons();

        function toggleDropdown() {
            document.getElementById('dropdown')?.classList.toggle('hidden');
        }

        window.onclick = function(e) {
            if (!e.target.closest('.relative')) {
                const d = document.getElementById('dropdown');
                if (d) d.classList.add('hidden');
            }
        }
    </script>

    @stack('scripts')

</body>
</html>
