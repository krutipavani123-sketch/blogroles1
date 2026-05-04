    @extends('components.layout')
    @section('title', 'Blog Management')


    <body>
    @section('main')   
    <div class="main">

    <h1>
        Blog Management
    </h1>
    <form method="post" action="{{ url('bloglist') }}" enctype="multipart/form-data">
@csrf

<label>
    <input type="checkbox" name="isfeatured" value="1"> Feature Blog
</label><br>
        <label>Title</label>
        <input type="text" name="title"><br><br> 

        <label>Description</label>
        <textarea type="text" name="description"></textarea><br><br> 
        
            
    <label>Upload Image</label> 
    <input type="file" name="image" id="image"><br><br>
   

    <button type="submit" name="btn" class="btn btn-info">Add</button>
    </form>
    </div>

    @endsection
    </body>

  
    </html>





