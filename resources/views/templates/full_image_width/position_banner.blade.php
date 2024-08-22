<div>
    <div>
        <!-- Header -->
        <div class="relative">
            <div class="absolute inset-0 hidden sm:block">
                <img
                    src="{{ Storage::url($section->extra['image']) }}"
                    alt="Fanaka Real Estate Plots and Land for sale"
                    class="sm:h-full sm:w-full object-cover brightness-100" loading="lazy"
                />
                <div class="absolute inset-0 " aria-hidden="true"></div>
            </div>

            <div class="sm:h-[400px] sm:py-24"></div>
        </div>

        <!-- Overlapping cards -->
        <section class="relative  mx-auto sm:-mt-20 max-w-7xl px-4 lg:px-8" aria-labelledby="Properties">
            <h2 class="sr-only" id="selling-points">Contact us</h2>
            <div class="flex flex-row flex-wrap md:flex-nowrap  sm:flex-nowrap gap-4 justify-center">

                <div class="px-4 sm:hidden ">
                    {!! view('templates.embeded._video_iframe', ["autoplay" => false, 'videoUri' => trim($section->extra['video_path'])])->render() !!}
                </div>


                <li class="flex flex-col items-center space-x-1 bg-white z-10 shadow-xl shadow-secondary-500/50 px-3 rounded-2xl py-8">

                    <svg xmlns="http://www.w3.org/2000/svg" height="48" width="80" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="icon icon-tabler icons-tabler-outline icon-tabler-cash-banknote-off">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M9.88 9.878a3 3 0 1 0 4.242 4.243m.58 -3.425a3.012 3.012 0 0 0 -1.412 -1.405"/>
                        <path
                            d="M10 6h9a2 2 0 0 1 2 2v8c0 .294 -.064 .574 -.178 .825m-2.822 1.175h-13a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h1"/>
                        <path d="M18 12l.01 0"/>
                        <path d="M6 12l.01 0"/>
                        <path d="M3 3l18 18"/>
                    </svg>

                    <p class="font-bold text-base text-center sm:py-2">
                        No hidden charges
                    </p>
                </li>
                <li class="flex flex-col items-center space-x-1 bg-white z-10 shadow-xl shadow-secondary-500/50 px-3 rounded-2xl py-8">


                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="icon icon-tabler icons-tabler-outline icon-tabler-map-2">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5"/>
                        <path d="M9 4v13"/>
                        <path d="M15 7v5.5"/>
                        <path
                            d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z"/>
                        <path d="M19 18v.01"/>
                    </svg>


                    <p class="font-bold text-base text-center sm:py-2">
                        {{ __( "Affordable plots within Nairobi Metropolis") }}
                    </p>

                </li>
                <li class="flex flex-col items-center space-x-1 bg-white z-10 shadow-xl shadow-secondary-500/50 px-3 rounded-2xl py-8">


                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="icon icon-tabler icons-tabler-outline icon-tabler-heart-handshake">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"/>
                        <path
                            d="M12 6l-3.293 3.293a1 1 0 0 0 0 1.414l.543 .543c.69 .69 1.81 .69 2.5 0l1 -1a3.182 3.182 0 0 1 4.5 0l2.25 2.25"/>
                        <path d="M12.5 15.5l2 2"/>
                        <path d="M15 13l2 2"/>
                    </svg>


                    <p class="font-bold text-base text-center sm:py-2">

                        {{ __("Flexible payment terms: Cash and Lipa Mdogo Mdogo") }}


                    </p>
                </li>

                <li class="flex flex-col items-center space-x-1 bg-white z-10 shadow-xl shadow-secondary-500/50 px-3 rounded-2xl py-8">


                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-week">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"/>
                        <path d="M16 3v4"/>
                        <path d="M8 3v4"/>
                        <path d="M4 11h16"/>
                        <path d="M8 14v4"/>
                        <path d="M12 14v4"/>
                        <path d="M16 14v4"/>
                    </svg>

                    <p class="font-bold text-base text-center sm:py-2">
                        {{ __("Get Your Title Deed within 30-Working days") }}
                    </p>
                </li>
                <li class="flex flex-col items-center space-x-1 bg-white z-10 shadow-xl shadow-secondary-500/50 px-3 rounded-2xl py-8">


                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="icon icon-tabler icons-tabler-outline icon-tabler-photo-check">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M15 8h.01"/>
                        <path d="M11.5 21h-5.5a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v7"/>
                        <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l4 4"/>
                        <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l.5 .5"/>
                        <path d="M15 19l2 2l4 -4"/>
                    </svg>

                    <p class="font-bold text-base text-center sm:py-2">
                        {{ __('Genuine land: All the land we sell is owned by Fanaka Real Estate') }}
                    </p>
                </li>

            </div>
        </section>
    </div>
</div>
