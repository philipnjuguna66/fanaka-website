<div class="bg-gray-50 md:py-12 md:mt-3 @if($section->extra['bg_white'] )  bg-white @endif">
    <div class="mx-auto w-4/5 max-w-7xl  lg:px-8">
        <div class="  grid grid-cols-1 md:grid-cols-{{ $section->extra['columns'] }}  gap-x-1 space-y-4 mt-4 py-4">
            @foreach($section->extra['columns_sections'] as $index => $columns)
                <div class="md:text-justify max-w-7xl">
                    @foreach($columns as $column)
                            <?php
                            $html = match ($column['type'])
                            {
                                "header" => view('templates.hero._header', ['heading' => $column['data']['heading'], "subheading" => $column['data']['subheading']])->render(),
                                "video" => view('templates.embeded._video_iframe', ["autoplay" => 0, 'videoUri' => $column['data']['video_path']])->render(),
                                "image" => view('templates.hero._image', ['image' => $column['data']['image'],'section' => $section])->render(),
                                "booking_form" => view('templates.hero._site')->render(),
                                "text_area" => view('templates.hero._text_area', ['html' => $column['data']['body']])->render(),
                                "slider" => view('templates.hero._slider', ['sliders' => $column['data']['body'],'page' => $page])->render(),
                                "default" => null,
                            };
                            ?>
                        {{ str($html)->toHtmlString() }}
                    @endforeach
                </div>

            @endforeach

        </div>
    </div>
</div>
