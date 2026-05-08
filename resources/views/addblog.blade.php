@extends('components.layout')

@section('title', 'Blog List')

@section('main')

@role('admin')

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">

    <div class="col-md-5">

        <div class="card shadow-lg border-0 rounded-4">

            <div class="card-header bg-primary text-white text-center rounded-top-4">
                <h4 class="mb-0">Add Blog</h4>
            </div>

            <div class="card-body p-4">

                <form method="POST" action="{{ url('bloglist') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-check mb-3">
                        <input type="checkbox" name="isfeatured" class="form-check-input" id="featured">
                        <label class="form-check-label" for="featured">
                            Featured
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

          
                    <button type="submit" class="btn btn-primary w-100">
                        Add Blog
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endrole

@endsection