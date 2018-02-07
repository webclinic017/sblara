<div style="display: inline-block; width: 100%">	
<input type="hidden" id="chart_id" value="{{$viewer->getId()}}">
<?php $viewer->setImageUrl('/'.$viewer->getImageUrl()); echo $viewer->renderHTML('usemap="#map1"'); ?>
<map name="map1">
	{!!$imageMap!!}
</map>

</div>