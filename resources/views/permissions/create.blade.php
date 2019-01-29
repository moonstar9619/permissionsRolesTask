@extends('layouts.app')
@section('content')
    <div class="col-lg-4">
        <h1>
            Add Permission
        </h1>
        <br>
        <form action="" method="post">
            {{ csrf_field() }}
            <div class="from-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control"
                       value="{{ old('name') }}"/>
            </div>
            <br>
            @if(!$roles->isEmpty())
                <h4>Assign Permission to Roles</h4>
                @foreach($roles as $role)
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}">
                    <label>{{ $role->name }}</label>
                @endforeach
            @endif
            <br>
            <input type="submit" value="Add Permission" class="btn btn-success"/>
        </form>
    </div>
@endsection