<link href="/css/search.css" type="text/css" rel="stylesheet">
<form class="search" action="extra_search.html" method="GET">
    {{csrf_field()}}
    <input type="name" class="form-control" name="query" placeholder="Search..." id="top-search" autocomplete="false">
    <a href="javascript:;" class="btn submit md-skip">
        <i class="fa fa-search"></i>
    </a>
    <div class="search-result-ajax-top hidden">
        <div class="search-result-ajax">
            <div class="asp_group_header"></div>

            <div class="results">
                <div class="asp_spacer"></div>
            </div>
        </div>
    </div>
</form>