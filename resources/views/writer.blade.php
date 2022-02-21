@extends('layouts.app')

@section('title')
    Article Space
@endsection

@section('content')
    <br />
    <br />
    <style>
        .user_img {
            width: 100%;
            height: 100%;

            /*Scale down will take the necessary specified space that is 100px x 100px without stretching the image*/
            object-fit: cover;

        }

    </style>
    <main>
        <div class="container py-4">

            <div class="p-5 mb-4 bg-light rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold" align="center">This are list of all our writers</h1>
                </div>
            </div>
            <div class="row align-items-md-stretch">
                @foreach ($users as $user)
                    @if ($user->articles->count() > 0)
                        <div class="col-md-6 mb-5">
                            <div class="h-100 p-5 text-white bg-dark rounded-3">

                                <div class="">
                                    @if (!empty($user->settings))
                                        <img src="{{ url('uploads/profile_pictures/' . $user->settings->profile_pic) }}"
                                            class="user_img" />
                                    @else
                                        <img src="{{ asset('uploads/profile_pictures/default/user_icon2.jpg') }}"
                                            class="user_img" />
                                    @endif

                                </div>

                                <div class="clearfix mb-3 mt-3">
                                    <span>
                                        {{ $user->name }}
                                    </span>
                                    <span class="float-end price-hp"> Articles {{ $user->articles->count() }} </span>
                                </div>
                                @if (!empty($user->settings))
                                    <p>{{ $user->settings->bio }}</p>
                                @else
                                    No Bio
                                @endif

                                <a href="{{ route('profile', $user->username) }}" class="btn btn-outline-light">View
                                    Profile</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>




            <footer class="pt-3 mt-4 text-muted border-top">
                &copy; Article Space {{ date('Y') }}
            </footer>
        </div>
    </main>
@endsection
