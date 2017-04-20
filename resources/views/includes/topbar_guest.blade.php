                            <div class="topbar-actions">
                                <!-- BEGIN GROUP NOTIFICATION -->
                                <div class="btn-group-notification btn-group" id="header_notification_bar">
                                    <a  href="{{ route('login') }}" type="button" class="btn btn-sm md-skip"  data-hover="dropdown" data-close-others="true">
                                        <i class="fa fa-sign-in"></i>
                                    </a>

                                </div>
                                <!-- END GROUP NOTIFICATION -->

                                <!-- BEGIN GROUP INFORMATION -->
                                <div class="btn-group-red btn-group">
                                    <a href="{{ route('register') }}" type="button" class="btn btn-sm md-skip"  data-hover="dropdown" data-close-others="true">
                                        <i class="fa fa-user-plus"></i>
                                    </a>

                                </div>
                                <!-- END GROUP INFORMATION -->

                                <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                                <button type="button" class="quick-sidebar-toggler md-skip" data-toggle="collapse">
                                    <span class="sr-only">Toggle Quick Sidebar</span>
                                    <i class="icon-logout"></i>
                                </button>
                                <!-- END QUICK SIDEBAR TOGGLER -->
                            </div>