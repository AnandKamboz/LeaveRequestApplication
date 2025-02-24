@extends('admin.layouts.app')

@section('title', 'Leave Application Details')

@section('page-title', 'Leave Application Details')

@section('content')

<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center p-3">
            <h3 class="mb-0">Leave Application Details</h3>
            <a href="{{ route('admin.leave-applications.index') }}" class="btn btn-light btn-sm">
                <i class="fa fa-arrow-left"></i> Back to List
            </a>
        </div>
        <div class="card-body p-4">
            <div class="row">

                <div class="col-md-6">
                    <p class="mb-3"><strong><i class="fas fa-user"></i> Name:</strong> {{ $application->employee_name }}
                    </p>


                    <p class="mb-3 mt-4"><strong><i class="fas fa-calendar-alt"></i> Leave Type:</strong> {{
                        $application->leave_type }}</p>

                    <p class="mb-3"><strong><i class="fas fa-user-tag"></i> Designation:</strong> {{
                        $application->designation }}</p>
                    <p class="mb-3"><strong><i class="fas fa-map-marker-alt"></i> Place of Posting:</strong> {{
                        $application->place_of_posting }}</p>
                    {{-- <p class="mb-3"><strong><i class="fas fa-calendar-day"></i> Start Date:</strong>
                        {{ \Carbon\Carbon::parse($application->leave_from)->format('d M, Y') }}</p> --}}
                    <p class="mb-3"><strong><i class="fas fa-calendar-check"></i> End Date:</strong>
                        {{ \Carbon\Carbon::parse($application->leave_to)->format('d M, Y') }}</p>
                </div>


                <div class="col-md-6">
                    <p class="mb-3"><strong><i class="fas fa-map-marked-alt"></i> Leave Address:</strong>
                        <span class="text-muted">{{ $application->leave_address ?: 'Not provided' }}</span>
                    </p>
                    <p class="mb-3"><strong><i class="fas fa-comment-alt"></i> Leave Reason:</strong>
                        <span class="text-muted">{{ $application->leave_reason ?: 'No reason provided' }}</span>
                    </p>
                    <p class="mb-3"><strong><i class="fas fa-info-circle"></i> Status:</strong>
                        @if($application->status == 'Approved')
                        <span class="badge bg-success px-3 py-2">{{ $application->status }}</span>
                        @elseif($application->status == 'Pending')
                        <span class="badge bg-warning text-dark px-3 py-2">{{ $application->status }}</span>
                        @else
                        <span class="badge bg-danger px-3 py-2">{{ $application->status }}</span>
                        @endif
                    </p>
                    <p class="mb-3"><strong><i class="fas fa-calendar-day"></i> Start Date:</strong>
                        {{ \Carbon\Carbon::parse($application->leave_from)->format('d M, Y') }}</p>

                    {{-- <p class="mb-3"><strong><i class="fas fa-calendar-plus"></i> Created At:</strong>
                        {{ \Carbon\Carbon::parse($application->created_at)->format('d M, Y h:i A') }}
                    </p> --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection