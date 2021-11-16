@extends('layouts.errors')

@section('content')
    <h1>404</h1>
    <h2>Uh, Ohh</h2>
    <h3>Sorry we cant find what you are looking for 'cuz its so dark in here</h3>
    <h3>
        <button class="btn">
            <a href="{{ route('home') }}">Go Back</a>
        </button>
    </h3>
@endsection
