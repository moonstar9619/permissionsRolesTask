@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>Create New Post</h1>
            <hr>
            <form action="" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="body">Post Content</label>
                    <textarea id="body" name="body" class="form-control">
                    </textarea>
                </div>
                <input type="submit" value="Create Post" class="btn btn-success btn-block btn-lg">
            </form>
        </div>
    </div>
@endsection