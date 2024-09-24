<div class="shadow-md rounded-tl-2xl rounded-bl-2xl bg-white">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-0">
        <div class="col-span-4">
            <img class="rounded-tl-2xl rounded-bl-2xl object-cover"

                 src="{{ \Illuminate\Support\Facades\Storage::url($ceo->featured_image) }}" alt="{{ $ceo->name }}">

        </div>
        <div class="col-span-8">
            <h3 class="mt-6 text-lg font-semibold leading-8 tracking-tight text-gray-900">

                <a
                    href="{{ route('permalink.show', $ceo->link?->slug) }}">
                    {{ $ceo->name }} : {{ $ceo->title }}
                </a>

            </h3>
            <p class="prose">{{ str($ceo->body)->limit(200)->toHtmlString() }}</p>
        </div>
    </div>
</div>
