
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