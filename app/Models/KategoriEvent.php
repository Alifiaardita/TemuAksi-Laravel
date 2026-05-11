<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriEvent extends Model
{
    protected $table = 'kategori_event';

    public $timestamps = false;

    protected $fillable = ['nama_kategori'];

    public function sponsors()
    {
        return $this->hasMany(Sponsor::class, 'kategori_id');
    }

    public function volunteerKegiatan()
    {
        return $this->hasMany(VolunteerKegiatan::class, 'kategori_id');
    }

    // Emoji icon helper
    public function getIkonAttribute(): string
    {
        return match($this->nama_kategori) {
            'Lingkungan'          => '🌿',
            'Pendidikan'          => '📚',
            'Kesehatan'           => '❤️',
            'Sosial & Kemanusiaan'=> '🤝',
            'Olahraga'            => '🏃',
            'Seminar Tech'        => '💻',
            'Music Festival'      => '🎵',
            'Startup Pitch'       => '🚀',
            'Charity Run'         => '🏅',
            'Desain Workshop'     => '🎨',
            default               => '📌',
        };
    }
}
