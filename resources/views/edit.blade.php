@extends('components.layout')
@section('title', 'Blog Update')
@section('main')

   

<form action="/edit/{{ $data->id }}" method="post" enctype="multipart/form-data">
      @csrf
        <input type="hidden" name="_method" value="put">
<div class="main">

   <h1>Update Data</h1>

   <label>
    <input type="checkbox" name="isfeatured" value="1"> Feature Blog
</label><br>

    <label>Title</label><br>
    <input type="text" name="title" value="{{ $data->title }}"><br><br>

    <label>Description</label><br>
    <input type="text" name="description" value="{{ $data->description }}"><br><br>

     <label>Upload Image</label> 
    <input type="file" name="image" id="image">
    @if(!empty($data->image))
    <img src="{{ asset('storage/' . $data->image) }}" width="100"><br><br>
    @endif
    
<button name="btn">Update</button>


</form>

    <!-- He who is contented is rich. - Laozi -->
</div>
      @endsection