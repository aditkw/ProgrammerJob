<!DOCTYPE html>
@php
  use App\Models\Job_Request;
  use App\Models\Notification;

  $notification = Notification::where('user_id', 1)->orderBy('id', 'desc')->paginate(5);
  //$job_request  = new Job_Request;
  $unread       = Job_Request::where('status', 'unread')->count();
  $accepted     = Job_Request::where('status', 'accepted')->count();
  $rejected     = Job_Request::where('status', 'rejected')->count();
@endphp
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <!-- Bootstrap core CSS-->

  <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="{{asset('css/sb-admin.css')}}" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Programmer Job</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Job Request">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#jobRequests" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Job Requests</span> </a>
            <ul class="sidenav-second-level collapse" id="jobRequests">
              <li>
                <a href="{{ route('application.unread') }}">Unread ({{$unread}})</a>
              </li>
              <li>
                <a href="{{ route('application.accepted') }}">Accepted ({{$accepted}})</a>
              </li>
              <li>
                <a href="{{ route('application.rejected') }}">Rejected ({{ $rejected }})</a>
              </li>
            </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Manage Users">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#manageUsers" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Manage Users</span>
          </a>
          <ul class="sidenav-second-level collapse" id="manageUsers">
            <li>
              <a href="{{ route('show.user') }}">User List</a>
            </li>
            <li>
              <a href="{{ route('show.blocked') }}">Blocked User</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Jobs">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#jobs" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Jobs</span>
          </a>
          <ul class="sidenav-second-level collapse" id="jobs">
            <li>
              <a href="{{ route('new.job') }}">Create New Job</a>
            </li>
            <li>
              <a href="{{ route('job.list') }}">Job List</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Profile Admin">
          <a class="nav-link" target="_blank" href="{{ route('profile.show') }}">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Profile Admin</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning"></span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
              @php
                $notifikasi = Notification::where(function($query){
                                $query->where('user_id', 1);
                            })->where(function($query){
                                $query->where('seen', 0);
                            })->count();
              @endphp
              {!! ($notifikasi > 0) ? '<i class="fa fa-fw fa-circle"></i>' : ''!!}
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">Notifications:</h6>
            <div class="dropdown-divider"></div>
            <!-- sini -->
            @foreach ($notification as $notif)
              @php
              $sub_name = substr($notif->subject, 39);

                $job_request =  Job_Request::with('user.detail_user')->whereHas('user.detail_user', function($query) use($sub_name){
                                $query->where('first_name', $sub_name);
                })->first();

                if ($job_request == null) {
                  continue;
                }

              @endphp
              <a class="dropdown-item" href="{{ route('application.show', ['id' => $job_request->id]) }}">
                <span class="text-success">
                  <strong>
                    <i class="fa fa-long-arrow-up fa-fw"></i>New Applications!</strong>
                </span>
                <span class="small float-right text-muted"></span>
                <div class="dropdown-message small">{{ $notif->subject }}</div>
              </a>
              <div class="dropdown-divider"></div>
            @endforeach
          </div>
        </li>
        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    @yield('content')
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Programmer Job 2017</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="{{route('logout')}}">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin.min.js') }}"></script>
  </div>
</body>

</html>
