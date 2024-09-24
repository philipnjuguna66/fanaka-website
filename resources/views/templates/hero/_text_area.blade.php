<div class="py-2 @if($hasBoxShadow) shadow-md px-2 border-b-2 bg-gray-50 border-b-secondary-400 @endif">

    <div class="prose  max-w-7xl">
        {{ str($html)->trim(' ')->toHtmlString() }}
    </div>


</div>
