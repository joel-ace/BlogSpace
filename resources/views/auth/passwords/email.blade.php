@extends('layouts.unAuth')

@section('content')
    <div class="login-box">
        <div class="login-box-body">
            <p class="login-box-msg">Enter your email to reset your password</p>
            <form action="{{ route('password.email') }}" method="post">
                <div class="form-group has-feedback">
                    <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}" placeholder="Email" required>
                    <span class="fa fa-envelope-o form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                    </div>
                    <div class="col-xs-6">
                        <input name="recover_go" type="hidden" value="ok" />
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
                    </div>
                </div>
                {{ csrf_field() }}
            </form><br>
            <a href="{{ URL::to('login') }}">Log in to your account</a><br>
        </div>
    </div>
@endsection
