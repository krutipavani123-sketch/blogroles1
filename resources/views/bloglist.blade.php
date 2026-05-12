@extends('components.layout')
@section('title', 'Blog List')

@section('main')
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.27.3/dist/bootstrap-table.min.css">


<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.27.3/dist/bootstrap-table.min.js"></script>--}}
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
        justify-content: flex-end;<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
/* 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.27.3/dist/bootstrap-table.min.css">


<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.27.3/dist/bootstrap-table.min.js"></script>
        gap: 10px; */
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

<form action="{{ url('export') }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-info text-white btn-add mb-3">
        Export Task
    </button>
</form>
    @can('create task')
        <a href="{{ url('add-blog') }}" class="btn btn-info text-white btn-add mb-3">
            + Add Blog
        </a>
    @endcan

  
    <div class="table-card">

     <table id="table"
    class="table table-bordered table-sm"
    data-toggle="table"
    data-pagination="true"
    data-page-size="3"
    data-side-pagination="client"
    data-height="auto"
    data-page-list="[3,5,10,25,50,100,200,All]">


            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Featured</th>
                    <th>Image</th>
                   @if(auth()->user()->can('update task')||auth()->user()->can('delete task'))
                    <th>Action</th>
                    @endif
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

@can('delete task')

                        <a href="{{ url('delete/'.$datas->id) }}" class="text-danger me-2">
                            <i class="bi bi-trash2-fill"></i>
                        </a>
 @endcan
@can('update task')
                        <a href="{{ url('edit/'.$datas->id) }}" class="text-primary">
                            <i class="bi bi-pencil-square"></i>
                        </a>
 @endcan

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

    {{-- <!-- PAGINATION -->
    <div class="d-flex justify-content-end mt-3">
        {{ $data->withQueryString()->links() }}
    </div> --}}

</div>

@endsection
{{-- <style>

            .w-5.h-5 {
                width: 20px;
                margin-left: auto; 
                margin-right: 0;
    }   
        </style> --}}


            <style>
.bootstrap-table .fixed-table-container {
    border-bottom: 0 !important;
    height: auto !important;
}

.bootstrap-table .fixed-table-body {
    height: auto !important;
}

.bootstrap-table .fixed-table-pagination {
    margin-top: 5px !important;
}

.bootstrap-table {
    margin-bottom: 0 !important;
}
</style>