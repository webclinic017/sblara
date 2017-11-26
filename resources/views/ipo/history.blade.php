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
                            <tr>
                                <td> AAC </td>
                                <td> AUSTRALIAN AGRICULTURAL COMPANY LIMITED. </td>
                                <td class="numeric"> &nbsp; </td>
                                <td class="numeric"> -0.01 </td>
                                <td class="numeric"> -0.36% </td>
                                <td class="numeric"> $1.39 </td>
                                <td class="numeric"> $1.39 </td>
                                <td class="numeric"> &nbsp; </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>
<script>document.getElementById('year').value = "{{$year}}"; </script>
@endsection
