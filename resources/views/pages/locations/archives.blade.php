<x-guest-layout>
    @section('title', $branch->name . " Plots for Sale")
    @if(isset($whatsApp->phone_number))
        @section('whatsApp', $whatsApp->phone_number)
    @endif
    <section class="py-8 bg-white">
        <div class="mx-auto md:w-4/5">
            <div class="md:mx-auto max-w-7xl">
                <div class="mx-auto max-w-2xl text-center">
                    <h1 class="text-2xl font-bold tracking-tight md:text-5xl"> {{ $branch->name  }} Plots for Sale With Ready Title Deed </h1>
                </div>

                <livewire:project.website.location-projects :branch="$branch"/>

            </div>
        </div>

    </section>
</x-guest-layout>
