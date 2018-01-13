
<div class="col-md-12">
	<div class="col-md-8">
		<div id="marketStat" style="height:280px">
		</div>
	</div>
	<div class="col-md-4">
        <span class="badge badge-danger"> </span>
     </div>
	</div>
	
</div>
<script>
	$(document).ready(function(){
      
        Morris.Donut({
            element: 'marketStat',
            data: [{
                    label: "Up",
                    value: 70
                },
                {
                    label: "Down",
                    value: 20
                },
                {
                    label: "Unchanged",
                    value: 10
                }
            ],
            labelColor: '#a7a7c2',
            colors: [
				'#32C5D2',
                '#E7505A',
                '#8E44AD'
            ]
            //formatter: function (x) { return x + "%"}
        });
	});
</script>


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