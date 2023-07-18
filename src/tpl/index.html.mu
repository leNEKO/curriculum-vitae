<!doctype html>
<html>
<title>{{title}}</title>

<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id={{gtag}}"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());

		gtag('config', '{{gtag}}');
	</script>

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	{{#stylesheets}}
	<link rel="stylesheet" href="{{url}}" integrity="{{integrity}}" crossorigin="anonymous" />
	{{/stylesheets}}
	{{#scripts}}
	<script async defer src="{{url}}"></script>
	{{/scripts}}
	{{{style}}}
	<script defer>
		const LANGS = ['fr', 'en'];
		const FALLBACK_LANG = 'en';

		function getAvailableLang() {
			for (const lang of LANGS) {
				if (navigator.language.includes(lang)) {
					return lang;
				}
			}

			return FALLBACK_LANG;
		}

		function showTranslation() {
			const availableLang = getAvailableLang();
			const translatedElements = document.querySelectorAll('[lang]');
			translatedElements.forEach(
				(element) => {
					if (element.getAttribute('lang') != availableLang) {
						element.style.display = 'none';
					}
				}
			);
		}

		window.addEventListener('DOMContentLoaded', showTranslation);
	</script>
</head>

<body>
	{{{content}}}

	<div id="bonus" class="noscreen">
		<div>
			<span lang="fr">J'</span><span lang="en">I </span><i class="fa-solid fa-heart"></i>
			<i class="fa-brands fa-rust"></i>
			&amp;
			<i class="fa-brands fa-python"></i>
		</div>
	</div>
</body>

</html>