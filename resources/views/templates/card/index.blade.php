<section  class="  @if($section->extra['bg_white']  ) bg-white @endif">
    <div class="  lg:py-24 py-4 md:mx-auto md:w-4/5">
        <div {{ $animationEffect }}  class="lg:mx-auto max-w-7xl px-6 lg:px-8">
            <div class="lg:mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">{{ $section->extra['heading'] }}</h2>
                <p class="mt-2 text-lg leading-8 text-gray-600">{{ $section->extra['subheading'] }}</p>
            </div>
            <div
                class="md:mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-4 lg:gap-y-20  lg:mx-0 lg:max-w-none lg:grid-cols-3">


                @foreach($section->extra['cards'] as $card)
                    <article class="flex flex-col items-start justify-between shadow-xl lg:shadow-gray-900/50 rounded-xl mt-0 py-0">

                        @if( isset($card['image']) && ! empty($card['image']))
                        <div class="relative w-full">
                            <img src="{{\Illuminate\Support\Facades\Storage::url($card['image']) }}" loading="lazy" alt="{{ $card['title'] }}"
                                 class="aspect-[16/9] w-full  bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
                            <div class="absolute inset-0  ring-1 ring-inset ring-gray-900/10"></div>
                        </div>
                        @endif

                        <div class="max-w-xl px-4">
                            <div class="group relative py-4">
                                <h3 class="lg:mt-3 text-lg font-semibold leading-6 group-hover:text-gray-600">

                                        <span class="absolute inset-0"></span>
                                        {{ $card['title'] }}
                                </h3>



                                @if(isset($card['has_modal']) && ! $card['has_modal'])

                                    <p class="mt-5 line-clamp-3 leading-6 text-gray-600">
                                        {{ $card['description'] }}
                                    </p>
                                @endif



                                @if(isset($card['has_modal']) && $card['has_modal'])
                                    <div class="mt-4 justify-end  py-4" x-data="{}">

                                        <button
                                            class="mb-4 button py-1 px-6 rounded-lg shadow-lg text-white absolute bottom-0 mt-4"
                                            @click="$dispatch('open-modal', { image: '{{  url(\Illuminate\Support\Facades\Storage::url($card['image'])) }}', headline: '{{ $card['title'] }}' ,
                                             content: '{{ trim( str($card['description'])->trim()->replace("'",'`')->toHtmlString()) }}' ,
                                              open: true,
                                              id: '{{ $loop->iteration }}'
                                              })">
                                            More Bio
                                        </button>


                                    </div>
                                @endif
                            </div>
                        </div>
                    </article>

                @endforeach


            </div>


            <div class=" ">
                <div class="px-6 py-2 sm:px-6 sm:py-1 lg:px-8">
                    <div class="md:mx-auto max-w-2xl text-center">
                        <div class="mt-10 flex items-center justify-center gap-x-6">

                            @if($section->extra['view_more_link'])
                                <a href="{{ $section->extra['view_more_link'] }}"
                                   class="text-sm font-semibold leading-6 text-gray-900">View more <span
                                        aria-hidden="true">→</span></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



    @push('scripts')

        <x-team_modal/>

    @endpush

</section>
