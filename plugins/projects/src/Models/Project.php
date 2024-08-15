<?php

namespace Appsorigin\Plots\Models;

use App\Models\Permalink;
use App\Models\Whatsapp;
use App\Utils\Concerns\InteractsWithPermerlinks;
use App\Utils\Enums\ProjectStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{

    use InteractsWithPermerlinks;

    const CACHE_KEY = "project";

    protected $with = [
        'link'
    ];
    public $casts = [
        'status' => ProjectStatusEnum::class,
        'gallery' => 'json',
        'amenities' => 'json',
        'extra' => 'json'
    ];

    public function branches(): BelongsToMany
    {
        return $this->belongsToMany(Location::class,'project_branches','project_id','location_id');
    }

    public function link()
    {
        return $this->morphOne(Permalink::class, 'linkable');
    }


    public function title() : Attribute
    {
        return  new Attribute(
            get: fn() => $this->name
        );
    }

    public function getPhoneNumber() : ?string
    {
        $locationIds =  $this->loadMissing('branches')->branches()?->pluck('location_id')->toArray();

        $ids = [];

        foreach ($locationIds as $locationId) {

            $ids[] = "$locationId";
        }

        return Whatsapp::query()
            ->whereJsonContains('location_tags', $ids)
            ->first()?->phone_number;
    }

}
