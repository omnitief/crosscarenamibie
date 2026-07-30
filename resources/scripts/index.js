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

function initFileInputs() {

  const isNL = document.documentElement.lang.startsWith('nl');

  const defaultText = isNL
    ? 'Geen bestand gekozen'
    : 'No file chosen';

  const buttonText = isNL
    ? 'Bestand kiezen'
    : 'Choose file';

  document.querySelectorAll('.ginput_container_fileupload').forEach(function(wrapper) {

    const input = wrapper.querySelector('input[type="file"]');
    if (!input) return;

    let text = wrapper.querySelector('.file-name-text');
    let button = wrapper.querySelector('.file-upload-btn');

    if (!button) {
      button = document.createElement('button');
      button.type = 'button';
      button.className = 'file-upload-btn';
      button.innerText = buttonText;
      wrapper.appendChild(button);

      button.addEventListener('click', () => input.click());
    }

    if (!text) {
      text = document.createElement('span');
      text.className = 'file-name-text';
      wrapper.appendChild(text);
    }

    text.innerText = defaultText;

    if (!input.dataset.listenerAdded) {
      input.addEventListener('change', function() {
        text.innerText = this.files.length
          ? this.files[0].name
          : defaultText;

        text.classList.toggle('has-file', this.files.length > 0);
      });

      input.dataset.listenerAdded = 'true';
    }

  });
}

document.addEventListener('DOMContentLoaded', initFileInputs);
document.addEventListener('gform_post_render', initFileInputs);