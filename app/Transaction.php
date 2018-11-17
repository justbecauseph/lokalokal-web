<?php

namespace LokaLocal;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {
    protected $casts = [
        'amount'        => 'double',
        'before_amount' => 'double',
        'after_amount'  => 'double'
    ];

    protected $with = [
        'sku', 'branch'
    ];

    protected $hidden = [
        'sku_id', 'branch_id', 'user_id'
    ];

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
