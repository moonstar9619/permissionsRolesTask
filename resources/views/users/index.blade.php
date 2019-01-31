@extends('layouts.app')
@section('content')
    <div class="col-lg-10">
        <h1>
            User Administration
        </h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User Roles</th>
                    <th>Opertations</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles()->pluck('name')->implode(' ') }}</td>
                        <td>
{{--                            @if(auth()->user()->can('Edit User') || auth()->user()->can('AllPermission'))--}}
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info pull-left"
                                   style="margin-right: 3px;">Edit</a>
                            {{--@endif--}}
                            @if(auth()->user()->can('Delete User') || auth()->user()->can('AllPermission'))
                                <a href="{{ route('user.delete',$user->id) }}"
                                   class="btn btn-danger pull-left">Delete</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        @if( auth()->user()->can('Create User')|| auth()->user()->can('AllPermission'))
            <a href="{{ route('user.create') }}" class="btn btn-success">Add User</a>
        @endif
    </div>
@endsection