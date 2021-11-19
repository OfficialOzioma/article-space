@extends('layouts.app')

@section('title')
    Settings
@endsection

@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="d-flex justify-content-center align-items-center">
            <h4 class="text-right text-capitalize">Profile Settings</h4>
        </div>
        @if (Session::has('message'))
            <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show">
                {{ Session::get('message') }}
                <script>
                    alert("{{ Session::get('message') }}");
                </script>
                <button type="button" class="close float-right" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    @if (!empty($user->settings))

                        <img class="rounded-circle mt-5" width="150px"
                            src="{{ url('uploads/profile_pictures/'. $user->settings->profile_pic) }}">
                    @else
                        <img class="rounded-circle mt-5" width="150px"
                            src="{{ url('uploads/profile_pictures/default/user_icon2.jpg') }}">
                    @endif

                    <span class="font-weight-bold mt-3">{{ $user->name }}</span>
                    <span class="text-black-50">{{ $user->email }}</span>
                    <br>

                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <form action="{{ route('profile.update', $user->username) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <h5>Profile picture </h5>
                            <img id="output" width="100%" height="100%" class=" d-flex mb-3" />
                            <input class="form-control form-control-lg mb-3" name="thumbnail" accept="image/*"
                                id="formFileLg" type="file"
                                onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])"
                                capture>

                            @error('thumbnail')
                                <div class="alert alert-danger mt-2 p-2">{{ $message }}</div>
                                <script>
                                    alert('{{ $message }}');
                                </script>
                            @enderror
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 mb-5">
                                <label class="labels">Name</label>
                                <input type="text"
                                    class="form-control form-control-lg mb-3 @error('name') is-invalid @enderror"
                                    name="name" placeholder="enter your name" value="{{ $user->name }}" required
                                    readonly>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-5">
                                <label class="labels">Email Address</label>
                                <input type="text"
                                    class="form-control form-control-lg mb-3 @error('email') is-invalid @enderror"
                                    name="email" placeholder="enter email address" value="{{ $user->email }}" required
                                    readonly>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-5">
                                <label class="labels">Username</label>
                                <input type="text"
                                    class="form-control form-control-lg mb-3 @error('username') is-invalid @enderror"
                                    name="username" placeholder="enter your Username" value="{{ $user->username }}"
                                    required readonly>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-5">
                                <label class="labels">
                                    <h5>
                                        <a href="#" class="btn btn-primary">Click here</a>
                                        to change or upadate your name, email, and username
                                    </h5>
                                </label>
                            </div>
                            <div class="col-md-12 mb-5">
                                <label class="labels">Bio</label>
                                <textarea class="form-control form-control-lg mb-3 @error('bio') is-invalid @enderror"
                                    name="bio" id="bio" maxlength="200" placeholder="enter bio maximum 200 characters"
                                    required>{{ $user->settings->bio ?? '' }}</textarea>
                                @error('bio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <button class="btn btn-primary btn-lg" type="submit">
                                Update Profile
                            </button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <form action="{{ route('profile.password.update', $user->username) }}" method="post"
                        class="needs-validation" enctype="multipart">
                        @csrf

                        <div class="d-flex justify-content-between align-items-center experience">
                            <span>Change Password</span>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <label class="labels">Old Password</label>
                            <input type="password" name="current_password"
                                class="form-control @error('current_password') is-invalid @enderror" required
                                placeholder="Enter current password">
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <br>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels">New Password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" required
                                    placeholder="Enter the new password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Confirm Password</label>
                                <input type="password" name="confirm_password"
                                    class="form-control @error('confirm_password') is-invalid @enderror" required
                                    placeholder="Enter same password">
                                @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror

                            </div>
                            <div class="mt-5 text-center">
                                <button class="btn btn-primary btn-lg" type="submit">
                                    Save password
                                </button>
                            </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
