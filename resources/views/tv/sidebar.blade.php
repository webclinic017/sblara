                                                                        <div id="TVsidebar" class="col-md-2" style="padding: 0; display: none;">
                                                                                <div class="tree">
                                                                                        @include('tv.filterlist')
                                                                                        @include('tv.toplist')

                                                                                        <!-- watch list -->
                                                                                        <div class="panel-group accordion " id="watchLists">
                                                                                          
                                                                                            @if(!\Auth::guest())
                                                                                            @php $i = 0; @endphp
                                                                                                @foreach(request()->user()->watchlists as $portfolio)
                                                                                                    <div class="panel panel-default" id="{{$portfolio->id}}" style="position: relative;">
                                                                                                        <div class="panel-heading">
                                                                                                            <h4 class="panel-title">
                                                                                                                <a class="accordion-toggle accordion-toggle-styled {{$i != 0?"collapsed":""}}" data-toggle="collapse" data-parent="#watchLists" href="#{{$portfolio->id}}_watchList">  {{$portfolio->name}} 
                                                                                                                 </a>
                                                                                                            </h4>

                                                                                                        </div>
                                                                                                                                                            <div class="btn-group watchlist-options">
                                                        <a class="btn-sm " href="javascript:;" data-toggle="dropdown">
                                                            <i class="fa fa-bars" ></i>
                                                        </a>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li>
                                                                <a href="javascript:;" class="rename-watchlist" data-name="{{$portfolio->name}}" data-id="{{$portfolio->id}}">
                                                                    <i class="icon-pencil"></i> Rename </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;" data-id="{{$portfolio->id}}" class="delete-watchlist">
                                                                    <i class="icon-trash"></i> Delete
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>         
                                                                                                        <div id="{{$portfolio->id}}_watchList" class="panel-collapse {{$i == 0?"in":"collapse"}}">
                                                                                                            @php $i++ ; @endphp
                                                                                                            <div class="panel-body" >

                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endforeach
                                                                                                @if($i != 0)

                                                                                                                
                                                                                                                    <a style="width: 100%; text-align: center;" href="#" data-toggle="modal" data-target="#createWatchlist">Create watchlist</a>
                                                                                                           
                                                                                                @endif
                                                                                                @if($i == 0)
                                                                                                    <div class="panel panel-default">
                                                                                                        <div class="panel-heading">
                                                                                                            <h4 class="panel-title">
                                                                                                                <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#watchLists" href="#collapse_3_1"> Watchlists </a>
                                                                                                            </h4>
                                                                                                        </div>
                                                                                                        <div id="collapse_3_1" class="panel-collapse in">
                                                                                                            <div class="panel-body" >
                                                                                                                <p>Looks like you don't have any watchlist yet. <a href="#" data-toggle="modal" data-target="#createWatchlist">Create new watchlist</a>.</p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>                                                                                                
                                                                                                @endif
                                                                                            @else
                                                                                            <div class="panel panel-default">
                                                                                                <div class="panel-heading">
                                                                                                    <h4 class="panel-title">
                                                                                                        <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#portfolios" href="#collapse_3_1"> Watchlists </a>
                                                                                                    </h4>
                                                                                                </div>
                                                                                                <div id="collapse_3_1" class="panel-collapse in">
                                                                                                    <div class="panel-body" >
                                                                                                        <p> Please <a href="/login">login</a> to see your watchlists.</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            @endif

                                                                                        </div>       
                                                                                        <!-- watch list -->
                                                                                        
                                                                                        <!-- Portfolios -->

                                                                                        <div class="panel-group accordion " id="portfolios">
                                                                                          
                                                                                            @if(!\Auth::guest())
                                                                                            @php $i = 0; @endphp
                                                                                                @foreach(request()->user()->portfolios as $portfolio)
                                                                                                    <div class="panel panel-default" id="{{$portfolio->id}}">
                                                                                                        <div class="panel-heading">
                                                                                                            <h4 class="panel-title">
                                                                                                                <a class="accordion-toggle accordion-toggle-styled {{$i != 0?"collapsed":""}}" data-toggle="collapse" data-parent="#portfolios" href="#{{$portfolio->id}}_portfolio"> {{$portfolio->portfolio_name}} </a>
                                                                                                            </h4>
                                                                                                        </div>
                                                                                                        <div id="{{$portfolio->id}}_portfolio" class="panel-collapse {{$i == 0?"in":"collapse"}}">
                                                                                                            @php $i++ ; @endphp
                                                                                                            <div class="panel-body" >

                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endforeach
                                                                                                @if($i == 0)
                                                                                                    <div class="panel panel-default">
                                                                                                        <div class="panel-heading">
                                                                                                            <h4 class="panel-title">
                                                                                                                <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#portfolios" href="#collapse_3_1"> Portfolios </a>
                                                                                                            </h4>
                                                                                                        </div>
                                                                                                        <div id="collapse_3_1" class="panel-collapse in">
                                                                                                            <div class="panel-body" >
                                                                                                                <p>Looks like you don't have any portfolio yet. <a href="/portfolio/create">Create new portfolio</a>.</p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>                                                                                                
                                                                                                @endif
                                                                                            @else
                                                                                            <div class="panel panel-default">
                                                                                                <div class="panel-heading">
                                                                                                    <h4 class="panel-title">
                                                                                                        <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#portfolios" href="#collapse_3_1"> Portfolios </a>
                                                                                                    </h4>
                                                                                                </div>
                                                                                                <div id="collapse_3_1" class="panel-collapse in">
                                                                                                    <div class="panel-body" >
                                                                                                        <p> Please <a href="/login">login</a> to see you portfolios.</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            @endif

                                                                                        </div>                                                                                        
                                                                                        <!-- Portfolios -->
                                                                                        <!-- screeners -->

                                                                                        <div class="panel-group accordion " id="screeners">
                                                                                            @php $i = 0; @endphp
                                                                                          

                                                                                                    @foreach(\App\Screener::where('featured', 1)->get() as $portfolio)
                                                                                                    <div class="panel panel-default" id="{{$portfolio->id}}sb">
                                                                                                        <div class="panel-heading">
                                                                                                            <h4 class="panel-title">
                                                                                                                <a class="accordion-toggle accordion-toggle-styled {{$i != 0?"collapsed":""}}" data-toggle="collapse" data-parent="#screeners" href="#{{$portfolio->id}}sb_screener"> {!!$portfolio->name!!} </a>
                                                                                                            </h4>
                                                                                                        </div>
                                                                                                        <div id="{{$portfolio->id}}sb_screener" class="panel-collapse {{$i == 0?"in":"collapse"}}">
                                                                                                            @php $i++ ; @endphp
                                                                                                            <div class="panel-body" >

                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endforeach
                                                                                                @if($i == 0)
                                                                                                    <div class="panel panel-default">
                                                                                                        <div class="panel-heading">
                                                                                                            <h4 class="panel-title">
                                                                                                                <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#portfolios" href="#collapse_3_1"> Portfolios </a>
                                                                                                            </h4>
                                                                                                        </div>
                                                                                                        <div id="collapse_3_1" class="panel-collapse in">
                                                                                                            <div class="panel-body" >
                                                                                                                <p>Looks like you don't have any portfolio yet. <a href="/portfolio/create">Create new portfolio</a>.</p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>                                                                                                
                                                                                                @endif




                                                                                        </div>                                                                                            
                                                                                        <!-- / screeners -->

                                                                                        <!-- myscreeners -->

                                                                                        <div class="panel-group accordion " id="myscreeners">
                                                                                            @php $i = 0; @endphp
                                                                                          
                                                                                            @if(!\Auth::guest())
                                                                                                    @foreach(request()->user()->screeners as $portfolio)
                                                                                                    <div class="panel panel-default" id="{{$portfolio->id}}">
                                                                                                        <div class="panel-heading">
                                                                                                            <h4 class="panel-title">
                                                                                                                <a class="accordion-toggle accordion-toggle-styled {{$i != 0?"collapsed":""}}" data-toggle="collapse" data-parent="#myscreeners" href="#{{$portfolio->id}}_screener"> {!!$portfolio->name!!} </a>
                                                                                                            </h4>
                                                                                                        </div>
                                                                                                        <div id="{{$portfolio->id}}_screener" class="panel-collapse {{$i == 0?"in":"collapse"}}">
                                                                                                            @php $i++ ; @endphp
                                                                                                            <div class="panel-body" >

                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endforeach
                                                                                                @if($i == 0)
                                                                                                    <div class="panel panel-default">
                                                                                                        <div class="panel-heading">
                                                                                                            <h4 class="panel-title">
                                                                                                                <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#portfolios" href="#collapse_3_1"> My Screeners </a>
                                                                                                            </h4>
                                                                                                        </div>
                                                                                                        <div id="collapse_3_1" class="panel-collapse in">
                                                                                                            <div class="panel-body" >
                                                                                                                <p>Looks like you don't have any screener yet. <a href="/screeners/new">Create new screener</a>.</p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>                                                                                                
                                                                                                @endif
                                                                                            @else
                                                                                            <div class="panel panel-default">
                                                                                                <div class="panel-heading">
                                                                                                    <h4 class="panel-title">
                                                                                                        <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#portfolios" href="#collapse_3_1"> My Screeners </a>
                                                                                                    </h4>
                                                                                                </div>
                                                                                                <div id="collapse_3_1" class="panel-collapse in">
                                                                                                    <div class="panel-body" >
                                                                                                        <p> Please <a href="/login">login</a> to see you screeners.</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            @endif

                                                                                        </div>                                                                                            
                                                                                        <!-- / myscreeners -->

                                                                                </div>
                                                                                <div class="navigation">
                                                                                    
                                                                                </div>
                                                                        </div>