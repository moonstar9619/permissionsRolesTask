@extends('layouts.app')
@section('content')
    <div class="col-lg-4">
        <h1>
            Edit Permission : " {{ $permission->name }} "
        </h1>
        <br>
        <form action="" method="post">
            {{ csrf_field() }}
            <div class="from-group">
                <label for="name">Permission Name</label>
                <input type="text" name="name" id="name" class="form-control"
                       value="{{ old('name',$permission->name) }}"/>
            </div>
            <br>
            <input type="submit" value="Update Permission" class="btn btn-primary"/>
        </form>
    </div>
@endsection