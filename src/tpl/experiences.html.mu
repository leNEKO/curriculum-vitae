<h3 class="text-uppercase" lang="fr">Expérience professionnelle</h3>
<h3 class="text-uppercase" lang="en">Work experience</h3>

{{#.}}
<div class="section">
    <div class="row">
        <div class="col">
            <h4>
                <small>{{period}}</small><br />
                {{#experience}}
                {{#job_title}}
                <span lang="fr">{{fr}}</span><span lang="en">{{en}}</span>
                {{/job_title}}<br />
                {{#company}}
                <small>
                    @
                    {{#link}}
                    <a href="{{.}}" target="info">{{name}}</a>
                    {{/link}}
                    {{^link}}
                    {{name}}
                    {{/link}}
                </small>
                {{/company}}
                {{/experience}}
            </h4>
        </div>
    </div>
    <div class=" row">
        <div class="col col-xs-12">
            <ul class="stack spaced">
                {{#technos}}
                <li>
                    {{#icon}}<i class="fa-fw {{.}}"></i>{{/icon}}
                    {{#link}}
                    <a href="{{link}}" target="info">{{name}}</a>
                    {{/link}}
                    {{^link}}
                    {{name}}
                    {{/link}}
                </li>
                {{/technos}}
            </ul>
        </div>
    </div>
    {{#experience}}
    <div class="row">
        <ul>
            {{#tasks}}
            <li>{{#.}}<span lang="fr">{{fr}}</span><span lang="en">{{en}}</span>{{/.}}</li>
            {{/tasks}}
        </ul>
    </div>
    {{/experience}}
</div>
{{/.}}