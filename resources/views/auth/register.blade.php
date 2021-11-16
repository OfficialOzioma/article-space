@extends('layouts.auth')


@section('title')
    MyBook-Registration
@endsection

@section('content')
    <!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Sign up</h2>
                    <form method="POST" action="{{ route('registration') }}" class="register-form" id="register-form">
                        @csrf
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="name" id="name" placeholder="Your Name" value="{{ old('name') }}"
                                minlength="3" required />
                        </div>
                        @error('name')
                            <div class="alert-danger p-2 mb-2">{{ $errors->first('name') }} </div>
                        @enderror
                        <div class="form-group">
                            <label for="username"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="username" id="username" placeholder="Your username"
                                value="{{ old('username') }}" minlength="3" required />
                        </div>
                        @error('username')
                            <div class="alert-danger p-2 mb-2">{{ $errors->first('username') }} </div>
                        @enderror
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Your Email"
                                value="{{ old('email') }}" required />
                        </div>
                        @error('email')
                            <div class="alert-danger p-2 mb-2">{{ $errors->first('email') }} </div>
                        @enderror
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="pass" placeholder="Password" minlength="8"
                                required />
                        </div>
                        @error('password')
                            <div class="alert-danger p-2 mb-2">{{ $errors->first('password') }} </div>
                        @enderror

                        <div class="form-group">
                            <input type="checkbox" name="terms" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all
                                statements in <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        @error('terms')
                            <div class="alert-danger p-2 mb-2">{{ $errors->first('terms') }} </div>
                        @enderror
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                        </div>
                    </form>
                </div>

                <div class="signup-image">
                    <figure><img src="{{ asset('images/signup-image.jpg') }}" alt="sing up image"></figure>
                    <a href="/login" class="signup-image-link text-bold">I am already member</a>
                    <hr />
                </div>
            </div>
        </div>
    </section>
@endsection
