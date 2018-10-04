 
            <header class="page-header">
                <nav class="navbar mega-menu" role="navigation">
                    <div class="container-fluid">
                        <div class="clearfix navbar-fixed-top">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="toggle-icon">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </span>
                            </button>
                            <!-- End Toggle Button -->
                            <!-- BEGIN LOGO -->
                            <a id="index" class="page-logo" href="{{url('/')}}">
                                <img src="{{ URL::asset('metronic/assets/layouts/layout5/img/logo.jpg') }}" alt="Logo"> </a>
                                
                            <!-- END LOGO -->
                            <!-- BEGIN SEARCH -->
                            @include('search')

                            <div id="fixedStat">
                                @include('fixedStat')
                            </div>
                            <!-- END SEARCH -->

                            <!-- BEGIN TOPBAR ACTIONS -->
                            @if (Auth::guest())
                                 @include('includes.metronic.topbar_guest')
                            @else
                                 @include('includes.metronic.topbar_login')
                            @endif
                            <!-- END TOPBAR ACTIONS -->
                        </div>
                        <!-- BEGIN HEADER MENU -->
                    @include('includes.metronic.header_menu')
                        <!-- END HEADER MENU -->
                    </div>
                    <!--/container-->
                </nav>
            </header>

