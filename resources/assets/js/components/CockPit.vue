<template>
		<div class="col-md-12" style="position:relative; height:800px; background:#000; overflow:scroll" >
				<CockPitElement :config="elements[0]"  />
		</div>
</template>
<script>
	import CockPitElement from './CockPitElement'

	export default{
		components:{
			 CockPitElement
		},
		computed: {
			elements(){ 
				var config = {};
				config.width = 200
				config.height = 200
				return [config]
			}
		}
	}
</script>
