    <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta content="width=device-width, initial-scale=1" name="viewport" />
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <title>@yield('meta-title','Share Market Analysis Portal For Dhaka Stock Exchange-Bangladesh')</title>
            <meta content="@yield('meta-description','First and oldest financial portal based on share markets of Bangladesh. Pioneer in technical analysis of Bangladesh')" name="description" />
            <meta content="" name="author" />

            <meta property="fb:app_id"          content="@yield('fb:app_id','184429869012471')" />
            <meta property="og:type"            content="@yield('og:type','website')" />
            <meta property="og:url"             content="@yield('og:url',url()->full())" />
            <meta property="og:title"           content="@yield('og:title','Share Market Analysis Portal For Dhaka Stock Exchange-Bangladesh')" />
            <meta property="og:image"           content="@yield('og:image',url('img/sbThumb.jpg'))" />
            <meta property="og:description"    content="@yield('og:description','First and oldest financial portal based on share markets of Bangladesh. Pioneer in technical analysis of Bangladesh')" />


            {{--<meta property="fb:app_id" content="184429869012471" />--}}

            {{--<meta property="og:image" content="{{url('img/sbThumb.jpg')}}">--}}
            <!-- BEGIN LAYOUT FIRST STYLES -->
            <link href="//fonts.googleapis.com/css?family=Oswald:400,300,700" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="/css/animate.css">
            <!-- END LAYOUT FIRST STYLES -->
            <!-- BEGIN GLOBAL MANDATORY STYLES -->
            
                <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
                <link href="/metronic_home.css" rel="stylesheet" type="text/css" />
            <!-- END PAGE LEVEL PLUGINS -->
             <link href="{{ URL::asset('metronic_custom/custom.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ URL::asset('css/se.css') }}?v=0.03{{uniqid()}}" rel="stylesheet" type="text/css" />
            <link rel="shortcut icon" type="image/png" href="/favicon.ico" />

            @stack('css')
            <script>
                    window.Laravel = {!! json_encode([
                        'csrfToken' => csrf_token(),
                    ]) !!};
                    var urlName = '{{\Request::route()->getName()}}';
                    var loggedIn = {{\Auth::guest()?'false':'true'}};
            </script>

         <script async='async' src='https://www.googletagservices.com/tag/js/gpt.js'></script>
         <script>
           var googletag = googletag || {};
           googletag.cmd = googletag.cmd || [];
         </script>

         <script>
           googletag.cmd.push(function() {
             googletag.defineSlot('/87381380/home_page_double_click2', [[728, 90], [320, 50], [970, 90]], 'div-gpt-ad-1524465580068-0').addService(googletag.pubads());
             googletag.pubads().enableSingleRequest();
             googletag.pubads().collapseEmptyDivs();
             googletag.enableServices();
           });
         </script>


    </head>
<script src="{{ mix('metronic_home.js') }}"></script>
