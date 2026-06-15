@extends('layouts.app')

@section('title', 'FAQ')

@section('content')

<div x-data="{ openFaqForm: false }" class="max-w-6xl mx-auto px-6 py-10">

    {{-- HEADER --}}
    <div class="mb-10">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center shadow-md">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Frequently Asked Questions</h1>
        </div>
        <p class="text-gray-500 ml-13">Temukan jawaban seputar penggunaan platform, event, dan volunteer.</p>
    </div>

    <div class="grid md:grid-cols-5 gap-6">

        {{-- LEFT PANEL --}}
        <div class="md:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm p-7 flex flex-col justify-between">

            <div>
                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>

                <h2 class="text-xl font-bold text-gray-900 mb-2">Bantuan & Informasi</h2>
                <p class="text-sm text-gray-500 leading-relaxed">
                    Halaman FAQ ini membantu kamu memahami cara kerja TemuAksi — mulai dari pendaftaran, kegiatan, hingga sertifikat.
                </p>

                <div class="mt-6 space-y-2.5">
                    <div class="flex items-center gap-2.5 text-sm text-gray-500">
                        <svg class="w-4 h-4 text-blue-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        Jawaban cepat untuk pertanyaan umum
                    </div>
                    <div class="flex items-center gap-2.5 text-sm text-gray-500">
                        <svg class="w-4 h-4 text-blue-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        Informasi kegiatan & volunteer
                    </div>
                    <div class="flex items-center gap-2.5 text-sm text-gray-500">
                        <svg class="w-4 h-4 text-blue-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        Ajukan pertanyaan langsung ke tim
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <button
                    @click="openFaqForm = true"
                    class="flex items-center justify-center gap-2 w-full bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white px-5 py-3 rounded-xl font-medium text-sm transition-colors duration-150"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Ajukan Pertanyaan
                </button>
            </div>

        </div>

        {{-- RIGHT PANEL: ACCORDION --}}
        <div class="md:col-span-3 bg-white rounded-2xl border border-gray-100 shadow-sm p-7 space-y-2">

            <h2 class="text-base font-semibold text-gray-400 uppercase tracking-wide mb-4">Pertanyaan Umum</h2>

            <details class="group border border-gray-100 rounded-xl overflow-hidden">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-gray-800 list-none px-5 py-4 hover:bg-gray-50 transition-colors">
                    Apa itu TemuAksi?
                    <span class="w-7 h-7 rounded-full bg-gray-100 group-open:bg-blue-100 flex items-center justify-center shrink-0 transition-colors">
                        <svg class="w-4 h-4 text-gray-500 group-open:text-blue-600 group-open:rotate-180 transition-all duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </span>
                </summary>
                <div class="px-5 pb-4 pt-1 text-sm text-gray-600 leading-relaxed border-t border-gray-100">
                    TemuAksi adalah platform volunteer dan event management yang menghubungkan relawan dengan kegiatan sosial yang bermakna.
                </div>
            </details>

            <details class="group border border-gray-100 rounded-xl overflow-hidden">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-gray-800 list-none px-5 py-4 hover:bg-gray-50 transition-colors">
                    Bagaimana cara mendaftar?
                    <span class="w-7 h-7 rounded-full bg-gray-100 group-open:bg-blue-100 flex items-center justify-center shrink-0 transition-colors">
                        <svg class="w-4 h-4 text-gray-500 group-open:text-blue-600 group-open:rotate-180 transition-all duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </span>
                </summary>
                <div class="px-5 pb-4 pt-1 text-sm text-gray-600 leading-relaxed border-t border-gray-100">
                    Daftar menggunakan email atau Google, lalu lengkapi profilmu untuk mulai bergabung dengan kegiatan.
                </div>
            </details>

            <details class="group border border-gray-100 rounded-xl overflow-hidden">
                <summary class="flex justify-between items-center cursor-pointer font-semibold text-gray-800 list-none px-5 py-4 hover:bg-gray-50 transition-colors">
                    Apakah kegiatan gratis?
                    <span class="w-7 h-7 rounded-full bg-gray-100 group-open:bg-blue-100 flex items-center justify-center shrink-0 transition-colors">
                        <svg class="w-4 h-4 text-gray-500 group-open:text-blue-600 group-open:rotate-180 transition-all duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </span>
                </summary>
                <div class="px-5 pb-4 pt-1 text-sm text-gray-600 leading-relaxed border-t border-gray-100">
                    Sebagian besar kegiatan gratis, namun ada beberapa yang berbayar tergantung kebijakan organizer masing-masing.
                </div>
            </details>

        </div>

    </div>

    {{-- MODAL FORM --}}
    <div
        x-show="openFaqForm"
        x-transition.opacity
        class="fixed inset-0 bg-black/50 z-999 flex items-center justify-center p-4"
        style="display:none"
    >
        <div
            @click.away="openFaqForm = false"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            class="bg-white rounded-2xl p-8 w-full max-w-xl shadow-2xl"
        >
            {{-- Modal Header --}}
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">Kirim Pertanyaan</h2>
                </div>
                <button
                    type="button"
                    @click="openFaqForm = false"
                    class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-colors"
                >
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form action="{{ route('faq.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Pertanyaan</label>
                    <input
                        type="text"
                        name="pertanyaan"
                        required
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        placeholder="Tulis pertanyaan kamu..."
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Detail
                        <span class="text-gray-400 font-normal">(opsional)</span>
                    </label>
                    <textarea
                        name="detail"
                        rows="4"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition resize-none"
                        placeholder="Jelaskan lebih detail..."
                    ></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button
                        type="button"
                        @click="openFaqForm = false"
                        class="px-5 py-2.5 border border-gray-200 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 transition-colors"
                    >
                        Batal
                    </button>
                    <button
                        type="submit"
                        class="flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-medium transition-colors"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        Kirim
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection
