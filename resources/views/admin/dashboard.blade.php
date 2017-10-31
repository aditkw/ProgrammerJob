@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.html">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">My Dashboard</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-user-o"></i>
              </div>
              <div class="mr-5">{{ $user }} Users!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ route('show.user') }}">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-file-o"></i>
              </div>
              <div class="mr-5">{{ $unread }} New Requests!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ route('application.unread') }}">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-check-square-o"></i>
              </div>
              <div class="mr-5">{{ $accepted }} Job Accepted!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ route('application.accepted') }}">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-plus-square"></i>
              </div>
              <div class="mr-5">{{ $rejected }} Job Rejected!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ route('application.rejected') }}">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>
    </div>
  <!-- /.container-fluid-->
@endsection
