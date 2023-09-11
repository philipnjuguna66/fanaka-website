<?php

namespace App\Models;

use App\Utils\Concerns\InteractsWithPermerlinks;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    use InteractsWithPermerlinks;

    const CACHE_KEY = 'tag';
}
