<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use plugins\projects\src\Models\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Whatsapp extends Model
{
    use HasFactory;


    protected $casts = [
        'location_tags' => 'array'
    ];

    public function locations() : HasMany
    {
        return  $this
            ->hasMany(\Appsorigin\Plots\Models\Location::class,'location_tags');
    }

}
