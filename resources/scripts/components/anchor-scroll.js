document.querySelectorAll('a[href^="#"]').forEach(anchor => {
	anchor.addEventListener('click', function (e) {
		e.preventDefault();

		const href = this.getAttribute('href');
		if (href.length === 1) {
			return;
		}

		const yOffset = document.querySelector('.nav').offsetHeight,
			element = document.querySelector(this.getAttribute('href'));

		y = element.getBoundingClientRect().top + window.scrollY - yOffset;

		window.scrollTo({ top: y, behavior: 'smooth' });
	});
});