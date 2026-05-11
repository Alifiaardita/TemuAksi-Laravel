<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VolunteerSertifikat extends Model
{
    protected $table = 'volunteer_sertifikat';

    const UPDATED_AT = null;

    protected $fillable = [
        'pendaftaran_id', 'user_id', 'kegiatan_id',
        'nama_penerima', 'nik_nim', 'institusi',
        'nomor_sertifikat', 'tanggal_terbit', 'file_url',
    ];

    protected $casts = [
        'tanggal_terbit' => 'date',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(VolunteerPendaftaran::class, 'pendaftaran_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kegiatan()
    {
        return $this->belongsTo(VolunteerKegiatan::class, 'kegiatan_id');
    }
}
