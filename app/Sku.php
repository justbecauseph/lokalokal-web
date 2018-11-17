<?php

namespace LokaLocal;

use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
