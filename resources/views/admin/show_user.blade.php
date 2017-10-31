@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">User List</li>
    </ol>
    <div class="row">
      @if (session('notice'))
        <div style="width: 100%" class="alert alert-success">
          <p style="margin-top:10px; line-height:10%;text-align: center">{{ session('notice') }}</p>
        </div>
      @endif
      <div id="pesan" style="width: 100%;">
        <p id='isi_pesan' style="margin-top:10px; line-height:10%; text-align: center"></p>
      </div>
      <table class="table">
        <thead align="center">
          <tr>
            <th scope="col">Nama</th>
            <th scope="col">No Telepon</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">Alamat</th>
            <th scope="col">Negara Asal</th>

            <th scope="col">Status</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($user as $user)
            <tr>
              @php
                $status = $user->status;
                $user2 = $user->detail_user;
                switch ($status) {
                  case 0:
                      $status = 'Belum Aktif';
                    break;
                  case 1:
                      $status = 'Belum Lengkapi Profil';
                    break;
                  case 2:
                      $status = 'Belum Melamar';
                    break;
                  case 3:
                      $status = 'Sudah Melamar';
                    break;
                }
              @endphp
              <td align="center">{{ $user2->first_name.' '.$user2->last_name }}</td>
              <td align="center">{{ $user2->phone }}</td>
              <td align="center">{{ $user2->gender }}</td>
              <td align="center">{{ $user2->address }}</td>
              <td align="center">{{ $user2->country }}</td>
              <td align="center">{{ $status}}</td>

              <td align="center"><a style="color:#fff" id="block" class="btn btn-warning" href="{{ route('block.user', ['id' => $user->id]) }}">Blokir</a></td>
              <td align="center">
                <form  action="{{ route('delete.user', ['id' => $user->id]) }}" method="post" csrf="{{ csrf_token() }}">
                  <input class="btn btn-danger" type="submit" name="delete" value="Hapus">
                  <input type="hidden" name="_method" value="delete">
                </form>
              </td>
            </tr>
          @endforeach
      </tbody>
    </table>
    </div>
  </div>
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="{{asset('/js/user.js')}}"></script>
  <!-- /.container-fluid-->
@endsection
