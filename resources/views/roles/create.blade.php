@extends('layouts.app')
@section('content')
    <div class="col-lg-4">
        <h1>
            Add Role
        </h1>
        <hr>
        <form action="" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control"
                       value="{{ old('name') }}"/>
            </div>
            <h5><b>Assign Permissions</b></h5>
            <div class="form-group">
                @foreach($permissions as $permission)
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                    <label>{{ $permission->name }}</label>
                @endforeach
            </div>
            <input type="submit" value="Add Role" class="btn btn-success"/>
        </form>
    </div>
@endsection