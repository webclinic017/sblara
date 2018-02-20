@foreach($portfolio_holdings as $transaction)


<div class="row">
        <div class="col-md-4">
            <div class="btn-group btn-group btn-group-justified">
                <a target="_blank" href="{{'/ta-chart?instrumentCode='.$transaction->instrument_code}}" class="btn red"> TA Chart  </a>
                <a target="_blank" href="{{'/company-details/'.$transaction->instrument_id}}" class="btn blue"> Company Details </a>

            </div>
         </div>
        <div class="col-md-4">
            <div class="btn-group btn-group btn-group-justified">
                <a target="_blank" href="{{'/fundamental-details/'.$transaction->instrument_id}}" class="btn green"> Fundamental Details </a>
                <a target="_blank" href="{{'/news/search?keyword=&instrument_id='.$transaction->instrument_id.'&from_date=&to_date='}}" class="btn red">{{$transaction->instrument_code}} News</a>

            </div>
         </div>
        <div class="col-md-4">
            <div class="btn-group btn-group btn-group-justified">
                <a target="_blank" href="{{'/minute-chart/'.$transaction->instrument_id}}" class="btn blue"> Minute Chart </a>
                <a target="_blank" href="{{'/advance-ta-chart?instrumentCode='.$transaction->instrument_code}}" class="btn green"> Advance TA Chart </a>



            </div>
         </div>
</div>
<div class="row">
<div class="col-md-12">

                    <div class="portlet light bordered">
                                      <div class="portlet-title tabbable-line">
                                            <div class="caption">
                                                <i class="icon-graph font-yellow-casablanca"></i>
                                                <span class="caption-subject bold font-yellow-casablanca uppercase">
                                                    {{$transaction->instrument_code}} : fundamentals </span>

                                              </div>
                                                <div class="tools">
                                                    <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.fundamental_summary:instrument_id={{$transaction->instrument_id}}" class="reload"></a>

                                                    <a href="" class="collapse">
                                                    </a>

                                                </a>
                                                <a href="" class="remove">
                                                </a>
                                            </div>
                                        </div>

                                    <div class="portlet-body">

                                    </div>


        </div>

        </div>

</div>
<div class="row">
        <div class="col-md-6">
            @include("block.share_holdings_chart",array("instrument_id"=>$transaction->instrument_id,"render_to"=>"share_holding_".$transaction->instrument_id))

         </div>
        <div class="col-md-6">
            <div class="search-page search-content-2">
                <div class="search-container ">
                    <ul class="search-container">
                    @foreach($portfolio_holding_news[$transaction->instrument_id] as $news)
                        <li class="search-item clearfix">
                            <div class="search-content text-left">
                                <h2 class="search-title">
                                    <a href="javascript:;">{{$transaction->instrument_code}} | {{$news->post_date}}</a>
                                </h2>
                                <p class="search-desc"> {{$news->details}} </p>
                            </div>
                        </li>
                    @endforeach
                    </ul>

                </div>
            </div>
        </div>


</div>

        @endforeach




<script>
$('.reload').click();
/*$('.collapse').click();*/

</script>
