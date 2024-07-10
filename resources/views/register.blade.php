@extends('master.layout')
@section('title',"Register")
@section('content')
    <div class="container">

        <form class="login-form" action="{{route('register')}}" method="post">
            @csrf
            <div class="login-wrap">
                <p class="login-img"><i class="icon_lock_alt"></i></p>

                <div class="input-group">
                    <span class="input-group-addon"><i class="icon_profile"></i></span>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" autofocus
                        required="true">
                    @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon_mail"></i></span>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" autofocus
                        required="true">
                    @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon_house"></i></span>
                    <textarea name="address"  rows="6" class="form-control @error('address') is-invalid @enderror" placeholder="Address"></textarea>
                    @error('address')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="input-group">
                    <span class="input-group-addon"><i class="icon_phone"></i></span>
                    <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Phone" autofocus
                        required="true">
                    @error('phone')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="input-group">
                    <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                    <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" placeholder="Password" required="true">
                    @error('password')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="input-group">
                    <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                    <input type="password" class="form-control  @error('cm_password') is-invalid @enderror" name="cm_password" placeholder="Comfrim Password" required="true">
                    @error('cm_password')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <span class="pull-right"> <a href="{{route('login')}}">If you have account?  Login</a></span>
                <button class="btn btn-primary btn-lg btn-block" type="submit" name="login">Register</button>
                <p style="margin-top:3%; font-weight:bold"><a href="{{route('user.dashboard')}}">Back to Home page</a></p>
            </div>
        </form>


    </div>


@endsection
