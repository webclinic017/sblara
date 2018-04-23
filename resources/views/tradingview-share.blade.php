@php
$instrument = \App\Instrument::where('instrument_code', explode(':', explode("_", $image)[0])[1])->first();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Stock Bangladesh LTD| Advance chart</title>
		<meta property="og:url"                content="{{url('/storage/chartimages').'/'.$image}}" />
		<meta property="og:type"               content="article" />
		<meta property="og:title"              content="{{$instrument->name}}({{$instrument->instrument_code}})" />
		<meta property="og:description"        content="{{$instrument->name}} High configurable and nice looking technical analysis chart of Bangladesh. From 5 minutes candle to 1 hour candle available as well as daily data" />
		<meta property="og:image"              content="{{url('/storage/chartimages').'/'.$image}}.png" />	
</head>
<body>
	<img src="{{url('/storage/chartimages').'/'.$image}}.png" alt="">
</body>
</html>