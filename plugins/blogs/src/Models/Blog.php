<?php

namespace Appsorigin\Blog\Models;

use App\Events\BlogCreatedEvent;
use App\Models\Permalink;
use App\Utils\Concerns\InteractsWithPermerlinks;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    use InteractsWithPermerlinks;

    const CACHE_KEY = 'post';

    protected $casts = [
        'is_published' => 'boolean',
    ];

    protected $with = [
        'link',
    ];

    protected $dispatchesEvents = [
        BlogCreatedEvent::class,
    ];
    public function link()
    {
        return $this->morphOne(Permalink::class, 'linkable');
    }
}
