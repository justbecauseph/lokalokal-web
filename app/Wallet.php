<?php

namespace LokaLocal;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model {
    protected $casts = [
        'amount' => 'double'
    ];

    protected $fillable = ['amount'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
