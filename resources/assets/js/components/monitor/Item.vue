<template>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="padding: 5px; !important">
        <div class="portlet light" id="chart_portlet">
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
                                            <select @change="onInstrumentChanged()" v-model="instrument_id" :class="instrument.instrument_code"   class="form-control selectpicker " data-live-search="true">
                                                <option value="-1">-- Select Symbol --</option>
													<option  v-for="ins in instruments" :value="ins.id">{{ins.instrument_code}}</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

<!--                                             <select name="period" id="period" class="form-control selectpicker" data-live-search="true">
                                                <option value="-1">Time range</option>
                                                <option value="15">15 Minute</option>
                                                <option value="30">30 Minute</option>
                                                <option value="45">45 Minute</option>
                                                <option value="60">1 Hour</option>
                                                <option value="120">2 Hour</option>
                                                <option value="1440">Full Day</option>
                                            </select> -->
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="clearfix margin-bottom-10"> </div>

									<div id="chart_placeholder" >
									    <div id="displayDiv">
									        <div :id="instrument.instrument_code"></div>
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
    </div>
</template>

<script>
	export default{
		props:['instruments', 'item', 'intradays'],
		mounted(){
            this.instrument_id = this.item;
            if(this.intradays == null){return}
                this.setInstrument()

                if(!this.intradays[this.instrument_id]){
                    return
                }
               this.processData(this.intradays[this.instrument_id]);
               setTimeout(() => {
                    $('.'+this.instrument.instrument_code).val( this.instrument_id)
                    $('.'+this.instrument.instrument_code).selectpicker();
                 this.loadChart()
               }, 100);
		},
		data(){
			return{
				chart: null,
                data: null,
				instrument_id: -1,
				instrument: {
					name: 'abc',
                    id: 9
				},
                colors: {
                    red: "#EF4836",
                    green: "#1BA39C",
                    blue: "#ACB5C3",
                },
				updated_at: '',
				totalVolume: 0,
				bullVolume: 0,
				bearVolume: 0,
				neutralVolume: 0,
				chartColor: "#1BA39C",
				xcat: [],
				xdata: [],
				ydata: [] 
			}
		},
		methods: {	
				append(data) {
					this.chart.series[0].addPoint({color: "#ACB5C3", y: 136000})
				},
				onInstrumentChanged(){
					if(this.instrument_id < 1){ return ;}

                    this.setInstrument()
                    
                    axios.get("/api/instruments/"+this.instrument.id+"/intraday").then((respons)=>{
                       this.intradays[this.instrument.id] = respons.data;
                        this.processData(respons.data);
                        this.loadChart()
                    })
					
					// this.loadInstrumentData();

				},
                 setInstrument() {
                    this.instrument = this.instruments.filter(obj => {
                                      return obj.id === this.instrument_id
                                    })[0]
                }
                ,
                processData(data) {
                    // if( this.instrument_id in this.intradays ){return}
                    this.xcat = [];
                    this.xdata = [];
                    this.ydata = [];

                    var prevObj = null;
                    var color;
                    var prevPrice;
                    data.filter(obj =>{
                        this.xcat.push(moment(obj.lm_date_time).format("hh:mm"))
                        if(prevObj == null){
                           prevPrice = obj.yday_close_price;
                        }else{
                            prevPrice = prevObj.close_price
                        }
                        var close_price = obj.close_price

                       color =  this.getColor(close_price, prevPrice)

                       if(color == this.colors.red){
                            this.bearVolume += obj.new_volume;
                       }else if(color == this.colors.green){
                            this.bullVolume += obj.new_volume;
                       }else{
                        this.neutralVolume += obj.new_volume;
                       }


                        prevObj = obj;

                        this.xdata.push({color:color, y:obj.close_price})
                        this.ydata.push({color:color, y:obj.new_volume})

                    })

                    //set price color
                    this.chartColor = this.getColor(prevObj.close_price, prevObj.yday_close_price)
                    this.totalVolume = prevObj.total_volume
                    this.updated_at = moment(prevObj.lm_date_time).toNow(true)+" ago."
                },
                 getColor(close_price, prevPrice) {
                    var color;
                        if(close_price > prevPrice){
                            //green
                            color = this.colors.green
                        }else if(close_price < prevPrice){
                            //red
                            color = this.colors.red
                        }else{
                            //blue
                            color = this.colors.blue
                        }   
                        return color;                 
                },
				loadChart(){

                        if(this.intradays == null){return}
					     this.chart = Highcharts.chart(this.instrument.instrument_code, {
					        
                             chart: {
                                 zoomType: 'xy',
                                 defaultSeriesType: 'spline',
                                 events: {
                                     load: function() {
                                         this.renderer.image('/img/chart_logo.gif', this.chartWidth/2.5, this.chartHeight/2.5, 86, 63).add(); 
                                     }
                                 },
                                 showAxes: true,
                                 shadow: false,
                                 borderWidth: 1,
                                 borderColor: "#D5DAE0",

                                 spacingLeft: 2,
                                 spacingRight: 2


                             },
                                exporting: {
                                     buttons: {
                                         contextButton: {
                                             menuItems: [

                                                 {
                                                     textKey: 'downloadPNG',
                                                     onclick: function () {
                                                         this.exportChart({filename: 'StockBangladesh_minute-chart'});
                                                     }
                                                 }]
                                         }
                                     }
                                 },
                                 title: {
                                     //text: '"'+returnData.instrumentInfo+'"',
                                     text: '<b>'+this.instrument.instrument_code+'</b>: '+ this.updated_at,
                                     style: {
                                         fontSize: '12px'
                                     },
                                     margin: 1

                                 },


                             subtitle: {
                                 text: 'Total Vol: <b>'+this.totalVolume+'</b> Bull: '+this.bullVolume+' Bear: '+this.bearVolume+' Neutral: '+this.neutralVolume,
                                 useHTML: true,
                 //floating: true,
                                 y: 23,
                                 style: {
                                     fontSize: '10px'
                                 }
                 //margin: 50
                             },
                                                     xAxis: [
                                                         {
                                                             categories: this.xcat
                                                                 //'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                                                             ,
                                                             tickInterval: 1,
                                                             crosshair: true,
                                                             labels: {
                                                                 enabled: true,
                                                                 rotation: -90,
                                                                 align: 'right'

                                                                 //x:10,
                                                             }

                                                         }
                                                     ],
                                                     yAxis: [
                                                         { // Primary yAxis

                                                             title: {
                                                                 /* text: 'Price',
                                                                  style: {
                                                                  color: Highcharts.getOptions().colors[1]
                                                                  }*/
                                                                 text: ''
                                                             },
                                                             id: 'y_price',
                                                             enabled: false
                                                         },
                                                         { // Secondary yAxis
                                                             title: {
                                                                 text: ''
                                                             },
                                                             enabled: false,
                                                             labels: {
                                                                 format: '{value}',
                                                                 style: {
                                                                     color: '#1BA39C'
                                                                 }
                                                             },
                                                             id: 'y_volume',
                                                             opposite: true
                                                         }
                                                     ],
                                                     tooltip: {
                                                         shared: true
                                                     },
                                                     credits: {
                                                         enabled: true,
                                                         href: "http://www.stockbangladesh.com",
                                                         text: "stockbangladesh.com",
                                                         style: {
                                                             color: '#4572A7'

                                                         },
                                                         position: {
                                                             align: 'right',
                                                             verticalAlign: 'bottom'
                                                             /*  x: 5,
                                                              y: 15*/
                                                         }
                                                     },
                                                     legend: {
                                                         enabled: false
                                                         //layout: 'vertical',
                                                         /*   align: 'left',
                                                          verticalAlign: 'bottom'*/
                                                         /* x: 120,
                                                          verticalAlign: 'top',
                                                          y: 100,*/
                                                         /*  floating: true,
                                                          backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'*/
                                                     },



                                                     series: [
                                                         {
                                                             name: 'Volume',
                                                             type: 'column',
                                                             color: '#8CC152',
                                                             yAxis: 0,
                                                             data: this.ydata,
                                                             tooltip: {
                                                                 valueSuffix: ''
                                                             }

                                                         },
                                                         {
                                                             name: 'Price',
                                                             type: 'spline',
                                                             //color: '"'+returnData.price_chart_color+'"',
                                                             // color: returnData.price_chart_color,
                                                             color: this.chartColor,
                                                             yAxis: 1,
                                                             marker: {
                                                                 radius: 3
                                                             },
                                                             data: this.xdata,
                                                             tooltip: {
                                                                 valueSuffix: ''
                                                             }
                                                         }
                                                         ,
                                                         {
                                                             type: 'pie',
                                                             name: 'BullBear',
                                                             data: [{
                                                                 name: 'Bull Vol',
                                                                 y: this.bullVolume,
                                                                 color: this.colors.green // bear
                                                             }, {
                                                                 name: 'Bear Vol',
                                                                 y: this.bearVolume,
                                                                 color: this.colors.red // Bear color
                                                             }, {
                                                                 name: 'Neutral Vol',
                                                                 y: this.neutralVolume,
                                                                 color: this.colors.blue // Neutral
                                                             }],
                                                             center: [30, 20],
                                                             size: 60,
                                                             showInLegend: false,
                                                             dataLabels: {
                                                                 enabled: false
                                                             }
                                                         }



                                                     ],




                         responsive: {
                         rules: [{
                             condition: {
                                 maxWidth: 500
                             }

                         }]
                     }



					    });						
				}
			
		}
	}
</script>