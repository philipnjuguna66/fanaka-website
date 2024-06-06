@php

    $styles  = "";

    if (str($videoUri)->contains('shorts'))
        {
            $styles = 'width=415 height=560';
        }

    $canAutoPlay  = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")) ;



        $videoUri = str($videoUri)
        ->replace("watch?v=", "")
        ->replace("https://www.youtube.com/", "https://www.youtube.com/embed/")
        ->replace("https://youtu.be/", "https://www.youtube.com/embed/")
        ->replace("https://www.youtube.com/embed/embed/", "https://www.youtube.com/embed/")
        ->replace("https://www.youtube.com/shorts/", "https://www.youtube.com/embed/")
        ->replace("https://www.youtube.com/embed/shorts/", "https://www.youtube.com/embed/")
        ->value();

@endphp

<iframe
    {{ $styles }}
    src="{{ $videoUri }}?rel=0&&mute=0&controls=0&autoplay={{ $autoplay && $canAutoPlay ?? false }}&loop=1"
    class="w-full aspect-video"
    frameborder="0"
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture;web-share"

    allowfullscreen>

</iframe>
