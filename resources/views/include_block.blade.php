 @php
 $paramArr=explode(':',$param);
          $viewData=array();
         foreach($paramArr as $each_param)
         {
             $explodeArr=explode('=',$each_param);
             $param_name=$explodeArr[0];
             $param_value=$explodeArr[1];

             $viewData[$param_name]=$param_value;

         }
         $viewData=r_collect($viewData);

// \Cache::forget(md5($viewData['block_name']. join('_', $viewData->toArray())));
  $page = \Cache::remember(md5($viewData['block_name']. join('_', $viewData->toArray())), 1, function () use ($viewData)
  {
  	return  base64_encode(view($viewData['block_name'], $viewData)) ;
  });
  echo base64_decode($page);

 @endphp




