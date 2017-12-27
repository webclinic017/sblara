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
            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form class="forget-form" action="/password/email" method="post" style="display: block;">
                {{ csrf_field() }}
                <input type="hidden" name="reset" value="1">
                <h3>Forget Password ?</h3>
                        @if ($errors->has('username') || $errors->has('email'))
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span> {{$errors->first('username')}} {{$errors->first('email')}} </span>
                </div>
                        @endif   
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif                                       
                <p> Enter your e-mail address below to reset your password. </p>
                <div class="form-group  {{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="input-icon">
                        <i class="fa fa-envelope"></i>
                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" value="{{old('email')}}" placeholder="Email" name="email" /> </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn green pull-right"> Submit </button>
                    <div class="clearx" >    </div>
                </div>
            </form>
            <!-- END FORGOT PASSWORD FORM -->
            <!-- BEGIN REGISTRATION FORM -->
   

            <!-- END REGISTRATION FORM -->
        </div>    
</div>



@endsection
