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

              @if($results)
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        @foreach($results as $index => $result)
                            <div class="bg-white rounded-2xl shadow-md">
                                <a href="{{ $result['url'] }}" target="_blank">
                                    <div>
                                        <img
                                            src="{{ $result['featured_image'] }}"
                                            class="w-full h-[250px] object-cover"
                                            alt="{{ $result['title'] }}"
                                        >
                                        <div class=" px-5 py-2">
                                            {{ $result['title'] }}
                                        </div>
                                    </div>
                                </a>

                                <div class="py-4 px-8">
                                    <a
                                        target="_blank"
                                        href="{{ $result['url'] }}"
                                        class="button"
                                    >
                                        View More Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                  <div class="h3 mx-auto text-center">
                      <p>No Result found for {{ request('query', old('query')) }}</p>
                  </div>
              @endif

            </div>
        </div>
    </section>


</x-guest-layout>
