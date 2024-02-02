<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,200&display=swap" rel="stylesheet">


<!-- Scripts -->
@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles

{!! app(\App\Settings\ScriptSettings::class)?->header !!}
