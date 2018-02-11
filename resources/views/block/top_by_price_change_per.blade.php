<style>
.popover{
    max-width:600px;
    height:350px;

}
</style>


<div class="portlet light" id="chart_portlet">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <i class="icon-pin font-green-sharp"></i>
                                 <span class="caption-subject font-green-sharp bold uppercase">
                                 TOP 10 </span>
        </div>
        <ul class="nav nav-tabs">
            <li class="active" >
                <a class="reload" href="#gainer" data-toggle="tab" aria-expanded="false" > GAINER </a>
            </li>

            <li class="" >
                <a class="reload" href="#loser" data-toggle="tab" aria-expanded="false" > LOSER </a>
            </li>


        </ul>
    </div>
    <div class="portlet-body">
        <div class="tab-content">

                     <div class="tab-pane active" id="gainer">
<div class="scroller" style="height:350px" data-rail-visible="1" data-always-visible="1"
     data-rail-color="yellow" data-handle-color="#a1b2bd">
    <div class="table-scrollable table-scrollable-borderless" id="gain_by_percentage">
        <!--<table class="table table-hover table-light">-->

        <table class="table table-hover flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    LTP
                </th>
                <th class="numeric">
                    YCP
                </th>
                <th class="numeric">
                    Change
                </th>
                <th class="numeric">
                    Volume
                </th>

            </tr>
            </thead>
            <tbody>


            @foreach($top_list_gainer as $instrument)
                <tr>
                    <td>


                        @include('html.tooltip_chart',array('instrumentId'=>$instrument->instrument_id,'instrument_code'=>$instrument->instrument_code))


                    </td>

                    <td>
                             {{cpOrLtp($instrument)}}
                    </td>

                    <td>
                            {{$instrument->yday_close_price}}
                    </td>


                    <td class="success">
                        {{round($instrument->pchange_per,2)}}%
                    </td>
                    <td class="numeric">
                        {{$instrument->total_volume}}
                    </td>


                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="scroller-footer">
</div>



                     </div>

                     <div class="tab-pane" id="loser">

<div class="scroller" style="height:350px" data-rail-visible="1" data-always-visible="1"
     data-rail-color="yellow" data-handle-color="#a1b2bd">
    <div class="table-scrollable table-scrollable-borderless" id="gain_by_percentage">
        <!--<table class="table table-hover table-light">-->

        <table class="table table-hover flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    LTP
                </th>
                <th class="numeric">
                    YCP
                </th>
                <th class="numeric">
                    Change
                </th>
                <th class="numeric">
                    Volume
                </th>

            </tr>
            </thead>
            <tbody>


            @foreach($top_list_losser as $instrument)
            @if($instrument->pchange_per<0)
                <tr>
                    <td>


                        @include('html.tooltip_chart',array('instrumentId'=>$instrument->instrument_id,'instrument_code'=>$instrument->instrument_code))


                    </td>

                    <td>
                             {{cpOrLtp($instrument)}}
                    </td>

                    <td>
                            {{$instrument->yday_close_price}}
                    </td>


                    <td class="danger">
                        {{round($instrument->pchange_per,2)}}%
                    </td>
                    <td class="numeric">
                        {{$instrument->total_volume}}
                    </td>


                </tr>
                @endif

            @endforeach
            </tbody>
        </table>
    </div>
</div>

                     </div>


        </div>


    </div>
</div>
