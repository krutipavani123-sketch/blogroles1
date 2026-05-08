@extends('components.layout')

@section('title', 'Add Roles')

@section('main')

<style>
    body {
        background: #f4f6fb;
    }

    .role-wrapper {
        min-height: 85vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .role-card {
        width: 100%;
        max-width: 650px;
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        padding: 25px;
        transition: 0.3s;
    }

    .role-card:hover {
        transform: translateY(-3px);
    }

    .role-title {
        font-size: 22px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 6px;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #ddd;
        border-radius: 10px;
        outline: none;
        transition: 0.2s;
    }

    input[type="text"]:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 5px rgba(13,110,253,0.3);
    }

    .permission-box {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 10px;
        margin-top: 10px;
    }

    .permission-item {
        background: #f8f9fa;
        padding: 8px 10px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: 0.2s;
    }

    .permission-item:hover {
        background: #e9ecef;
    }

    .btn-save {
        width: 100%;
        background: linear-gradient(135deg, #0d6efd, #4a90e2);
        border: none;
        padding: 10px;
        color: white;
        font-weight: 600;
        border-radius: 10px;
        margin-top: 15px;
        transition: 0.3s;
    }

    .btn-save:hover {
        transform: scale(1.02);
    }
</style>

<div class="role-wrapper">

    <div class="role-card">

        <div class="role-title">
            Add Roles
        </div>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{ old('name') }}">

                 <label class="form-label">Email</label>
                <input type="text" name="email" value="{{ old('email') }}">

                 <label class="form-label">Password</label>
                <input type="text" name="password" value="{{ old('password') }}">
                @error('name')
                    <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Users</label>

                <div class="permission-box">
                    @foreach($roles as $role)
                        <label class="permission-item">
                            <input type="checkbox" name="role[]" value="{{ $role->name }}">
                            <span>{{ $role->name }}</span>
                        </label>

                       
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn-save">
                Save Role
            </button>

        </form>

    </div>

</div>

@endsection