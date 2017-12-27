 <ol class="breadcrumb">
 {{--{!! $MyNavBar->crumbMenu()->asUl() !!}--}}
 @foreach($bread as $node)
     <li>
         <a href="{{url($node['url'])}}">{{$node['text']}}</a>
     </li>
@endforeach

 </ol>

