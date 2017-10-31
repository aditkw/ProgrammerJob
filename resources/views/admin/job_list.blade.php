@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Job List</li>
    </ol>
    <div class="row">
      @if (session('notice'))
        <div style="width: 100%" class="alert alert-success">
          <p style="margin-top:10px; line-height:10%;text-align: center">{{ session('notice') }}</p>
        </div>
      @endif
      <div id="pesan" style="width: 100%; display:none">
        <p id='isi_pesan' style="margin-top:10px; line-height:10%; text-align: center"></p>
      </div>
      <table class="table">
        <thead align="center">
          <tr>
            <th scope="col">Nama Pekerjaan</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Gaji</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($job as $job)
            <span class="tr">
            <tr>
              <td align="center">{{$job->name}}</td>
              <td align="center">{{$job->description}}</td>
              <td align="center">{{$job->salary}}</td>
              <td>
                <form  action="{{ route('delete.job', ['id' => $job->id]) }}" class="ajax" method="post" csrf="{{ csrf_token() }}">
                  <input class="btn btn-danger" type="submit" name="submit" value="Hapus">
                  <input type="hidden" name="_method" value="delete">
                </form>
              </td>
            </tr>
          </span>
          @endforeach
      </tbody>
    </table>
    </div>
  </div>
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="{{asset('/js/job.js')}}"></script>
  <!-- /.container-fluid-->
@endsection
