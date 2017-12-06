@extends('layouts.metronic.default')
@section('content')
<div class="row">

    <div class="col-md-12">
        <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        Historical Background of IPO [for the Year: <b>{{$year}}</b>]</div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                    <div class="center form-group" >    
                        <select class="form-control" id="year" onchange="window.location.href='?year='+this.value">
                            <option>Select a Year</option>
                            {!!yearsAsOption()!!}
                         </select>
                        </div>
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                            <tr>
                                <th width="20%"> Ticker </th>
                                <th> Company </th>
                                <th class="numeric">Subscription Open </th>
                                <th class="numeric"> Subscription Close </th>
                                <th class="numeric"> Issue Manager </th>
                                <th class="numeric"> 1st Day Close </th>
                                <th class="numeric"> Return [%] </th>
                                <th class="numeric"> Prospectus </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ipos as $ipo)
                            <tr>
                                <td> {{$ipo->short_name}} </td>
                                <td> {{$ipo->ipo_name}}  </td>
                                <td class="numeric"> {{$ipo->subscription_open}}</td>
                                <td class="numeric"> {{$ipo->subscription_close}} </td>
                                <td class="numeric"> {{$ipo->issue_manager}} </td>
                                <td class="numeric"> {{$ipo->firstDayClose}} </td>
                                <td class="numeric"> {{$ipo->return}} </td>
                                <td class="numeric"> {{$ipo->prospectus}} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>
<script>document.getElementById('year').value = "{{$year}}"; </script>
@endsection
