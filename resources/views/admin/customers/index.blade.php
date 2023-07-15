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
                    <h4 class="card-title">All Customers</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="customers-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Avatar</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Phone</th>
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
        $('#customers-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/admin/customers',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'avatar', name: 'avatar'},
                {data: 'email', name: 'email'},
                {data: 'name', name: 'name'},
                {data: 'phone', name: 'phone'},
                {data: 'action', name: 'action'}
            ]
        });
    });
</script>
