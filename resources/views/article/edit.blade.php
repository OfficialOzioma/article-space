@extends('layouts.app')

@section('title')
    Edit Article
@endsection

@section('content')
    <div class=" container-fluid">
        <div class="container">
            <div class="card">
                <img class="card-img-top" src="" alt="">
                <div class="card-body">

                    <form method="post" action="{{ route('article.update', $article->id) }}"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <h5>Title of the Article </h5>
                            <input type="text" name="title" class="form-control form-control-lg mb-5"
                                placeholder="Enter Your Title here maximum 100 characters" autocomplete="on"
                                value="{{ $article->title }}" required>
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
                                placeholder="summarize article maximum of 200 charater" maxlength="200" minlength="3"
                                required>{{ $article->summary }}</textarea>
                            @error('summary')
                                <div class="alert alert-danger mt-2 p-2">{{ $message }}</div>
                                <script>
                                    alert('{{ $message }}');
                                </script>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h5>Add display picture </h5>
                            <img id="output" src="{{ url('uploads/thumbnails', $article->thumbnail) }}" width="400"
                                height="400" class=" d-flex mb-3" />
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

                        <div class="form-group">
                            <h5>Who will see this Article </h5>
                            <select class="form-control form-control-lg mb-3" name="visibility" id="visibility">
                                <option disabled selected>{{ $article->visibility }}
                                </option>
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
                                placeholder="Type your article here">{{ $article->article }}</textarea>
                        </div>
                        @error('editor')
                            <div class="alert alert-danger mt-2 p-2">{{ $message }}</div>
                            <script>
                                alert('{{ $message }}');
                            </script>
                        @enderror

                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-success btn-lg mt-3 w-100">
                                Update this Article
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script src="{{ asset('ckeditor/build/ckeditor.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
