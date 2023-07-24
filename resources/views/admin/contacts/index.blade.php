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
                    <h4 class="card-title">All Contacts</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="contacts-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
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
        $('#contacts-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/admin/contacts',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'message', name: 'message'},
                {data: 'action', name: 'action'}
            ]
        });
    });
</script>
