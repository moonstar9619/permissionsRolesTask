@extends('layouts.app)
@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>Edit Post</h1>
            <hr>
            <form action="" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control"
                    value="{{ old('name',$post->title) }}" />

                    <label for="body">Post Content</label>
                    <textarea name="body" id="body" cols="30" rows="10">
                        {{ old('body', $post->body) }}
                    </textarea>

                    <input type="submit" value="Update Post" name="save" id="save" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection