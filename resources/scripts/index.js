// Load styles
import 'swiper/scss';
import 'swiper/scss/navigation';
import 'swiper/scss/autoplay';
import '../styles/index.scss';

// Load scripts
import('./components/anchor-scroll');
import('./components/nav');
// import('./components/animations');

const accordionItems = document.querySelectorAll('.accordion');
if (accordionItems.length > 0) {
	import('./components/accordion')
		.then(initAccordion => initAccordion.initAccordion(accordionItems));
}

const swiperItems = document.querySelectorAll('.slider');
if (swiperItems.length > 0) {
	import('./components/slider')
		.then(slider => slider.slider(swiperItems));
}

const filterContainer = document.querySelector('#filter');
if (filterContainer) {
	import('./components/filter')
		.then(initFilter => initFilter.initFilter(filterContainer));
}

const readMoreButtons = document.querySelectorAll('.btn-read-more');
if (readMoreButtons.length > 0) {
	import('./components/read-more')
		.then(initReadMore => initReadMore.initReadMore(readMoreButtons));
}