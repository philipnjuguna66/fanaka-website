<?php

namespace App\Models;

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

}
