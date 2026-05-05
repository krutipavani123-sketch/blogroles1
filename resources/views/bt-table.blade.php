@extends('components.layout')
@section('title', 'Blog List')

@section('main')

    <table id="table" data-toggle="table" data-url="{{ url('list-json') }}" data-side-pagination="server"
  data-pagination="true" 
  data-search="true"
  data-query-params="queryParams">

        Show Featured Blogs
        <select id="show_featured_blog">
            <option value="1">Yes</option>
            <option value="0">No</option>
            <option value="">All</option>
        </select>
        <thead>
            <tr>
                <th data-field="title" data-sortable="true">
                    Title
                </th>
                <th data-field="description" data-sortable="true">
                    Description
                </th>
                <th data-field="image"  data-formatter="imageFormatter">
                    Image
                </th>
                
                <th data-field="isfeatured" data-formatter="isFeatured">
                    Featured
                </th>

                <th data-field="name">
                    Name
                </th>

                {{-- //User name
                //Image --}}
            </tr>
        </thead>
    </table>

    <script>
        function isFeatured(value){
            if(value==0){
                return "No";
            }else{
                return "Yes";
            }
        }

        $('#show_featured_blog').on('change',function(){
            $('.table').bootstrapTable('refresh');
        })


        function queryParams(params){
            console.log(params);
            params.is_featured = $('#show_featured_blog').val();
            return params;
        }

        function imageFormatter(value) {
        if (!value) return 'No Image';

        return `<img src="/storage/${value}" width="80" height="50">`;
}
    </script>
@endsection