@extends('components.layout')

@section('title', 'Edit Role')

@section('main')




<div class="container d-flex justify-content-center">

    <div class="col-md-7">

        <div class="card shadow border-0 rounded-4">

            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">Edit Role</h4>
            </div>

            <div class="card-body p-4">

                <form action="{{ route('roles.update',$role->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Role Name</label>
                        <input value="{{ old('name',$role->name) }}"
                               name="name"
                               type="text"
                               class="form-control">
                        @error('name')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Permissions</label>

                        <div class="row">
                            @foreach($permissions as $permission)
                                <div class="col-md-3 mt-2">
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            name="permission[]"
                                            value="{{ $permission->name }}"
                                            class="form-check-input"
                                            {{ $hasPermissions->contains($permission->name) ? 'checked' : '' }}
                                        >
                                        <label class="form-check-label">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- BUTTON -->
                    <button class="btn btn-success w-100">
                        Update Role
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection