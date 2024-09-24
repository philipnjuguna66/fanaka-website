<div class="shadow-md rounded-tl-2xl rounded-bl-2xl bg-white mt-6">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-0">
        <div class="col-span-4">
            <img class="rounded-tl-2xl rounded-bl-2xl object-cover"

                 src="{{ \Illuminate\Support\Facades\Storage::url($ceo->featured_image) }}" alt="{{ $ceo->name }}">

        </div>
        <div class="col-span-8 px-4">
            <h3 class="mt-6 text-lg font-semibold leading-8 tracking-tight text-gray-900">

                <a
                    href="{{ route('permalink.show', $ceo->link?->slug) }}">
                    {{ $ceo->name }} : {{ $ceo->title }}
                </a>

            </h3>
            <p class="prose">{{ str($ceo->body)->limit(700,'  <a class="button hover:bg-primary-400 text-white py-0.5 px-2 rounded-md"
                    href="'. route('permalink.show', $ceo->link?->slug) .'">
                Read More
                </a>')->toHtmlString() }}</p>
        </div>
    </div>
</div>
