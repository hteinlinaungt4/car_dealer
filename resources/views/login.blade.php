@extends('master.layout')
@section('title', 'Register')
@section('content')
    <div class="container">

        <form class="login-form" action="{{route('login')}}" method="post">
            @csrf
            <div class="login-wrap">
                <p class="login-img"><i class="icon_lock_alt"></i></p>
                @error('email')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon_profile"></i></span>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" autofocus
                        required="true">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                    <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" placeholder="Password" required="true">
                    @error('password')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <span class="pull-right"> <a href="{{route('register')}}">Don't you have account?  Register</a></span>
                <button class="btn btn-primary btn-lg btn-block" type="submit" name="login">Login</button>
                <p style="margin-top:3%; font-weight:bold"><a href="route('user.dashboard')">Back to Home page</a></p>
            </div>
        </form>


    </div>
@endsection
