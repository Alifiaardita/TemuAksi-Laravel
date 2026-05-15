<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VolunteerKegiatan extends Model
{
    protected $table = 'volunteer_kegiatan';

    protected $fillable = [
        'kategori_id', 'judul', 'deskripsi', 'penyelenggara',
        'lokasi', 'tanggal_mulai', 'tanggal_selesai',
        'jam_mulai', 'jam_selesai', 'kuota', 'syarat',
        'status', 'gambar_url', 'created_by',
    ];

    protected $casts = [
        'tanggal_mulai'  => 'date',
        'tanggal_selesai'=> 'date',
    ];

    // Status constants
    const STATUS_AKTIF      = 'aktif';
    const STATUS_PENUH      = 'penuh';
    const STATUS_SELESAI    = 'selesai';
    const STATUS_DIBATALKAN = 'dibatalkan';

    public function kategori()
    {
        return $this->belongsTo(KategoriEvent::class, 'kategori_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function pendaftaran()
    {
        return $this->hasMany(VolunteerPendaftaran::class, 'kegiatan_id');
    }

    public function pendaftaranAktif()
    {
        return $this->pendaftaran()->where('status', '!=', 'ditolak');
    }

    public function volunteerPendaftaran()
    {
        return $this->hasMany(\App\Models\VolunteerPendaftaran::class, 'kegiatan_id');
    }

    // Badge CSS
    public function badgeClass(): string
    {
        return match($this->status) {
            'aktif'      => 'badge-aktif',
            'penuh'      => 'badge-penuh',
            'selesai'    => 'badge-selesai',
            'dibatalkan' => 'badge-batal',
            default      => '',
        };
    }

    public function badgeLabel(): string
    {
        return match($this->status) {
            'aktif'      => 'Dibuka',
            'penuh'      => 'Penuh',
            'selesai'    => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
            default      => $this->status,
        };
    }

    // Check apakah bisa didaftar
    public function bisaDaftar(): bool
    {
        return $this->status === self::STATUS_AKTIF;
    }
}
