<br class="noprint" />
<div class="container">
	<div id="header">
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				{{{address}}}
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
		{{#cv.education}}
		<div class="row">
			<div class="col-xs-6 col-sm-4" lang="fr">
				<h3 class="text-uppercase">Formation</h3>
				<h4>
					<small>
						<ul class="stack">
							{{#formations}}
							<li>
								{{#title}}{{fr}}{{/title}}
								{{#comment}}<small><em>{{fr}}</em></small>{{/comment}}
							</li>
							{{/formations}}
						</ul>
					</small>
				</h4>
			</div>
			<div class="col-xs-6 col-sm-4" lang="en">
				<h3 class="text-uppercase">Education</h3>
				<h4>
					<small>
						<ul class="stack">
							{{#formations}}
							<li>
								{{#title}}{{en}}{{/title}}
								{{#comment}}<small><em>{{en}}</em></small>{{/comment}}
							</li>
							{{/formations}}
						</ul>
					</small>
				</h4>
			</div>
			<div class=" col-xs-6 col-sm-8" lang="fr">
				<br class="d-sm-none" />
				<h3 class="text-uppercase">Langues</h3>
				<h4>
					<small>
						<ul class="stack">
							{{#languages}}
							<li>
								{{#title}}{{fr}}{{/title}}
								{{#comment}}<small><em>({{fr}})</em></small>{{/comment}}
							</li>
							{{/languages}}
						</ul>
					</small>
				</h4>
			</div>
			<div class=" col-xs-6 col-sm-8" lang="en">
				<br class="d-sm-none" />
				<h3 class="text-uppercase">Languages</h3>
				<h4>
					<small>
						<ul class="stack">
							{{#languages}}
							<li>
								{{#title}}{{en}}{{/title}}
								{{#comment}}<small><em>({{en}})</em></small>{{/comment}}
							</li>
							{{/languages}}
						</ul>
					</small>
				</h4>
			</div>
		</div>
		{{/cv.education}}

		<hr />
		{{{experiences}}}
	</div>
</div>

<br />