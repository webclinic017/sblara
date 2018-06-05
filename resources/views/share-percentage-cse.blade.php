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
            <a href="/admin/share-percentage-cse/update" target="_blank" class="btn btn-success">Update CSE Data</a>
            {{-- <a href="?update=sb" onclick="return confirm('Are you sure?')" class="btn btn-warning disable" disabled >Auto Update SB Data</a> --}}
        </div>
          {{-- content start  --}}
          {{-- 
    	 	// 18 director
    	 	// 21 foreign
    	 	// 19 govt
    	 	// 20 institute
    	 	// 22 public
           --}}
            <table class="table table-striped">
                <thead>
                    <th>#</th>
                    <th>Instruments</th>
                    <th>SPONSOR (SB/CSE)</th>
                    <th>GOVERNMENT (SB/CSE)</th>
                    <th>INSTITUTE  (SB/CSE)</th>
                    <th>FOREIGN (SB/CSE)</th>
                    <th>PUBLIC (SB/CSE)</th>
                    <th>DATE(SB/CSE)</th>

                </thead>
                	<tbody>
                		@php $i = 1;  @endphp
                		@foreach($cse as $instrument)
                		@php $form = [];
                			$form[18] = $cse[$instrument->id]->sponsor;
                			$form[19] = $cse[$instrument->id]->government;
                			$form[20] = $cse[$instrument->id]->institute;
                			$form[21] = $cse[$instrument->id]->foreign;
                			$form[22] = $cse[$instrument->id]->public;
                		 @endphp
                		<tr>
                			<td>{{$i++}}</td>
                			<td>{{$instrument->instrument_code}}</td>

                			<td style="color:@if($fundamentals[$instrument->id][18] == number_format($cse[$instrument->id]->sponsor, 2)) green @else @php $form[18] = $cse[$instrument->id]->sponsor @endphp red   @endif" >{{$fundamentals[$instrument->id][18]}}|{{number_format($cse[$instrument->id]->sponsor, 2)}}

                			</td>
                			
                			<td style="color:@if(@$fundamentals[$instrument->id][19] == number_format($cse[$instrument->id]->government, 2)) green @else red @php $form[19] = $cse[$instrument->id]->government @endphp   @endif" >{{@$fundamentals[$instrument->id][19]}}|{{number_format($cse[$instrument->id]->government, 2)}}</td>

                			<td style="color:@if(@$fundamentals[$instrument->id][20] == number_format($cse[$instrument->id]->institute, 2)) green @else red   @php $form[20] = $cse[$instrument->id]->institute @endphp    @endif" >{{@$fundamentals[$instrument->id][20]}}|{{number_format($cse[$instrument->id]->institute, 2)}}</td>
                			
                			<td style="color:@if(@$fundamentals[$instrument->id][21] == number_format($cse[$instrument->id]->foreign, 2)) green @else red   @php $form[21] = $cse[$instrument->id]->foreign @endphp  @endif" >{{@$fundamentals[$instrument->id][21]}}|{{number_format($cse[$instrument->id]->foreign, 2)}}</td>

                			<td style="color:@if($fundamentals[$instrument->id][22] == number_format($cse[$instrument->id]->public, 2)) green @else red   @php $form[22] = $cse[$instrument->id]->public @endphp  @endif" >{{$fundamentals[$instrument->id][22]}}|{{number_format($cse[$instrument->id]->public, 2)}}</td>
                		
                			<td style="color:@if(explode(' ', $fundamentals[$instrument->id]['meta_date'])[0] == $cse[$instrument->id]->meta_date) green @php  $type = "update" @endphp  @else @php $type = "insert" @endphp red   @endif" >{{explode(' ', $fundamentals[$instrument->id]['meta_date'])[0]}}|{{$cse[$instrument->id]->meta_date}}</td>

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
								<form action="" method="post">
									{{csrf_field()}}
									<div class="form-group">
										<label for="">Instrument</label>
										<input type="text" class="form-control" readonly="" disabled="" value="{{$instrument->instrument_code}}">
									</div>
									<div class="form-group">
										<label for="">Meta Date</label>
										<input type="date" name="meta_date" class="form-control" value="{{$cse[$instrument->id]->meta_date}}">
									</div>

									@foreach($form as  $meta_id => $meta_value)

									<div class="form-group">
										<label for="">{{$metaNames[$meta_id]}}</label>
										<input type="text" class="form-control"  name="{{$meta_id}}" value="{{$meta_value}}">
									</div>

									@endforeach
									{{-- {{dump($form)}} --}}
									<input type="hidden"  name="instrument_id" value="{{$instrument->id}}">
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

                		</tr>
                		@endforeach
                	</tbody>
            </table>
          {{-- content end  --}}
    </div><!-- .page-content container-fluid -->
@stop
