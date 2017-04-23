@if(isset($navigation))
<div class="breadcrumbs">
    <h1>{{last($navigation)}}</h1>
    <ol class="breadcrumb">
        @foreach($navigation as $item)
        @if($item==last($navigation))
        <li class="active">{{$item}}</li>
        @else
        <li><a href="#">{{$item}}</a></li>
        @endif
        @endforeach
    </ol>
</div>
@endif
