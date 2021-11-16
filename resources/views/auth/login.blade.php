@extends('layouts.auth')

@section('title')
    MyBook-Login
@endsection

@section('content')
    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container">

            <div class="signin-content">
                <div class="signin-image mb-5">
                    <figure><img src="{{ asset('images/signin-image.jpg') }}" alt="sing up image"></figure>
                    <a href="/register" class="signup-image-link">
                        <button class="btn btn-secondary">Create an account</button>
                    </a>
                    <hr />
                </div>

                <div class="signin-form ">
                    <h2 class="form-title">Login</h2>
                    @if (Session::get('errors'))
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}
                        </div>
                    @endif
                    <form method="POST" action=" {{ route('authicate') }}" class="register-form" id="login-form">
                        @csrf
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="email" name="email" id="email" placeholder="Your email"
                                value="{{ old('email') }}" />
                            @error('email')
                                <div class="alert-danger">{{ $errors->first('email') }} </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="your_pass" placeholder="Password" />
                            @error('password')
                                <div class="alert-danger">{{ $errors->first('password') }} </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="remember_me" id="remember-me" class="agree-term" />
                            <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember
                                me</label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" />
                        </div>
                    </form>
                    <div class="social-login">
                        <span class="social-label">Or login with</span>
                        <ul class="socials">
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
