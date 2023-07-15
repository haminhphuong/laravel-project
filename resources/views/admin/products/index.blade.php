@extends('admin.index')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Products</h4>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Create New Product</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="products-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Special Price</th>
                            <th>Quantity</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(function () {
        $('#products-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/admin/products',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'image', name: 'image'},
                {data: 'name', name: 'name'},
                {data: 'price', name: 'price'},
                {data: 'special_price', name: 'special_price'},
                {data: 'quantity', name: 'quantity'},
                {data: 'category', name: 'category'},
                {data: 'action', name: 'action'},
            ]
        });
    });
</script>
