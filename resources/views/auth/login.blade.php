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
            <form class="login-form" action="/login" method="post" @if(old('reset') || old('register')) style="display: none;" @endif>
            {{ csrf_field() }}
                <h3 class="form-title">Login to your account</h3>

                        @if ($errors->has('username') || $errors->has('email'))
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span> {{$errors->first('username')}} {{$errors->first('email')}} </span>
                </div>
                        @endif     
                        @if ($errors->has('active'))
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span> {{$errors->first('active')}}  </span>
                </div>
                        @endif     
                        @if ($errors->has('password'))
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span> {{$errors->first('password')}} </span>
                </div>
                        @endif                
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Enter any username and password. </span>
                </div>

                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}{{ $errors->has('username') ? ' has-error' : '' }}">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username/Email</label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username/Email" name="email" value="{{old('username')}}{{old('email')}}" /> </div>
                </div>
                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
                </div>
                <div class="form-actions">
                    <label class="rememberme mt-checkbox mt-checkbox-outline">
                        <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }} /> Remember me
                        <span></span>
                    </label>
                    <button type="submit" class="btn green pull-right"> Login </button>
                </div>

                <div class="forget-password">
                    <h4>Forgot your password ?</h4>
                    <p> no worries, click
                        <a href="/password/reset" > here </a> to reset your password. </p>
                </div>
                <div class="create-account">
                    <p> Don't have an account yet ?&nbsp;
                        <a href="/register" > Create an account </a>
                    </p>
                </div>
            </form>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->

            <!-- END FORGOT PASSWORD FORM -->
            <!-- BEGIN REGISTRATION FORM -->
         

            <!-- END REGISTRATION FORM -->
        </div>    
</div>



@endsection
