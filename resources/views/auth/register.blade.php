@extends('layouts.metronic.default')
@push('css')
<link rel="stylesheet" href="/css/login.css">
@endpush
@push('scripts')
<script src="/js/login.js">    </script>
@endpush
@section('content')
<div class="login"> 
        <div class="content">
            <!-- BEGIN LOGIN FORM -->

            <!-- END LOGIN FORM -->
 
            <!-- BEGIN REGISTRATION FORM -->
            <form class="register-form" action="/register" method="post" style="display: block;">
                                  {{ csrf_field() }}

                <input type="hidden" name="register" value="1">
                <h3>Sign Up</h3>
                        @if (session()->has('success'))
                <div class="alert alert-success">
                    <button class="close" data-close="alert"></button>
                    <span> {{session()->get('success')}} </span>
                </div>
                        @endif    
                        @if ($errors->has('username') || $errors->has('email'))
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span> {{$errors->first('username')}} {{$errors->first('email')}} </span>
                </div>
                        @endif     
                        @if ($errors->has('password'))
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span> {{$errors->first('password')}} </span>
                </div>
                        @endif    
                        @if ($errors->has('name'))
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span> {{$errors->first('name')}} </span>
                </div>
                        @endif                      
                <p> Enter your account details below: </p>
                <div class="form-group  {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="control-label visible-ie8 visible-ie9">Full Name</label>
                    <div class="input-icon">
                        <i class="fa fa-font"></i>
                        <input class="form-control placeholder-no-fix" type="text" placeholder="Full Name" name="name" value="{{old('name')}}" /> </div>
                </div>
                <div class="form-group  {{ $errors->has('email') ? ' has-error' : '' }}">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                    <div class="input-icon">
                        <i class="fa fa-envelope"></i>
                        <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email"  value="{{old('email')}}"/> </div>
                </div>


                <div class="form-group  {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password" /> </div>
                </div>
                <div class="form-group  {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
                    <div class="controls">
                        <div class="input-icon">
                            <i class="fa fa-check"></i>
                            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="password_confirmation" /> </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" id="register-submit-btn" class="btn green pull-right"> Sign Up </button>
                    <div class="clearx"></div>
                </div>
            </form>
            <!-- END REGISTRATION FORM -->
        </div>    
</div>



@endsection
