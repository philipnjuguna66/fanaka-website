<section class="  @if($section->extra['bg_white']  ) bg-white @endif py-12">
<div class="md:mx-auto max-w-7xl px-2 lg:px-8">
        <div>
            <div class="mx-auto max-w-5xl text-center">
                <h1 class="text-xl  md:text-3xl font-bold tracking-tight"> {{ str($section->extra['heading'])->toHtmlString() }}</h1>

            </div>
            <div class="mx-auto sm:max-w-5xl">
                <p class="py-3 px-8 text-lg leading-8 text-gray-600 sm:text-center">{{ str($section->extra['subheading'])->toHtmlString() }}</p>
            </div>
        </div>
        <livewire:project.website.featured-project :projectIds="$section->extra['project_ids']"/>



    @if(isset($section->extra['project_link']) && ! is_null($section->extra['project_link']))

        <div class=" ">
            <div class="px-6 py-2 sm:px-6 sm:py-1 lg:px-8">
                <div class="md:mx-auto max-w-2xl text-center">
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <a
                            href="{{ route('permalink.show', $section->extra['project_link']) }}"
                            class="button">
                            View more Projects <span aria-hidden="true">→</span></a>
                    </div>
                </div>
            </div>
        </div>

    @endif

    </div>
</section>





