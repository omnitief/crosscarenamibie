import { Swiper } from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';

export function slider(swiperItems) {
	swiperItems.forEach(slider => {

		if (slider.classList.contains('slider--reviews')) {
			const sliderEl = slider.querySelector('.swiper');
			new Swiper(sliderEl, {
				modules: [Navigation, Autoplay],
				slidesPerView: 'auto',
				watchSlidesProgress: true,
				loop: true,
				threshold: 10,
				spaceBetween: 40,
				simulateTouch: true,
				autoplay: {
					delay: 6000,
				},
			});
		} else if (slider.classList.contains('slider--team')) {
			const sliderEl = slider.querySelector('.swiper'),
				buttons = slider.querySelector('.slider__nav');

			let prev = false,
				next = false;

			if (buttons) {
				prev = buttons.querySelector('.prev');
				next = buttons.querySelector('.next');
			}

			new Swiper(sliderEl, {
				modules: [Navigation],
				slidesPerView: 'auto',
				spaceBetween: 40,
				loop: false,
				threshold: 10,
				navigation: {
					nextEl: next,
					prevEl: prev,
				},
			});
		} else if (slider.classList.contains('slider--logos')) {
			const sliderEl = slider.querySelector('.swiper');
			new Swiper(sliderEl, {
				modules: [Navigation, Autoplay],
				slidesPerView: 'auto',
				watchSlidesProgress: true,
				loop: true,
				threshold: 10,
				spaceBetween: 22,
				centeredSlides: true,
				simulateTouch: false,
				autoplay: {
					delay: 3000,
				},
			});
        } else if (slider.classList.contains('slider--gallery')) {
            const sliderEl = slider.querySelector('.swiper');
            const paginationEl = slider.querySelector('.swiper-pagination');
        
            new Swiper(sliderEl, {
                modules: [Autoplay, Pagination],
                slidesPerView: 'auto',
				watchSlidesProgress: true,
				loop: true,
				threshold: 10,
                spaceBetween: 22,
				centeredSlides: true,
                autoplay: {
                    delay: 5000,
                },
                pagination: {
                    el: paginationEl,
                    clickable: true,
                },
            });
        };
	});
}