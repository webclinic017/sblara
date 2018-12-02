<template>
		<vue-draggable-resizable :w="config.width" :h="config.height" :parent="true" :active="true" >
			<div class="col-md-12"  style="background:#ffffff">

			</div>
		</vue-draggable-resizable>
</template>

<script>
	import VueDraggableResizable from 'vue-draggable-resizable'
	export default{
		props:['config'],
		components: {VueDraggableResizable},
		created(){
		},
		data(){
			return {
				h: "",
				// config:{height:200, width:200},
			}
		},
		computed:{
			html(){
				return this.h
			},
		},
	}
</script>