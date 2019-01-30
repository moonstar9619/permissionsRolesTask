@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <hr>
        <p>
            {{ $post->body }}
        </p>
        <form action="" method="post">
            {{ csrf_field() }}
            <a href="{{ url()->previous() }}" class="btn btn-warning">Back</a>
            @can('Edit Post')
                <a href="" class="btn btn-info">Edit</a>
            @endcan
            @can('Delete Post')
                <input type="submit" value="Delete" class="btn btn-danger">
            @endcan
        </form>
    </div>
@endsection