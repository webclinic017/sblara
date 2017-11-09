@extends('layouts.metronic.default')

@section('page_heading')
  Sector Chart
@endsection

@section('content')
<div id="app">
	  <div class="row">
    <div class="col-md-12">
      <!-- BEGIN Portlet PORTLET-->
      <div class="portlet light bordered">
        <div class="portlet-body">
          <select id='sectors' class="bs-select form-control" data-live-search="true" title="Select sector" @change="refreshIds">
            @foreach($sectors as $sector)
              <option value="{{ $sector->id }}"{{ $loop->first ? ' selected' : ''}}>{{ $sector->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12">
      <div class="portlet light bordered">
        <div class="portlet-body">
        	<div class="col-md-4" v-for="value in ids">
	        	<img :src="'/tooltip_chart/' + value">
	      	</div>
			<div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="https://unpkg.com/vue"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.4"></script>
  <script>
    var app = new Vue({
		el: '#app',
		data: {
		   ids: []
		},
		mounted: function () {
	        this.$http.get('/sector_chart/1').then((response) => {
		      	for(instrument in response.body) {
		        	this.ids.push(response.body[instrument].id);
		        }
		      });
	    },
		methods: {
		    refreshIds(resource) {
		    	var sectorId = $("#sectors").selectpicker("val");
		      this.$http.get('/sector_chart/' + sectorId).then((response) => {
		      	this.ids = [];
		      	for(instrument in response.body) {
		        	this.ids.push(response.body[instrument].id);
		        }
		      });
		    }
	  	}
	});
  </script>
@endsection
