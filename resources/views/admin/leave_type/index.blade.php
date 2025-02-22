@extends('admin.layouts.app')

@section('title', 'View Employee')

@section('page-title', 'View Employee')

@section('content')

<!-- jQuery & DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Leave Types</h3>
            <a href="{{ route('admin.leave-types.create') }}" class="btn btn-light btn-sm">+ Add Leave Type</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="companyTable" class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>S.N.</th>
                            <th>Name</th>
                            <th>Max Leave Allow</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($leaveTypes as $key => $leaveType)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ ucfirst($leaveType->leave_type) }}</td>
                            <td>{{ $leaveType->max_days }}</td>
                            <td>{{ ucfirst($leaveType->description) }}</td>
                            <td>
                                <a href="{{ route('admin.leave-types.edit', $leaveType->secure_id) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form id="delete-form"
                                    action="{{ route('admin.leave-types.destroy', $leaveType->secure_id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
            $('#companyTable').DataTable({
                "paging": true,
                "ordering": true,
                "info": true,
                "searching": true
            });
        });

        function confirmDelete(button) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        }
</script>

@endsection