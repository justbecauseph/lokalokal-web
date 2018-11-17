<?php

namespace LokaLocal;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model {
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
