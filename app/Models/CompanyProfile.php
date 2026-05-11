<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $table = 'company_profiles';

    public $timestamps = false;

    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'user_id', 'nama_perusahaan', 'deskripsi',
        'bidang_industri', 'no_telepon', 'alamat',
        'website', 'ttd_stempel_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
