<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th> Symbol </th>
            <th> Last </th>
            <th colspan="2"> Change </th>
        </tr>
    </thead>
    <tbody>
        @foreach(\App\Instrument::{request()->panel}() as $instrument)
        <tr>
            <td style="color:@if($instrument->gain > 0) green @elseif($instrument->gain < 0) rgb(185, 27, 42) @else #58c3e5 @endif !important"> {{$instrument->instrument_code}} </td>
            <td style="color:@if($instrument->gain > 0) green @elseif($instrument->gain < 0) rgb(185, 27, 42) @else #58c3e5 @endif !important"> {{$instrument->close_price}} </td>
            <td style="color:@if($instrument->gain > 0) green @elseif($instrument->gain < 0) rgb(185, 27, 42) @else #58c3e5 @endif !important" > {{$instrument->gain}}% </td>
             <td class="addItem actionIcon" data-instrument="{{$instrument->instrument_id}}" data-id="{{request()->panel}}" style=""><i class="fa fa-plus"></i></td>            
        </tr>
        @endforeach
    </tbody>
</table>