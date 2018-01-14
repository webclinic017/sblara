@php
 $latestNews = \App\NewspaperNews::latest('id')->take(10)->get();
@endphp
<div class="search-container bordered courseTicker">

<div>
@foreach($latestNews as $news)
                    <div class="search-content">
                        <h4 class="search-title">
                            <a href="/news/details/{{$news->id}}" target="_blank">{{$news->title}}</a>
                        </h4>
                        <h6>{{\Carbon\Carbon::parse($news->published_date)->format('d M Y')}}</h6>
                        <p class="search-desc">{!! mb_substr($news->details, 0, 200)!!}... </p>
                        <hr>
                    </div>
    @endforeach       
</div>

</div>
  


<script>
    $('.courseTicker').easyTicker({
        interval: 3000,
        height: 298,
        visible: 3
});
</script>