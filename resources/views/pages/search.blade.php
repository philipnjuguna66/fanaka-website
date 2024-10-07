<x-guest-layout>
    @section('title',"Fanaka Plots -Fanaka Real Estate Ltd")
    @section('description', "Affordable Plots for Sale along Thika Road, Kangundo Road, Mombasa Road")
    @push('metas')

        @meta('title',"Fanaka Plots -Fanaka Real Estate Ltd")
        @meta('description', "Affordable Plots for Sale along Thika Road, Kangundo Road, Mombasa Road")
    @endpush

    <section class="py-4">
        <div class="">
            <div class="mx-auto max-w-7xl">

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @foreach($results as $index => $result)
                        <div class="bg-white rounded-2xl shadow-md px-5 py-2">
                            <a href="{{ $result['url'] }}">
                                <div>
                                    <img
                                        src="{{ $result['featured_image'] }}"
                                        alt="{{ $result['title'] }}"
                                    >
                                    <div>
                                        {{ $result['title'] }}
                                    </div>


                                </div>
                            </a>

                            <a
                                href="{{ $result['url'] }}"
                                class="button"
                            >
                                View More Details
                            </a>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>


</x-guest-layout>
