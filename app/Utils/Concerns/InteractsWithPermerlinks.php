<?php

namespace App\Utils\Concerns;

use Appsorigin\Plots\Models\Location;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait InteractsWithPermerlinks
{
    public function branches(): BelongsToMany
    {
        return $this->belongsToMany(Location::class,'project_branches','project_id','location_id');
    }

    public function getTitle(): string
    {
        return str($this->title)->title();
    }

    public function getContent(): string
    {
        return $this->body;
    }

    public function getMetaTitle(): string
    {
        return str($this->meta_title)->headline()->value();
    }

    public function getMetaDescription(): string
    {
        return str($this->meta_description)->ucfirst()->value();
    }
}
