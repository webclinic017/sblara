 @php 
 // \Cache::forget(md5($viewData['block_name']. join('_', $viewData->toArray())));
  $page = \Cache::remember(md5($viewData['block_name']. join('_', $viewData->toArray())), 1, function () use ($viewData)
  {
  	return  base64_encode(view($viewData['block_name'], $viewData)) ;
  });
  echo base64_decode($page);
 @endphp
