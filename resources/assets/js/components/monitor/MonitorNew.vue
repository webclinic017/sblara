<template>
	<div>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="padding: 1px;">


				<input type="HIDDEN" name="symbols" id="symbols">
				<input type="HIDDEN" name="periods" id="periods">
		        <button type="button" id="saveBtn" class="btn btn-primary" style="width: 100%" >Save My Watch List</button>
		    </div>
		    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="padding: 1px;">
				<button type="button" id="shotBtn" class="btn btn-primary" style="width: 100%" >Screen Shot</button>
		    </div>


		</div>


	<div class="row">
		<monitor-item v-for="item in items" :item="item" :selectedItems="selectedItems" :instruments="instruments" :intradays="intradays" :items="items"></monitor-item>
	</div>

	</div>
</template>
<script>
	export default{
		created(){
			axios.get("/api/instruments").then((response)=> {
				this.instruments = response.data
					this.updateData();	
				setInterval(() =>{
					this.updateData();	
   				 }, 10000)
			})

		},
		data(){
			return {
				instruments: [],
				items: [],
				selectedItems: [12, 13, 14],
				intradays: null

			}
		},
		methods: {
			updateData(){
				axios.get('/api/intraday?instruments='+this.selectedItems).then((response)=> {
					this.intradays = response.data;
				this.items = [];
				this.selectedItems.forEach((e)=>{
					this.items.push(e)
				})
				
				this.items.push(-1)
				this.items.push(-1)
				this.items.push(-1)
				})
			}
		}
	}
</script>