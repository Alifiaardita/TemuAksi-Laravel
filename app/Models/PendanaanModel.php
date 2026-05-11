<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendanaan extends Model
{
    protected $table = 'pendanaan';

    const UPDATED_AT = null;
    const CREATED_AT = 'tanggal';

    protected $fillable = ['proposal_id', 'perusahaan_id', 'jumlah_dana'];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'proposal_id');
    }

    public function perusahaan()
    {
        return $this->belongsTo(User::class, 'perusahaan_id');
    }
}
