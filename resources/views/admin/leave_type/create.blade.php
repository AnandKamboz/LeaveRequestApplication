@extends('admin.layouts.app')

@section('title', 'Company Name')

@section('page-title', 'Company Name')

@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Add Leave Type</h3>
            <a href="{{ route('admin.leave-types.index') }}" class="btn btn-light btn-sm"><i
                    class="fa fa-arrow-left"></i> View Leave Type</a>
        </div>
        <div class="card-body">
            <form id="userForm" enctype="multipart/form-data" method="post"
                action="{{ route('admin.leave-types.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Leave Type Name <span class="text-danger">*</span></label>
                        <input type="text" name="leave_type" id="leave_type" class="form-control"
                            placeholder="Enter Leave Type" value="{{ old('leave_type') }}">
                        @error('leave_type')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Enter Max Days This Type Of Live <span class="text-danger">*</span></label>
                        <input type="text" name="max_days" id="max_days" class="form-control"
                            placeholder="Enter Max Days" value="{{ old('max_days') }}">
                        @error('max_days')
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

                    {{-- description --}}
                </div>

                <div class="text-center">
                    <button type="submit" class="btn submit-btn mt-3">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById("userForm").addEventListener("submit", function(event) {
        event.preventDefault();

        let leaveType = document.getElementById("leave_type").value.trim();
        let maxDays = document.getElementById("max_days").value.trim();

        if (leaveType === "") {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please enter the Leave Type!"
            }).then(() => {
                document.getElementById("leave_type").focus();
            });
            return;
        }

        if (maxDays === "" || isNaN(maxDays) || parseInt(maxDays) <= 0) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please enter a valid number of Max Days!"
            }).then(() => {
                document.getElementById("max_days").focus();
            });
            return;
        }

        this.submit();
    });

    // Allow only letters and spaces in Leave Type
    document.getElementById("leave_type").addEventListener("input", function() {
        this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
    });

    // Restrict Max Days input to positive numbers only
    document.getElementById("max_days").addEventListener("input", function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Limit description to 255 characters
    document.getElementById("description").addEventListener("input", function() {
        if (this.value.length > 255) {
            this.value = this.value.substring(0, 255);
        }
    });
</script>

@endsection