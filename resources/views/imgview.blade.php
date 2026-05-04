    @extends('components.layout')
    @section('title', 'Blog Management')


    <body>
    @section('main')   
    <div class="main">

    <h1>
        Blog Management
    </h1>
    <form method="post" action="" enctype="multipart/form-data">
@csrf
      
            
    <label>Upload Image</label> 
    <input type="file" name="image" id="">
    <button>Upload Image</button><br><br>

    <button type="submit" name="btn" class="btn btn-info">Add</button>
    </form>
    </div>

    @endsection
    </body>
    </html>





