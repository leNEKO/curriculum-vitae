<h3 class="text-uppercase">Expérience professionnelle</h3>

{{#.}}
<div class="section">
    <div class="row">
        <div class="col">
            <h4>{{company}}
                <small>{{period}}</small><br />
                {{#experience}}
                {{job_title}}<br />
                <small>@{{company}}</small>
                {{/experience}}
            </h4>
        </div>
    </div>
    <div class="row">
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
            <li>{{.}}</li>
            {{/tasks}}
        </ul>
    </div>
    {{/experience}}
</div>
{{/.}}