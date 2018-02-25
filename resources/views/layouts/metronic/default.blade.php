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
        <!-- BEGIN CONTAINER -->
        <div class="wrapper">
            <!-- BEGIN HEADER -->
            @include('includes.metronic.header')
            <!-- END HEADER -->
            <div class="container-fluid">
                <div class="page-content">

                    <!-- BEGIN BREADCRUMBS -->
                    <div class="breadcrumbs hidden-xs hidden-sm">
                        <h1>@yield('page_heading')</h1>
                        <h1>@yield('title')</h1>
                        @include('html.breadcrumbs')
                     </div>
                     <div class="alert alert-info alert-info">
                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
{{--                          Dear valued visitors, we have added 59 candlestick patterns in our TA chart
                         <a target="_blank" href="{{url('/ta-chart')}}" class="alert-link"> Please check this one as well. </a>
                         If you have any suggestion, you can drop an email to info@stockbangladesh.com --}}
                         
                                                  Dear valued visitors, we have released our new Amibroker Plugin. Please 
                         <a target="_blank" href="{{url('/resources/amibroker-data-plugin-dse')}}" class="alert-link"> click here  </a> to check this one as well.
                         If you have any suggestion, you can drop an email to info@stockbangladesh.com

                     </div>
                        @include('global-ui')

                    <!-- END BREADCRUMBS -->


                    <!-- BEGIN ads beneath the main menu -->
                     @include('ads.under_the_menu_1')
                     <!-- END ads beneath the main menu -->


                    <!-- BEGIN SIDEBAR CONTENT LAYOUT -->
                    <div class="page-content-container">

{{-- custom mod for ad --}}

                         @yield('content')

        {{-- full width content --}}
                         @yield('full-width-content')
                                             <!-- resposive_new_site -->
<div class="row">
    <div class="col-md-12">
        @include('ads.google_responsive')
    </div>
</div>
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


    </body>

</html>