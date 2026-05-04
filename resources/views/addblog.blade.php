@extends('layout')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.27.3/dist/bootstrap-table.min.css">


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.27.3/dist/bootstrap-table.min.js"></script>

    <title>Blog Management</title>
</head>
<body>
    
<h1>
    Blog Management
</h1>
<form method="post" action="bloglist" enctype="multipart/form-data">
@csrf
    <label>Title</label>
    <input type="text" name="title"><br><br> 

      <label>Description</label>
    <textarea type="text" name="description"></textarea><br><br> 
    
    <label>Upload Image</label><br>
    <button>Upload Image</button>

<button type="submit" name="btn" class="btn btn-primary">Add</button>
</form>
</body>
</html>





