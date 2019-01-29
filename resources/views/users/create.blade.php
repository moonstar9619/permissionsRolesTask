@extends('layouts.app')
@section('content')
    <div class="col-lg-4">
        <h1>
            Add User
        </h1>
        <form action="" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control"/>
            </div>
            <div class="form-group">
                @foreach($roles as $role)
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}">
                    <label>{{ $role->name }}</label>
                @endforeach
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"/>
            </div>
            <input type="submit" value="Add New User" class="btn btn-success"/>
        </form>
    </div>
@endsection