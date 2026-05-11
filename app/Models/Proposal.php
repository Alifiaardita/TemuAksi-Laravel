<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $table = 'proposal';

    const UPDATED_AT = null; // tabel tidak punya updated_at

    protected $fillable = [
        'user_id', 'sponsor_id', 'judul', 'deskripsi',
        'kategori', 'lokasi', 'tanggal', 'target_dana',
        'status', 'file_proposal',
    ];

    protected $casts = [
        'tanggal'    => 'date',
        'created_at' => 'datetime',
    ];

    // Status constants
    const STATUS_TERKIRIM  = 'terkirim';
    const STATUS_PENDANAAN = 'pendanaan';
    const STATUS_SELESAI   = 'selesai';
    const STATUS_DITOLAK   = 'ditolak';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class, 'sponsor_id');
    }

    public function pendanaan()
    {
        return $this->hasMany(Pendanaan::class, 'proposal_id');
    }

    // Scopes
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Helper
    public function isEditable(): bool
    {
        return $this->status === self::STATUS_TERKIRIM;
    }

    public function badgeClass(): string
    {
        return match($this->status) {
            'terkirim'  => 'bg-yellow-500',
            'pendanaan' => 'bg-blue-500',
            'selesai'   => 'bg-green-500',
            'ditolak'   => 'bg-red-500',
            default     => 'bg-gray-400',
        };
    }
}
