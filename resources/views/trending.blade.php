@extends('layouts.app')

@section('title')
    Article Space
@endsection

@section('content')
    <br />
    <br />
    <br />
    <br />

    <div class="container-fluid">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @if (count($trending))
                    @foreach ($trending as $trend)
                        <div class="col d-flex align-items-stretch">
                            <div class="card shadow-sm">

                                <img src="{{ url('uploads/thumbnails/' . $trend->thumbnail) }}" class="img-fluid"
                                    alt="" sizes="" srcset="" />

                                <div class="card-body d-flex flex-column">
                                    <hr />
                                    <p class=" card-title text-center">
                                        {{ $trend->title }}
                                    </p>
                                    <hr />
                                    <span>
                                        <p class="card-text text-justify">
                                            {!! Str::limit($trend->article, 200, '') !!}
                                        </p>
                                    </span>

                                </div>
                                <div class=" card-footer">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{ route('article.show', $trend->slug) }}">
                                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                                    <i class="fa fa-eye"></i> Read
                                                </button>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                                {{ $trend->totallike }}
                                            </button>
                                        </div>
                                        <small class="text-muted">{{ $trend->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @else
                    <div align="center">
                        No Trending Article and blog post
                    </div>
                @endif


            </div>
        </div>
    </div>
@endsection
