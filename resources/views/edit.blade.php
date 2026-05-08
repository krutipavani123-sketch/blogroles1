@extends('components.layout')
@section('title', 'Edit Blog')

@section('main')

<div class="d-flex justify-content-center">
    <div class="col-md-6 app-card">

        <h4 class="app-title text-center">Edit Blog</h4>

        <form action="/edit/{{ $data->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" value="{{ $data->title }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Description</label>
                <input type="text" name="description" value="{{ $data->description }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Image</label>
                <input type="file" name="image" class="form-control">

                @if($data->image)
                    <img src="{{ asset('storage/'.$data->image) }}" width="100" class="mt-2">
                @endif
            </div>

            <button class="btn btn-success w-100">Update</button>

        </form>

    </div>
</div>

@endsection