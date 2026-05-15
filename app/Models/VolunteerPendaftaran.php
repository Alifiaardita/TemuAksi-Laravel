<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VolunteerPendaftaran extends Model
{
    protected $table = 'volunteer_pendaftaran';

    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'user_id', 'kegiatan_id', 'nama_lengkap',
        'no_telepon', 'email', 'motivasi', 'pengalaman',
        'status', 'catatan_admin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kegiatan()
    {
        return $this->belongsTo(VolunteerKegiatan::class, 'kegiatan_id');
    }

    public function sertifikat()
    {
        return $this->hasOne(VolunteerSertifikat::class, 'pendaftaran_id');
    }

    public function volunteerKegiatan()
    {
        return $this->belongsTo(\App\Models\VolunteerKegiatan::class, 'kegiatan_id');
    }

    public function statusChipClass(): string
    {
        return match($this->status) {
            'menunggu' => 'chip-menunggu',
            'diterima' => 'chip-diterima',
            'ditolak'  => 'chip-ditolak',
            'selesai'  => 'chip-selesai',
            default    => '',
        };
    }

    public function statusIcon(): string
    {
        return match($this->status) {
            'menunggu' => '⏳',
            'diterima' => '✅',
            'ditolak'  => '❌',
            'selesai'  => '🏅',
            default    => '',
        };
    }

    public function statusLabel(): string
    {
        return match($this->status) {
            'menunggu' => 'Menunggu Konfirmasi',
            'diterima' => 'Diterima',
            'ditolak'  => 'Ditolak',
            'selesai'  => 'Selesai',
            default    => $this->status,
        };
    }
}
