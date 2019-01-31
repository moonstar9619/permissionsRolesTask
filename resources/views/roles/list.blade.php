@extends('layouts.app')
@section('content')
    <div class="col-lg-10">
        <h1>
            Roles
        </h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Operations</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ str_replace(array('[',']','"'),'',$role->permissions()->pluck('name')) }}</td>
                        <td>
                            @if(auth()->user()->can('Edit Role') || auth()->user()->can('AllPermission'))
                                <a href="{{ route('role.edit',$role->id) }}" class="btn btn-info pull-left"
                                   style="margin-right: 3px;">Edit</a>
                            @endif
                            @if(auth()->user()->can('Delete Role') || auth()->user()->can('AllPermission'))
                                <a href="{{ route('role.delete',$role->id) }}" class="btn btn-danger pull-left"
                                   style="margin-right: 3px;">Delete</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @if( auth()->user()->can('Create Role')|| auth()->user()->can('AllPermission'))
            <a href="{{ route('role.create') }}" class="btn btn-success">Add Role</a>
        @endif
    </div>
@endsection
