<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    protected $casts = [
        'due_at' => 'datetime',
        'returned_at' => 'datetime'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function reader()
    {
        return $this->belongsTo(Reader::class);
    }

    public function scopeActive($query)
    {
        return $query->whereNull('returned_at');
    }

    public function scopeReturned($query)
    {
        return $query->whereNotNull('returned_at');
    }

    public function scopeDue($query)
    {
        return $query->whereNotNull('due_at')->where('due_at', '<', now());
    }
}
