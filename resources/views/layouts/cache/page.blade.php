<div class=" ">
    @foreach($page->sections as $section)
        @php $animationEffect = new \Illuminate\Support\HtmlString('');
           if ($loop->even && ($loop->iteration != 2  )){
               $animationEffect = new \Illuminate\Support\HtmlString('data-aos="fade-left" set="200" data-aos-easing="ease-in-sine" data-aos-duration="600"'); }
        @endphp
        @include($section->type->sectionPath() ,['section' => $section ,'animationEffect' => $animationEffect])
    @endforeach
</div>
