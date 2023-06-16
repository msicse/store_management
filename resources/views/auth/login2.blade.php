@extends('layouts.app')

@section('title','Login')



<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #17a2b8 !important;
        height: 100vh;
    }
    #login .container #login-row #login-column #login-box {

        max-width: 600px;
        height: 320px;
        border: 1px solid #9C9C9C;
        background-color: #fff;
        color: #000;

    }
    #login .container #login-row #login-column #login-box #login-form {
        padding: 20px;
    }
    #login .container #login-row #login-column #login-box #login-form #register-link {
        margin-top: -85px;
    }

</style>


@section('content')


    <div id="login">
        <form method="POST" action="{{ route('login') }}">
        @csrf
            <h1 class="text-center text-white pt-5">Store Management System (SMS)</h1>
            <div class="container pt-5">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" action="" method="post">
                                <h3 class="text-center pt-5">Login</h3>
                                <div class="form-group">
                                    <label for="email" class="">Email:</label><br>
                                    <input type="text" name="email" id="username" class="form-control">
                                    <span class="invalid-feedback">
                                        <strong>vjvjjsaefg</strong>
                                    </span>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password" class="">Password:</label><br>
                                    <input type="text" name="password" id="password" class="form-control">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group text-center">
                                    <!-- <label for="remember-me" class="te"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br> -->
                                    <input type="submit" name="submit" class="btn btn-success btn-md" value="submit">
                                </div>
                                <!-- <div id="register-link" class="text-right">
                                    <a href="#" class="text-info">Register here</a>
                                </div> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
@endsection
