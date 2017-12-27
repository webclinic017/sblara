@extends('layouts.metronic.default')

@section('content')
    <div class="container-fluid">
            <div class="page-content-row">
                    <!-- BEGIN PAGE SIDEBAR -->
                    <div class="page-sidebar">
                        <nav class="navbar" role="navigation">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <ul class="nav navbar-nav margin-bottom-35">
                                <li class="active">
                                    <a href="index.html">
                                        <i class="icon-home"></i> Home </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-note "></i> Reports </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-user"></i> User Activity </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-basket "></i> Marketplace </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-bell"></i> Templates </a>
                                </li>
                            </ul>
                            <h3>Quick Actions</h3>
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="#">
                                        <i class="icon-envelope "></i> Inbox
                                        <label class="label label-danger">New</label>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-paper-clip "></i> Task </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-star"></i> Projects </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-pin"></i> Events
                                        <span class="badge badge-success">2</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- END PAGE SIDEBAR -->
                    <div class="page-content-col">
                        <!-- BEGIN PAGE BASE CONTENT -->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN PROFILE SIDEBAR -->
                                <div class="profile-sidebar">
                                    <!-- PORTLET MAIN -->
                                    <div class="portlet light profile-sidebar-portlet bordered">
                                        <!-- SIDEBAR USERPIC -->
                                        <div class="profile-userpic">
                                            <img src="{{ Auth::user()->image ? URL::asset("img/149x149/" . Auth::user()->image) : url('metronic/assets/layouts/layout5/img/avatar1.jpg') }}" class="img-responsive" alt=""> </div>
                                        <!-- END SIDEBAR USERPIC -->
                                        <!-- SIDEBAR USER TITLE -->
                                        <div class="profile-usertitle">
                                            <div class="profile-usertitle-name"> {{ Auth::user()->name }} </div>
                                            <div class="profile-usertitle-job"> Developer </div>
                                        </div>
                                        <!-- END SIDEBAR USER TITLE -->
                                        <!-- SIDEBAR BUTTONS -->
                                        <div class="profile-userbuttons">
                                            <button type="button" class="btn btn-circle green btn-sm">Follow</button>
                                            <button type="button" class="btn btn-circle red btn-sm">Message</button>
                                        </div>
                                        <!-- END SIDEBAR BUTTONS -->
                                        <!-- SIDEBAR MENU -->
                                        <div class="profile-usermenu">
                                            <ul class="nav">
                                                <li>
                                                    <a href="page_user_profile_1.html">
                                                        <i class="icon-home"></i> Overview </a>
                                                </li>
                                                <li class="active">
                                                    <a href="page_user_profile_1_account.html">
                                                        <i class="icon-settings"></i> Account Settings </a>
                                                </li>
                                                <li>
                                                    <a href="page_user_profile_1_help.html">
                                                        <i class="icon-info"></i> Help </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- END MENU -->
                                    </div>
                                    <!-- END PORTLET MAIN -->
                                    <!-- PORTLET MAIN -->
                                    <div class="portlet light bordered">
                                        <!-- STAT -->
                                        <div class="row list-separated profile-stat">
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <div class="uppercase profile-stat-title"> 37 </div>
                                                <div class="uppercase profile-stat-text"> Projects </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <div class="uppercase profile-stat-title"> 51 </div>
                                                <div class="uppercase profile-stat-text"> Tasks </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <div class="uppercase profile-stat-title"> 61 </div>
                                                <div class="uppercase profile-stat-text"> Uploads </div>
                                            </div>
                                        </div>
                                        <!-- END STAT -->
                                        <div>
                                            <h4 class="profile-desc-title">About Marcus Doe</h4>
                                            <span class="profile-desc-text"> Lorem ipsum dolor sit amet diam nonummy nibh dolore. </span>
                                            <div class="margin-top-20 profile-desc-link">
                                                <i class="fa fa-globe"></i>
                                                <a href="http://www.keenthemes.com">www.keenthemes.com</a>
                                            </div>
                                            <div class="margin-top-20 profile-desc-link">
                                                <i class="fa fa-twitter"></i>
                                                <a href="http://www.twitter.com/keenthemes/">@keenthemes</a>
                                            </div>
                                            <div class="margin-top-20 profile-desc-link">
                                                <i class="fa fa-facebook"></i>
                                                <a href="http://www.facebook.com/keenthemes/">keenthemes</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END PORTLET MAIN -->
                                </div>
                                <!-- END BEGIN PROFILE SIDEBAR -->
                                <!-- BEGIN PROFILE CONTENT -->
                                <div class="profile-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light bordered">
                                                @if($errors->count() > 0)
                                                    <div class="alert alert-danger">
                                                        @foreach($errors->all() as $message)
                                                            <strong>Danger!</strong> {{ $message }} <br />
                                                        @endforeach
                                                    </div>
                                                @endif
                                                @if(session('type') == 'success')
                                                    <div class="alert alert-success">
                                                        <strong>Success!</strong> {{ session('msg') }}
                                                    </div>
                                                @endif

                                                @if(session('type') == 'error')
                                                    <div class="alert alert-danger">
                                                      <strong>Danger!</strong>  {{ session('msg') }}
                                                    </div>
                                                @endif


                                                <div class="portlet-title tabbable-line">
                                                    <div class="caption caption-md">
                                                        <i class="icon-globe theme-font hide"></i>
                                                        <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                                    </div>

                                                    <ul class="nav nav-tabs">
                                                        <li class="active">
                                                            <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab_1_4" data-toggle="tab">Privacy Settings</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="tab-content">
                                                        <!-- PERSONAL INFO TAB -->
                                                        <div class="tab-pane active" id="tab_1_1">
                                                            <form role="form"  method="GET" action="{{ route('user-name-change') }}">
                                                                <div class="form-group">
                                                                    <label class="control-label">First Name</label>
                                                                    <input type="text" placeholder="John" class="form-control" name="name" value="{{ Auth::user()->name }}" /> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Last Name</label>
                                                                    <input type="text" placeholder="Doe" class="form-control" /> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Mobile Number</label>
                                                                    <input type="text" placeholder="+1 646 580 DEMO (6284)" class="form-control" /> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Interests</label>
                                                                    <input type="text" placeholder="Design, Web etc." class="form-control" /> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Occupation</label>
                                                                    <input type="text" placeholder="Web Developer" class="form-control" /> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">About</label>
                                                                    <textarea class="form-control" rows="3" placeholder="We are KeenThemes!!!"></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Website Url</label>
                                                                    <input type="text" placeholder="http://www.mywebsite.com" class="form-control" /> </div>
                                                                <div class="margiv-top-10">
                                                                    <input type="submit" class="btn green" value="Save Changes">
                                                                    <a href="javascript:;" class="btn default"> Cancel </a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END PERSONAL INFO TAB -->
                                                        <!-- CHANGE AVATAR TAB -->
                                                        <div class="tab-pane" id="tab_1_2">
                                                            <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                                laborum eiusmod. </p>
                                                            <form action="{{ route('change-image') }}" method="POST" role="form" enctype="multipart/form-data">
                                                                {{ csrf_field() }}

                                                                <div class="form-group">
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" id="output" alt="" /> </div>
                                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                                        <div>
                                                                                    <span class="btn default btn-file">
                                                                                        <span class="fileinput-new"> Select image </span>
                                                                                        <span class="fileinput-exists"> Change </span>
                                                                                        <input type="file" name="image" id="imgInp">
                                                                                    </span>
                                                                            <a class="btn default fileinput-exists" id="remove">Remove</a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix margin-top-10">
                                                                        <span class="label label-danger">NOTE! </span>
                                                                        <span>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                                                                    </div>
                                                                </div>
                                                                <div class="margin-top-10">
                                                                    <input type="submit" class="btn green" value="Submit">
                                                                    <a href="javascript:;" class="btn default"> Cancel </a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END CHANGE AVATAR TAB -->
                                                        <!-- CHANGE PASSWORD TAB -->
                                                        <div class="tab-pane" id="tab_1_3">
                                                            <form action="{{ route('user-password-change') }}" method="GET">
                                                                <div class="form-group">
                                                                    <label class="control-label">Current Password</label>
                                                                    <input type="password" name="password" class="form-control" /> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">New Password</label>
                                                                    <input type="password" name="newPassword" class="form-control" /> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Re-type New Password</label>
                                                                    <input type="password" name="rePassword" class="form-control" /> </div>
                                                                <div class="margin-top-10">
                                                                    <input type="submit" class="btn green" value="Change Password">
                                                                    <a href="javascript:;" class="btn default"> Cancel </a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END CHANGE PASSWORD TAB -->
                                                        <!-- PRIVACY SETTINGS TAB -->
                                                        <div class="tab-pane" id="tab_1_4">
                                                            <form action="#">
                                                                <table class="table table-light table-hover">
                                                                    <tr>
                                                                        <td> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus.. </td>
                                                                        <td>
                                                                            <div class="mt-radio-inline">
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios1" value="option1" /> Yes
                                                                                    <span></span>
                                                                                </label>
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios1" value="option2" checked/> No
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                                        <td>
                                                                            <div class="mt-radio-inline">
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios11" value="option1" /> Yes
                                                                                    <span></span>
                                                                                </label>
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios11" value="option2" checked/> No
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                                        <td>
                                                                            <div class="mt-radio-inline">
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios21" value="option1" /> Yes
                                                                                    <span></span>
                                                                                </label>
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios21" value="option2" checked/> No
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                                        <td>
                                                                            <div class="mt-radio-inline">
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios31" value="option1" /> Yes
                                                                                    <span></span>
                                                                                </label>
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios31" value="option2" checked/> No
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <!--end profile-settings-->
                                                                <div class="margin-top-10">
                                                                    <a href="javascript:;" class="btn red"> Save Changes </a>
                                                                    <a href="javascript:;" class="btn default"> Cancel </a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END PRIVACY SETTINGS TAB -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END PROFILE CONTENT -->
                            </div>
                        </div>
                        <!-- END PAGE BASE CONTENT -->
                    </div>
                </div>
        <!-- BEGIN FOOTER -->
        <p class="copyright"> 2016 &copy; Metronic Theme By
            <a target="_blank" href="http://keenthemes.com">Keenthemes</a> &nbsp;|&nbsp;
            <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
        </p>
        <a href="#index" class="go2top">
            <i class="icon-arrow-up"></i>
        </a>
        <!-- END FOOTER -->
    </div>


    <script>

      $("#remove").click(function(){
         $("#output").attr('src','http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image');
      });

        document.getElementById("imgInp").onchange = function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                document.getElementById("output").src = e.target.result;
            };

            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        };

    </script>

@endsection
