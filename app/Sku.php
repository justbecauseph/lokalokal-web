<?php

namespace LokaLocal;

use Illuminate\Database\Eloquent\Model;
use QrCode;

/**
 * LokaLocal\Sku
 *
 * @property-read \LokaLocal\Branch $branch
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Sku newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Sku newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Sku query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $desc
 * @property string $code
 * @property float $amount
 * @property string $avatar
 * @property int $branch_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Sku whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Sku whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Sku whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Sku whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Sku whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Sku whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Sku whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Sku whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Sku whereUpdatedAt($value)
 */
class Sku extends Model
{
    protected $casts = [
        'amount' => 'double'
    ];

    protected $appends = [
        'qr_code'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function getQrCodeAttribute()
    {
        return base64_encode(QrCode::size(500)->format('svg')->generate($this->code));
    }
}
