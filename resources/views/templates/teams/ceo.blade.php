<div class="shadow-md rounded-md bg-white">
    <div class="grid grid-cols-1 md:grid-col-12">
        <div class="col-span-3">
            <img class="rounded-2xl object-cover w-[200px] h-[200px]"

                 src="{{ \Illuminate\Support\Facades\Storage::url($ceo->featured_image) }}" alt="{{ $ceo->name }}">

        </div>
        <div class="col-span-8">
            <h3 class="mt-6 text-lg font-semibold leading-8 tracking-tight text-gray-900">

                <a
                    href="{{ route('permalink.show', $ceo->link?->slug) }}">
                    {{ $ceo->name }} : {{ $ceo->title }}
                </a>

            </h3>
            <p>{{ str($ceo->body)->limit(200)->toHtmlString() }}</p>
        </div>
    </div>
</div>
