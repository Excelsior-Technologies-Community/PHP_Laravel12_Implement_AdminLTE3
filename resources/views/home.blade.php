@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalUsers }}</h3>
                <p>Total Users</p>
            </div>
            <div class="icon">
               
            </div>
            <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                More info 
            </a>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $todayUsers }}</h3>
                <p>Today's Registrations</p>
            </div>
            <div class="icon">
                
            </div>
            <a href="#" class="small-box-footer">
                Today's activity 
            </a>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $weekUsers }}</h3>
                <p>This Week</p>
            </div>
            <div class="icon">
               
            </div>
            <a href="#" class="small-box-footer">
                Weekly stats 
            </a>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $monthUsers }}</h3>
                <p>This Month</p>
            </div>
            <div class="icon">
              
            </div>
            <a href="#" class="small-box-footer">
                Monthly stats 
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">User Registration Trend (Last 7 Days)</h3>
            </div>
            <div class="card-body">
                <canvas id="userChart" style="height: 250px;"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Quick Actions</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-block">
                            Add New User
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-info btn-block">
                            Manage Users
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="#" class="btn btn-success btn-block">
                            View Reports
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="/profile" class="btn btn-warning btn-block">
                            My Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">User Statistics</h3>
            </div>
            <div class="card-body">
                <div class="progress-group">
                    Verified Users
                    <span class="float-right"><b>{{ $verifiedUsers }}</b>/{{ $totalUsers }}</span>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: {{ $totalUsers > 0 ? ($verifiedUsers/$totalUsers)*100 : 0 }}%"></div>
                    </div>
                </div>
                <div class="progress-group mt-3">
                    Last 7 Days Activity
                    <span class="float-right"><b>{{ $last7DaysUsers }}</b>/{{ $totalUsers }}</span>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: {{ $totalUsers > 0 ? ($last7DaysUsers/$totalUsers)*100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recent Users</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Registered</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\User::latest()->take(5)->get() as $recentUser)
                        <tr>
                            <td>{{ $recentUser->name }}</td>
                            <td>{{ $recentUser->email }}</td>
                            <td>{{ $recentUser->created_at->diffForHumans() }}</td>
                            <td>
                                @if($recentUser->email_verified_at)
                                    <span class="badge badge-success">Verified</span>
                                @else
                                    <span class="badge badge-warning">Pending</span>
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
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('userChart').getContext('2d');
    const userChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_keys($chartData)) !!},
            datasets: [{
                label: 'New Users',
                data: {!! json_encode(array_values($chartData)) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@stop