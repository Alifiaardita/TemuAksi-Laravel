<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FaqCompanySeeder extends Seeder
{
    public function run()
    {
        $faqs = [
    [
        'pertanyaan' => 'Bagaimana cara mendaftarkan perusahaan kami di TemuAksi?',
        'detail'     => 'Daftarkan perusahaan kamu melalui halaman registrasi, pilih role Perusahaan, lalu lengkapi profil perusahaan termasuk nama, bidang usaha, dan kontak. Setelah verifikasi, akun perusahaan kamu siap digunakan.',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ],
    [
        'pertanyaan' => 'Apakah ada biaya untuk bergabung sebagai perusahaan sponsor di TemuAksi?',
        'detail'     => 'Tidak ada biaya pendaftaran. TemuAksi gratis untuk digunakan oleh perusahaan yang ingin berkontribusi mendanai kegiatan sosial dan event komunitas.',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ],
    [
        'pertanyaan' => 'Bagaimana keamanan data perusahaan kami dijamin oleh TemuAksi?',
        'detail'     => 'Data perusahaan kamu disimpan secara aman dan tidak dibagikan kepada pihak ketiga tanpa izin. TemuAksi menggunakan enkripsi standar industri untuk melindungi seluruh informasi yang tersimpan.',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ],
    [
        'pertanyaan' => 'Apakah perusahaan bisa memilih kategori kegiatan yang ingin didanai?',
        'detail'     => 'Ya, perusahaan bisa memfilter proposal berdasarkan kategori kegiatan sesuai fokus CSR perusahaan, seperti pendidikan, lingkungan, kesehatan, atau pemberdayaan masyarakat.',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ],
    [
        'pertanyaan' => 'Siapa yang bisa kami hubungi jika ada kendala teknis saat menggunakan platform TemuAksi?',
        'detail'     => 'Kamu bisa menghubungi tim support TemuAksi melalui tombol "Ajukan Pertanyaan" yang ada di halaman FAQ ini. Tim kami akan merespons pertanyaan kamu dalam 1x24 jam kerja.',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ],
];

        DB::table('faq_company')->insert($faqs);
    }
}
