export function initAccordion(accordionItems) {
	setTimeout(() => {
		window.dispatchEvent(new Event('resize'));
	}, 150);

	accordionItems.forEach((accordion, i) => {
		accordion.querySelectorAll('.accordion__item').forEach((accordion_item, i) => {
			let header = accordion_item.querySelector('.accordion__item__header');
			let body = accordion_item.querySelector('.accordion__item__body');
			let bodyInner = accordion_item.querySelector('.accordion__item__body__inner');

			body.style.maxHeight = bodyInner.offsetHeight + 'px';

			window.addEventListener('resize', function () {
				body.style.maxHeight = bodyInner.offsetHeight + 'px';
			})

			header.addEventListener('click', function () {
				let changeClass = false;

				if (!body.classList.contains('accordion__item__body--active')) {
					changeClass = true;
				}

				if (changeClass) {
					body.classList.add('accordion__item__body--active')
					header.classList.add('accordion__item__header--active')
				} else {
					body.classList.remove('accordion__item__body--active')
					header.classList.remove('accordion__item__header--active')
				}
			})

		});
	});
}