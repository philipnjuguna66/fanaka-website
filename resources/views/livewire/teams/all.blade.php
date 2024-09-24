<div>




    @if($ceo)
        @include('templates.teams.ceo',['ceo' => $ceo])
    @endif



    <ul role="list" class="mx-auto mt-20 grid max-w-4xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-3 lg:mx-0 lg:max-w-none lg:grid-cols-3">

        @foreach($teams as $item)
            <li
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90"
            >



                @if(\App\Utils\Enums\TeamTypeEnum::MANAGEMENT == $item->type)
                    @include('templates.teams.management')

                    @else
                        <img class="rounded-2xl object-cover w-[800px] h-[500px]"

                             src="{{ \Illuminate\Support\Facades\Storage::url($item->featured_image) }}" alt="{{ $item->name }}">
                        <h3 class="mt-6 text-lg font-semibold leading-8 tracking-tight text-gray-900">

                            <a
                                href="{{ route('permalink.show', $item->link?->slug) }}">
                                {{ $item->name }} : {{ $item->title }}
                            </a>

                        </h3>
                @endif

            </li>
        @endforeach

    </ul>

    <div class="mx-auto max-w-4xl text-center mt-2 flex justify-end">
        {{ $teams->links() }}
    </div>
</div>
