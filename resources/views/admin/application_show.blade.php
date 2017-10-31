@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.html">Dashboard</a>
      </li>
      <li class="breadcrumb-item">
        <a href="index.html">Application Accepted</a>
      </li>
      <li class="breadcrumb-item active">Show</li>
    </ol>
    <div class="row">
      @if (session('notice'))
        <div style="width: 100%" class="alert alert-success">
          <p style="margin-top:10px; line-height:10%; text-align: center">{{ session('notice') }}</p>
        </div>
      @endif

      <div style="margin:0 auto;width:50%" class="card mb-3">
      <div class="card-header">
        <i class="fa fa-list"></i> Application</div>
      <div>
        <table class="table">
            @php
              $user = $application->user->detail_user;
              $sub_tgl = substr($user->birth, 8, 2);
              $sub_bln = substr($user->birth, 5, 2);
              $sub_thn = substr($user->birth, 0, 4);
            @endphp
            <tbody>
              <tr>
                <td>Nama Pelamar:</td>
                <td>{{ $user->first_name.' '.$user->last_name }}</td>
              </tr>
              <tr>
                <td>Jenis Kelamin</td>
                <td>{{ $user->gender }}</td>
              </tr>
              <tr>
                <td>Email:</td>
                <td>{{ $application->user->email }}</td>
              </tr>
              <tr>
                <td>No Telpon:</td>
                <td>{{ $user->phone }}</td>
              </tr>
              <tr>
                <td>Tgl Lahir:</td>
                <td>{{ $sub_tgl.' - '.$sub_bln.' - '.$sub_thn }}</td>
              </tr>
              <tr>
                <td>Alamat:</td>
                <td>{{ $user->address }}</td>
              </tr>
              <tr>
                <td>Melamar Sebagai:</td>
                <td>{{ $application->job->name }}</td>
              </tr>
              <tr>
                <td>Gaji:</td>
                <td>{{ $application->job->salary }}</td>
              </tr>
              <tr>
                <td>Deskripsi Pelamar:</td>
                <td><i>{{$application->description}}</i></td>
              </tr>

            </tbody>
        </table>
      </div>
      <div class="card-footer"><a href="{{ asset('/storage/cv/'.$application->cv) }}" class="btn btn-success btn-block">Download CV</a></div>
      <div class="card-footer"><a href="{{ route('application.reject', ['id' => $application->id]) }}" class="btn btn-danger btn-block">Reject</a></div>
    </div>
    </div>
  </div>
  <!-- /.container-fluid-->
@endsection
