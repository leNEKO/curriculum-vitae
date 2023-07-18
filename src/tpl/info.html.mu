{{#job_title}}
<h5 lang="fr">
	{{fr}}
</h5>
<h5 lang="en">
	{{en}}
</h5>
{{/job_title}}

{{#available_date}}
<div>
	<i class="fa fa-clock"></i>
	<b lang="fr">Disponibilité</b><b lang="en">Availability</b><br />
	~ {{.}}
</div>
{{/available_date}}

{{#mobility}}
<div>
	<div lang="fr">
		<i class="fa fa-map"></i>
		<b>Mobilité géographique</b><br />
		{{{fr}}}
	</div>
	<div lang="en">
		<i class="fa fa-map"></i>
		<b>Mobility</b><br />
		{{{en}}}
	</div>
</div>
{{/mobility}}