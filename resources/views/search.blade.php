<link href="/css/search.css" type="text/css" rel="stylesheet">
<div class="se-search">
    
<form class="search" action="extra_search.html" method="GET">
    {{csrf_field()}}
    <div class="search-input">
        <input type="name" class="form-control" name="query" placeholder="Search..." id="top-search" autocomplete="off" style="background-color: #fff; width: 300px;">
    <a href="javascript:;" class="btn submit md-skip">
        <i class="fa fa-search"></i>
    </a>
    <a href="javascript:;" class="btn md-skip ">
        <i class="fa fa-gear show-search-options" style="right: 40px"></i>
    </a>


    </div>
</form>
<div class=" portlet box yellow search-result">
    <div class="portlet-body" style="padding-top: 0">
        <div class="tabbable-line" style="padding-top: 0">
            {{--  <ul class="nav nav-tabs ">
                <li class="active">
                    <a href="#tab_15_1" data-toggle="tab" data-search="company"> Company </a>
                </li>
                <li>
                    <a href="#tab_15_2" data-toggle="tab" data-search="news"> News </a>
                </li>
                <li>
                    <a href="#tab_15_3" data-toggle="tab" data-search="papernews"> Newspaper News </a>
                </li>
            </ul>
              --}}
            <div class="tab-content" style="padding:0">
                <div class="tab-pane active" id="tab_15_1" style="overflow:unset">
                    <div class="search-page search-content-2">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="search-container">
                                    <ul style="padding: 0px" class="company-search">
                                        <li class="search-item clearfix">
                                            <div class="search-content">
                                                <div class="row">
                                                    <div class="col-sm-4 col-xs-12">
                                                        <h2 class="search-title">
                                                            <a href="javascript:;">ABBANK</a>
                                                        </h2>
                                                        <p class="search-desc">
                                                            <a href="javascript:;">Minute Chart</a> |
                                                            <a href="javascript:;">TA Chart </a> |
                                                            <a href="javascript:;">TA Chart</a> |
                                                            <a href="javascript:;">Advance TA Chart</a>
                                                            <span class="font-grey-salt"></span>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="col-sm-3 col-xs-4">
                                                            <p class="text-center">LTP</p>
                                                            <p class="search-counter-label uppercase">362</p>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-4">
                                                            <p class="text-center">HIGH</p>
                                                            <p class="search-counter-label uppercase">79</p>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-4">
                                                            <p class="text-center">LOW</p>
                                                            <p class="search-counter-label uppercase">8</p>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-4">
                                                            <p class="text-center">YCP</p>
                                                            <p class="search-counter-label uppercase">8</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-8" style="margin-top: 10px;">
                                                        <div class="col-sm-3 col-xs-4">
                                                            <p class="text-center">%Change    </p>
                                                            <p class="search-counter-label uppercase">8</p>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-4">
                                                            <p class="text-center">TRADE</p>
                                                            <p class="search-counter-label uppercase">8</p>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-4">
                                                            <p class="text-center">VALUE</p>
                                                            <p class="search-counter-label uppercase">8</p>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-4">
                                                            <p class="text-center">VOLUME</p>
                                                            <p class="search-counter-label uppercase">8</p>
                                                        </div>
                                                    </div>
                                                </div>
                                        </li>                                      
                                        <li class="search-item clearfix">
                                            <div class="search-content">
                                                <div class="row">
                                                    <div class="col-sm-5 col-xs-12">
                                                        <h2 class="search-title">
                                                            <a href="javascript:;">ABBANK</a>
                                                        </h2>
                                                        <p class="search-desc">
                                                            <a href="javascript:;">Minute Chart</a> | 
                                                            <a href="javascript:;">TA Chart </a> |
                                                            <a href="javascript:;">TA Chart</a> |
                                                            <a href="javascript:;">Advance TA Chart</a>
                                                            <span class="font-grey-salt"></span>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="col-sm-3 col-xs-4">
                                                            <p class="text-center">LTP</p>
                                                            <p class="search-counter-label uppercase">362</p>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-4">
                                                            <p class="text-center">HIGH</p>
                                                            <p class="search-counter-label uppercase">79</p>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-4">
                                                            <p class="text-center">LOW</p>
                                                            <p class="search-counter-label uppercase">8</p>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-4">
                                                            <p class="text-center">YCP</p>
                                                            <p class="search-counter-label uppercase">8</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-8" style="margin-top: 10px;">
                                                        <div class="col-sm-3 col-xs-4">
                                                            <p class="text-center">%Change    </p>
                                                            <p class="search-counter-label uppercase">8</p>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-4">
                                                            <p class="text-center">TRADE</p>
                                                            <p class="search-counter-label uppercase">8</p>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-4">
                                                            <p class="text-center">VALUE</p>
                                                            <p class="search-counter-label uppercase">8</p>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-4">
                                                            <p class="text-center">VOLUME</p>
                                                            <p class="search-counter-label uppercase">8</p>
                                                        </div>
                                                    </div>
                                                </div>
                                        </li>                                      
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_15_2">
                    <div class="search-page search-content-2">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="search-container">
                                    <ul class="search-container">
                                        <li class="search-item clearfix">
                                            <div class="search-content text-left">
                                                <div class="row">
                                                    <div class="pull-left">
                                                        <h2 class="search-title">
                                                            <a href="javascript:;">AB Bank</a>
                                                        </h2>
                                                    </div>
                                                    <div class="pull-right">
                                                        <h4>13-12-2017</h4>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <p class="search-desc"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec efficitur pellentesque auctor. Morbi lobortis, leo in tristique scelerisque, mauris quam volutpat nunc </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="search-item clearfix">
                                            <div class="search-content text-left">
                                                <div class="row">
                                                    <div class="pull-left">
                                                        <h2 class="search-title">
                                                            <a href="javascript:;">AB Bank</a>
                                                        </h2>
                                                    </div>
                                                    <div class="pull-right">
                                                        <h4>13-12-2017</h4>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <p class="search-desc"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec efficitur pellentesque auctor. Morbi lobortis, leo in tristique scelerisque, mauris quam volutpat nunc </p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_15_3">
                    <div class="search-page search-content-2">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="search-container">
                                    <ul class="search-container">
                                        <li class="search-item clearfix">
                                            <div class="search-content text-left">
                                                <div class="row">
                                                    <div class="pull-left">
                                                        <h2 class="search-title">
                                                            <a href="javascript:;">নভেম্বরেও বাড়ল রেমিট্যান্স</a>
                                                        </h2>
                                                    </div>
                                                    <div class="pull-right">
                                                        <h4>13-12-2017</h4>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <p class="search-desc"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec efficitur pellentesque auctor. Morbi lobortis, leo in tristique scelerisque, mauris quam volutpat nunc </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="search-item clearfix">
                                            <div class="search-content text-left">
                                                <div class="row">
                                                    <div class="pull-left">
                                                        <h2 class="search-title">
                                                            <a href="javascript:;">নভেম্বরেও বাড়ল রেমিট্যান্স</a>
                                                        </h2>
                                                    </div>
                                                    <div class="pull-right">
                                                        <h4>13-12-2017</h4>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <p class="search-desc"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec efficitur pellentesque auctor. Morbi lobortis, leo in tristique scelerisque, mauris quam volutpat nunc </p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>     


</div>