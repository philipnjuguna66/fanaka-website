<div class=" @if($section->extra['bg_white'] )  bg-white @endif
 @if( isset($section->extra['hide_on']) && $section->extra['hide_on'] == "mobile") hidden md:block @endif
 @if( isset($section->extra['hide_on']) && $section->extra['hide_on'] == "desktop") block  md:hidden @endif
 ">
    <div {{ $animationEffect }} class="md:mx-auto md:w-4/5 max-w-7xl px-2 lg:px-8">

        <div class="mx-auto max-w-5xl text-center">
            <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">{{ $section->extra['heading'] ?? null }}</h1>

        </div>
        <div class="md:mx-auto md:max-w-5xl md:text-center text-start">
            <p class="mt-6 text-lg leading-8 prose text">
                {!!  $section->extra['sub_heading'] ?? null!!}
            </p>

        </div>

        <div class="mt-4 py-4 space-y-3.5">
            <div
                class="grid grid-cols-1  md:grid-cols-2 lg:grid-cols-{{ $section->extra['columns'] }} flex-wrap  gap-4">
                @foreach($section->extra['columns_sections'] as $index => $columns)
                    <div class="md:text-start md:max-w-7xl">
                        @foreach($columns as $column)
                                <?php

                                $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"] ?? null), "mobile"));

                                $html = match ($column['type']) {
                                    "header" => view('templates.hero._header', ['heading' => $column['data']['heading'], "subheading" => $column['data']['subheading']])->render(),
                                    "video" => view('templates.embeded._video_iframe', ["autoplay" => $column['data']['autoplay'] && $isMob && (isset($section->extra['hide_on']) && $section->extra['hide_on'] == "desktop") , 'videoUri' => $column['data']['video_path']])->render(),
                                    "image" => view('templates.hero._image', ['image' => $column['data']['image'], "title" => $column['data']['title'], 'section' => $section])->render(),
                                    "booking_form" => view('templates.hero._site', ['heading' => $column['data']['heading'] ?? null])->render(),
                                    "text_area" => view('templates.hero._text_area', ['html' => $column['data']['body'],'hasBoxShadow' => $column['data']['has_box_shadow'] ?? false])->render(),
                                    "sliders" => view('templates.hero._slider', ['sliders' => $column['data']['images'], 'page' => $page])->render(),
                                    "masonary_block" => view('templates.hero.masionary', ['masonrySections' => $column['data']['masonary_block'], 'page' => $page])->render(),
                                    default => null,
                                };
                                ?>
                            <div class="mx-auto md:px-2 py-4  max-w-7xl">

                                {{ str($html)->toHtmlString() }}
                            </div>

                        @endforeach
                    </div>

                @endforeach

            </div>
        </div>
    </div>
</div>
