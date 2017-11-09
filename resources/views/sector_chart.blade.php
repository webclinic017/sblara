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
        	 <select id='sectors' class="bs-select form-control"  ref="select"  data-live-search="true" title="Select sector" @change="refreshIds">
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
  <div class="row">
    <div class="col-md-12">
      <div class="portlet light bordered">
        <div class="portlet-body">
        	<div class="col-md-2" v-for="(value, index) in names" style="text-align: center; margin-bottom: 10px;">
        		<label class="btn btn-danger">
        			@{{ value }}
        			<span @click="removeChart(index)" class="close" style="margin-top: 4px;margin-left: 10px;">
        				
        			</span>
        		</label>
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
		   ids: [],
		   names: []
		},
		mounted: function () {
	        this.$http.get('/sector_chart/1').then((response) => {
		      	for(instrument in response.body) {
		        	this.ids.push(response.body[instrument].id);
		        	this.names.push(response.body[instrument].instrument_code);
		        }
		      });
	    },
		methods: {
		    refreshIds(resource) {
		    	var sectorId = document.getElementById("sectors").value;
		      this.$http.get('/sector_chart/' + sectorId).then((response) => {
		      	this.ids = [];
		      	this.names = [];
		      	for(instrument in response.body) {
		        	this.ids.push(response.body[instrument].id);
		        	this.names.push(response.body[instrument].instrument_code);
		        }
		      });
		    },
		    removeChart(id) {
		    	if(this.names.length == 2) {
		    		alert('Can\'t remove.');
		    		return;
		    	}
		    	this.names.splice(id, 1);
		    	this.ids.splice(id, 1);
		    }
	  	}
	});
  </script>
@endsection
