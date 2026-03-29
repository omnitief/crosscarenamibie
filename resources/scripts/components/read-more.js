export function initReadMore(buttons) {
	buttons.forEach(button => {
		button.addEventListener('click', () => {
			let dots = button.parentElement.querySelector('.dots'),
				readMoreText = button.parentElement.querySelector('.read-more');

			dots.classList.toggle('dn');
			readMoreText.classList.toggle('dn');
			button.innerHTML = button.innerHTML === 'Lees meer' ? 'Lees minder' : 'Lees meer';
		});
	});
}