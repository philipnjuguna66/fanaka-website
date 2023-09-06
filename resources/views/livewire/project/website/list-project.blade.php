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
                        <h3 class="mt-1 text-primary-500 text-lg md:text-2xl font-bold leading-6">
                            <a href="{{ route('permalink.show', $project->link?->slug) }}">
                                <span class="absolute inset-0 text-center"></span>
                                {{ $project->name }}
                            </a>
                        </h3>
                        <div>
                            <p class="flex flex-col md:flex-row justify-between gap-4">
                                <span class="font-bold text-secondary-500">Purpose</span>:
                                <span class="font-normal ">
                                {{ $project->purpose }}
                                </span>
                            </p>
                            <p class="flex flex-col md:flex-row justify-between gap-4">
                                <span class="font-bold text-secondary-500">Location: </span>
                                <span class="font-normal ">
                                    {{ $project->location }}
                                </span>
                            </p>

                            <p class="flex justify-center text-red-600 font-semibold">
                                Discounted Cash Price of {{  money($project->price , 'kes', true) }}
                            </p>
                        </div>
                        <div class="flex flex-row justify-center gap-4 w-auto">
                            <a class="mt-5 button
                            shadow-lg hover-shadow-2xl
                             @if($project->status == \App\Utils\Enums\ProjectStatusEnum::SOLD_OUT) bg-rose-600 @else bg-white text-secondary-500  @endif ">
                                View Details
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
