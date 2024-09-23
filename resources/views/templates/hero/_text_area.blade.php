<div class="py-2 @if($hasBoxShadow) shadow-md px-2 py-2 border-b border-b-secondary-400 @endif">

    <div class="prose  md:text-justify max-w-7xl">
        {{ str($html)->trim(' ')->toHtmlString() }}
    </div>


</div>
