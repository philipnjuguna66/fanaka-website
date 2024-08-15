<section class="">
<a href="{{ $section->extra['url']  }}">
    <img
        loading="lazy"
        class="w-full object-cover"

        src="{{  \Illuminate\Support\Facades\Storage::url($section->extra['image']) }}"
        alt="{{ settings('site_name') }}"
    >
</a>
</section>
