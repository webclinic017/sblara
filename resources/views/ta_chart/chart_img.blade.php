
<input type="hidden" id="chart_id" value="{{$viewer->getId()}}">
<?php $viewer->setImageUrl('/'.$viewer->getImageUrl()); echo $viewer->renderHTML('usemap="#map1"'); ?>