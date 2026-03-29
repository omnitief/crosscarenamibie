export function initFilter(filterContainer) {
	const filterInputWrapper = document.getElementById('filter-input');
	const filterOutputWrapper = document.getElementById('filter-results');

	if (filterInputWrapper) {
		const selectFilters = filterInputWrapper.querySelectorAll('select');

		if (selectFilters) {
			selectFilters.forEach((select) => {
				select.addEventListener('change', () => {
					let value = select.value;
					searchObject.category.selected = value;
					searchObject.is_page = 1;
					getPosts(searchObject);
				});
			});
		}
	}

	let searchObject = {
		post_type: filterContainer.dataset.postType,
		component: filterContainer.dataset.card,
		is_page: false,
		category: {
			selected: 'all',
			taxonomy: 'category'
		}
	};

	filterPagination();

	updateValues();

	async function getPosts(filterObject) {
		const url = window.location.origin + '/wp-admin/admin-ajax.php?action=get_posts';

		let blocks = filterContainer.querySelectorAll('.article');
		blocks.forEach((item) => {
			item.classList.add('loading');
		});

		let formData = new FormData();
		formData.append('filter_object', JSON.stringify(filterObject));

		try {
			const response = await fetch(url, {
				method: 'POST',
				body: formData
			});

			if (response.ok) {
				const data = await response.json();
				updatePosts(data);
			} else {
				throw new Error('Something went wrong');
			}
		} catch (error) {
			console.error(error);
		}
	}

	function updatePosts(data) {
		// Update post HTML
		if (data.html) {
			filterOutputWrapper.innerHTML = data.html.join('');
		}

		// Update pagination
		if (data.pagination) {
			filterOutputWrapper.innerHTML += data.pagination;
			filterPagination();
		}

		updateValues();
	}

	function filterPagination() {
		let paginationLinks = document.querySelectorAll('.page-numbers'),
			post_type = filterContainer.dataset.posttype;

		paginationLinks.forEach((link) => {
			let pageIndex = link.dataset.pageIndex;

			link.addEventListener('click', (e) => {
				e.preventDefault();

				if (link.classList.contains('page-numbers--dots')) return;

				searchObject.is_page = pageIndex;

				jQuery('html, body').animate({
					scrollTop: jQuery(filterContainer).offset().top - 350
				}, 800);

				getPosts(searchObject);
			});
		});
	}

	function updateValues() {
		// Update URL and searchObject
		let currentUrl = new URL(window.location.href),
			params = new URLSearchParams(currentUrl.search);

		if (params.get('category') && searchObject.category.selected == 'all') {
			params.set('category', params.get('category'));
			searchObject.category.selected = params.get('category');
		} else if (searchObject.category.selected !== 'all') {
			params.set('category', searchObject.category.selected);
		}

		if (params.get('is_page') && searchObject.is_page === false) {
			params.set('is_page', params.get('is_page'));
			searchObject.is_page = params.get('is_page');
		} else if (searchObject.is_page !== false) {
			params.set('is_page', searchObject.is_page);
		} else {
			params.delete('is_page');
		}

		currentUrl.search = params;
		window.history.replaceState({}, '', currentUrl.href);
	}
}
