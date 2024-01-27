<x-guest-layout>
    @section('title', $branch->name . " Plots for Sale | Fanaka Real Estate")
    <section class=" mt-4 py-8 bg-white">
        <div class="mx-auto md:w-4/5">
            <div class="md:mx-auto max-w-7xl">
                <div class="mx-auto max-w-2xl text-center">
                    <h1 class="text-5xl font-bold tracking-tight sm:text-2xl"> {{ $branch->name  }} Plots for Sale With Ready Ready Title Deeds</h1>
                </div>

                <livewire:project.website.location-projects :branch="$branch"/>

            </div>
        </div>

    </section>
</x-guest-layout>
