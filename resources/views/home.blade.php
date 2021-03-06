@extends('layouts.app')

@section('title')
    Article Space - Home
@endsection

@section('content')

    <main class="my-5 mt-5 mt-md-5 mt-sm-5 mb-5 content">
        <div class="container mb-3">
            <h4 class="mb-5 text-center mt-md-5"><strong>Featured posts</strong></h4>
            <div class="row ">
                <div class="col-lg-4 col-md-12 mb-4">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-sm-6 mb-3">
                            <div class="card bg-dark text-white shadow-sm">
                                <img src="https://mdbootstrap.com/img/new/standard/nature/184.jpg" class="card-img"
                                    alt="...">
                                <div class="card-img-overlay">
                                    <h2 class="card-title">Card title</h2>
                                    <p class="card-text">This is a wider card with supporting text below as a natural
                                        lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text">Last updated 3 mins ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6 col-sm-6">
                            <div class="card bg-dark text-white shadow-sm">
                                <img src="https://mdbootstrap.com/img/new/standard/nature/023.jpg" class="card-img"
                                    alt="...">
                                <div class="card-img-overlay">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural
                                        lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text">Last updated 3 mins ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 mb-4 d-flex">
                    <div class="card bg-dark text-white shadow-sm flex-fill">
                        <img src="https://mdbootstrap.com/img/new/standard/nature/002.jpg" class="card-img flex-fill"
                            alt="...">
                        <div class="card-img-overlay">
                            <h2 class="card-title m-5">Card title</h2>
                            <p class="card-text">This is a wider card with supporting text below as a natural
                                lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text">Last updated 3 mins ago</p>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-12 mb-4">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-sm-6 mb-3">
                            <div class="card bg-dark text-white shadow-sm">
                                <img src="https://mdbootstrap.com/img/new/standard/nature/035.jpg" class="card-img"
                                    alt="...">
                                <div class="card-img-overlay">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural
                                        lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text">Last updated 3 mins ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6 col-sm-6">

                            <div class="card bg-dark text-white shadow-sm">
                                <img src="https://mdbootstrap.com/img/new/standard/nature/111.jpg" class="card-img"
                                    alt="...">
                                <div class="card-img-overlay">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural
                                        lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text">Last updated 3 mins ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container">
            <!--Section: Content-->
            <section class="p-5 text-justify">
                <h4 class="mb-5 text-center"><strong>Latest posts</strong></h4>

                <div class="row">
                    @if (!empty($articles) && $articles->count())
                        @foreach ($articles as $article)
                            <div class="col-lg-4 col-md-12 mb-4 d-flex align-items-stretch">
                                <div class="card border border-1">
                                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                        <img src="{{ url('uploads/thumbnails/' . $article->thumbnail) }}"
                                            class="img-fluid w-100" />
                                        <a href="{{ route('article.show', $article->slug) }}">
                                            <div class="mask"
                                                style="background-color: rgba(251, 251, 251, 0.15);">
                                            </div>
                                        </a>
                                    </div>
                                    <span class="p-2">
                                        <small class="text-muted">
                                            <small class="text-muted p-2">
                                                <i class="fa fa-user"></i>
                                                <span class="text-muted">
                                                    {{ $article->user->name }}
                                                </span>
                                            </small>|
                                            <small class="text-dark main-color">
                                                <span class="text-muted">
                                                    <i class="fas fa-clock"></i>
                                                    {{ $article->created_at->diffForHumans() }}
                                                </span>
                                            </small>
                                        </small>
                                    </span>

                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-primary text-bold">
                                            <a href="{{ route('article.show', $article->slug) }}" target="_blank"
                                                rel="noopener noreferrer" class=" text-decoration-none">
                                                {{ $article->title }}
                                            </a>
                                        </h5>

                                        <hr>
                                        <p class="card-text">
                                            <span class="text-justify">
                                                {!! Str::limit($article->article, 200, '...') !!}
                                                <a href="{{ route('article.show', $article->slug) }}"
                                                    class="text-black-50 text-decoration-none text-bold">
                                                    <strong><i>Read more</i></strong>
                                                </a>
                                            </span>
                                            <br />

                                        </p>
                                    </div>
                                    <hr>

                                    <div class=" card-footer">
                                        <div class="btn-group d-flex" role="group" aria-label="Basic example">

                                            <a href="{{ route('article.show', $article->slug) }}"
                                                class="btn btn-outline-primary">
                                                {{-- <button type="button" class="btn btn-outline-primary"> --}}
                                                <i class="fa fa-eye"></i> {{ $article->view->count() }}
                                                {{-- </button> --}}
                                            </a>

                                            <button type="button" class="btn btn-outline-success">
                                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                                {{ $article->like->count() }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        @endforeach

                    @endif
                </div>
            </section>
            <!--Section: Content-->

            <!-- Pagination -->
            <nav class="my-4" aria-label="...">
                <ul class="pagination pagination-circle justify-content-center">
                    {!! $articles->links() !!}
                </ul>
            </nav>
        </div>
    </main>
@endsection
