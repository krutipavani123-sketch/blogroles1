<h2>Task List</h2>

<p>Data</p>

<ul>
@foreach($task as $item)
 <strong>ID:</strong><li>{{ $item->id }}</li>
    <strong>Title:</strong><li>{{ $item->title }}</li>
    <strong>Description</strong><li>{{ $item->description }}</li>
    <strong>IsFeatured</strong><li>{{ $item->isfeatured ==1?'yes':'no' }}</li>
   {{-- <li>
   <img src="{{ asset('storage/' . $item->image) }}" width="100">
</li> --}}
    <hr>
@endforeach
</ul>
