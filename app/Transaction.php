<?php

namespace LokaLocal;

use Illuminate\Database\Eloquent\Model;

/**
 * LokaLocal\Transaction
 *
 * @property-read \LokaLocal\Branch $branch
 * @property-read \LokaLocal\Sku $sku
 * @property-read \LokaLocal\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Transaction query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $type
 * @property float $amount
 * @property float $before_amount
 * @property float $after_amount
 * @property int|null $sku_id
 * @property int $user_id
 * @property int|null $branch_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Transaction whereAfterAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Transaction whereBeforeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Transaction whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Transaction whereSkuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Transaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Transaction whereUserId($value)
 */
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
