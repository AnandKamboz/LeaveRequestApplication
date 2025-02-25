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
            <h3 class="mb-0">Apply Leave</h3>
            <a href="{{ route('admin.leave-applications.index') }}" class="btn btn-light btn-sm"><i
                    class="fa fa-arrow-left"></i> View Leave Application</a>
        </div>
        <div class="card-body">
            {{-- <form>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Select Employee <span class="text-danger">*</span></label>
                        <select name="name" id="name" class="form-control">
                            <option value="">-- Select Employee --</option>
                            @foreach ($employeeNames as $employeeName)
                            <option value="{{ $employeeName->secure_id }}">
                                {{ $employeeName->first_name . ' ' . $employeeName->last_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-6 mb-3">
                        <label>Designation</label>
                        <input type="text" class="form-control" placeholder="Enter Designation">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Place of Posting</label>
                        <input type="text" class="form-control" placeholder="Enter Place of Posting">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Division/Section</label>
                        <input type="text" class="form-control" placeholder="Enter Division/Section">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Kind of Leave Applied For</label>
                        <select class="form-select">
                            <option>Options</option>
                            @foreach ($leaveTypes as $leaveType)
                            <option value="{{ $leaveType->secure_id }}">
                                {{ $leaveType->leave_type }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Period of Leave (From)</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Period of Leave (To)</label>
                        <input type="date" class="form-control">
                    </div>
                    <!-- <div class="col-md-6 mb-3 d-flex align-items-center">
                                        <label class="me-2">Prefix & Suffix Holidays</label>
                                        <input type="checkbox" class="form-check-input">
                                    </div> -->
                    <!-- <div class="col-md-6 mb-3 d-flex align-items-center">
                                        <label class="me-2">Permission to Leave Station</label>
                                        <input type="checkbox" class="form-check-input">
                                    </div> -->
                    <div class="col-md-6 mb-3">
                        <label>Full Address During Leave</label>
                        <textarea class="form-control" placeholder="Enter Address"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Contact Phone Number</label>
                        <input type="tel" class="form-control" placeholder="Enter Phone Number">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Reason</label>
                        <input type="tel" class="form-control" placeholder="Reason of Leave">
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn submit-btn ">Submit</button>
                </div>
            </form> --}}
            <form id="leaveApplicationForm" method="post" action="{{ route('admin.leave-applications.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Select Employee <span class="text-danger">*</span></label>
                        <select name="name" id="employee_name" class="form-control">
                            <option value="">-- Select Employee --</option>
                            @foreach ($employeeNames as $employeeName)
                            <option value="{{ $employeeName->secure_id }}">
                                {{ ucfirst($employeeName->first_name . ' ' . $employeeName->last_name) }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Designation <span class="text-danger">*</span></label>
                        <input type="text" id="designation" name="designation" class="form-control"
                            placeholder="Enter Designation">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Place of Posting <span class="text-danger">*</span></label>
                        <input type="text" id="place_of_posting" name="place_of_posting" class="form-control"
                            placeholder="Enter Place of Posting">
                    </div>

                    {{-- <div class="col-md-6 mb-3">
                        <label>Kind of Leave Applied For <span class="text-danger">*</span></label>
                        <select id="leave_type" class="form-select">
                            <option value="">-- Select Leave Type --</option>
                            @foreach ($leaveTypes as $leaveType)
                            <option value="{{ $leaveType->secure_id }}">
                                {{ $leaveType->leave_type }}
                            </option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="col-md-6 mb-3">
                        <label>Kind of Leave Applied For</label>
                        <select class="form-select" name="leave_type">
                            <option>Options</option>
                            @foreach ($leaveTypes as $leaveType)
                            <option value="{{ $leaveType->leave_type }}">
                                {{ ucfirst($leaveType->leave_type) }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Period of Leave (From) <span class="text-danger">*</span></label>
                        <input type="date" id="leave_from" name="leave_from" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Period of Leave (To) <span class="text-danger">*</span></label>
                        <input type="date" id="leave_to" name="leave_to" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Full Address During Leave <span class="text-danger">*</span></label>
                        <textarea id="leave_address" name="leave_address" class="form-control"
                            placeholder="Enter Address"></textarea>
                    </div>

                    {{-- <div class="col-md-6 mb-3">
                        <label>Contact Phone Number</label>
                        <input type="tel" id="contact_number" class="form-control" placeholder="Enter Phone Number">
                    </div> --}}

                    <div class="col-md-6 mb-3">
                        <label>Reason <span class="text-danger">*</span></label>
                        {{-- <input type="text" id="leave_reason" class="form-control" placeholder="Reason of Leave">
                        --}}
                        <textarea id="leave_reason" name="leave_reason" class="form-control"
                            placeholder="Reason of Leave"></textarea>
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
    document.getElementById("leaveApplicationForm").addEventListener("submit", function(event) {
            event.preventDefault();

            let employee_name = document.getElementById("employee_name").value.trim();
            let designation = document.getElementById("designation").value.trim();
            let place_of_posting = document.getElementById("place_of_posting").value.trim();
            // let leave_type = document.getElementById("leave_type").value.trim();
            let leave_from = document.getElementById("leave_from").value;
            let leave_to = document.getElementById("leave_to").value;
            let leave_address = document.getElementById("leave_address").value.trim();
            // let contact_number = document.getElementById("contact_number").value.trim();
            let leave_reason = document.getElementById("leave_reason").value.trim();

            if (employee_name === "") {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please select an employee!"
                });
                return;
            }

            if (designation === "") {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please select an designation!"
                });
                return;
            }

            if (place_of_posting === "") {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please select an place of posting!"
                });
                return;
            }



            // if (leave_type === "") {
            //     Swal.fire({
            //         icon: "error",
            //         title: "Oops...",
            //         text: "Please select the type of leave!"
            //     });
            //     return;
            // }

            if (leave_from === "") {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please select the start date of leave!"
                });
                return;
            }

            if (leave_to === "") {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please select the end date of leave!"
                });
                return;
            }

            if (new Date(leave_from) > new Date(leave_to)) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Leave end date cannot be before the start date!"
                });
                return;
            }

            // if (contact_number !== "" && !/^\d{10}$/.test(contact_number)) {
            //     Swal.fire({
            //         icon: "error",
            //         title: "Oops...",
            //         text: "Please enter a valid 10-digit phone number!"
            //     });
            //     return;
            // }

            if (leave_reason === "") {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Please enter the reason for leave!"
                });
                return;
            }

            // Submit form if all validations pass
            this.submit();
        });

        // Allow only letters in designation
        document.getElementById("designation").addEventListener("input", function() {
            this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
        });

        // Allow only letters in place_of_posting
        document.getElementById("place_of_posting").addEventListener("input", function() {
            this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
        });

        // Restrict textarea to 255 characters
        document.getElementById("leave_address").addEventListener("input", function() {
            if (this.value.length > 255) {
                this.value = this.value.substring(0, 255);
            }
        });

        // Allow only numbers in phone number
        // document.getElementById("contact_number").addEventListener("input", function() {
        //     this.value = this.value.replace(/\D/g, '');
        // });

        document.addEventListener("DOMContentLoaded", function() {
            let today = new Date().toISOString().split("T")[0];
            document.getElementById("leave_from").setAttribute("min", today);
            document.getElementById("leave_to").setAttribute("min", today);
        });
</script>


@endsection