import './bootstrap';
import 'flowbite';
import AOS from 'aos';
import 'aos/dist/aos.css'; // You can also use <link> for styles

import HesGallery from "hes-gallery";

import Alpine from 'alpinejs'
import intersect from '@alpinejs/intersect'
import FormsAlpinePlugin from '../../vendor/filament/forms/dist/module.esm'
import NotificationsAlpinePlugin from '../../vendor/filament/notifications/dist/module.esm'

Alpine.plugin(FormsAlpinePlugin)
Alpine.plugin(NotificationsAlpinePlugin)
Alpine.plugin(intersect)

window.Alpine = Alpine

Alpine.start()
// You can also pass an optional settings object
// below listed default settings
AOS.init({
    // Global settings:
    disable: "mobile", // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
    startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
    initClassName: 'aos-init', // class applied after initialization
    animatedClassName: 'aos-animate', // class applied on animation
    useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
    disableMutationObserver: false, // disables automatic mutations' detections (advanced)
    debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
    throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)


    // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
    offset: 120, // offset (in px) from the original trigger point
    delay: 0, // values from 0 to 3000, with step 50ms
    duration: 400, // values from 0 to 3000, with step 50ms
    easing: 'ease', // default easing for AOS animations
    once: false, // whether animation should happen only once - while scrolling down
    mirror: false, // whether elements should animate out while scrolling past them
    anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation

});


HesGallery.setOptions({
    wrapAround: true,
    disableScrolling: true,
})

HesGallery.init({
    wrapAround: true,
    disableScrolling: true,
})
