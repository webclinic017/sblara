<template>
	<div class="price-board" v-bind:style="{width: masonry.boardWidth + 'px'}">	
		<div class="portlet-body">
		    <div class="mt-element-list">
		        <div class="mt-list-head list-simple ext-1 font-white bg-green-sharp">
		            <div class="list-head-title-container">
		                <div class="list-date"> <span style="color:rgb(200,255,200)"> <i class="fa fa-caret-up"></i> {{group.gainer}}</span> | <span style="color:rgb(255,200,200)">  <i class="fa fa-caret-down"></i>  {{group.loser}}</span></div>
		                <h3 class="list-title">{{group.title}}</h3>
		            </div>
		        </div>
		        <div class="mt-list-container list-simple ext-1">
		            <ul>
		                <li class="mt-list-item gainer" v-for="instrument in group.instruments" v-on:click="blink()"  v-bind:class="{ 'loser': isLoser(instrument), 'unchanged': isUnchanged(instrument) }">
		                    <div class="list-icon-container">
		                        <i class="fa fa-caret-down"  v-bind:class="{ 'fa-caret-down': isLoser(instrument), 'fa-caret-up': isGainer(instrument), 'fa-sort': isUnchanged(instrument)}"></i>
		                        
		                    </div>
		                    		<transition name="fade"  >
					                    <div class="list-datetime" :key="instrument.close_price">
					                    	<span class="col-xs-6 text-right"  >
												    {{getValue(instrument)}}
					                    </span>
					                    	<span class="col-xs-6 text-right">{{gain(instrument)}}%</span>
					                    	   	
					                    </div>
									</transition>
		                    <div class="list-item-content">

		                            <a href="javascript:;" class="instrument_hover" :data-id="instrument.instrument_id" :data-code="instrument.instrument_code">{{instrument.instrument_code}}</a>
		                       
		                    </div>
		                </li>
		            </ul>
				</div>
				</div>
		</div>
	</div>

</template>
<style scoped >
.fade-enter-active, .fade-leave-active {
  transition: opacity .2s;
  background: green;
  color:#fff;
}
.gainer.loser  .fade-enter-active, .fade-leave-active {
  /*transition: opacity .5s;*/
  background: rgba(255, 0, 0, .5 );;
  color:#fff;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  /*opacity: 0;*/
  display: none;
  /*background: red;*/
}
*{
	font-size: 0.94em;
	font-weight: bold;
}
	.col-xs-6{
		padding: 0;
	}

	.col-md-2, .price-board{
		margin-bottom: 1px;
		display: inline-block;
		padding: 1px;  
	}
	.gainer{
		color:green;
		background: rgba(0, 155, 0, .05);
	}
	 .gainer a{
		color:green;
	 }
	.loser{
		color:red;
	}
	.loser a{
		color:red;
	}
	.gainer.loser{
		background: rgba(155, 0, 0, .05);
		color:red;
	}
	.gainer.unchanged{
		background: rgba(0, 0, 155, .05);
		color:#009dc7 !important;
	}

	.unchanged .fa{
		font-size: 10px !important; 
	}
	.gainer.unchanged a{
		color:#009dc7 !important;
	}
	.list-datetime{
		width: 50% !important;
	}
.mt-element-list .list-simple.mt-list-head, .mt-element-list .list-simple.ext-1.mt-list-container ul>.mt-list-item {
		padding: 5px;
	}
	.mt-element-list .list-simple.mt-list-container ul>.mt-list-item>.list-datetime{
		width: auto;
	}
	.mt-element-list .list-simple.ext-1.mt-list-container ul>.mt-list-item{
		border-left:0;
	}
	.mt-element-list .list-simple.mt-list-container ul>.mt-list-item>.list-item-content{
		padding: 0;
	}
	.mt-element-list .list-simple.mt-list-container ul>.mt-list-item{
		border-color:#fff !important;
	}
	.mt-element-list .list-simple.mt-list-container ul>.mt-list-item>.list-icon-container{
		margin-top:-5px;
	}
	.mt-element-list .list-simple.mt-list-head .list-date{
		font-size: .94em;
		opacity: 1;
		padding: 0;
		text-align: right;
	}
</style>
<script>

	export default {
		props:['group', 'masonry', 'valueOf'],
		data(){
			return {
				hello: null
			}
		}
		,
		methods: {
				gain(instrument){
					//gain round(((d.close_price - d.yday_close_price)/d.close_price)*100, 2)
					var value = this.getValue(instrument)
					var prevValue = this.getPrevValue(instrument)
					return ((( value - prevValue)/value)*100).toFixed(2)
				}
			,
				getValue: function(instrument){
					return instrument[this.valueOf]
				},
				getPrevValue(instrument){
					return instrument['prev_'+this.valueOf]
				}
				,
				isGainer: function (instrument) {
					if(this.gain(instrument) > 0){
						return true;
					}
					return false;
			},
			isLoser: function (instrument) {
					if(this.gain(instrument) < 0){
						return true;
					}
					return false;
				},
			isUnchanged: function (instrument) {
					if(this.gain(instrument) == 0){
						return true;
					}
					return false;
				},
			blink: function () {
				this.hello = Math.random();
			}
		}
	};
</script>