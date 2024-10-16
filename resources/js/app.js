import './bootstrap';
import Alpine from 'alpinejs';
import mask from '@alpinejs/mask';
import focus from '@alpinejs/focus'
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import VMasker from 'vanilla-masker/build/vanilla-masker.min.js'


// window.VMasker = VMasker;

Alpine.plugin(focus)
Alpine.plugin(mask);
Alpine.start();

window.Alpine = Alpine;


// window.flatpickr = flatpickr;

// Função para inicializar o Flatpickr
// function initializeFlatpickr() {
//     flatpickr(".datepicker", {
//         altInput: true,
//         altFormat: "d/m/Y",
//         dateFormat: "Y-m-d",
//     });
// }
//
// document.addEventListener("livewire:update", function() {
//     initializeFlatpickr();
// });
//




