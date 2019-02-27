@extends('voyager::master')

@section('page_title', __('voyager.generic.media'))

@section('content')
@php 
 $metaNames = [];
 $metaNames[18] = "Sponsor/Director";
 $metaNames[19] = "Govt";
 $metaNames[20] = "Institute";
 $metaNames[21] = "Foreign";
 $metaNames[22] = "Public";
@endphp
    <div class="page-content container-fluid">
        <div class="col-md-12">
            <a href="/admin/data-extractors/share-percentage-dse-import" target="_blank" class="btn btn-success">Update DSE Data</a>
            {{-- <a href="?update=sb" onclick="return confirm('Are you sure?')" class="btn btn-warning disable" disabled >Auto Update SB Data</a> --}}
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
                    <th style="min-width: 200px">Holding Update Date(Y-M-D)  (SB/DSE)</th>
                    <th>Update</th>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach($instruments as $instrument)
                        <tr>
                            <td>{{$i++}}</td>
                            <td >{{$instrument->instrument_code}}</td>
                            <td @if($instrument->total_no_securities != $instrument->total)style="color:red"  @else style="color:green" @endif >{{$instrument->total_no_securities}}||{{$instrument->total}}</td>

                            @php $form[18] = $instrument->sponsor @endphp
                            @php $form[19] = $instrument->govt @endphp
                            @php $form[20] = $instrument->institute @endphp
                            @php $form[21] = $instrument->f_share @endphp
                            @php $form[22] = $instrument->public_share @endphp

                            <td  @if($instrument->share_percentage_director != $instrument->sponsor)style="color:red"  @else style="color:green" @endif >{{$instrument->share_percentage_director}}||{{$instrument->sponsor}}</td>
                            <td @if($instrument->share_percentage_govt != $instrument->govt)style="color:red"  @else style="color:green"  @endif >{{$instrument->share_percentage_govt}}||{{$instrument->govt}}</td>
                            <td @if($instrument->share_percentage_institute != $instrument->institute)style="color:red"  @else style="color:green" @endif >{{$instrument->share_percentage_institute}}||{{$instrument->institute}}</td>
                            <td @if($instrument->share_percentage_foreign != $instrument->f_share)style="color:red"  @else style="color:green" @endif >{{$instrument->share_percentage_foreign}}||{{$instrument->f_share}}</td>
                            <td @if($instrument->share_percentage_public != $instrument->public_share)style="color:red"  @else style="color:green" @endif >{{$instrument->share_percentage_public}}||{{$instrument->public_share}}</td>
                            <td @if($instrument->net_asset_val_per_share != $instrument->nav)style="color:red"  @else style="color:green" @endif >{{$instrument->net_asset_val_per_share}}||{{$instrument->nav}}</td>
                            <td @if($instrument->paid_up_capital != $instrument->paid_up)style="color:red"  @else style="color:green" @endif >{{$instrument->paid_up_capital}}||{{$instrument->paid_up}}</td>
                            <td @if($instrument->authorized_capital != $instrument->authorized)style="color:red"  @else style="color:green" @endif >{{$instrument->authorized_capital}}||{{$instrument->authorized}}</td>
                            @php
                            if(isset($instrument->last_agm_held)):
                                $instrument->last_agm_held = str_replace('/', '-', $instrument->last_agm_held);
                            if(strlen($instrument->last_agm_held) > 5)
                            {
                                $date = \Carbon\Carbon::parse($instrument->last_agm_held)->format('d/m/Y');
                            }else{
                                $date = $instrument->last_agm_held;

                            }
                        else:
                            $date = 'N/A';
                            $instrument->last_agm_held = null;
                            endif;
                             $holding_update = $instrument->holding_update;

                            @endphp
                            <td @if($date != $instrument->last_agm)style="color:red"  @else style="color:green" @endif >@if($instrument->last_agm_held == null) @else {{$date}}@endif||{{$instrument->last_agm}}</td>
                            <td @if($instrument->reserve_and_surp != $instrument->rserve_surplus)style="color:red"  @else style="color:green" @endif >{{$instrument->reserve_and_surp}}||{{$instrument->rserve_surplus}}</td>

                            {{-- new tds --}}
                            <td @if($holding_update != $instrument->holding_update_sb)style="color:red"  @else style="color:green" @endif  >{{$instrument->holding_update_sb}}||{{$holding_update}}</td>


                            <td>
                                    <!-- Trigger the modal with a button -->
                                    <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal_{{$instrument->id}}">Update</button>

                                    <!-- Modal -->
                                    <div id="myModal_{{$instrument->id}}" class="modal fade" role="dialog">
                                      <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Update {{$instrument->instrument_code}}</h4>
                                          </div>
                                          <div class="modal-body">
                                                                    <form action="/admin/share-percentage-cse" method="post">
                                                                        {{csrf_field()}}
                                                                        <div class="form-group">
                                                                            <label for="">Instrument</label>
                                                                            <input type="text" class="form-control" readonly="" disabled="" value="{{$instrument->instrument_code}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Meta Date</label>
                                                                            <input type="date" name="meta_date" class="form-control" value="{{$instrument->holding_update}}">
                                                                        </div>

                                                                        @foreach($form as  $meta_id => $meta_value)

                                                                        <div class="form-group">
                                                                            <label for="">{{$metaNames[$meta_id]}}</label>
                                                                            <input type="text" class="form-control"  name="{{$meta_id}}" value="{{$meta_value}}">
                                                                        </div>

                                                                        @endforeach
                                                                        {{-- {{dump($form)}} --}}
                                                                        <input type="hidden"  name="instrument_id" value="{{$instrument->instrument_id}}">
                                                                        <input type="submit"  class="btn btn-success pull-right" value="Update">
                                                                    
                                                                        {{-- <input type="submit" value="Update" @if(count($form) < 1) disabled @endif class="btn btn-success"></td> --}}
                                                                    </form>
                                          </div>
                                          <div class="modal-footer">
                                            {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                                          </div>
                                        </div>

                                      </div>
                                    </div>                              
                                    </td>

                            {{-- new tds --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
          {{-- content end  --}}
    </div><!-- .page-content container-fluid -->
@stop
