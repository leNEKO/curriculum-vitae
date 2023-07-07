<h3 class="text-uppercase">Expérience professionnelle</h3>

{{#experiences}}
<div class="section">
    <div class="row">
        <div class="col">
            <h4>
                <small>{{periode}}</small><br />
                {{poste}}<br />
                <small>@{{entreprise}}</small>
            </h4>
        </div>
    </div>
    {{#stackCollection}}
    <div class="row">
        <div class="col col-xs-12">
            <ul class="stack spaced">
                {{#competences}}
                <li>
                    {{#icons}}<i class="fa-fw {{icons}}"></i>{{/icons}}
                    {{#url}}
                    <a href="{{.}}" target="info">{{techno}}</a>
                    {{/url}}
                    {{^url}}
                    {{techno}}
                    {{/url}}
                </li>
                {{/competences}}
            </ul>
        </div>
    </div>
    {{/stackCollection}}
    <div class="row">
        {{#tacheCollection}}
        <ul>
            {{#taches}}
            <li>{{.}}</li>
            {{/taches}}
        </ul>
        {{/tacheCollection}}
    </div>
</div>
{{/experiences}}