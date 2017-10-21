<div class="container">
    <div class="row">
        <div class="col-xs-12">

            <h1>{{ greeting }}  {{ planet }}</h1>

            {{# things}}

            <h2> {{ . }} </h2>

            {{/ things}}

            {{ obj.props }}

            {{ site_url }}
        </div>
    </div>
</div>
