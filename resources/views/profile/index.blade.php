@extends('layouts.app')

@section('title')
    Profile
@endsection

@section('style')
    <style>
        .card {
            width: 100%;
            background-color: #efefef;
            border: none;

            transition: all 0.5s
        }

        .image img {
            transition: all 0.5s
        }

        .btn-img {
            /* height: 20%; */
            /* width: 20%; */
            border-radius: 50%
        }

        .name {
            font-size: 22px;
            font-weight: bold;
        }

        .idd {
            font-size: 14px;
            font-weight: 600
        }

        .idd1 {
            font-size: 12px
        }

        .number {
            font-size: 22px;
            font-weight: bold
        }

        .follow {
            font-size: 12px;
            font-weight: 500;
            color: #444444
        }

        .btn1 {
            height: 40px;
            width: 150px;
            border: none;
            background-color: #000;
            color: #aeaeae;
            font-size: 15px
        }

        .text span {
            font-size: 13px;
            color: #545454;
            font-weight: 500;
            font-size: 13pt;
        }

        .icons i {
            font-size: 19px
        }

        hr .new1 {
            border: 1px solid
        }

        .join {
            font-size: 14px;
            /* color: #a8d878; */
            font-weight: bold
        }

        .date {
            background-color: #ccc
        }

        .ck-editor__editable_inline {
            min-height: 500px;
            min-width: 50%;
        }

    </style>
@endsection

@section('content')

    <div class="container mt-5 mb-4 p-3 d-flex justify-content-center">
        <div class="card p-4">
            <div class=" image d-flex flex-column justify-content-center align-items-center">
                <div class="">

                    @if (!empty($user->settings))
                        <img class="rounded-circle mt-5" width="250px" class="img-fluid rounded-circle btn-img img-responsive"
                            src="{{ url('uploads/profile_pictures/' . $user->settings->profile_pic) }}">
                    @else
                        <img class="rounded-circle mt-5" width="250px" class="img-fluid rounded-circle btn-img img-responsive"
                            src="{{ asset('uploads/profile_pictures/default/user_icon2.jpg') }}">
                    @endif
                </div>

                <span class="name mt-3">
                    <h2>{{ $user->name }}</h2>
                </span>
                <span class="idd">
                    <h5>
                        <a href="#" class="text-decoration-none text-success">
                            {{ '@' . $user->username }}
                        </a>
                    </h5>
                </span>

                <div class="d-flex justify-content-between align-items-center mt-4 px-4">
                    <div class="row text-center m-t-20">
                        <div class="col-lg-4 col-md-4 m-t-20">
                            <button type="button" class="btn btn-outline-primary mb-2">
                                Followings
                                <span
                                    class="badge rounded-pill bg-success">{{ $user->followings()->get()->count() }}</span>
                            </button>
                        </div>
                        <div class="col-lg-4 col-md-4 m-t-20">
                            <button type="button" class="btn btn-outline-primary mb-2">
                                Followers <br>
                                <span
                                    class="badge rounded-pill bg-success">{{ $user->followers()->get()->count() }}</span>
                            </button>
                        </div>
                        <div class="col-lg-4 col-md-4 m-t-20">
                            <button type="button" class="btn btn-outline-primary">
                                Articles
                                <span class="badge rounded-pill bg-success">{{ $articlesCount }}</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="d-flex mt-4">
                    <div class=" p-3">

                        @if ($the_authicated_User == true)
                            <a href="{{ route('profile.settings', $user->username) }}">
                                <button class="btn btn-outline-secondary ">
                                    Edit Profile
                                </button>
                            </a>

                        @else
                            {{-- <form action="{{ route('follow') }}" method="post"> --}}
                            {{-- @csrf --}}
                            {{-- <input type="hidden" name="user_id" value="{{ $user->id }}" id="id"> --}}
                            <button class="btn btn-outline-secondary  action-follow" data-id="{{ $user->id }}">
                                <strong>
                                    @if (auth()->user()->isFollowing($user))
                                        UnFollow
                                    @else
                                        Follow
                                    @endif
                                </strong>

                            </button>
                            {{-- </form> --}}

                        @endif

                    </div>
                    <div class=" p-3">
                        {{-- <button class="btn btn-outline-success float-right">
                            <i class="fa fa-envelope" aria-hidden="true"></i> message
                        </button> --}}
                        <button type="button" class="btn btn-outline-success position-relative">
                            <i class="fa fa-envelope" aria-hidden="true"></i> Chat
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                0
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="text mt-3 w-responsive border border-5 p-2">
                    <span class=" p-2">
                        {{ $user->settings->bio ?? '' }}
                    </span>
                </div>
                <div class="gap-3 mt-3 icons d-flex flex-row justify-content-center align-items-center">
                    <span><i class="fa fa-twitter"></i></span>
                    <span><i class="fa fa-facebook-f"></i></span>
                    <span><i class="fa fa-instagram"></i></span>
                    <span><i class="fa fa-linkedin"></i></span>
                </div>
                <div class=" px-2 rounded date bg-success text-white">
                    <span class="join">
                        <h5> {{ $user->created_at->format('M d, Y') }}</h5>
                    </span>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link show active btn btn-outline-primary" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                            <h5>View Article</h5>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link btn btn-outline-primary" id="create-tab" data-bs-toggle="tab"
                            data-bs-target="#create" type="button" role="tab" aria-controls="create" aria-selected="false">
                            <h5>Create an Article</h5>
                        </button>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <section class="text-center p-5">
                            <h4 class="mb-5"><strong>Your Article</strong></h4>
                            @if (Session::has('message'))
                                <div
                                    class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show">
                                    {{ Session::get('message') }}
                                    <script>
                                        alert("{{ Session::get('message') }}");
                                    </script>
                                    <button type="button" class="close float-right" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="row ">
                                @foreach ($articles as $article)
                                    <div class="col-lg-4 col-md-12 mb-4 d-flex align-items-stretch">
                                        <div class="card border border-1">
                                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                                <img src="{{ url('uploads/thumbnails/'.$article->thumbnail) }}"
                                                    class="img-fluid" />
                                                <a href="#!">
                                                    <div class="mask"
                                                        style="background-color: rgba(251, 251, 251, 0.15);">
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title text-primary text-capitalize text-bold ">
                                                    <a href="{{ route('article.show', $article->id) }}" target="_blank"
                                                        rel="noopener noreferrer" class=" text-decoration-none">
                                                        {{ $article->title }}
                                                    </a>
                                                </h5>
                                                <hr>
                                                <p class="card-text">
                                                    <span class="text-justify">

                                                        {{ $article->summary }}
                                                    </span>
                                                    <br />
                                                    <a href="{{ route('article.show', $article->id) }}"
                                                        class="text-black-50 text-decoration-none text-bold">
                                                        <strong>read more</strong>
                                                    </a>
                                                </p>
                                            </div>
                                            <hr>
                                            <div class=" card-footer">
                                                <div class="btn-group d-flex" role="group" aria-label="Basic example">

                                                    <a href="{{ route('article.show', $article->id) }}"
                                                        class=" text-decoration-none ">
                                                        <button type="button" class="btn btn-outline-primary">
                                                            <i class="fa fa-eye"></i>
                                                            {{ $article->view->count() }}
                                                        </button>
                                                    </a>

                                                    <button type="button" class="btn btn-outline-success">
                                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                                        {{ $article->like->count() }}
                                                    </button>

                                                    <button type="button"
                                                        class="btn btn btn-outline-secondary text-decoration-none"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span class="">
                                                            more <i class="fas fa-angle-double-down"></i>
                                                        </span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('article.edit', $article->id) }}">
                                                                <i class="fas fa-edit" aria-hidden="true"></i> Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="fas fa-trash-restore" aria-hidden="true"></i>
                                                                Delete
                                                            </a>
                                                        </li>
                                                    </ul>

                                                </div>



                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" data-bs-backdrop="static"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>
                                                            Are sure you want to delete this Article ? <br />
                                                            <strong>Title:</strong>
                                                            "<i>{{ $article->title }}</i>"
                                                        </p>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <form method="post"
                                                            action="{{ route('article.destroy', $article->id) }}">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">
                                                                Yes Delete it
                                                            </button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                            <div class="mt-3">
                                <button class="btn btn-outline-primary">
                                    <i class="fa fa-eye" aria-hidden="true"></i> View all Posts
                                </button>
                            </div>
                        </section>
                    </div>
                    <div class="tab-pane fade" id="create" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row">
                            <div class="card-body">

                                <form method="post" action="{{ route('article.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <h5>Title of the Article </h5>
                                        <input type="text" name="title" class="form-control form-control-lg mb-5"
                                            placeholder="Enter Your Title here maximum 100 characters" autocomplete="on"
                                            value="{{ old('title') }}" required>
                                        @error('title')
                                            <div class="alert alert-danger mt-2 p-2">{{ $message }}</div>
                                            <script>
                                                alert('{{ $message }}');
                                            </script>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>Summarize your Article </h5>
                                        <textarea class="form-control  form-control-lg mb-3" id="" name="summary"
                                            placeholder="summarize article maximum of 200 charater" maxlength="200"
                                            minlength="3" required>{{ old('summary') }}</textarea>
                                        @error('summary')
                                            <div class="alert alert-danger mt-2 p-2">{{ $message }}</div>
                                            <script>
                                                alert('{{ $message }}');
                                            </script>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>Add display picture </h5>
                                        <img id="output" width="200" height="200" class=" d-flex mb-3" />
                                        <input class="form-control form-control-lg mb-3" name="thumbnail" accept="image/*"
                                            id="formFileLg" type="file"
                                            onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])"
                                            capture required>
                                        @error('thumbnail')
                                            <div class="alert alert-danger mt-2 p-2">{{ $message }}</div>
                                            <script>
                                                alert('{{ $message }}');
                                            </script>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>Who will see this Article </h5>
                                        <select class="form-control form-control-lg mb-3" name="visibility"
                                            id="visibility">
                                            <option disabled selected>select your visibility</option>
                                            <option value="public">Public "Everybody" </option>
                                            <option value="followers">Only my Followers and Followings</option>
                                            <option value="private">Private "Only me"</option>
                                        </select>
                                        @error('visibility')
                                            <div class="alert alert-danger mt-2 p-2">{{ $message }}</div>
                                            <script>
                                                alert('{{ $message }}');
                                            </script>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <textarea class="ckeditor form-control" id="editor" name="editor"
                                            placeholder="Type your article here">{{ old('editor') }}</textarea>
                                    </div>
                                    @error('editor')
                                        <div class="alert alert-danger mt-2 p-2">{{ $message }}</div>
                                        <script>
                                            alert('{{ $message }}');
                                        </script>
                                    @enderror

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-success btn-lg mt-3 w-100">
                                            Publish this Article
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    {{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('ckeditor/build/ckeditor.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/ajax.js') }}"></script>
@endsection
