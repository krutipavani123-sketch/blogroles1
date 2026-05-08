@extends('components.layout')
@section('title', 'Blog List')

@section('main')

<style>
    body{
        background: #f4f6f9;
    }

    .page-wrapper{
        padding: 20px;
    }

    .page-title{
        font-weight: 700;
        margin-bottom: 20px;
        color: #333;
    }

    /* SEARCH BOX */
    .search-box{
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-bottom: 15px;
    }

    .search-box input{
        width: 250px;
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 6px 10px;
        outline: none;
        transition: 0.3s;
    }

    .search-box input:focus{
        border-color: #0d6efd;
        box-shadow: 0 0 5px rgba(13,110,253,0.3);
    }

    /* TABLE CARD */
    .table-card{
        background: #fff;
        border-radius: 12px;
        padding: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    table{
        border-radius: 10px;
        overflow: hidden;
    }

    table thead{
        background: #0d6efd;
        color: #fff;
    }

    table tbody tr:hover{
        background: #f1f5ff;
        transition: 0.2s;
    }

    /* BUTTON */
    .btn-add{
        border-radius: 8px;
        padding: 6px 14px;
    }

    /* IMAGE */
    table img{
        border-radius: 8px;
        object-fit: cover;
    }

    /* PAGINATION */
    .pagination{
        margin-top: 15px;
    }
</style>

<div class="page-wrapper">

    <h2 class="page-title">📄 Blog List</h2>

    <!-- SEARCH -->
    <form method="get" action="{{ url('search') }}">
        <div class="search-box">
            <input type="text" name="search" placeholder="Search blog..." value="{{ $search ?? '' }}">
            <button class="btn btn-primary btn-sm">Search</button>
        </div>
    </form>

    <!-- ADD BUTTON -->
    @if(auth()->user()->hasRole('admin'))
        <a href="{{ url('add-blog') }}" class="btn btn-info text-white btn-add mb-3">
            + Add Blog
        </a>
    @endif

    <!-- TABLE -->
    <div class="table-card">

        <table class="table table-bordered table-hover table-sm align-middle mb-0" data-toggle="table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Featured</th>
                    <th>Image</th>
                    @hasrole('admin')
                    <th>Action</th>
                    @endhasrole
                </tr>
            </thead>

            <tbody>
                @forelse($data as $datas)
                <tr>
                    <td>{{ $datas->id }}</td>
                    <td>{{ $datas->title }}</td>
                    <td>{{ Str::limit($datas->description, 60) }}</td>

                    <td>
                        @if($datas->isfeatured == 1)
                            <span class="text-success">⭐ Yes</span>
                        @else
                            <span class="text-danger">✖ No</span>
                        @endif
                    </td>

                    <td>
                        <img src="{{ $datas->image ? asset('storage/' . $datas->image) : 'https://via.placeholder.com/80' }}"
                             width="70" height="50">
                    </td>

                    <td>
                        @hasrole('admin')
                        <a href="{{ url('delete/'.$datas->id) }}" class="text-danger me-2">
                            <i class="bi bi-trash2-fill"></i>
                        </a>

                        <a href="{{ url('edit/'.$datas->id) }}" class="text-primary">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        @endhasrole
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-3">No data found</td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->
    <div class="d-flex justify-content-end mt-3">
        {{ $data->withQueryString()->links() }}
    </div>

</div>

@endsection
<style>

            .w-5.h-5 {
                width: 20px;
                margin-left: auto; 
                margin-right: 0;
    }   
        </style>