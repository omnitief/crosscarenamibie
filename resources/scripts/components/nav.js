const nav = document.querySelector('.nav'),
	button = document.getElementById('toggle-menu'),
	dropdownBackBtn = nav.querySelectorAll('.nav__submenu__back'),
	buttonSpan = button.querySelector('span[data-toggle-title]'),
	buttonSpanTitleClose = buttonSpan.dataset.toggleTitle,
	buttonSpanTitleOpen = buttonSpan.innerText;

button.addEventListener('click', () => {
	document.body.classList.toggle('menu-is-open');

	buttonSpan.innerText = buttonSpan.innerText == buttonSpanTitleOpen ? buttonSpanTitleClose : buttonSpanTitleOpen;
});

window.addEventListener('scroll', () => {
	if (window.scrollY > 30) {
		nav.classList.add('fixed');
	} else {
		nav.classList.remove('fixed');
	}
});

setTimeout(() => {
	const dropdownBtns = nav.querySelectorAll('.icon-dropdown');

	dropdownBtns.forEach(button => {
		let subMenu = button.parentElement.nextElementSibling;

		if (subMenu) {
			let backBtn = '<div class="nav__submenu__back f f-c ff-primary"><i class="icon icon-dropdown back pr"></i>Terug</div>';

			subMenu.insertAdjacentHTML('afterbegin', backBtn);

			let backBtnEl = subMenu.querySelector('.nav__submenu__back');
			backBtnEl.addEventListener('click', () => {
				button.parentElement.parentElement.classList.remove('active-submenu');
			});
		}

		button.addEventListener('click', () => {
			button.parentElement.parentElement.classList.add('active-submenu');
		});
	});

	window.dispatchEvent(new Event('resize'));
}, 10);