@extends('layouts.unAuth')

@section('content')
    <div class="login-box">
        <div class="login-box-body">
            <p class="login-box-msg">Login to your account</p>

            @include('partials.errors')

            <form action="{{ route('login') }}" method="post">
                <div class="form-group has-feedback">
                    <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                    <span class="fa fa-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="fa fa-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                </div>
                {{ csrf_field() }}
            </form>

            <a class="btn btn-link" href="{{ route('password.request') }}">Forgot your password? Click here</a><br>

        </div>
    </div>
@endsection
