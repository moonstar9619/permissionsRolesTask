@extends('layouts.app')
@section('content')
    <div class="col-lg-10">
        <h1>
            Available Permissions
        </h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Permissions</th>
                    <th>Operations</th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>
                            @if(auth()->user()->can('Edit Permission') || auth()->user()->can('AllPermission'))
                                <a href="{{ route('permission.edit',$permission->id) }}" class="btn btn-info pull-left"
                                   style="margin-right: 3px;">Edit</a>
                            @endif
                            @if(auth()->user()->can('Delete Permission') || auth()->user()->can('AllPermission'))
                                <a href="{{ route('permission.delete',$permission->id) }}"
                                   class="btn btn-danger pull-left"
                                   style="margin-right: 3px;">Delete</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @if( auth()->user()->can('Create Permission')|| auth()->user()->can('AllPermission'))
            <a href="{{ route('permission.create') }}" class="btn btn-success">Add Permission</a>
        @endif
    </div>
@endsection