@extends('admin.index')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Categories</h4>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-success btn-lg">Create New Category</a>
                </div>
                <div class="card-body">
                <table class="table table-striped" id="categories-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                    </thead>
{{--                    <tbody>--}}
{{--                    @foreach($categories as $category)--}}
{{--                        <tr>--}}
{{--                            <td>{{ $category->id }}</td>--}}
{{--                            <td>{{ $category->name }}</td>--}}
{{--                            <td>{{ $category->slug }}</td>--}}
{{--                            <td>--}}
{{--                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>--}}
{{--                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post" style="display: inline-block;">--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>--}}
{{--                                </form>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    </tbody>--}}
                </table>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(function () {
        $('#categories-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/admin/categories',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'slug', name: 'slug'},
                {data: 'action', name: 'action'},
            ]
        });
    });
</script>
