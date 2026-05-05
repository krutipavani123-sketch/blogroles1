@extends('components.layout')
@section('title', 'Blog List')

@section('main')

<h1>Blog List</h1>

<form method="get" action="search">
    <div class="text-end mb-3">
        <input type="text" placeholder="search with name" name="search" value="{{ $search ?? '' }}">
        <button class="btn btn-primary btn-sm">Search</button>
    </div>
</form>

<a href="{{ url('add-blog') }}" class="btn btn-info mb-3 text-white">
    Add Blog
</a>

<div class="table-responsive">
    <table class="table table-bordered table-sm mb-0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Featured</th>
                <th>Image</th>
               
            </tr>
        </thead>

        <tbody>
            @forelse($data as $datas)
            <tr>
                <td>{{ $datas->id }}</td>
                <td>{{ $datas->title }}</td>
                <td>{{ $datas->description }}</td>

                <td>
                    @if($datas->isfeatured == 1)
                        <span class="text-success">
                            <i class="bi bi-star-fill"></i> Yes
                        </span>
                    @else
                        <span class="text-danger">
                            <i class="bi bi-star-fill"></i> No
                        </span>
                    @endif
                </td>

                <td>
                    <img src="{{ asset('storage/' . $datas->image) }}" width="80">
                </td>

                
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No data found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Bootstrap pagination aligned right -->
<div class="d-flex justify-content-end mt-3">
    {{ $data->withQueryString()->links() }}
</div>

@endsection
<style>

            .w-5.h-5 {
                width: 20px;
                margin-left: auto; 
                margin-right: 0;
    }   
        </style>