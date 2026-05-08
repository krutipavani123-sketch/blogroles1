@extends('components.layout')
@section('title', 'Roles List')

@section('main')

<div class="app-card">

    <div class="d-flex justify-content-between mb-3">
        <h4>Roles List</h4>
        <a href="{{ route('roles.create') }}" class="btn btn-dark btn-sm">Create</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Permissions</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->permissions->pluck('name')->implode(', ') }}</td>
                <td>
                    <a href="{{ route('roles.edit',$role->id) }}" class="text-primary">
                          <i class="bi bi-pencil-square"></i>
                    </a>

                    <a href="{{ route('roles.delete',$role->id) }}" class="text-danger">
                        <i class="bi bi-trash2-fill"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection