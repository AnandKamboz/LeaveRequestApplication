@extends('admin.layouts.app')

@section('title', 'View Employee')

@section('page-title', 'View Employee')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg p-4 rounded">
        <h3 class="text-center text-primary mb-4">Employee Details</h3>

        <div class="row">
            <div class="col-md-4 text-center">
                <img src="{{ asset($employee->profile_photo ?? 'default.png') }}" alt="Profile Photo"
                    class="rounded-circle img-fluid shadow" style="width: 150px; height: 150px; object-fit: cover;">
            </div>
            <div class="col-md-8">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th class="bg-light">Name</th>
                            <td>{{ $employee->first_name . " " . ($employee->last_name ?? '') }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Email</th>
                            <td>{{ $employee->email ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Mobile</th>
                            <td>{{ $employee->mobile ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Date of Joining</th>
                            <td>{{ $employee->date_of_joining ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Salary</th>
                            <td>₹{{ number_format($employee->salary, 2) ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Gender</th>
                            <td>{{ $employee->gender }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Company Group</th>
                            <td>
                                @php $companyFound = false; @endphp
                                @foreach($companyNames as $companyName)
                                @if($companyName->id == $employee->company_group_id)
                                {{ $companyName->company_name }}
                                @php $companyFound = true; @endphp
                                @break
                                @endif
                                @endforeach
                                @if(!$companyFound)
                                {{ '-' }}
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
</div>
@endsection