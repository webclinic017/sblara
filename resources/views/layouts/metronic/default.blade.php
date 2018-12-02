<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->

    <!-- BEGIN HEAD -->
@include('includes.metronic.head')
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-md">
{{-- anouncements --}}
@php 
   
  if(isset($_GET['action']) && $_GET['action'] == 'closeAnouncement'){
    $_COOKIE["closeAnouncement"] = 'hide';
    setcookie("closeAnouncement", "hide", time() + (86400 * 30), "/");

  }

$course = \App\Anouncement::where('expires_at', '>=', date('Y-m-d 00:00:00'))->orderBy('id', 'desc')->get();

@endphp
@if(count($course)>0 && !isset($_COOKIE["closeAnouncement"]))
      <style>
        .anouncement{
          color:#fff;
          height: 30px;
          line-height: 30px;
          width:100%;
          /*cursor: pointer;*/
          text-align: center;
          position: fixed;
          top:0;
          z-index: 9999;
          white-space: nowrap;
        }
        .navbar-fixed-top{
          margin-top:30px !important; 
        }
        @media only screen and (min-width: 1000px) {
        .navbar{
          margin-top: 37px !important;
        }
        }
        #course {
          background: url("/img/course2.jpg")  no-repeat center center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            padding-right: 0 !important;
        }
        .anouncement a{
            color:#fff !important;
            font-weight: bold;
        }
        .course-background{
          /*color:#fff !important;*/
          background: #fff;
          /*background: rgba(0,0,0, .8);*/
          height: 100%;
        }
         #course .close{
/*          background: none !important;
          color:#fff !important;*/
        }

        #course .modal-header{   
           border-bottom: 1px solid #e5e5e522;
        }
        .closeAnouncement{
          cursor: pointer;
          color:#fff;
          position: fixed;
          top:0;
          right: 0;
          background: rgba(0,0,0,.8);
          height: 30px;
          width:30px;
          line-height: 30px;
          z-index: 999999999999;
          display: inline-block;
          text-align: center;
        }
      </style>
    

<script type='text/javascript' src='//cdn.jsdelivr.net/jquery.marquee/1.4.0/jquery.marquee.min.js'></script>

      <div onclick="window.location.href='?action=closeAnouncement'" class="closeAnouncement">
        &times;
      </div>
      <div class='marquee anouncement'   style="background:#000; color:#fff"  >
    
      </div>
<script>
  $(document).ready(function () {
    var news = [];

      @foreach($course as $c)
      news.push({message: "{!! $c->message !!}", color: "{!!$c->color!!}"})
      @endforeach


    var i = 0;
    $('.marquee').html(news[0].message);
    $('.marquee').css('background', news[0].color);
    $('.marquee')
    .bind('finished', function () {
      i++;
      if(i == news.length){
        i = 0;
      }      

      $('.marquee').css('background', news[i].color);
      $(this).html(news[i].message).marquee({
        speed:8,
        pauseOnHover: true
      });  
    })
    .marquee({
      speed:8,
      pauseOnHover: true
    });

  })
</script>      
@endif
{{-- anouncements --}}



    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId=184429869012471&autoLogAppEvents=1';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
        <!-- BEGIN CONTAINER -->
        <div class="wrapper" >
            <!-- BEGIN HEADER -->
            @include('includes.metronic.header')
            <!-- END HEADER -->
            <div class="container-fluid">
                <div class="page-content">

                    <!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs hidden-xs hidden-sm">
                        <h1>@yield('page_heading')</h1>
                        <h1>@yield('title')</h1>
                        {{-- @include('html.breadcrumbs') --}}
                     </div>

                   <!-- BEGIN ads beneath the main menu -->
                      {{-- @include('ads.under_the_menu_1') --}}
                   <!-- END ads beneath the main menu -->




  {{--                    <div class="alert alert-info alert-danger">
                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>

                                                  Dear valued visitors, we have released our new Screener. Please 
                         <a target="_blank" href="{{url('/screeners')}}" class="alert-link"> click here  </a> to check this one as well.
                         If you have any suggestion, you can drop an email to info@stockbangladesh.com

                         Due to high load unfortunately our free version of amibroker plugin is unavailable.  mail to info@stockbangladesh.com for any query

                     </div> --}}

                        @if(session()->has('success'))
                     <div class="alert alert-success">
                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            {{session()->get('success')}}
                     </div>
                        @endif

                        @if(session()->has('error'))
                         <div class="alert alert-danger">
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                {{session()->get('error')}}
                         </div>
                        @endif

                        @if(Route::current()->getName()=='ta-chart-new')
                          <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="portlet light bordered">
                                        <div class="portlet-body">
                                           @include('ads.google_responsive')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(Route::current()->getName()!='advance-ta-chart')
                        @include('global-ui')
                        @endif

                        @if(Route::current()->getName()=='ta-chart-new')
                          <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="portlet light bordered">
                                        <div class="portlet-body">
                                           @include('ads.google_responsive')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                    <!-- END BREADCRUMBS -->


                    <!-- BEGIN SIDEBAR CONTENT LAYOUT -->
                    <div class="page-content-container">

{{-- custom mod for ad --}}

                         @yield('content')

        {{-- full width content --}}
                         @yield('full-width-content')
                                             <!-- resposive_new_site -->
{{--
<div class="row">
    <div class="col-md-12">
        @include('ads.google_double_click')
    </div>
</div>
--}}
                         </div>
        {{-- full width content --}}
{{-- custom mod for ad --}}


                    </div>
                    <!-- END SIDEBAR CONTENT LAYOUT -->

                </div>


                <!-- BEGIN FOOTER -->
                @include('includes.metronic.footer')
                <!-- END FOOTER -->
            </div>
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN QUICK SIDEBAR -->
        {{-- @include('includes.metronic.quick_sidebar') --}}
        <!-- END QUICK SIDEBAR -->
        <!-- BEGIN QUICK NAV -->
        {{-- @include('includes.metronic.quick_nav') --}}
        <!-- END QUICK NAV -->

         <!-- BEGIN ALL JS SCRIPTS -->
            @include('includes.metronic.js')
            @yield('js')
        <!-- END ALL JS SCRIPTS -->



        <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
            })
        </script>

<script async defer src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.0.0/masonry.pkgd.min.js"></script>
<script src="/js/passport-vue.js"></script>
    </body>

</html>