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
$course = \App\CourseParticipants::getActiveCourse();
@endphp
@if($course)
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
            color:#ccc !important;
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
      </style>
    

     <div id="course" class="modal fade" tabindex="-1" data-width="760">
        <div class="course-background">

              <div class="modal-header">
                  <button type="button" class="close" style="color:#fff !important" data-dismiss="modal" aria-hidden="true">xsdfdsfsffsfsdfdsf</button>
                  <h4 class="modal-title">Upcoming Course - 20th Jan (Friday - Saturday)</h4>
              </div>
              <div class="modal-body">
                  <div class="row">
                        
                        <div class="col-md-12">
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores temporibus sint accusamus harum ea hic, consectetur possimus cum excepturi non doloribus voluptate, saepe deleniti cupiditate reiciendis quam numquam. Itaque, magni.
                        </div>

                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn btn-outline dark">Close</button>
                  <button type="button" class="btn green">Save changes</button>
              </div>


        </div>

      </div>

      <div style="background: {{$course[0]->color}}" class="anouncement" {{-- data-toggle="modal" href="#course" --}} >
         <marquee onmouseover="this.stop();" onmouseout="this.start();">
           {!!$course[0]->topScrollBangla!!}
         </marquee>
      </div>
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