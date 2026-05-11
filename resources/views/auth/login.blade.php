<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - TemuAksi</title>
    <link rel="stylesheet" href="{{ asset('src/output.css') }}">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="min-h-screen bg-canvas flex items-start justify-center px-4 py-12">
    <div class="pointer-events-none fixed inset-0 overflow-hidden">
        <div class="absolute -top-32 -right-32 w-96 h-96 bg-mist/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-pear/60 rounded-full blur-3xl"></div>
    </div>

    <div class="relative w-full max-w-md">
        <div class="text-center mb-7">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-cornflower flex items-center justify-center">
                    <i data-lucide="zap" class="w-4 h-4 text-white"></i>
                </div>
                <span class="text-cornflower font-black text-xl tracking-tight">
                    Temu<span class="text-mist">Aksi</span>
                </span>
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-xl shadow-cornflower/5 border border-pear p-8">
            <div class="mb-8 text-center">
                <h1 class="text-2xl font-bold text-cornflower">Selamat Datang Kembali</h1>
                <p class="text-sm text-gray-500 mt-1.5">Masuk untuk melanjutkan kolaborasi di TemuAksi</p>
            </div>

            @if($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            @if(session('success'))
                <div class="mb-4 bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Email</label>
                    <div class="flex items-center gap-2.5 border border-gray-200 bg-canvas rounded-xl px-3.5 py-2.5 focus-within:border-mist focus-within:bg-white focus-within:ring-2 focus-within:ring-mist/15 transition-all duration-150">
                        <i data-lucide="mail" class="w-4 h-4 text-gray-400 shrink-0"></i>
                        <input type="email" name="email" placeholder="contoh@email.com"
                            value="{{ old('email') }}"
                            class="w-full text-sm text-gray-800 placeholder-gray-400 outline-none bg-transparent" required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Password</label>
                    <div class="flex items-center gap-2.5 border border-gray-200 bg-canvas rounded-xl px-3.5 py-2.5 focus-within:border-mist focus-within:bg-white focus-within:ring-2 focus-within:ring-mist/15 transition-all duration-150">
                        <i data-lucide="lock" class="w-4 h-4 text-gray-400 shrink-0"></i>
                        <input type="password" name="password" placeholder="Masukkan password"
                            class="w-full text-sm text-gray-800 placeholder-gray-400 outline-none bg-transparent" required>
                    </div>
                </div>

                <button type="submit"
                    class="w-full mt-2 bg-cornflower hover:bg-mist text-white font-semibold text-sm py-3.5 rounded-xl transition-all duration-200 shadow-sm flex items-center justify-center gap-2">
                    <i data-lucide="log-in" class="w-4 h-4"></i>
                    Masuk
                </button>
            </form>

            <p class="text-center text-xs text-gray-400 mt-8">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-mist font-semibold hover:text-cornflower transition-colors">
                    Daftar sekarang
                </a>
            </p>
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>
