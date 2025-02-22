@extends('admin.layouts.app')

@section('title', 'Add User')

@section('page-title', 'Apply for Cash Award')

@section('content')
{{-- <div class="form-container animate_animated animate_zoomIn">
    <div class="new-class mb-5">
        <a href="{{ route('admin.employees.index') }}" class="btn-employee btn-common ">Back</a>
        <h3 class="text-center heading">Add User</h3>
    </div>

    <form id="userForm" enctype="multipart/form-data" method="post" action="{{ route('admin.user.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>First Name <span class="text-danger">*</span></label>
                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter Name"
                    value="{{ old('first_name') }}">
                @error('first_name')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label>Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter Last Name"
                    value="{{ old('last_name') }}">
                @error('last_name')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label>Profile Photo <span class="text-danger">*</span></label>
                <input type="file" name="profile_photo" id="profile_photo" class="form-control"
                    value="{{ old('profile_photo') }}">
                @error('profile_photo')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label>Email <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email"
                    value="{{ old('email') }}">
                @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label>Phone Number <span class="text-danger">*</span></label>
                <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Enter Phone Number"
                    value="{{ old('mobile') }}">
                @error('mobile')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label>Select Gender <span class="text-danger">*</span></label>
                <select name="gender" id="gender" class="form-select">
                    <option value="">Select Gender</option>
                    <option value="Male" {{ old('gender')=='Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender')=='Female' ? 'selected' : '' }}>Female</option>
                </select>
                @error('gender')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-md-6 mb-3">
                <label>Select Company Group <span class="text-danger">*</span></label>
                <select name="company_group_id" id="company_group" class="form-select">
                    <option value="">Choose Company</option>
                    <option value="1" {{ old('company_group_id')=='1' ? 'selected' : '' }}>SISL</option>
                    <option value="2" {{ old('company_group_id')=='2' ? 'selected' : '' }}>HKCL</option>
                    <option value="3" {{ old('company_group_id')=='3' ? 'selected' : '' }}>TCS</option>
                    <option value="4" {{ old('company_group_id')=='4' ? 'selected' : '' }}>Infosys</option>
                </select>
                @error('company_group_id')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label>Date of Joining <span class="text-danger">*</span></label>
                <input type="date" id="date_of_joining" name="date_of_joining" class="form-control"
                    max="{{ date('Y-m-d') }}" value="{{ old('date_of_joining') }}">
                @error('date_of_joining')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label>Salary <span class="text-danger">*</span></label>
                <input type="number" id="salary" name="salary" class="form-control" placeholder="Enter Salary"
                    value="{{ old('salary') }}" min="0" step="0.01">
                @error('salary')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn submit-btn">Submit</button>
        </div>
    </form>
</div> --}}

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Add Employee</h3>
            <a href="{{ route('admin.users.index') }}" class="btn btn-light btn-sm"><i class="fa fa-arrow-left"></i>
                View Employee</a>
        </div>
        <div class="card-body">
            <form id="userForm" enctype="multipart/form-data" method="post" action="{{ route('admin.user.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>First Name <span class="text-danger">*</span></label>
                        <input type="text" name="first_name" id="first_name" class="form-control"
                            placeholder="Enter Name" value="{{ old('first_name') }}">
                        @error('first_name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control"
                            placeholder="Enter Last Name" value="{{ old('last_name') }}">
                        @error('last_name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Profile Photo <span class="text-danger">*</span></label>
                        <input type="file" name="profile_photo" id="profile_photo" class="form-control"
                            value="{{ old('profile_photo') }}">
                        @error('profile_photo')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email"
                            value="{{ old('email') }}">
                        @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Phone Number <span class="text-danger">*</span></label>
                        <input type="text" id="mobile" name="mobile" class="form-control"
                            placeholder="Enter Phone Number" value="{{ old('mobile') }}">
                        @error('mobile')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Select Gender <span class="text-danger">*</span></label>
                        <select name="gender" id="gender" class="form-select">
                            <option value="">Select Gender</option>
                            <option value="Male" {{ old('gender')=='Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender')=='Female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-6 mb-3">
                        <label>Select Company Group <span class="text-danger">*</span></label>
                        <select name="company_group_id" id="company_group" class="form-select">
                            <option value="">Choose Company</option>
                            <option value="1" {{ old('company_group_id')=='1' ? 'selected' : '' }}>SISL</option>
                            <option value="2" {{ old('company_group_id')=='2' ? 'selected' : '' }}>HKCL</option>
                            <option value="3" {{ old('company_group_id')=='3' ? 'selected' : '' }}>TCS</option>
                            <option value="4" {{ old('company_group_id')=='4' ? 'selected' : '' }}>Infosys</option>
                        </select>
                        @error('company_group_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Date of Joining <span class="text-danger">*</span></label>
                        <input type="date" id="date_of_joining" name="date_of_joining" class="form-control"
                            max="{{ date('Y-m-d') }}" value="{{ old('date_of_joining') }}">
                        @error('date_of_joining')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Salary <span class="text-danger">*</span></label>
                        <input type="number" id="salary" name="salary" class="form-control" placeholder="Enter Salary"
                            value="{{ old('salary') }}" min="0" step="0.01">
                        @error('salary')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn submit-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    document.getElementById("userForm").addEventListener("submit", function(event) {
            event.preventDefault();

            let firstName = document.getElementById("first_name").value.trim();
            let email = document.getElementById("email").value.trim();
            let gender = document.getElementById("gender").value;
            let companyGroup = document.getElementById("company_group").value;
            let profile_photo = document.getElementById("profile_photo").value;
            let date_of_joining = document.getElementById("date_of_joining").value;
            let salary = document.getElementById("salary").value.trim();




            if (firstName === "") {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please Enter The First Name!"
                }).then(() => {
                    document.getElementById("first_name").focus();
                });
                return;
            }

            if (email === "") {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please Enter The Email!"
                }).then(() => {
                    document.getElementById("email").focus();
                });
                return;
            }

            if (gender === "") {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please Select Gender!"
                }).then(() => {
                    document.getElementById("gender").focus();
                });
                return;
            }

            if (companyGroup === "") {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please Select Company Group!"
                }).then(() => {
                    document.getElementById("company_group").focus();
                });
                return;
            }

            if (profile_photo === "") {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please Select Profile Photo!"
                }).then(() => {
                    document.getElementById("company_group").focus();
                });
                return;
            }

            if (date_of_joining === "") {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please Select Date of Joining!"
                }).then(() => {
                    document.getElementById("date_of_joining").focus();
                });
                return;
            }

            if (salary === "" || isNaN(salary) || parseInt(salary) > 999999) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Salary must be a number and not exceed 6 digits!"
                }).then(() => {
                    document.getElementById("salary").focus();
                });
                return;
            }

            this.submit();
        });

        document.getElementById("mobile").addEventListener("input", function() {
            this.value = this.value.replace(/\D/g, '').slice(0, 10);
        });

        document.getElementById("profile_photo").addEventListener("change", function() {
            let file = this.files[0];

            if (!file) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please select a profile photo!"
                }).then(() => {
                    document.getElementById("profile_photo").focus();
                });
                return;
            }

            let allowedExtensions = ["image/png", "image/jpg", "image/jpeg"];
            if (!allowedExtensions.includes(file.type)) {
                Swal.fire({
                    icon: "error",
                    title: "Invalid File Type",
                    text: "Only PNG, JPG, and JPEG files are allowed!"
                }).then(() => {
                    document.getElementById("profile_photo").value = "";
                    document.getElementById("profile_photo").focus();
                });
                return;
            }

            let maxSize = 2 * 1024 * 1024 * 1024;
            if (file.size > maxSize) {
                Swal.fire({
                    icon: "error",
                    title: "File Too Large",
                    text: "Profile photo must be less than 2GB!"
                }).then(() => {
                    document.getElementById("profile_photo").value = "";
                    document.getElementById("profile_photo").focus();
                });
                return;
            }
        });

        document.getElementById("salary").addEventListener("input", function () {
          this.value = this.value.replace(/\D/g, '').slice(0, 6); 
        });

        // Restrict first name to letters only and max 25 characters
        document.getElementById("first_name").addEventListener("input", function () {
        this.value = this.value.replace(/[^a-zA-Z\s]/g, "").slice(0, 25);
        });
        
        // Restrict last name to letters only and max 25 characters
        document.getElementById("last_name").addEventListener("input", function () {
        this.value = this.value.replace(/[^a-zA-Z\s]/g, "").slice(0, 25);
        });
</script>


@endsection