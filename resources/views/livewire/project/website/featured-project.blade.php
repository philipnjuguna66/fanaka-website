<div>
    <div
        class="mx-auto sm:px-4 mt-16 grid max-w-4xl grid-cols-1 gap-x-3 space-y-12 md:space-y-0  md:gap-y-0  lg:max-w-none lg:grid-cols-{{ $grid }}">

        @foreach($projects as $project)
            <article
                class="{{ $loop->even ? "bg-white" : "bg-gray-50" }}  border-b-4 border-b-secondary-400 flex flex-col items-start justify-between shadow-2xl shadow-gray-900/50 rounded-xl  flex-wrap-reverse inset-0">
                <div class="relative w-full">
                    <a href="{{ route('permalink.property.show', $project->link) }}">
                        <img
                            src="{{ \Illuminate\Support\Facades\Storage::url($project->featured_image) }}"
                            alt="{{ $project->name }}"
                            class="aspect-[16/9] w-full object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
                    </a>

                    <div class="absolute inset-0  ring-1 ring-inset ring-gray-900/10"></div>
                </div>
                <div class="flex relative mt-4 sm:h-48 flex-1 flex-col space-y-2 ">
                    <h3 class="font-semibold px-4 ">
                        <a href="{{ route('permalink.property.show', $project->link) }}" class="text-xl font-semibold">
                            Land for Sale In {{ $location = $project->branches?->first()?->name }}
                            - {{ $project->name }}
                        </a>
                    </h3>
                    <ul role="list" class="grid grid-cols-1 px-4  ">
                        <li class="overflow-hidden rounded">
                            <ul class="-my-3 divide-y divide-gray-100  py-4 text-md leading-6">

                                <li class="flex justify-between gap-x-4 py-3">
                                    <p class="text-gray-500">Location</p>
                                    <p class="text-gray-700">{{ $location }}</p>
                                </li>

                                <li class="flex justify-between gap-x-4 py-3">
                                    <p class="text-gray-500">Phone Number</p>
                                    <p class="text-gray-700">
                                        <a href="tel:{{ $project->getPhoneNumber() }}">{{ $project->getPhoneNumber() }} </a>
                                    </p>
                                </li>


                                <li class="flex justify-between gap-x-4 py-3">
                                    <p class="text-gray-500">Discounted Cash Price Of: </p>
                                    <p class="text-gray-700">
                                    <span class="flex justify-center text-red-600 font-semibold">
                                         Kes. {{ $project->price}}
                                    </span>
                                    </p>
                                </li>

                            </ul>
                        </li>
                    </ul>


                    <div class="flex  flex-col md:flex-row  justify-between gap-x-4 py-3 px-4">

                        <a href="{{ route('permalink.property.show', $project->link) }}"
                           aria-describedby="property-name"
                           class="mt-8 block rounded-md bg-red-500 px-3 py-2 text-center text-sm font-semibold leading-6 text-white shadow-sm hover:bg-primary-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">View
                            Details
                        </a>

                        <span class="md:hidden">
                             <a href="tel:{{ $project->getPhoneNumber() }}"
                                aria-describedby="property-name"
                                class="mt-8 block rounded-md bg-red-500 px-3 py-2 text-center text-sm font-semibold leading-6 text-white shadow-sm hover:bg-primary-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                 Talk To Relationship Manager
                             </a>
                        </span>

                        <span class="hidden md:block">
                             <a href="tel:{{ $project->getPhoneNumber() }}"
                                aria-describedby="property-name"
                                class="mt-8 block rounded-md bg-red-500 px-3 py-2 text-center text-sm font-semibold leading-6 text-white shadow-sm hover:bg-primary-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                 Talk To Relationship Manager
                             </a>
                        </span>


                    </div>
                </div>
            </article>

        @endforeach

    </div>


</div>
