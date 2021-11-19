@extends('layouts.app')

@section('title')
    Article Space - featured
@endsection

@section('content')
    <br />
    <br />
    <br />
    <br />
    <div class="container-fluid">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @if (!empty($featured))
                    @foreach ($featured as $feature)
                        <div class="col d-flex align-items-stretch">
                            <div class="card shadow-sm">

                                <img src="{{ url('uploads/thumbnails', $feature->article->thumbnail) }}"
                                    class="img-fluid" alt="" sizes="" srcset="" />
                                <div class="card-body">
                                    <hr />
                                    <p class=" card-title text-center">
                                        {{ $feature->article->title }}
                                    </p>
                                    <hr />
                                    <p class="card-text text-justify">{{ $feature->article->summary }}</p>

                                </div>
                                <div class=" card-footer">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{ route('article.show', $feature->article->id) }}">
                                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                                    <i class="fa fa-eye"></i> View
                                                </button>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                                {{ $feature->article->like->count() }}
                                            </button>
                                        </div>
                                        <small
                                            class="text-muted">{{ $feature->article->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @else
                    No Featured Article and blog post
                @endif


            </div>
        </div>
    </div>
@endsection
