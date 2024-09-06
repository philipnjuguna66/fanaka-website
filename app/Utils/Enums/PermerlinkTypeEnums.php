<?php

namespace App\Utils\Enums;

enum PermerlinkTypeEnums : string
{
    case  PAGE = "page";

    case PROJECT= "project";

    case POST = "post";


    public function template()
    {
        return match ($this) {
            'default' => abort(404, "Not Found"),
            static::PAGE => "pages.single",
            static::POST => "pages.post.single",
            static::PROJECT => "pages.property.single",


        };
    }

    public function cacheTemplate()
    {
        return match ($this) {
            'default' => abort(404,'Not Found'),
            static::PAGE => "layouts.cache.page",
            static::POST => "layouts.cache.blog",
            static::PROJECT => "layouts.cache.property",


        };
    }
}
