<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - TemuAksi</title>
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
            <a href="#" class="inline-flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-cornflower flex items-center justify-center">
                    <i data-lucide="zap" class="w-4 h-4 text-white"></i>
                </div>
                <span class="text-cornflower font-black text-xl tracking-tight">Temu<span class="text-mist">Aksi</span></span>
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-xl shadow-cornflower/5 border border-pear p-8">
            <div class="mb-8">
                <h1 id="page-title" class="text-2xl font-bold text-cornflower">Buat Akun</h1>
                <p id="page-subtitle" class="text-sm text-gray-500 mt-1.5">Daftar dan mulai kolaborasi di TemuAksi</p>
            </div>

            @if($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Step 1: Pilih Role -->
            <div id="step-role">
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-4">Daftar sebagai</p>
                <div class="space-y-3">
                    <button onclick="showForm('individu')"
                        class="w-full group flex items-center gap-4 p-5 rounded-2xl border-2 border-transparent bg-canvas hover:bg-pear hover:border-mist/40 transition-all duration-200 text-left">
                        <div class="w-11 h-11 rounded-xl bg-mist/10 flex items-center justify-center shrink-0">
                            <i data-lucide="users" class="w-5 h-5 text-mist"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-cornflower text-sm">Individu / Organisasi</p>
                            <p class="text-xs text-gray-500 mt-0.5">Ajukan proposal & cari volunteer</p>
                        </div>
                        <i data-lucide="chevron-right" class="w-4 h-4 text-gray-300"></i>
                    </button>

                    <button onclick="showForm('perusahaan')"
                        class="w-full group flex items-center gap-4 p-5 rounded-2xl border-2 border-transparent bg-canvas hover:bg-pear hover:border-mist/40 transition-all duration-200 text-left">
                        <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center shrink-0">
                            <i data-lucide="building-2" class="w-5 h-5 text-amber-500"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-cornflower text-sm">Perusahaan (Sponsor)</p>
                            <p class="text-xs text-gray-500 mt-0.5">Berikan sponsorship atau CSR</p>
                        </div>
                        <i data-lucide="chevron-right" class="w-4 h-4 text-gray-300"></i>
                    </button>
                </div>
                <p class="text-center text-xs text-gray-400 mt-8">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-mist font-semibold hover:text-cornflower">Masuk di sini</a>
                </p>
            </div>

            <!-- Form Individu -->
            <div id="form-individu" class="hidden">
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="role" value="individu">

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nama Lengkap</label>
                        <div class="flex items-center gap-2.5 border border-gray-200 bg-canvas rounded-xl px-3.5 py-2.5 focus-within:border-mist focus-within:bg-white transition-all">
                            <i data-lucide="user" class="w-4 h-4 text-gray-400 shrink-0"></i>
                            <input type="text" name="nama" placeholder="Nama Anda" class="w-full text-sm text-gray-800 placeholder-gray-400 outline-none bg-transparent" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Email</label>
                        <div class="flex items-center gap-2.5 border border-gray-200 bg-canvas rounded-xl px-3.5 py-2.5 focus-within:border-mist focus-within:bg-white transition-all">
                            <i data-lucide="mail" class="w-4 h-4 text-gray-400 shrink-0"></i>
                            <input type="email" name="email" placeholder="contoh@email.com" class="w-full text-sm text-gray-800 placeholder-gray-400 outline-none bg-transparent" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Password</label>
                        <div class="flex items-center gap-2.5 border border-gray-200 bg-canvas rounded-xl px-3.5 py-2.5 focus-within:border-mist focus-within:bg-white transition-all">
                            <i data-lucide="lock" class="w-4 h-4 text-gray-400 shrink-0"></i>
                            <input type="password" name="password" placeholder="Minimal 6 karakter" class="w-full text-sm text-gray-800 placeholder-gray-400 outline-none bg-transparent" required>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-cornflower hover:bg-mist text-white font-semibold text-sm py-3 rounded-xl transition-all flex items-center justify-center gap-2">
                        <i data-lucide="user-plus" class="w-4 h-4"></i> Buat Akun
                    </button>
                </form>
            </div>

            <!-- Form Perusahaan -->
            <div id="form-perusahaan" class="hidden">
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="role" value="perusahaan">

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nama Perusahaan</label>
                        <div class="flex items-center gap-2.5 border border-gray-200 bg-canvas rounded-xl px-3.5 py-2.5 focus-within:border-mist focus-within:bg-white transition-all">
                            <i data-lucide="building" class="w-4 h-4 text-gray-400 shrink-0"></i>
                            <input type="text" name="nama" placeholder="PT. Contoh Perusahaan" class="w-full text-sm text-gray-800 placeholder-gray-400 outline-none bg-transparent" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Bidang Industri</label>
                        <div class="flex items-center gap-2.5 border border-gray-200 bg-canvas rounded-xl px-3.5 py-2.5 focus-within:border-mist focus-within:bg-white transition-all">
                            <i data-lucide="briefcase" class="w-4 h-4 text-gray-400 shrink-0"></i>
                            <input type="text" name="bidang" placeholder="Teknologi, Pendidikan..." class="w-full text-sm text-gray-800 placeholder-gray-400 outline-none bg-transparent" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Email Perusahaan</label>
                        <div class="flex items-center gap-2.5 border border-gray-200 bg-canvas rounded-xl px-3.5 py-2.5 focus-within:border-mist focus-within:bg-white transition-all">
                            <i data-lucide="mail" class="w-4 h-4 text-gray-400 shrink-0"></i>
                            <input type="email" name="email" placeholder="corporate@contoh.com" class="w-full text-sm text-gray-800 placeholder-gray-400 outline-none bg-transparent" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">No. Telepon</label>
                        <div class="flex items-center gap-2.5 border border-gray-200 bg-canvas rounded-xl px-3.5 py-2.5 focus-within:border-mist focus-within:bg-white transition-all">
                            <i data-lucide="phone" class="w-4 h-4 text-gray-400 shrink-0"></i>
                            <input type="tel" name="telepon" placeholder="+62 812-3456-7890" class="w-full text-sm text-gray-800 placeholder-gray-400 outline-none bg-transparent" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Password</label>
                        <div class="flex items-center gap-2.5 border border-gray-200 bg-canvas rounded-xl px-3.5 py-2.5 focus-within:border-mist focus-within:bg-white transition-all">
                            <i data-lucide="lock" class="w-4 h-4 text-gray-400 shrink-0"></i>
                            <input type="password" name="password" placeholder="Minimal 6 karakter" class="w-full text-sm text-gray-800 placeholder-gray-400 outline-none bg-transparent" required>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-cornflower hover:bg-mist text-white font-semibold text-sm py-3 rounded-xl transition-all flex items-center justify-center gap-2">
                        <i data-lucide="building-2" class="w-4 h-4"></i> Daftar sebagai Perusahaan
                    </button>
                </form>
            </div>

            <div id="back-button" class="hidden mt-6 pt-5 border-t border-gray-100 text-center">
                <button onclick="backToRole()" class="inline-flex items-center gap-1.5 text-xs text-gray-400 hover:text-mist">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Kembali ke pilihan akun
                </button>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
        function showForm(type) {
            document.getElementById('step-role').classList.add('hidden');
            document.getElementById('form-' + type).classList.remove('hidden');
            document.getElementById('back-button').classList.remove('hidden');
            document.getElementById('page-title').textContent = type === 'individu' ? 'Individu / Organisasi' : 'Daftar Perusahaan';
        }
        function backToRole() {
            document.getElementById('form-individu').classList.add('hidden');
            document.getElementById('form-perusahaan').classList.add('hidden');
            document.getElementById('step-role').classList.remove('hidden');
            document.getElementById('back-button').classList.add('hidden');
            document.getElementById('page-title').textContent = 'Buat Akun';
        }
    </script>
</body>
</html>
