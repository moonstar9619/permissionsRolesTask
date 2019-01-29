@extends('layouts.app')
@section('content')
    <div class="col-lg-4">
        <h1>
            Edit {{ $user->name }}
        </h1>
        <hr>
        <form action="" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control"
                       value="{{ old('name',$user->name) }}"/>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email',$user->email) }}"/>
            </div>
            <h5>
                <b>Give Role</b>
            </h5>
            <div class="form-group">
                @foreach($roles as $role)
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                            {{ in_array($role->name,$userRoles) ? 'checked':'' }}>
                    <label>{{ $role->name }}</label>
                @endforeach
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"/>
            </div>
            <input type="submit" value="Update User" class="btn btn-primary">
        </form>
    </div>
@endsection