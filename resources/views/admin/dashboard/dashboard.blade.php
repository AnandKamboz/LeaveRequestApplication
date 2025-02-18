@extends('admin.layouts.app')

@section('content')

<div class="dashboard-panel">
    <div class="row">
        <div class="col-md-4">
            <div class="panel-box green">
                <h2>413</h2>
                <p>Total Applications</p>
                <a href="#">More Info</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel-box yellow">
                <h2>0</h2>
                <p>Recommended by DSO</p>
                <a href="#">More Info</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel-box red">
                <h2>0</h2>
                <p>Action by HQ</p>
                <a href="#">More Info</a>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Game Name</th>
                    <th>Total Applications</th>
                    <th>View Application</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Wrestling</td>
                    <td>56</td>
                    <td><button class="btn btn-primary">View</button></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Hockey</td>
                    <td>50</td>
                    <td><button class="btn btn-primary">View</button></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Athletics</td>
                    <td>48</td>
                    <td><button class="btn btn-primary">View</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection