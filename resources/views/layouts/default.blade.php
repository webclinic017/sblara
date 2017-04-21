<!DOCTYPE html>
<!-- Version: 4.7.5-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->

    <!-- BEGIN HEAD -->
    @include('includes.head')
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-md">

        <!-- BEGIN CONTAINER -->
        <div class="wrapper">

            <!-- BEGIN HEADER -->
            @include('includes.header')
            <!-- END HEADER -->

            <div class="container-fluid">
                <div class="page-content">

                    <!-- BEGIN BREADCRUMBS -->
                    @include('includes.breadcrumbs')
                    <!-- END BREADCRUMBS -->

                    <!-- BEGIN PAGE BASE CONTENT -->
                    @yield('content')
                    <!-- END PAGE BASE CONTENT -->

                </div>

                <!-- BEGIN FOOTER -->
                @include('includes.footer')
                <!-- END FOOTER -->

            </div>
        </div>
        <!-- END CONTAINER -->


        <!-- BEGIN QUICK SIDEBAR -->
        @include('includes.quick_sidebar')
        <!-- END QUICK SIDEBAR -->

        <!-- BEGIN QUICK NAV -->
        @include('includes.quick_nav')
        <!-- END QUICK NAV -->

        <!-- BEGIN ALL JS SCRIPTS -->
        @include('includes.js')
        @yield('js')
        <!-- END ALL JS SCRIPTS -->

    </body>

</html>