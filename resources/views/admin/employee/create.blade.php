@extends('admin.layouts.app')

@section('title', 'Cash Award Form')

@section('page-title', 'Apply for Cash Award')

@section('content')
<div class="form-container animate_animated animate_zoomIn">
    <div class="new-class mb-5">
        <a href="{{ route('admin.employees.index') }}" class="btn-employee btn-common ">Back</a>
        <h3 class="text-center  heading"> Necessary Proceedings Application Form</h3>
    </div>

    <form>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Enter Name">
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
                    <option>Casual Leave</option>
                    <option>Medical Leave</option>
                    <option>Earned Leave</option>
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
    </form>
</div>
@endsection