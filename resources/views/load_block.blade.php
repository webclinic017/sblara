@if($viewData['block_name']=='block.minute_chart')
 @include('block.minute_chart', array('instrument_id' => $viewData['instrument_id']))
@endif

@if($viewData['block_name']=='block.sector_minute_chart')
 @include('block.sector_minute_chart', array('instrument_id' => $viewData['instrument_id']))
@endif

@if($viewData['block_name']=='block.news_chart')
 @include('block.news_chart', array('instrument_id' => $viewData['instrument_id']))
@endif

@if($viewData['block_name']=='block.market_frame_old_site')
 @include('block.market_frame_old_site', array('instrument_id' => $viewData['instrument_id'],'height' => $viewData['height'],'base' => $viewData['base']))
@endif

@if($viewData['block_name']=='block.news_box')
 @include('block.news_box', array('instrument_id' => $viewData['instrument_id'],'limit' => $viewData['limit']))
@endif

