@extends('admin.layouts.app')

@section('title', 'Company Name')

@section('page-title', 'Company Name')

@section('content')

<!-- jQuery & DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">List Levae Application</h3>
            <a href="{{ route('admin.leave-applications.create') }}" class="btn btn-light btn-sm">+ Add Leave
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="companyTable" class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>S.N.</th>
                            <th>Employee Name</th>
                            <th>Designation</th>
                            <th>Place of Posting</th>
                            <th>Leave Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allLeaveApplications as $key => $allLeaveApplication)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $allLeaveApplication->employee_name }}</td>
                            <td>{{ $allLeaveApplication->designation }}</td>
                            <td>{{ $allLeaveApplication->place_of_posting }}</td>
                            <td>{{ $allLeaveApplication->leave_type }}</td>
                            <td>
                                @if ($allLeaveApplication->status == 'approved')
                                <span class="badge bg-success text-white px-3 py-2">Approved</span>
                                @elseif ($allLeaveApplication->status == 'pending')
                                <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                                @elseif ($allLeaveApplication->status == 'rejected')
                                <span class="badge bg-danger text-white px-3 py-2">Rejected</span>
                                @else
                                <span class="badge bg-secondary text-white px-3 py-2">{{ $allLeaveApplication->status
                                    }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.leave-applications.show', $allLeaveApplication->secure_id) }}"
                                    class="btn btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('admin.leave-applications.edit', $allLeaveApplication->secure_id) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form id="delete-form-{{ $allLeaveApplication->secure_id }}"
                                    action="{{ route('admin.leave-applications.destroy', $allLeaveApplication->secure_id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="confirmDelete('{{ $allLeaveApplication->secure_id }}')">
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


        // function confirmDelete(secure_id) {
        //     Swal.fire({
        //         title: "Are you sure?",
        //         text: "You won't be able to revert this!",
        //         icon: "warning",
        //         showCancelButton: true,
        //         confirmButtonColor: "#d33",
        //         cancelButtonColor: "#3085d6",
        //         confirmButtonText: "Yes, delete it!"
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             document.getElementById('deleteForm-' + secure_id).submit();
        //         }
        //     });
        // }

        function confirmDelete(secureId) {
            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + secureId).submit();
                }
            });
        }
</script>

@endsection