<?php

namespace LokaLocal;

use Illuminate\Database\Eloquent\Model;

/**
 * LokaLocal\Branch
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\LokaLocal\Transaction[] $transactions
 * @property-read \LokaLocal\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Branch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Branch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Branch query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $latitude
 * @property string $longitude
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Branch whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Branch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Branch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Branch whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Branch whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Branch whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Branch whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Branch whereUserId($value)
 */
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
