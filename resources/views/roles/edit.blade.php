@extends('layouts.app')
@section('content')
    <div class="col-lg-4">
        <h1>
            Edit Role: " {{ $role->name }} "
        </h1>
        <hr>
        <form action="" method="post">
            <div class="from-group">
                <label for="name">Role Name</label>
                <input type="text" name="name" id="name" class="form-control"
                       value="{{ old('name',$role->name) }}"/>
            </div>
            <h5><b>Assign Permissions</b></h5>
            @foreach($permissions as $permission)
                <input type="checkbox" name="pemissions[]" value="{{ $permission->id }}"
                        {{ in_array($permission->name,$rolePermissions) ? 'checked':'' }}>
                <label>{{ $permission->name }}</label>
            @endforeach
            <br>
            <input type="submit" value="Update Role" class="btn btn-primary"/>
        </form>
    </div>
@endsection