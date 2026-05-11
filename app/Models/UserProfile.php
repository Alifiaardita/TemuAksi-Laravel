<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profiles';

    public $timestamps = false;

    protected $fillable = [
        'user_id', 'nama_lengkap', 'username',
        'tanggal_lahir', 'gender', 'no_telepon', 'avatar_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
