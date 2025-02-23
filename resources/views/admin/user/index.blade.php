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
            <h3 class="mb-0">Employee List</h3>
            <a href="{{ route('admin.user.create') }}" class="btn btn-light btn-sm">+ Add New Employee</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="companyTable" class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>S.N.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date Of Joining</th>
                            <th>Salary</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $key => $employee)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $employee->first_name . " " . ($employee->last_name ?? '') }}</td>
                            <td>{{ $employee->email ?? '' }}</td>
                            <td>{{ $employee->mobile ?? '' }}</td>
                            <td>{{ $employee->date_of_joining ?? '' }}</td>
                            <td>{{ $employee->salary ?? '' }}</td>
                            <td>
                                <a href="{{ route('admin.user.show',[$employee->secure_id]) }}"
                                    class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                {{-- <a href="" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a> --}}
                                <a href="{{ route('admin.user.edit', [$employee->secure_id]) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>


                                @if (Auth::id() != $employee->id)
                                <form id="delete-form-{{ $employee->secure_id }}"
                                    action="{{ route('admin.user.destroy', [$employee->secure_id]) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="confirmDelete('{{ $employee->secure_id }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @else
                                <span class="text-muted">N/A</span>
                                @endif
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
    $(document).ready(function () {
        $('#companyTable').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "searching": true
        });
    });

    function confirmDelete(secureId) {
        Swal.fire({
            title: "Are you sure?",
            text: "Are you sure you want to delete this employee?",
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