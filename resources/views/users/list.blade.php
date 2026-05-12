@extends('components.layout')
@section('title', 'Roles List')

@section('main')

<div class="app-card">

    <div class="d-flex justify-content-between mb-3">
        <h4>Users List</h4>
        <a href="{{ route('users.create') }}" class="btn btn-dark btn-sm">Create</a>
    </div>

      <table id="table"
    class="table table-bordered table-sm"
    data-toggle="table"
    data-pagination="true"
    data-page-size="3"
    data-side-pagination="client"
    data-height="auto"
    data-page-list="[3,5,10,25,50,100,200,All]">

        <thead>
            <th class="px-6 py-3 text-left" width="60">No</th>
            <th class="px-6 py-3 text-left">Name</th>
             <th class="px-6 py-3 text-left">Role</th>
            <th class="px-6 py-3 text-left">Permissions</th>

            <th class="px-6 py-3 text-left">Created</th>
            <th class="px-6 py-3 text-left">Action</th>
        </tr>
    </thead>

    <tbody class="bg-white">
        @foreach($users as $user)
        <tr>
            <td class="px-6 py-3 text-left">{{ $user->id }}</td>
            <td class="px-6 py-3 text-left">{{ $user->name }}</td>
             <td>
        {{ $user->roles->pluck('name')->implode(', ') }}
    </td>
            <td class="px-6 py-3 text-left">{{ $user->roles
    ->flatMap->permissions
    ->pluck('name')
    ->unique()
    ->implode(', ') }}
    </td>
            <td class="px-6 py-3 text-left">{{ $user->created_at->format('d M, Y') }}</td>

            <td class="px-6 py-3 text-left">

                <a href="{{ route('users.edit', $user->id) }}">
    <i class="bi bi-pencil-square"></i>
</a>

                <a href="{{ route('users.delete',$user->id) }}" ><i class="bi bi-trash2-fill"></i></a>
            </td>
        </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection