@extends('admin.layouts.app')

@section('title', 'Cash Award Form')

@section('page-title', 'Apply for Cash Award')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard/dashboard.css') }}">
<div class="form-container animate_animated animate_zoomIn">
    <div class="row g-4">
        <div class="col-md-3">
            <div class="dashboard-card bg-primary">
                <i class="fas fa-file-alt icon"></i>
                <h5>Total Applications</h5>
                <p>150</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card bg-success">
                <i class="fas fa-check-circle icon"></i>
                <h5>Approved</h5>
                <p>100</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card bg-warning">
                <i class="fas fa-hourglass-half icon"></i>
                <h5>Pending</h5>
                <p>30</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card bg-danger">
                <i class="fas fa-times-circle icon"></i>
                <h5>Rejected</h5>
                <p>20</p>
            </div>
        </div>
    </div>
</div>
@endsection