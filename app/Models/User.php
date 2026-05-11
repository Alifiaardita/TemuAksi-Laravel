<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'email',
        'password_hash',
        'role',
        'status'
    ];

    protected $hidden = [
        'password_hash',
        'remember_token'
    ];

    /*
    |--------------------------------------------------------------------------
    | Laravel Auth pakai password_hash
    |--------------------------------------------------------------------------
    */
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    public function userProfile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    public function companyProfile()
    {
        return $this->hasOne(CompanyProfile::class, 'user_id');
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'user_id');
    }

    public function sponsors()
    {
        return $this->hasMany(Sponsor::class, 'user_id');
    }

    public function pendanaan()
    {
        return $this->hasMany(Pendanaan::class, 'perusahaan_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Role Checker
    |--------------------------------------------------------------------------
    */

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPerusahaan()
    {
        return $this->role === 'perusahaan';
    }

    public function isOrganizer()
    {
        return $this->role === 'organizer';
    }

    /*
    |--------------------------------------------------------------------------
    | Nama Tampilan
    |--------------------------------------------------------------------------
    */

    public function getNamaAttribute()
    {
        if ($this->isPerusahaan()) {
            return optional($this->companyProfile)->nama_perusahaan ?? $this->email;
        }

        return optional($this->userProfile)->nama_lengkap ?? $this->email;
    }
}
