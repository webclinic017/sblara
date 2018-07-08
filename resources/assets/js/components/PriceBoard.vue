<template>
	<div class="col-md-12 " style="padding:10px" >
		<div class="box-shadow">
						<div class="col-md-12">
				<vue-progress-bar></vue-progress-bar>
			</div>
		

		<div class="col-md-12 board-panel">

        <form class="form-inline" role="form">
            <div class="form-group">
                <label  for="exampleInputEmail2">Order By</label><br>
                 <select v-model="sortBy" @change="groupBy"  class="form-control">
				<option value="gain">Change(%)</option>
				<option value="instrument_code">Instrument Code</option>
			</select>
            </div>
            <div class="form-group">
               <label  for="exampleInputEmail2">Group By</label><br>
			<select v-model="group_by" @change="groupBy" class="form-control">
				<option value="sector_name">Sector</option>
				<option value="category">Category</option>
			</select>
               </div> 

               
			<div style=" display:inline-block">
            <div class="form-group">
               <label  for="exampleInputEmail2"> <span v-if="range">Start</span> Date

               			                          <label class="mt-checkbox " style="margin-bottom:0px" >
                                                        <input @change="rangeChanged" type="checkbox" v-model="range"> Range
                                                        <span></span>
                                                    </label>
               </label><br>
					<datepicker :format="'yyyy-MM-dd'"  @input="invalidateData"  v-model="startDate"  input-class="form-control"></datepicker>
             </div>

            <div class="form-group" v-if="range">
               <label  for="exampleInputEmail2">End Date</label> <br>
					<datepicker   :format="'yyyy-MM-dd'"  @input="invalidateData"  v-model="endDate" input-class="form-control"></datepicker>
               </div>
			
				
			</div>
			
            <div class="form-group">
               <label  for="exampleInputEmail2">Value Of</label><br>
			<select v-model="displayValue" @change="changeDisplayValue" class="form-control">
				<option value="close_price">LTP</option>
				<option value="total_volume">Volume</option>
				<option value="total_trades">Trade</option>
				<option value="total_value">Value</option>
			</select>
             </div>


          <div class="form-group pull-right">
                                                            	<label for="">Zoom</label> <br>
                                                            <div class="input-group ">
                                                                <span class="input-group-btn" @click="zoomout">
                                                                    <button class="btn red red btn-xs" type="button"><i class="fa fa-search-minus"></i></button>
                                                                </span>
   
                                                                <input type="range" style="width:100px" min="10" max="200" v-model="masonry.zoom" @change="invalidate" class="form-control">

                                                  <!--               <input  v-model="masonry.zoom" style="width:60px" type="text" class="form-control"> -->
                                                                <span class="input-group-btn" @click="zoomin">
                                                                    <button class="btn red btn-xs" type="button"><i class="fa fa-search-plus"></i></button>
                                                                </span>
                                                            </div>
                                                                 </div>
        </form>


			
					




		</div> 
		<div class="col-md-12">
			<div v-bind:style="{fontSize: masonry.fontSize + 'px'}"  v-masonry  origin-top="true" origin-center="true" transition-duration="1s" item-selector=".item" >
			<price-group  v-masonry-tile class="item"  v-for="title in data" v-bind:masonry="masonry"  v-bind:valueOf="displayValue"  v-bind:group="title"  ></price-group>
		</div> 		
		</div>

		</div>

	</div>
</template>
<style scoped>
	.refresh-progress .loader{
		height: 2px;
		background: #E7505A;
		margin-top: -2px;
	}
	.board-panel{
		padding:20px;
	}
	
.box-shadow{
	padding: 0;
	width: 100%;
}



</style>
<script>	
import Datepicker from 'vuejs-datepicker';
import Moment from 'moment';
	export default {
		  components: {
    		Datepicker
  		},
		mounted(){
			// alert('loaded')
			this.getData()
			var that = this
			// that.startProgress()
			setInterval(function() {
				that.getData()
			}, that.timeInterval * 1000); 
		},
		  data(){
	      return {
	      	  masonry: {
	      	  	boardWidth: "180",
	      	  	fontSize: '14',
	      	  	zoom: '100'
	      	  },
	          instruments:null,
	          data: null,
	          sortBy: 'instrument_code',
	          group_by: 'sector_name',
	          interval: null,
	          timeInterval: 30,
	          startDate: moment().format("YYYY-MM-DD"),
	          endDate: moment().format("YYYY-MM-DD"),
	          displayValue: 'close_price',
	          range: false
	      }	
  		},

  		methods:{

				gain(instrument){
					//gain round(((d.close_price - d.yday_close_price)/d.close_price)*100, 2)
					var value = this.getValue(instrument)
					var prevValue = this.getPrevValue(instrument)
					return ((( value - prevValue)/value)*100).toFixed(2)
				}
			,				getValue: function(instrument){
					return instrument[this.displayValue]
				},
				getPrevValue(instrument){
					return instrument['prev_'+this.displayValue]
				}
				,
  			rangeChanged(){
  				if(this.range){
  				 this.startDate = moment().subtract(1, 'days').format('YYYY-MM-DD');
  				 this.endDate = moment().format('YYYY-MM-DD');
  				}else{
  				 	this.startDate = moment().format('YYYY-MM-DD');
  				}
  			},
				changeDisplayValue: function () {
					this.groupBy()
					// this.invalidate()
				}
				,
  			zoomin(){

  				this.masonry.zoom ++
  				this.invalidate()
  			}
  			,
  			zoomout(){
  				this.masonry.zoom --
  				this.invalidate()
  			}
  			,
  			invalidate(){
  				// console.log('sdf')
  				var change = this.masonry.zoom - 100;
  				this.masonry.boardWidth =  ((change * 180)/100) + 180;
  				this.masonry.fontSize = (14*this.masonry.boardWidth)/180;
  				// 14:170
  				var that = this;
  				setTimeout(function() {
  				that.$redrawVueMasonry()
  					
  				}, 100);
  			}
  			,
  			invalidateData(){
  				var that = this;
  					this.getData()
  			}
  			,
  			startProgress: function () {
  							var that = this
  							var current = 	new Date().getTime();
							that.interval = setInterval(function () {
								var p = ((new Date().getTime() - current)*100) / (that.timeInterval*900 );
								that.$Progress.set(p)
								if(p > 100){
									 clearInterval(that.interval);
								}
							}, 1000)
  			}
  			,
  			sort: function () {
  				var that = this;
  				// console.log(this.sortBy)
  				this.instruments.sort(function (a, b) {
  					if(that.sortBy == 'instrument_code'){
  						if(b.instrument_code > a.instrument_code){
  							return -1;
  						}else{
  							return 1;
  						}
  					}else if(that.sortBy == 'gain'){
  						// console.log(that.gain(b))
  						return that.gain(b) - that.gain(a)
  					}
  				})
  			}
  			,
  			getUrl(){
  				var url =  '/price-board'
  				url+= '?startDate='+moment(this.startDate).format('YYYY-MM-DD')
  				if(this.range){
  					url+= "&range=true&endDate="+moment(this.endDate).format('YYYY-MM-DD')
  				}
  				return url
  			}
  			,
  			getData: function () {
  				axios.get(this.getUrl())
			  .then( (response) => {
			  	clearInterval(this.interval);

				// this.$Progress.set(100)
				this.$Progress.finish()
				// this.$Progress.start()
			  	this.instruments = response.data
			  	this.groupBy()
				this.startProgress()	
			  }
			  )
			  .catch(function (error) {
			    console.log(error);
			  });
  			},
  			groupOrder: function (data) {
  				var d = [];
  				var i = 0;
  				for (var key in data) {
  					d[i] = data[key]
  					i++
  				}
  				d.sort(function (a, b) {
  					if(a.instruments.length > b.instruments.length){
  						return -1
  					}
  					// if(a.title > b.title){
  					// 	return 1
  					// }
  					return 1
  				})
  				return d;
  			}
  			,
  			groupBy: function () {
  				this.sort()
  				var data = [];
  				for (var key in this.instruments) {
  					var instrument = this.instruments[key]
	  					if(!data[instrument[this.group_by]]){
	  						data[instrument[this.group_by]] = {};	
	  						data[instrument[this.group_by]].title = instrument[this.group_by];
	  						data[instrument[this.group_by]].instruments = [];	
	  						data[instrument[this.group_by]].gainer = 0;
	  						data[instrument[this.group_by]].loser = 0;
	  					}
	  					  	//set gainer loser count	
	  						if(this.gain(instrument) > 0){
	  							data[instrument[this.group_by]].gainer++
	  						}else{
	  							data[instrument[this.group_by]].loser++ 
	  						}
	  						data[instrument[this.group_by]].instruments.push(instrument)
  				}
  				this.data = this.groupOrder(data)
  				return this.data
  			}
  		}

	};
</script>