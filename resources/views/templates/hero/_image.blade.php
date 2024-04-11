<div class="dark:text-white py-4">

    <img
        loading="lazy"
        class="object-cover"
        alt="{{ $title }}"
        src="{{ \Illuminate\Support\Facades\Storage::url($image) }}">

    <div class="flex flex-wrap w-50 justify-center items-center py-2 leading-1">
        <span>{{ $title }}</span>
    </div>
</div>
