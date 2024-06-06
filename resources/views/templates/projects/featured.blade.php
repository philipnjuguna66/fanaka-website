<div class="  @if($section->extra['bg_white']  ) bg-white @endif py-12">
<div class="md:mx-auto max-w-7xl px-2 lg:px-8">
        <div class="mx-auto max-w-5xl text-center">
            <h1 class="text-xl  md:text-3xl font-bold tracking-tight"> {{ str($section->extra['heading'])->toHtmlString() }}</h1>
            <p class="py-3 text-lg leading-8 text-gray-600">{{ str($section->extra['subheading'])->toHtmlString() }}.</p>

        </div>
        <livewire:project.website.featured-project :projectIds="$section->extra['project_ids']"/>

    </div>
</div>





