<div class="shadow-md rounded-md bg-white">
    <div class="grid grid-cols-1 sm:grid-col-12">
        <div class="col-span-4">
            <img class="rounded-2xl object-cover w-[800px] h-[500px]"

                 src="{{ \Illuminate\Support\Facades\Storage::url($ceo->featured_image) }}" alt="{{ $ceo->name }}">

        </div>
        <div class="col-span-8">
            <h3 class="mt-6 text-lg font-semibold leading-8 tracking-tight text-gray-900">

                <a
                    href="{{ route('permalink.show', $ceo->link?->slug) }}">
                    {{ $ceo->name }} : {{ $ceo->title }}
                </a>

            </h3>
        </div>
    </div>
</div>