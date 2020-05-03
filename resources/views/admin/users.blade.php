@extends('admin.layouts.admin')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Manage Users</h1>

    <table id="users-table" class="table">
        <thead>
        <tr>
            <th>User Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th></th>
        </tr>
        </thead>
    </table>
</div>
<!-- /.container-fluid -->

@endsection

@push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'users/data',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'role', name: 'role' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        "fnDrawCallback": function() {
            http_handler.initialize();
        }
    });
});
</script>
@endpush

@push('scripts')
<script src="{{ asset('js/http-handler.js') }}"></script>
@endpush