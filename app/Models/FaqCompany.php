<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqCompany extends Model
{
    protected $table = 'faq_company';
    
    protected $fillable = [
        'user_id',
        'pertanyaan',
        'detail',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}