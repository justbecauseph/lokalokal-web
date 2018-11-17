<?php

namespace LokaLocal;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

use Storage;

/**
 * LokaLocal\User
 *
 * @property-read mixed $avatar_url
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\LokaLocal\Transaction[] $transactions
 * @property-read \LokaLocal\Wallet $wallet
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\User newQuery()
 * @method static \Illuminate\Database\Query\Builder|\LokaLocal\User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\User query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\User role($roles)
 * @method static \Illuminate\Database\Query\Builder|\LokaLocal\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\LokaLocal\User withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string $avatar
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\User whereUpdatedAt($value)
 */
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar',
    ];

    protected $with = [
        'wallet', 'transactions'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'deleted_at', 'email_verified_at'
    ];

    protected $dates = ['deleted_at'];

    protected $appends = ['avatar_url'];

    public function getAvatarUrlAttribute()
    {
        return Storage::url('avatars/'.$this->id.'/'.$this->avatar);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
