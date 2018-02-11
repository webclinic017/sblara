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
                                 INDEX MOVER </span>
        </div>
        <ul class="nav nav-tabs">
            <li class="active" >
                <a class="reload" href="#positive_index_mover" data-toggle="tab" aria-expanded="false" > POSITIVE </a>
            </li>

            <li class="" >
                <a class="reload" href="#negative_index_mover" data-toggle="tab" aria-expanded="false" > NEGATIVE </a>
            </li>


        </ul>
    </div>
    <div class="portlet-body">
        <div class="tab-content">

                     <div class="tab-pane active" id="positive_index_mover">

                     <div class="table-scrollable">

                                 <table class="table table-striped table-bordered table-advance table-hover">

                                     <thead>

                                     <tr>
                                         <th>
                                              Company
                                         </th>
                                         <th>
                                             LTP
                                         </th>
                                         <th>
                                             YCP
                                         </th>
                                         <th>
                                             IND CHG
                                         </th>
                                         <th>
                                             VOL
                                         </th>

                                     </tr>

                                     </thead>

                                     <tbody>

                                     @foreach($indexmover['positive'] as $instrument)

                                     <tr>

                                         <td>

                                            @include('html.tooltip_chart',array('instrumentId'=>$instrument['instrument_id'],'instrument_code'=>$instrument['instrument_code']))
                                         </td>

                                        <td>
                                                  {{$instrument['ltp']}}
                                         </td>

                                         <td>
                                             {{$instrument['yday_close_price']}}
                                         </td>

                                         <td class="success">
                                             {{$instrument['final_index_change']}}
                                         </td>
                                         <td class="numeric">
                                             {{$instrument['volume']}}
                                         </td>


                                     </tr>

                                     @endforeach


                                     </tbody>

                                 </table>

                             </div>

                     </div>

                     <div class="tab-pane" id="negative_index_mover">

                     <div class="table-scrollable">

                                 <table class="table table-striped table-bordered table-advance table-hover">

                                     <thead>

                                     <tr>
                                         <th>
                                              Company
                                         </th>
                                         <th>
                                             LTP
                                         </th>
                                         <th>
                                             YCP
                                         </th>
                                         <th>
                                             IND CHG
                                         </th>
                                         <th>
                                             VOL
                                         </th>

                                     </tr>

                                     </thead>

                                     <tbody>

                                     @foreach($indexmover['negative'] as $instrument)

                                     <tr>

                                         <td>

                                            @include('html.tooltip_chart',array('instrumentId'=>$instrument['instrument_id'],'instrument_code'=>$instrument['instrument_code']))
                                         </td>

                                        <td>
                                                  {{$instrument['ltp']}}
                                         </td>

                                         <td>
                                             {{$instrument['yday_close_price']}}
                                         </td>

                                         <td class="danger">
                                             {{$instrument['final_index_change']}}
                                         </td>
                                         <td class="numeric">
                                             {{$instrument['volume']}}
                                         </td>


                                     </tr>

                                     @endforeach


                                     </tbody>

                                 </table>

                             </div>

                     </div>


        </div>


    </div>
</div>
