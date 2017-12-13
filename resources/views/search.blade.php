<link href="/css/search.css" type="text/css" rel="stylesheet">
<form class="search" action="extra_search.html" method="GET">
    {{csrf_field()}}
    <input type="name" class="form-control" name="query" placeholder="Search..." id="top-search" autocomplete="false" style="background-color: #EEF1F5; width: 300px;">
    <a href="javascript:;" class="btn submit md-skip">
        <i class="fa fa-search"></i>
    </a>
    <a href="javascript:;" class="btn md-skip ">
        <i class="fa fa-gear show-search-options" style="right: 40px"></i>
    </a>
    <div class="search-result-options hidden">
        <div class="form-group">
            <div class="mt-checkbox-list">
                <label class="mt-checkbox"> Exact match only
                    <input type="checkbox" value="1" name="exact_match" />
                    <span></span>
                </label>
                <label class="mt-checkbox"> Search in title (code)
                    <input type="checkbox" value="1" name="title_search" />
                    <span></span>
                </label>
            </div>
        </div>
    </div>
    <div class="search-result-ajax-top hidden">
        <div class="search-result-ajax">
            <div class="asp_group_header"></div>

            <div class="results">
                <div class="asp_spacer"></div>
            </div>
        </div>
    </div>
</form>