<x-guest-layout>
    @section('title', str($post?->meta_title)->headline()->title())
    @section('description', $post?->meta_description)
    @section('cononical', $post?->cononical)
    @push('metas')
        @meta("url",  route('permalink.show', $post->link->slug))
        @meta("type", "Article")
        @meta("title", $post?->meta_title)
        @meta("description", $post?->meta_description)
        @meta("image", asset(Illuminate\Support\Facades\Storage::url($post?->featured_image)))
    @endpush



    @if(\Illuminate\Support\Facades\Cache::has($post::CACHE_KEY.".{$post->id}.html"))

        {!! \Illuminate\Support\Facades\Cache::get($post::CACHE_KEY.".{$post->id}.html") !!}
    @else
        @include('layouts.cache.blog',['$post' => $post])

    @endif




</x-guest-layout>
