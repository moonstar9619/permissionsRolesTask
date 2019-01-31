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
            {{--@can('Create Post')--}}
            @if(auth()->user()->can('Create Post') || auth()->user()->can('AllPermission'))
                <a href="" class="btn btn-info">Edit</a>
            @endif
            {{--@endcan--}}
            @if(auth()->user()->can('Delete Post') || auth()->user()->can('AllPermission'))
                <input type="submit" value="Delete" class="btn btn-danger">
            @endif
        </form>
    </div>
@endsection