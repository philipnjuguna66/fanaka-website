<div class="shadow-md rounded-2xl  bg-white mt-6">
    <div class="grid grid-cols-1">
        <div class="">
            <img class="rounded-full h-96 w-96 object-cover"

                 src="{{ \Illuminate\Support\Facades\Storage::url($team->featured_image) }}" alt="{{ $team->name }}">

        </div>
        <div class=" px-4 bg-primary-400">
            <h3 class="mt-6 text-lg font-semibold leading-8 tracking-tight text-gray-50">

                <a
                    href="{{ route('permalink.show', $team->link?->slug) }}">
                    {{ $team->name }} : {{ $team->title }}
                </a>

            </h3>
          {{--  <p class="prose">{{ str($team->body)->limit(700,'  <a class="button hover:bg-primary-400 text-white py-0.5 px-2 rounded-md"
                    href="'. route('permalink.show', $team->link?->slug) .'">
                Read More
                </a>')->toHtmlString() }}</p>--}}
        </div>
    </div>
</div>
