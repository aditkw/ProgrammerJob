@extends('layouts.user')

@section('title', 'Profile')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading"><h1 style="text-align:center" class="panel-title">Profil</h2></div>

                <div class="panel-body">
                  @if (session('notice'))
                    <div class="alert alert-success">
                      <p style="text-align: center">{{ session('notice') }}</p>
                    </div>
                  @elseif (session('warning'))
                    <div class="alert alert-warning">
                      <p style="text-align: center">{{ session('warning') }}</p>
                    </div>
                  @endif
                  @if (count($errors) > 0)
                    <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{$error}}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif

          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">{{$user->detail_user->first_name.' '.$user->detail_user->last_name}}</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{ asset('/storage/photo/'.$user->detail_user->photo) }}"  class="img-circle img-responsive"> </div>

                <div class=" col-md-9 col-lg-9 ">
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Email:</td>
                        <td>{{ $user->email }}</td>
                      </tr>
                      <tr>
                        <td>No. Telepon:</td>
                        <td>{{ $user->detail_user->phone }}</td>
                      </tr>
                      <tr>
                        <td>Jenis Kelamin:</td>
                        <td>{{ $user->detail_user->gender }}</td>
                      </tr>
                      <tr>
                        <td>Tgl Lahir:</td>
                        @php
                          $sub_tgl = substr($user->detail_user->birth, 8, 2);
                          $sub_bln = substr($user->detail_user->birth, 5, 2);
                          $sub_thn = substr($user->detail_user->birth, 0, 4);
                        @endphp
                        <td>{{ $sub_tgl.' - '.$sub_bln.' - '.$sub_thn }}</td>
                      </tr>
                      <tr>
                        <td>Alamat:</td>
                        <td>{{ $user->detail_user->address }}</td>
                      </tr>

                         <tr>
                             <tr>
                        <td>Negara Asal</td>
                        <td>{{ $user->detail_user->country }}</td>
                      </tr>
                        <tr>
                        <td>Pendidikan Terakhir</td>
                        <td>{{ $user->detail_user->last_education }}</td>
                      </tr>
                      <tr>
                        <td>Nama Institut</td>
                        <td>{{ $user->detail_user->institute_name }}</td>
                      </tr>
                      <tr>
                        <td>Jurusan</td>
                        <td>{{ $user->detail_user->majors }}</td>
                      </tr>
                      <tr>
                        <td>Lulus Tahun</td>
                        <td>{{ $user->detail_user->graduate_year }}</td>
                      </tr>

                    </tbody>
                  </table>

                  <a href="{{ route('profile.update') }}" class="btn btn-warning btn-lg">Edit Profil</a>
                  @if ($user->status == 4)
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-success btn-lg">Page Admin</a>
                  @endif
                  @if ($user->status == 2)
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Lamar Pekerjaan!</button>
                  @elseif ($user->status == 3)
                    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#statusModal">Status Lamaran</button>
                  @endif

                </div>
              </div>
            </div>
          </div>



                </div>
            </div>
        </div>
    </div>
</div>

@if ($user->status == 3)
  <div class="modal fade" id="statusModal" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Status Lamaran:</h4>
        </div>
        <div class="modal-body">
          <div class="container">
          <blockquote class="quote-box">
          <p class="quotation-mark">
          “
          </p>
          <p class="quote-text">
          In order to succeed, your desire for success should be greater than your fear of failure.
          </p>
          <hr>
          <div class="blog-post-actions">
          <p class="blog-post-bottom pull-left">
            Bill Cosby
          </p>
          <p class="blog-post-bottom pull-right">
            <span class="badge quote-badge">10</span>  ❤
          </p>
          </div>
          </blockquote>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Melamar Pekerjaan</th>
                <th scope="col">Curriculum Vitae</th>
                <th scope="col">Status</th>
                <th scope="col">Tanggal Melamar</th>
              </tr>
            </thead>
            <tbody>
              <tr>
              <td>{{$user->detail_user->first_name.' '.$user->detail_user->last_name}}</td>
              <td>{{$user->job_request->job->name}}</td>
              @php
                $status = $user->job_request->status;
              @endphp

                <td rowspan="2"><a href="{{ asset('/storage/cv/'.$user->job_request->cv) }}">{{$user->job_request->cv}}</a>
                @if ($status == 'unread')<br>
                    <form action="{{route('job.reupload')}}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="form-group">
                          <input style="margin-top:5px;width: 190px;" type="file" name="cv">
                      </div>
                      <div class="form-group">
                          <input class="btn btn-warning" style="width: 190px;" type="submit" name="submit" value="Upload Ulang CV?">
                      </div>
                      <input type="hidden" name="_method" value="PUT">
                    </form>
                @endif
                </td>


              <td>
                @if ($status == 'unread')
                  <p style="font-size:14px" class="label label-default">{{$user->job_request->status}}</p>
                @elseif ($status == 'accepted')
                  <p style="font-size:14px" class="label label-success">{{$user->job_request->status}}</p>
                @else
                  <p style="font-size:14px" class="label label-danger">{{$user->job_request->status}}</p>
                @endif
              </td>

              <td>
                @php
                  $created = $user->job_request->created_at;
                  $tgl = substr($created, 8, 2);
                  $bln = substr($created, 5, 2);
                  $thn = substr($created, 0, 4);
                @endphp
                {{ $tgl.' - '.$bln.' - '.$thn }}
              </td>
            </tr>
          </tbody>
        </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
@elseif ($user->status == 2)
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Pilih Pekerjaan:</h4>
        </div>
        <div class="modal-body">
          <div class="container">
          <blockquote class="quote-box">
          <p class="quotation-mark">
          “
          </p>
          <p class="quote-text">
          Choose a job you love, and you will never have to work a day in your life..
          </p>
          <hr>
          <div class="blog-post-actions">
          <p class="blog-post-bottom pull-left">
            Confucius
          </p>
          <p class="blog-post-bottom pull-right">
            <span class="badge quote-badge">25</span>  ❤
          </p>
          </div>
          </blockquote>
          </div>
          <div class="row">
            <div style="margin: 20px" class="col-md-12">
              @foreach ($job as $job)
                <a href="{{ route('job.show', ['name' => $job->slug]) }}" class="btn btn-success btn-lg">{{ $job->name }}</a>
              @endforeach
            </div>
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
@endif


  <!-- Modal -->

@endsection
