<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Country
 * @package App\Domain
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $parent_id
 * @property float $lat
 * @property float $lng
 * @property string $code
 * @property Country $parent
 * @property Country[] $children
 */
class Country extends Model
{
    protected $fillable = ['name', 'slug', 'parent_id', 'lat', 'lng', 'code'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class,'parent_id','id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class,'parent_id','id');
    }

    public $timestamps = false;
}
