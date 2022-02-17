@extends('layouts.app')

@section('title')
    show Articles
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .link-muted {
            color: #aaa;
        }

        .link-muted:hover {
            color: #1266f1;
        }

        .bottom {
            padding: 0 20px;
            margin-bottom: 17px;
        }

    </style>

@endsection

@section('content')

    <div class="container-fluid">
        <main>
            <!--================Blog Area =================-->
            <section class="blog_area single-post-area section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 posts-list ">
                            {{-- @foreach ($findArticle as $article) --}}
                            <div class="single-post">
                                <h1>
                                    {{ $findArticle->title }}
                                </h1>
                                <ul class="blog-info-link mt-3 mb-4">
                                    <small class="text-muted">
                                        <li>Posted By &nbsp;
                                            <a href="#">
                                                <i class="fa fa-user"></i>
                                                {{ $findArticle->user->name }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fas fa-clock"></i>
                                                {{ $findArticle->created_at->diffForHumans() }}
                                            </a>
                                        </li>
                                    </small>

                                </ul>
                                <div class="feature-img">
                                    <img class="img-fluid w-100"
                                        src="{{ url('uploads/thumbnails/' . $findArticle->thumbnail) }}">
                                </div>
                                <div class="blog_details">


                                    <div>
                                        <p class="lh-lg"> {!! $findArticle->article !!} </p>
                                    </div>
                                </div>
                            </div>
                            {{-- @endforeach --}}

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
                            <div class="navigation-top">
                                <div class="d-sm-flex justify-content-between text-center">
                                    <p class="like-info">
                                    <form action="{{ route('like', $findArticle->id) }}" method="post">
                                        @csrf
                                        @if ($findArticle->like->contains('user_id', auth()->user()->id) == true)
                                            <input type="hidden" name="like" value="like">
                                            <span class="align-middle" style="font-size:13pt;">
                                                <button type="submit" class="btn btn-outline-success mr-3">
                                                    <i class="fas fa-thumbs-up" style="font-size:20pt;"></i>
                                                </button>
                                                <span>
                                                    @if ($findArticle->like->count() == 1)
                                                        <small> You liked this article</small>
                                                    @elseif ($findArticle->like->count() == 2)
                                                        <small>
                                                            You and {{ $findArticle->like->count() - 1 }} other person
                                                            liked this
                                                            article
                                                        </small>
                                                    @else
                                                        <small>
                                                            You and {{ $findArticle->like->count() - 1 }} people liked
                                                            this article
                                                        </small>
                                                    @endif
                                                </span>
                                            </span>
                                        @else
                                            <input type="hidden" name="unlike" value="unlike">
                                            <span class="align-middle" style="font-size:13pt;">
                                                <button type="submit" class="btn btn-outline-success mr-3">
                                                    <i class="far fa-thumbs-up" style="font-size:20pt;"></i>
                                                </button>
                                                <span>
                                                    @if ($findArticle->like->count() == 1)
                                                        <small>{{ $findArticle->like->count() }} person liked this
                                                            article</small>
                                                    @else
                                                        <small>
                                                            {{ $findArticle->like->count() }} people liked this article
                                                        </small>
                                                    @endif
                                                </span>

                                            </span>
                                        @endif

                                    </form>

                                    </p>
                                    <div class="col-sm-4 text-center my-2 my-sm-0">
                                        <p class="comment-count">
                                            <span class="align-middle" style="font-size:13pt;">
                                                <i class="fas fa-comments" style="font-size:27pt;"></i>
                                                {{ $numberOfComments }} Comments
                                            </span>
                                        </p>
                                    </div>

                                    <ul class="social-icons">
                                        <span class="mr-20">Share:</span>
                                        <li><a href="#"><i class="fab fa-facebook-f" style=" font-size:17pt;"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter" style=" font-size:17pt;"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin" style=" font-size:17pt;"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram" style=" font-size:17pt;"></i></a></li>
                                    </ul>

                                </div>

                            </div>
                            <div>

                            </div>

                            <section class="w-100">

                                <div class="my-5 py-5 ">

                                    <h5>{{ $numberOfComments }} Comment (s)</h5>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-12 col-lg-10 col-xl-8">
                                            <div class="card ">
                                                @foreach ($findArticle->comments as $comments)
                                                    <div class="card-body border-0">
                                                        <div class="d-flex flex-start align-items-center">
                                                            <img class="rounded-circle shadow-1-strong me-3"
                                                                src="{{ url('uploads/profile_pictures/' . $user->settings->profile_pic) }}"
                                                                alt="avatar" width="60" height="60" />
                                                            <div>
                                                                <h6 class="fw-bold text-primary mb-1">
                                                                    {{ $user->name }}</h6>
                                                                <p class="text-muted small mb-0">
                                                                    <span class="badge bg-primary">user</span> -
                                                                    {{ $comments->created_at->diffForHumans() }}
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <p class="mt-3 mb-2 pb-2">
                                                            {{ $comments->comment }}
                                                        </p>

                                                        <div class="btn-group small d-flex justify-content-start">

                                                            <a href="#textAreaExample"
                                                                class="btn btn-outline-primary  btn-sm align-items-center me-3">
                                                                <i class="fas fa-comment-dots me-2"></i>
                                                                <p class="mb-0"></p>
                                                            </a>
                                                            <a href="#!"
                                                                class="btn btn-outline-success  btn-sm align-items-center me-3">
                                                                <i class="fas fa-edit me-2"></i>
                                                                <p class="mb-0"></p>
                                                            </a>
                                                            <a href="#!"
                                                                class="btn btn-outline-danger  btn-sm align-items-center me-3">
                                                                <i class="fas fa-trash me-2"></i>
                                                                <p class="mb-0"></p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                                                    <form class="form-contact comment_form"
                                                        action="{{ route('comment', $findArticle->id) }}"
                                                        id="commentForm" method="POST">
                                                        @csrf
                                                        <div class="d-flex flex-start w-100">
                                                            <img class="rounded-circle shadow-1-strong me-3"
                                                                src="{{ url('uploads/profile_pictures/' . $user->settings->profile_pic) }}"
                                                                alt="avatar" width="40" height="40" />
                                                            <div class="form-outline w-100">
                                                                <textarea class="form-control" id="textAreaExample"
                                                                    rows="5" name="comment"
                                                                    style="background: #fff;"></textarea>
                                                                <label class="form-label"
                                                                    for="textAreaExample">Comment</label>
                                                            </div>
                                                        </div>
                                                        <div class="float-end mt-2 pt-1">
                                                            <button type="submit" class="btn btn-primary btn-sm">Post
                                                                comment</button>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        </div>
                        <div class="col-lg-4">
                            <div class="blog_right_sidebar">
                                <aside class="single_sidebar_widget search_widget">
                                    <div class="card" style="width: 18rem;">
                                        <img src="{{ url('uploads/profile_pictures/' . $settings->profile_pic) }}"
                                            class="card-img-top img-fluid rounded-start" alt="..." style="heigh:auto;">
                                        <div class="card-body align-items-center">
                                            <div class="ml-3 w-100">
                                                <h5 class="card-title mb-0 mt-0">{{ $findArticle->user->name }}</h5>
                                                <div class="p-2 mt-2  d-flex  rounded text-white">
                                                    <p class="card-text">{{ $settings->bio }}</p>
                                                </div>
                                                <div class="bottom mt-3">
                                                    <a class="btn btn-primary btn-twitter btn-sm" href="#">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-sm" rel="publisher" href="#">
                                                        <i class="fab fa-google-plus"></i>
                                                    </a>
                                                    <a class="btn btn-primary btn-sm" rel="publisher" href="#">
                                                        <i class="fab fa-facebook"></i>
                                                    </a>
                                                    <a class="btn btn-warning btn-sm" rel="publisher" href="#">
                                                        <i class="fab fa-behance"></i>
                                                    </a>
                                                </div>
                                                <div class="button mt-2 d-flex flex-row align-items-center">
                                                    <button class="btn btn-sm btn-outline-primary w-100 mr-2">Chat</button>
                                                    <button class="btn btn-sm btn-primary w-100 ml-2">Follow</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </aside>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--================ Blog Area end =================-->
        </main>
    </div>

@endsection
