import 'bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const navbarToggle = document.querySelector('[aria-controls="navbarNav"]');
const navbarMenu = document.getElementById('navbarNav');

navbarToggle?.addEventListener('click', () => {
	const isExpanded = navbarToggle.getAttribute('aria-expanded') === 'true';

	navbarToggle.setAttribute('aria-expanded', String(!isExpanded));
	navbarMenu?.classList.toggle('show', !isExpanded);
});
