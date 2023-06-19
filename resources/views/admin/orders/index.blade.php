@extends('admin.index')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('success'))
                <div class="alert alert-success mt-3">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Orders</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="orders-table">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Email</th>
                            <th>Payment</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Action</th>
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
        $('#orders-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/admin/orders',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'email', name: 'email'},
                {data: 'payment_method', name: 'payment_method'},
                {data: 'total_price', name: 'total_price'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action'},
            ]
        });
    });
</script>
