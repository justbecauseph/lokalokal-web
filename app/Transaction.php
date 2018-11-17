<?php

namespace LokaLocal;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
