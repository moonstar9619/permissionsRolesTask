@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Posts</h3></div>
                    @foreach($posts as $post)
                        <div class="panel-body">
                            <div>
                                <a href="{{ route('post.show',$post->id) }}"><b>{{ $post->title }}</b>
                                    <p class="content">
                                        {{ $post->body }}
                                    </p>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection