<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    protected $casts = [
        'has_whatsapp' => 'boolean',
        'paid_deposit' => 'boolean',
    ];

    public function lendings()
    {
        return $this->hasMany(Lending::class);
    }
}
