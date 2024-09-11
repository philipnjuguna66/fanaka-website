<x-guest-layout>
    @section('title', str($page->meta_title)->headline()->title())
    @section('description', $page->meta_description)
    @section('whatsApp', $whatsApp)
    @push('metas')
        <base href="https://fanaka.co.ke/">
        @meta("title", $page->meta_title)
        @meta("description", $page->meta_description)
    @endpush
    <div class="mt-0">

        @if(\Illuminate\Support\Facades\Cache::has(\App\Models\Page::CACHE_KEY.".{$page->id}.html"))

            {!! \Illuminate\Support\Facades\Cache::get(\App\Models\Page::CACHE_KEY.".{$page->id}.html") !!}
        @else
            @include('layouts.cache.page',['page' => $page])

        @endif

      {{--  --}}
    </div>
</x-guest-layout>
