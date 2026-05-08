 @extends('components.layout')

@section('title', 'Edit Role')

@section('main')



<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users/Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">
                   <form action="{{ route('users.update',$users->id) }}" method="post">
@csrf
                        <div>
                            <label for="" class="text-lg font-medium">Edit Users</label>
                            <div class="my-3">

                                <label for="" class="text-lg font-medium">Name</label>
                            <div class="my-3"></div>
                                <input value="{{ old('name',$users->name) }}" name="name" type="text" class="border border-gray-300 shadow-sm w-1/2 rounded-lg">

                                <label for="" class="text-lg font-medium">Email</label>
                            <div class="my-3"></div>
                                <input value="{{ old('email',$users->email) }}" name="email" type="text" class="border border-gray-300 shadow-sm w-1/2 rounded-lg">

                                    @error('name')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                    @enderror
                            </div>

                            <div class="grid grid-cols-4 mt-3">
                                @if($roles->isNotEmpty())
                                @foreach($roles as $role)
                                <div class="mt-3">
                                    {{-- {{ $hasPermissions->contains($user->name)? 'checked':'' }}  --}}
                                    <input type="checkbox" id="role-{{ $role->id }}" class="rounded" name="role[]" value="{{ $role->name }}"
                                     {{ $users->roles->contains('name', $role->name) ? 'checked' : '' }}>
                                    <label for="role-{{ $role->id }}" >{{ $role->name }}</label>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <button class="bg-slate-700 text-sm rounded-md px-5 py-2 text-white ">Update</button>
                        </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
