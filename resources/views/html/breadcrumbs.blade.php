 {{-- {!! $MyNavBar->crumbMenu()->asUl() !!} --}}
 <ol class="breadcrumb">
 @foreach($bread as $node)
     <li>
         <a href="{{url($node['url'])}}">{{$node['text']}}</a>
     </li>
@endforeach

 </ol>

