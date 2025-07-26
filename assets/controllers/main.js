console.log('➡️ Main.js -> OK');
document.addEventListener('DOMContentLoaded', () => {
	console.log('📦 [check-js-loaded] DOM prêt');

	const checks = [
		{
			name: 'ClassicEditor',
			condition: () => typeof window.ClassicEditor !== 'undefined'
		},
		{
			name: 'jQuery',
			condition: () => typeof window.$ !== 'undefined'
		},
		{
			name: 'DataTables',
			condition: () => typeof window.$?.fn?.dataTable !== 'undefined'
		},
		{
			name: 'FontAwesome',
			condition: () => !!document.querySelector('link[href*="font-awesome"]') || !!document.querySelector('link[href*="fontawesome"]')
		}
	];

	checks.forEach(({ name, condition }) => {
		try {
			if (condition()) {
				console.log(`✅ ${name} chargé`);
			} else {
				console.warn(`❌ ${name} **non chargé** ou introuvable`);
			}
		} catch (err) {
			console.error(`❌ Erreur pendant le test de ${name}:`, err);
		}
	});
});