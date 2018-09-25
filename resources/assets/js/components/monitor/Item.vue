<template>
        <div class="portlet light col-md-4" id="chart_portlet">
            <div class="portlet-title tabbable-line">
                <div class="caption">
                    <i class="icon-globe font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase"></span>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#chart" aria-controls="chart" class="active" data-toggle="tab" aria-expanded="true"> Minute chart </a>
                    </li>
                    <li class="">
                        <a href="#Market_depth" aria-controls="Market_depth" data-toggle="tab" aria-expanded="false" id="marketBtn"> Market Depth </a>
                    </li>
                </ul>
            </div>
            <div class="portlet-body">
                <!--BEGIN TABS-->
                <div class="tab-content">
                    <div class="tab-pane active" id="chart">
                                    <div class="row" >
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            <select @change="onInstrumentChanged()" v-model="instrument_id" name="symbol" id="symbol" class="form-control selectpicker" data-live-search="true">
                                                <option value="-1">-- Select Symbol --</option>
													<option  v-for="instrument in instruments" :value="instrument.id">{{instrument.name}}</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

                                            <select name="period" id="period" class="form-control selectpicker" data-live-search="true">
                                                <option value="-1">Time range</option>
                                                <option value="15">15 Minute</option>
                                                <option value="30">30 Minute</option>
                                                <option value="45">45 Minute</option>
                                                <option value="60">1 Hour</option>
                                                <option value="120">2 Hour</option>
                                                <option value="1440">Full Day</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="clearfix margin-bottom-10"> </div>

									<div id="chart_placeholder" >
										<div id="container"></div>
									    <div id="displayDiv">
									        <div id="monitor_chart_"></div>
									    </div>

									    <div class="btn-group btn-group-xs btn-group-justified">
									            <a href="javascript:;" class="btn red" id="todayBtn">Today </a>
									            <a href="javascript:;" class="btn green" id="yDayBtn"> Yday </a>
									            <a href="javascript:;" class="btn green" id="2DayBtn"> 2 day ago </a>
									            <a href="javascript:;" class="btn green" id="3DayBtn"> 3 day ago </a>
									   </div>

									</div>
                                   
          </div>


                    </div>
                    <div class="tab-pane" id="Market_depth_">
                        <div class="row" id="marketDiv_" >

                        </div>
                    </div>
                </div>
                <!--END TABS-->
            </div>
        </div>
</template>

<script>
	export default{
		props:['instruments'],
		mounted(){
		},
		data(){
			return{
				instrument_id: -1,
				intraday: [],
			}
		},
		methods: {	
				loadInstrumentData(){
					axios.get("/api/instruments/"+this.instrument_id+"/intraday", (respons)=>{
						console.log(respons)
					})
				},
				onInstrumentChanged(){
					if(this.instrument_id < 1){ return ;}
					console.log("loading chart")
					this.loadChart()
					this.loadInstrumentData();

				},
				loadChart(){
					    var myChart = Highcharts.chart('container', {
					        chart: {
					            type: 'bar'
					        },
					        title: {
					            text: 'Fruit Consumption'
					        },
					        xAxis: {
					            categories: ['Apples', 'Bananas', 'Oranges']
					        },
					        yAxis: {
					            title: {
					                text: 'Fruit eaten'
					            }
					        },
					        series: [{
					            name: 'Jane',
					            data: [1, 0, 4]
					        }, {
					            name: 'John',
					            data: [5, 7, 3]
					        }]
					    });						
				}
			
		}
	}
</script>