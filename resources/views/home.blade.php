@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="row">

    <div class="col-md-6 col-lg-3">
        <div class="info-box bg-info">
            <span class="info-box-icon">
                <i class="fas fa-users"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Total Users</span>
                <span class="info-box-number">{{ $totalUsers }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="info-box bg-success">
            <span class="info-box-icon">
                <i class="fas fa-user-plus"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Today Users</span>
                <span class="info-box-number">{{ $todayUsers }}</span>
            </div>
        </div>
    </div>

</div>
@stop
