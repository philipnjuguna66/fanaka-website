<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ url(\Illuminate\Support\Facades\Storage::url($options?->favicon))  }}">
    <link rel="shortcut icon" href="{{ url(\Illuminate\Support\Facades\Storage::url($options?->favicon))  }}">
    <title class="capitalize">@yield('title',config('app.name')) - {{ $options?->name  }}</title>
    <meta name="description" content="@yield('description', $options?->meta_description)">
    <link rel="canonical"
          href="@yield('cononical', url()->current())"/> @stack('metas') {{ str($styles)->toHtmlString() }} </head>
<body
    class="h-full bg-gray-100 text-gray-900 "> {!! app(\App\Settings\ScriptSettings::class)?->body !!} @include('layouts.partials.navigation',['options' => $options])
<div
    class="font-sans text-gray-900 "> {{ $slot }}
    @livewire('notifications')
</div>
@include('layouts.partials.slider_over')
@livewireScripts
@include('layouts.partials.footer')
@stack('scripts')
{!! app(\App\Settings\ScriptSettings::class)?->footer !!}
</body>
</html>
