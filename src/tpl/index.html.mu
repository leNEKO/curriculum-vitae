<!doctype html>
<html lang="fr">
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
	<script defer async src="{{url}}"></script>
	{{/scripts}}
	{{{style}}}
</head>

<body>
	{{{content}}}

	<div id="bonus" class="noscreen">
		<div>
			J'<i class="fa-solid fa-heart"></i>
			<i class="fa-brands fa-rust"></i>
			&amp;
			<i class="fa-brands fa-python"></i>
		</div>
	</div>
</body>

</html>