<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

class Whatsapp extends Model
{
    use HasFactory;
    use HasJsonRelationships;


    protected $casts = [
        'location_tags' => 'json'
    ];


}
