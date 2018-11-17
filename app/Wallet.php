<?php

namespace LokaLocal;

use Illuminate\Database\Eloquent\Model;

/**
 * LokaLocal\Wallet
 *
 * @property-read \LokaLocal\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Wallet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Wallet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Wallet query()
 * @mixin \Eloquent
 * @property int $id
 * @property float $amount
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Wallet whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Wallet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Wallet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Wallet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Wallet whereUserId($value)
 */
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
