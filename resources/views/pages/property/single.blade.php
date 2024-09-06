<x-guest-layout>
    @section('title', str($page->meta_title)->headline()->title())
    @section('description', $page->meta_description)
    @if(isset($whatsApp->phone_number))
        @section('whatsApp', $whatsApp->phone_number)
    @endif
    @push('metas')

        @meta("title", $page->meta_title)
        @meta("description", $page->meta_description)
    @endpush


    @if(\Illuminate\Support\Facades\Cache::has($page::CACHE_KEY.".{$page->id}.html"))

        @php $html = \Illuminate\Support\Facades\Cache::get($page::CACHE_KEY.".{$page->id}.html") @endphp

        @include('layouts.cache.property',['page' => $page])

       {{-- {{ str($html)->toHtmlString() }}--}}
    @else
        @include('layouts.cache.property',['page' => $page])

    @endif



</x-guest-layout>
