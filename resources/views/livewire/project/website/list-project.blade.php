<div>
    <div class="mx-auto px-4 mt-16 grid max-w-4xl grid-cols-1 gap-x-8 gap-y-4 lg:max-w-none lg:grid-cols-{{ $grid }}">

        @foreach($projects as $project)
            <article class="flex flex-col items-start justify-between shadow-2xl shadow-gray-900/50 rounded-xl ">
                <div class="relative w-full">
                    <img
                        src="{{ \Illuminate\Support\Facades\Storage::url($project->featured_image) }}"
                        alt="{{ $project->name }}"
                        class="aspect-[16/9] w-full object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
                    <div class="absolute inset-0  ring-1 ring-inset ring-gray-900/10"></div>
                </div>
                <div class="max-w-xl py-2 ">
                    <div class="group relative py-4 px-4">
                        <h3 class="mt-1 text-lg md:text-2xl font-bold leading-6">
                            <a href="{{ route('permalink.show', $project->link?->slug) }}">
                                <span class="absolute inset-0 text-center"></span>
                                {{ $project->name }}
                            </a>
                        </h3>
                        <div>
                            <p class="flex">Purpose: {{ $project->purpose }}</p>
                            <p>Location: {{ $project->location }}</p>
                        </div>
                        <div class="flex flex-row justify-between gap-4 w-auto">

                            <p class="mt-5 line-clamp-3 text-sm leading-1  font-semibold">
                                {{  money($project->price , 'kes', true) }}
                            </p>
                            <a class="mt-5 @if($project->status == \App\Utils\Enums\ProjectStatusEnum::SOLD_OUT) bg-rose-600 @else  bg-primary-600 @endif button">
                                View project
                            </a>

                        </div>
                    </div>
                </div>
            </article>

        @endforeach



    </div>


    @if($take === 0  )
        <div class="py-4 mt-3">
            {{ $projects->links() }}
        </div>
    @endif



</div>
