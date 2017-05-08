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
                    @include('includes.metronic.breadcrumbs')

                    <!-- END BREADCRUMBS -->
                    <!-- BEGIN SIDEBAR CONTENT LAYOUT -->
                    <div class="page-content-container">
                         @yield('content')
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
        @include('includes.metronic.quick_sidebar')
        <!-- END QUICK SIDEBAR -->
        <!-- BEGIN QUICK NAV -->
        @include('includes.metronic.quick_nav')
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