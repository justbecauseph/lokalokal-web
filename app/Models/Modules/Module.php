<?php

namespace LokaLocal\Models\Modules;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

/**
 * LokaLocal\Models\Modules\Module
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Models\Modules\Module newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Models\Modules\Module newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Models\Modules\Module query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string $icon
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Models\Modules\Module whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Models\Modules\Module whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Models\Modules\Module whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Models\Modules\Module whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Models\Modules\Module whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Models\Modules\Module whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Models\Modules\Module whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LokaLocal\Models\Modules\Module whereUpdatedAt($value)
 */
class Module extends Model
{
    protected $guarded = ['id'];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
