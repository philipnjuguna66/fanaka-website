<x-guest-layout title="Property for sale">


    <main class="relative bg-gray-50">



        <section class="bg-white sm:bg-gray-50 ">
            <div class="max-w-7xl mx-auto ">
                <div class=" pb-5 px-10 pt-24">
                    <h2 class="text-base leading-6 text-primary-900 text-center sm:text-3xl sm:font-extrabold">
                        Affordable Plots For Sale Within Nairobi Metropolis.
                    </h2>
                    <p class="mt-2  sm:text-2xl sm:font-light  text-center py-4">
                        We offer affordable and genuine land for sale along Kangundo Road ,Eastern Bypass, Mombasa Road
                        and
                        along Thika Road with Ready Title Deeds.
                    </p>
                </div>

                <div class="py-12 ">
                    <div id="paginated-data" class="mx-auto space-y-4  max-w-7xl px-2  ">
                        <h2 class="sr-only">Projects</h2>

                        <livewire:project.website.featured-project :projectIds="[80,78,75]" :grid="3"/>
                    </div>
                </div>

            </div>
        </section>


    </main>

</x-guest-layout>
