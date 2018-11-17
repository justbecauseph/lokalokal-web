<?php

namespace LokaLocal;

use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    protected $casts = [
        'amount' => 'double'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
