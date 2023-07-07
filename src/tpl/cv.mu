<br class="noprint" />
<div class="container">
	<div id="header">
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				{{{adresse}}}
			</div>
			<div class="col-xs-12 col-sm-6 d-xs-block d-sm-none">
				<br />
				{{{info}}}
			</div>
			<div class="col-sm-6 text-right d-none d-sm-block">
				{{{info}}}
			</div>
		</div>
	</div>

	<br />

	<div class="cv">
		{{#data.education}}
		<div class="row">
			<div class="col-xs-6 col-sm-4">
				<h3 class="text-uppercase">Formation</h3>
				<h4>
					<small>
						<ul class="stack">
							{{#formations}}
							<li>
								{{title}}
								{{#comment}}<small><em>({{comment}})</em></small>{{/comment}}
							</li>
							{{/formations}}
						</ul>
					</small>
				</h4>
			</div>
			<div class=" col-xs-6 col-sm-8">
				<br class="d-sm-none" />
				<h3 class="text-uppercase">Langues</h3>
				<h4>
					<small>
						<ul class="stack">
							{{#languages}}
							<li>
								{{title}}
								{{#comment}}<small><em>({{comment}})</em></small>{{/comment}}
							</li>
							{{/languages}}
						</ul>
					</small>
				</h4>
			</div>
		</div>
		{{/data.education}}

		<hr />
		{{{experiences}}}
	</div>
</div>

<br />