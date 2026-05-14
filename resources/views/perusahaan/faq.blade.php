@extends('layouts.app')

@section('title', 'FAQ - TemuAksi')

@section('content')
<div class="min-h-screen grid md:grid-cols-2 bg-white">

    {{-- LEFT --}}
    <div class="bg-white px-12 py-20 flex items-start">
        <div>
            <h1 class="text-4xl md:text-5xl font-bold text-cornflower leading-tight">
                Frequently Asked Questions
            </h1>
            <p class="mt-6 text-gray-500">
                Temukan jawaban seputar penggunaan platform, event, dan volunteer.
            </p>
        </div>
    </div>

    {{-- RIGHT --}}
    <div class="bg-white px-8 py-20">
        <div class="max-w-xl space-y-4 mt-2">

            @foreach([
                ['Apa itu Temu Aksi untuk perusahaan?', 'Temu Aksi adalah platform yang membantu perusahaan menemukan dan mendanai kegiatan sosial dari organisasi atau komunitas yang mengajukan proposal secara langsung.'],
                ['Apa yang bisa dilakukan perusahaan di platform ini?', 'Perusahaan dapat meninjau proposal, menerima atau menolak pengajuan, memberikan pendanaan, serta memantau dan mengevaluasi kegiatan yang didanai.'],
                ['Bagaimana alur proposal masuk ke perusahaan?', 'Proposal diajukan oleh organisasi, kemudian masuk ke dashboard perusahaan untuk ditinjau. Jika disetujui, proses berlanjut ke pendanaan dan pelaksanaan kegiatan.'],
                ['Apa yang harus diperhatikan saat meninjau proposal?', 'Perusahaan perlu melihat tujuan kegiatan, dampak sosial, rincian anggaran, kredibilitas organisasi, serta timeline pelaksanaan kegiatan.'],
                ['Apakah perusahaan bisa menolak proposal?', 'Ya, perusahaan dapat menolak proposal jika tidak sesuai dengan kriteria atau visi perusahaan. Penolakan biasanya disertai alasan yang jelas.'],
                ['Bagaimana proses pendanaan dilakukan?', 'Setelah proposal disetujui, perusahaan dapat menyalurkan dana melalui sistem Temu Aksi yang dirancang aman dan transparan.'],
                ['Apakah perusahaan bisa memantau penggunaan dana?', 'Ya, perusahaan dapat memantau perkembangan kegiatan melalui update dan laporan yang dikirimkan oleh organisasi secara berkala.'],
                ['Apa yang terjadi setelah kegiatan selesai?', 'Organisasi akan mengirimkan laporan akhir berupa dokumentasi kegiatan dan penggunaan dana yang kemudian dapat ditinjau oleh perusahaan.'],
                ['Apakah perusahaan bisa memilih proposal tertentu saja?', 'Ya, perusahaan bebas memilih proposal yang sesuai dengan fokus, nilai, atau program CSR yang dimiliki.'],
                ['Bagaimana jika terjadi penyalahgunaan dana?', 'Perusahaan dapat melaporkan melalui sistem yang tersedia. Tim Temu Aksi akan melakukan investigasi dan mengambil tindakan sesuai kebijakan.'],
                ['Apakah organisasi yang mengajukan proposal sudah diverifikasi?', 'Ya, setiap organisasi akan melalui proses verifikasi untuk memastikan keaslian data dan kredibilitas sebelum proposal diterima.'],
                ['Apakah perusahaan mendapatkan laporan transparansi?', 'Ya, semua kegiatan yang didanai dilengkapi dengan laporan transparansi yang dapat diakses langsung oleh perusahaan melalui dashboard.'],
            ] as [$pertanyaan, $jawaban])
            <details class="group border-b border-gray-300 pb-4">
                <summary class="flex justify-between items-center cursor-pointer list-none font-semibold text-lg">
                    {{ $pertanyaan }}
                    <span class="text-2xl group-open:rotate-45 transition">+</span>
                </summary>
                <p class="mt-3 text-gray-600">{{ $jawaban }}</p>
            </details>
            @endforeach

        </div>
    </div>
</div>
@endsection