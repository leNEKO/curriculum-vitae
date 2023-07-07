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
				<a href="{{url}}">{{url}}</a>
				<i class="fas fa-arrow-left"></i> ce CV à jour
			</small>
		</div>
	</div>

</address>