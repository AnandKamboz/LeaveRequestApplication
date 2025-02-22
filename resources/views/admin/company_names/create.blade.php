{{-- @extends('admin.layouts.app')

@section('title', 'Add User')

@section('page-title', 'Apply for Cash Award')

@section('content')
<div class="form-container animate_animated animate_zoomIn">
    <div class="new-class mb-5">
        <h3 class="text-center heading">Add Company</h3>
    </div>

    <form id="userForm" enctype="multipart/form-data" method="post" action="{{ route('admin.company-names.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Company Name <span class="text-danger">*</span></label>
                <input type="text" name="company_name" id="company_name" class="form-control"
                    placeholder="Enter Company Name" value="{{ old('company_name') }}">
                @error('company_name')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label>Description</label>
                <textarea name="description" id="description" class="form-control"
                    placeholder="Enter Description">{{ old('description') }}</textarea>
                @error('description')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn submit-btn mt-3">Submit</button>
        </div>
    </form>
</div>

<script>
    document.getElementById("userForm").addEventListener("submit", function(event) {
        event.preventDefault();

        let company_name = document.getElementById("company_name").value.trim();
        let description = document.getElementById("description").value.trim();

        if (company_name === "") {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please Enter The Company Name!"
            }).then(() => {
                document.getElementById("company_name").focus();
            });
            return;
        }

        // if (description === "") {
        //     Swal.fire({
        //         icon: "error",
        //         title: "Oops...",
        //         text: "Please Enter Description!"
        //     }).then(() => {
        //         document.getElementById("description").focus();
        //     });
        //     return;
        // }

        this.submit();
    });

    document.getElementById("company_name").addEventListener("input", function() {
        this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
    });

    document.getElementById("description").addEventListener("input", function() {
        if (this.value.length > 255) {
            this.value = this.value.substring(0, 255);
        }
    });
</script>

@endsection --}}


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
            <h3 class="mb-0">Company Name List</h3>
            <a href="{{ route('admin.company-names.index') }}" class="btn btn-light btn-sm"><i
                    class="fa fa-arrow-left"></i> View Company Name</a>
        </div>
        <div class="card-body">
            <form id="userForm" enctype="multipart/form-data" method="post"
                action="{{ route('admin.company-names.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Company Name <span class="text-danger">*</span></label>
                        <input type="text" name="company_name" id="company_name" class="form-control"
                            placeholder="Enter Company Name" value="{{ old('company_name') }}">
                        @error('company_name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Description</label>
                        <textarea name="description" id="description" class="form-control"
                            placeholder="Enter Description">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn submit-btn mt-3">Submit</button>
                </div>
            </form>
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


        function confirmDelete(secure_id) {
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
                    document.getElementById('deleteForm-' + secure_id).submit();
                }
            });
        }

        document.getElementById("userForm").addEventListener("submit", function(event) {
            event.preventDefault();

            let company_name = document.getElementById("company_name").value.trim();
            let description = document.getElementById("description").value.trim();

            if (company_name === "") {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please Enter The Company Name!"
                }).then(() => {
                    document.getElementById("company_name").focus();
                });
                return;
            }

            // if (description === "") {
            // Swal.fire({
            // icon: "error",
            // title: "Oops...",
            // text: "Please Enter Description!"
            // }).then(() => {
            // document.getElementById("description").focus();
            // });
            // return;
            // }

            this.submit();
        });

        document.getElementById("company_name").addEventListener("input", function() {
            this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
        });

        document.getElementById("description").addEventListener("input", function() {
            if (this.value.length > 255) {
                this.value = this.value.substring(0, 255);
            }
        });
</script>

@endsection