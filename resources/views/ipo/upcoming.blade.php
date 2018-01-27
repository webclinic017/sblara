@extends('layouts.metronic.default')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    List of Upcoming IPO[s]
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body">
                
            @if(count($ipos) == 0)
            Currently there is no IPO. Please check again later.
            @endif
                @foreach( $ipos as $ipo )
                <div class="panel-group accordion show" id="ipo-accordion_{{$ipo->id}}">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle  @if($loop->first) first-accordion @endif " data-toggle="collapse" data-parent="#accordion1" href="#collapse_{{$ipo->id}}" aria-expanded="true"> <span><h3>{{$ipo->ipo_name}}</h3></span> <br>
                                    <span>Subscription Open: <b>{{\Carbon\Carbon::parse($ipo->subscription_open)->format('F d, Y')}}</b> </span>
                                    <span>Subscription Close: <b>{{\Carbon\Carbon::parse($ipo->subscription_close)->format('F d, Y')}}</b> </span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse_{{$ipo->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <div class="col-md-4">
                                    <table>
                                        <tr>
                                            <td width="120px;"><strong>Proposed Share</strong></td>
                                            <td>: {{$ipo->proposed_share}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Face Value</strong></td>
                                            <td>: {{$ipo->share_price}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Offered Value</strong></td>
                                            <td>: {{$ipo->offeredValue}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Market Lot</strong></td>
                                            <td>: {{$ipo->lot}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>EPS</strong></td>
                                            <td>: {{$ipo->eps}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-8">
                                    <strong>Nature of Businesss :</strong>
                                    <p>{{$ipo->nature_of_business}}</p>
                                    <strong>Major Product :</strong>
                                    <p>{{$ipo->major_product}}</p>
                                    <strong>Use IPO of Proceeds :</strong>
                                    <p>{{$ipo->use_of_ipo_proceeds}}</p>
                                    <strong>Issue Manager :</strong>
                                    <p>{{$ipo->issue_manager}}</p>
                                    <strong>NAV :</strong>
                                    <p>
                                        {{$ipo->revaluation_reserve}} :<br>
                                        {{$ipo->w_revaluation_reserve}} :
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.first-accordion').trigger('click');
    });
</script>
@endsection
