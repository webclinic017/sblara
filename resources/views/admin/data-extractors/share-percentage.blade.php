@extends('voyager::master')

@section('page_title', __('voyager.generic.media'))

@section('content')
    <div class="page-content container-fluid">
        <div class="col-md-12">
            <a href="/admin/data-extractors/share-percentage-dse-import" target="_blank" class="btn btn-success">Update DSE Data</a>
            <a href="?update=sb" onclick="return confirm('Are you sure?')" class="btn btn-warning disabled">Auto Update SB Data</a>
        </div>
          {{-- content start  --}}
            <table class="table table-striped">
                <thead>
                    <th>#</th>
                    <th>Instruments</th>
                    <th>Total Share (SB/DSE)</th>
                    <th>SPONSOR (SB/DSE)</th>
                    <th>GOVERNMENT (SB/DSE)</th>
                    <th>INSTITUTE  (SB/DSE)</th>
                    <th>FOREIGN (SB/DSE)</th>
                    <th>PUBLIC (SB/DSE)</th>
                    <th>NAV (SB/DSE)</th>
                    <th>PAID UP (SB/DSE)</th>
                    <th>AUTHORIZED(SB/DSE)MN</th>
                    <th>LAST AGM (SB/DSE)MN</th>
                    <th>RESERVE & SURPLUS  (SB/DSE)</th>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach($instruments as $instrument)
                        <tr>
                            <td>{{$i++}}</td>
                            <td >{{$instrument->instrument_code}}</td>
                            <td @if($instrument->total_no_securities != $instrument->total)style="color:red" @endif >{{$instrument->total_no_securities}}||{{$instrument->total}}</td>
                            <td @if($instrument->share_percentage_director != $instrument->sponsor)style="color:red" @endif >{{$instrument->share_percentage_director}}||{{$instrument->sponsor}}</td>
                            <td @if($instrument->share_percentage_govt != $instrument->govt)style="color:red" @endif >{{$instrument->share_percentage_govt}}||{{$instrument->govt}}</td>
                            <td @if($instrument->share_percentage_institute != $instrument->institute)style="color:red" @endif >{{$instrument->share_percentage_institute}}||{{$instrument->institute}}</td>
                            <td @if($instrument->share_percentage_foreign != $instrument->f_share)style="color:red" @endif >{{$instrument->share_percentage_foreign}}||{{$instrument->f_share}}</td>
                            <td @if($instrument->share_percentage_public != $instrument->public_share)style="color:red" @endif >{{$instrument->share_percentage_public}}||{{$instrument->public_share}}</td>
                            <td @if($instrument->net_asset_val_per_share != $instrument->nav)style="color:red" @endif >{{$instrument->net_asset_val_per_share}}||{{$instrument->nav}}</td>
                            <td @if($instrument->paid_up_capital != $instrument->paid_up)style="color:red" @endif >{{$instrument->paid_up_capital}}||{{$instrument->paid_up}}</td>
                            <td @if($instrument->authorized_capital != $instrument->authorized)style="color:red" @endif >{{$instrument->authorized_capital}}||{{$instrument->authorized}}</td>
                            @php
                            if(strlen($instrument->last_agm_held_for_the_year) > 5)
                            {
                                $date = \Carbon\Carbon::parse($instrument->last_agm_held_for_the_year)->format('d/m/Y');
                            }else{
                                $date = $instrument->last_agm_held_for_the_year;

                            }
                            @endphp
                            <td @if($date != $instrument->last_agm)style="color:red" @endif >@if($instrument->last_agm_held_for_the_year == null) @else {{$date}}@endif||{{$instrument->last_agm}}</td>
                            <td @if($instrument->reserve_and_surp != $instrument->rserve_surplus)style="color:red" @endif >{{$instrument->reserve_and_surp}}||{{$instrument->rserve_surplus}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          {{-- content end  --}}
    </div><!-- .page-content container-fluid -->
@stop
