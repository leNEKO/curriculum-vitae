<address>
	<h5>
		{{firstname}} {{lastname}}
	</h5>

	<div>
		{{#address}}
		<i class="fas fa-map-marker-alt fa-fw"></i>
		<a href="{{gmap}}" target="map" class="text-uppercase">
			{{cp}} {{city}}
		</a>
		{{/address}}
	</div>

	<div>
		<i class="fas fa-fw fa-envelope"></i>
		<a href="mailto:{{email}}">{{email}}</a>
	</div>

	<div>
		<div>
			<i class="fab fa-fw fa-github-alt"></i>
			<small><a href="{{github}}">{{github}}</a></small>
		</div>
		<div class="noscreen">
			<br />
			<small>
				<a href="{{website}}">{{website}}</a>
				<i class="fas fa-arrow-left"></i>
				<span lang="fr">ce CV à jour</span>
				<span lang="en">this CV up to date</span>
			</small>
		</div>
	</div>

</address>