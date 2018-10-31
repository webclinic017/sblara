<template>
	<div>
		<div class="row">
			<div class="col-md-3 " style="padding: 1px;">


				<input type="HIDDEN" name="symbols" id="symbols">
				<input type="HIDDEN" name="periods" id="periods">
		        <button type="button" id="saveBtn" @click="save" class="btn btn-primary btn-large" style="width: 400px" >Save List</button>
		    </div>
		    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="padding: 1px;">
				<!-- <button type="button" id="shotBtn" class="btn btn-primary" style="width: 100%" >Screen Shot</button> -->
		    </div>

		</div>

	<div class="row" v-for="i in Math.ceil(items.length / 3)">
		<monitor-item v-for="(item, index) in items.slice((i - 1) * 3, i * 3)" :item="item" :index="index + (i-1)*3" :selectedItems="selectedItems" :instruments="instruments" :intradays="intradays" :items="items"></monitor-item>
	</div>

	</div>
</template>
<script>
	export default{
		created(){
			this.loadSavedData()
			axios.get("/api/instruments").then((response)=> {
				this.instruments = response.data
					this.updateData();	

				setInterval(() =>{
					this.updateData();	
   				 }, 60000)
			})

		},
		data(){
			return {
				instruments: [],
				items: [],
				selectedItems: [-1, -1, -1, -1, -1, -1, -1, -1, -1],
				intradays: [],
				updatingStatus: true,
			}
		},
		methods: {
			loadSavedData(){
				if(loggedIn){
						this.updatingStatus = false;
						axios.get("/user/settings/monitor_instruments").then((response) => {
							if(response.data == ""){
										if( this.$cookies){
											var savedData = this.$cookies.get("monitor_instruments");
											if(savedData.split(',').length > 2){
												this.selectedItems = savedData.split(',');

											}
										}
							}else{
								this.selectedItems = response.data.split(',');
							}
							this.updatingStatus = true;
							this.updateData()
						})
				}else{

						var savedData = this.$cookies.get("monitor_instruments");
						if(savedData){
							this.selectedItems = savedData.split(',');
						}
				}
					if(this.selectedItems.length < 2){
						this.selectedItems = [-1, -1, -1, -1,-1, -1, -1, -1,-1];
					}
			},
			updateData(){
				if(!this.updatingStatus){
					return;
				}
				axios.get('/api/intraday?instruments='+this.getSelectedItems()).then((response)=> {
					// for( var key in response.data){
					// 	this.intradays[key] = response.data[key]
					// }
					// response.data.forEach((e, k) => {
					// 	console.log(e)
					// 	console.log(k)
					// })
					this.intradays = response.data;
					this.items = [];

					this.selectedItems.forEach((e)=>{
						this.items.push(e)
					})
				

					setTimeout(() => {
							var i = 0;
						this.selectedItems.forEach((e)=>{
							var child = this.$children[i];
							if(child.isToday()){
								child.onDataUpdate();
							}
							i++;
						})						
					}, 100);

				})
			},
			getSelectedItems(){
				var results = [];
				for (var i = this.selectedItems.length - 1; i >= 0; i--) {
					//skip if previous date
					var child;
					if( child =  this.$children[i]){
						if(!this.$children[i].isToday()){
							continue
						}
					}
					//skip if previous date
					if(this.selectedItems[i] != -1){
					results.push(this.selectedItems[i]) 
					}
				}
				return results;
			},
			save(){
				if(loggedIn){
					axios.post("/user/settings/monitor_instruments", {value:this.selectedItems}).then((response)=>{
						console.log(this.$cookies)
						this.$cookies.config('300d')
						this.$cookies.set("monitor_instruments", this.selectedItems)
						swal("success", "Monitor successfully saved.", "success")
					})
				}else{
					this.$cookies.config('300d')
					this.$cookies.set("monitor_instruments", this.selectedItems)
					swal("success", "Monitor successfully saved.", "success")
				}
			}
		}
	}
</script>
<style scope>	
	.vdp-datepicker__calendar{right:0;} 
</style>