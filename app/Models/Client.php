<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static self create(array $array)
 *
 */
class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact',
    ];


    public function resource(): HasMany
    {
        return $this->hasMany(Resource::class,'client_id');
    }

}
