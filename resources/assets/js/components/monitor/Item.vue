<template>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="padding: 5px; !important;">
        <div class="portlet light" id="chart_portlet">
            <div class="portlet-title tabbable-line">
                <div class="caption">
                    <i class="icon-globe font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase"></span>
                </div>
                <ul class="nav nav-tabs">
                    <li :class="{active:chartTab}">
                        <a href="javascript:"  @click="switchTab(true)"  class="active"  aria-expanded="true"> Minute chart </a>
                    </li>
                    <li :class="{active: !chartTab}">
                        <a href="javascript:"  @click="switchTab(false)"   aria-expanded="false" id="marketBtn"> Market Depth </a>
                    </li>
                </ul>
            </div>
            <div class="portlet-body">
                <!--BEGIN TABS-->
                <div class="tab-content">
                    <div class="tab-pane" :class="{active: chartTab}" id="chart">
                                    <div class="row" >
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            <select @change="onInstrumentChanged()" v-model="instrument_id" :class="instrument.instrument_code"   class="form-control selectpicker " data-live-search="true">
                                                <option value="-1">-- Select Symbol --</option>
													<option  v-for="ins in instruments" :value="ins.id">{{ins.instrument_code}}</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

                                        <!-- <datepicker :format="'yyyy-MM-dd'"  @input="date"  v-model="date"  input-class="form-control"></datepicker> -->
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
                    <div class="tab-pane" :class="{active: chartTab == false}" id="Market_depth_">
                        <div v-html="depthHtml" class="row" id="marketDiv_" >
                              
                        </div>
                    </div>
                </div>
                <!--END TABS-->
            </div>
        </div>
    </div>
</template>

<script>

    import Datepicker from 'vuejs-datepicker';
	export default{
          components: {
            Datepicker
        },        
		props:['instruments', 'item', 'intradays', 'selectedItems', 'items', 'index'],
		created(){
            // console.log(this.item)
            // console.log(this.index)
            // console.log(this.selectedItems)

            if(this.item == -1){

                setTimeout(() => {
                  $('.'+this.instrument.instrument_code).selectpicker();
                }, 500);
                  return
            }

            this.instrument_id = this.item;
            if(this.intradays == null){return}
                this.setInstrument()

                if(!this.instrument.instrument_code){
                    return
                }
                
                if(!this.intradays[this.instrument_id]){
                    return
                }
                this.onDataUpdate()
		},
		data(){
			return{
                chart: null,
                depthHtml: "",
				chartTab: true,
                data: null,
				instrument_id: -1,
                date: '',
				instrument: {
					instrument_code: 'No data',
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
        watch: {
            instrument_id: function (newValue, oldValue){
                  this.selectedItems[this.index] = newValue;
            }
        },
		methods: {	
                switchTab(val){
                        if(!val){
                            this.depthHtml = this.depthLoading();
                            axios.get("/ajax/market/"+this.instrument_id).then((response)=>{
                                this.depthHtml = response.data
                            })
                        }
                        this.chartTab = val;
                },
                onDataUpdate(){
                    if(this.intradays[this.instrument_id]){
                        this.processData(this.intradays[this.instrument_id]);
                    }else{
                        return
                    }
                   

                   setTimeout(() => {
                        $('.'+this.instrument.instrument_code).val( this.instrument_id)
                        $('.'+this.instrument.instrument_code).selectpicker();
                     this.loadChart()
                   }, 500);
                },
				append(data) {
					this.chart.series[0].addPoint({color: "#ACB5C3", y: 136000})
				},
				onInstrumentChanged(){
					if(this.instrument_id < 1){ return ;}

                    if(this.selectedItems.includes(this.instrument_id)){
                        swal("Share already selected.")
                        return
                    }

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
                                      return obj.id == this.instrument_id
                                    })[0]
                }
                ,
                processData(data) {
                    // if( this.instrument_id in this.intradays ){return}
                    this.xcat = [];
                    this.xdata = [];
                    this.ydata = [];

                    this.bearVolume = 0;
                    this.bullVolume = 0;
                    this.totalVolume = 0;
                    this.neutralVolume = 0;


                    if(data.length == 0){
                        return
                    }
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
				},
                 depthLoading() {
  return '\n<table style="font-family:Arial, Helvetica, sans-serif; font-size: 13px;" width="100%" border="0" cellspacing="0" cellpadding="0">\n  <tbody><tr>\n    <td><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">\n      <tbody><tr>\n        <td width="15%" valign="top">&nbsp;</td>\n        <td width="75%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">\n          <tbody><tr>\n            <td width="100%" valign="top"><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#E8FFFB">\n                <tbody><tr bgcolor="#339966">\n                  <td height="34%" colspan="2"><div align="center"><strong><font color="#FFFFFF">Buy</font></strong></div></td>\n                </tr>\n                <tr>\n                  <td width="50%" bgcolor="#D2F0E1"><div align="center">Buy Price </div></td>\n                  <td height="34%" bgcolor="#D2F0E1"><div align="center">Buy Volume </div></td>\n                  </tr>\n                                <tr>\n                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>\n                  </tr>\n                                <tr>\n                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>\n                  </tr>\n                                <tr>\n                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>\n                  </tr>\n                                <tr>\n                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>\n                  </tr>\n                                <tr>\n                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>\n                  </tr>\n                                <tr>\n                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>\n                  </tr>\n                                <tr>\n                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>\n                  </tr>\n                                <tr>\n                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>\n                  </tr>\n                                <tr>\n                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>\n                  </tr>\n                              \n                            </tbody></table></td>\n\n          </tr>\n        </tbody></table></td>\n        <td width="15%" valign="top">&nbsp;</td>\n      </tr>\n      <tr>\n        <td valign="top">&nbsp;</td>\n        <td valign="top">&nbsp;</td>\n        <td valign="top">&nbsp;</td>\n      </tr>\n      <tr>\n        <td valign="top">&nbsp;</td>\n        <td valign="top">&nbsp;</td>\n        <td valign="top">&nbsp;</td>\n      </tr>\n      <tr>\n        <td valign="top">&nbsp;</td>\n        <td valign="top"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#FFF7EA">\n          <tbody><tr bgcolor="#339966">\n            <td colspan="4"><font color="#FFFFFF"><strong>Price Statistics </strong></font> </td>\n          </tr>\n\n          <tr>\n            <td colspan="4" >\n\t\t\t\t<div class="animated-background" style="margin:2px; min-height:15px"></div>\n            </td>\n          </tr>\n       \n          <tr>\n            <td colspan="4" >\n\t\t\t\t<div class="animated-background" style="margin:2px; min-height:15px"></div>\n            </td>\n          </tr>\n       \n          <tr>\n            <td colspan="4" >\n\t\t\t\t<div class="animated-background" style="margin:2px; min-height:15px"></div>\n            </td>\n          </tr>\n       \n          <tr>\n            <td colspan="4" >\n\t\t\t\t<div class="animated-background" style="margin:2px; min-height:15px"></div>\n            </td>\n          </tr>\n       \n          <tr>\n            <td colspan="4" >\n\t\t\t\t<div class="animated-background" style="margin:2px; min-height:15px"></div>\n            </td>\n          </tr>\n       \n          <tr>\n            <td colspan="4" >\n\t\t\t\t<div class="animated-background" style="margin:2px; min-height:15px"></div>\n            </td>\n          </tr>\n       \n        </tbody></table></td>\n        <td valign="top">&nbsp;</td>\n      </tr>\n      <tr>\n        <td valign="top">&nbsp;</td>\n        <td valign="top">&nbsp;</td>\n        <td valign="top">&nbsp;</td>\n      </tr>\n\n    </tbody></table></td>\n  </tr>\n</tbody></table>\t\t\n\t';
}
			
		}
	}
</script>