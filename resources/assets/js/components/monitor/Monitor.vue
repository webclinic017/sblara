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
		<monitor-item :instruments="instruments"></monitor-item>
	</div>

	</div>
</template>
<script>
	export default{
		mounted(){
			// alert('mounted')
		},
		data(){
			return {
				instruments: [{"name":"janata", "id": 9}],
			}
		}
	}
</script>