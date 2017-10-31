@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.html">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Application Unread</li>
    </ol>
    <div class="row">
      @if (session('notice'))
        <div style="width: 100%" class="alert alert-success">
          <p style="margin-top:10px; line-height:10%;text-align: center">{{ session('notice') }}</p>
        </div>
      @endif
      <table class="table">
        <thead align="center">
          <tr>
            <th scope="col">Nama Pelamar</th>
            <th scope="col">Melamar Pekerjaan</th>
            <th scope="col">Pendidikan Terakhir</th>
            <th scope="col">Nama Institut</th>
            <th scope="col">Jurusan </th>
            <th scope="col">Tahun Lulus</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($application as $application)
            @php
              $user = $application->user->detail_user;
            @endphp
            <tr>
              <td align="center">{{ $user->first_name.' '.$user->last_name }}</td>
              <td align="center">{{ $application->job->name }}</td>
              <td align="center">{{ $user->last_education }}</td>
              <td align="center">{{ $user->institute_name }}</td>
              <td align="center">{{ $user->majors }}</td>
              <td align="center">{{ $user->graduate_year }}</td>
              <td align="center"><a class="btn btn-info" href="{{ route('application.show', ['id' => $application->id]) }}">Read</a></td>
              <td align="center"><a class="btn btn-danger" href="{{ route('application.reject', ['id' => $application->id]) }}">Reject</a></td>
            </tr>
          @endforeach
      </tbody>
    </table>
    </div>
  </div>
  <!-- /.container-fluid-->
@endsection
