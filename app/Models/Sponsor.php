<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $table = 'sponsor';

    public $timestamps = false;

    protected $fillable = [
        'user_id', 'nama', 'industri', 'deskripsi',
        'kategori_id', 'min_dana', 'max_dana', 'lokasi',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriEvent::class, 'kategori_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'sponsor_id');
    }
}
