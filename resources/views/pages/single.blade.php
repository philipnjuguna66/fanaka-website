<x-guest-layout>
    @section('title', str($page->meta_title)->headline()->title())
    @section('description', $page->meta_description)
    @push('metas')
        @meta("title", $page->meta_title)
        @meta("description", $page->meta_description)
    @endpush
    @if(\Illuminate\Support\Facades\Cache::has($page.".{$page->id}.html"))
        @php $html = \Illuminate\Support\Facades\Cache::get($page.".{$page->id}.html") @endphp

        {{ str($html)->toHtmlString() }}
    @else
        @include('layouts.cache.page',['page' => $page])

    @endif
</x-guest-layout>
