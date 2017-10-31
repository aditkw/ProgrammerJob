@extends('layouts.user')

@section('title', 'Job')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading"><h1 style="text-align:center" class="panel-title">Job Detail</h2></div>

                <div class="panel-body">
                  @if (session('notice'))
                    <div class="alert alert-success">
                      <p style="text-align: center">{{ session('notice') }}</p>
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

                    </div>
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img style="width:200px;height:180px;" alt="User Pic" src="{{ asset('/storage/photo/'.$job->photo) }}"  class="img-rounded img-responsive"> </div>

                        <div class=" col-md-9 col-lg-9 ">
                          <table class="table table-user-information">
                            <tbody>
                              <tr>
                                <td>Pekerjaan:</td>
                                <td>{{ $job->name }}</td>
                              </tr>
                              <tr>
                                <td>Deskripsi:</td>
                                <td>{{ $job->description }}</td>
                              </tr>
                              <tr>
                                <td>Gaji:</td>
                                <td>{{ $job->salary }}</td>
                              </tr>
                              <tr>
                                <td>Jam Kerja:</td>
                                <td>09:00 - 16:00</td>
                              </tr>

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br>

                  <h4 style="text-align: center;">Pekerjaan <strong>{{ $job->name }}</strong> sesuai dengan passion mu? Ayo lamar sekarang juga!</h4>
                  <br>
                  <button type="button" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#myModal">Lamar Sekarang!</button>
                </div>
            </div>
        </div>
    </div>
</div>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Lamar Pekerjaan:</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('job.store', ['slug' => $job->slug]) }}">
              {{ csrf_field() }}

              <div class="form-group">
                  <label for="first_name" class="col-md-4 control-label">Nama Pekerjaan:</label>

                  <div class="col-md-6">
                      <label for="first_name" class="control-label">{{ $job->name }}</label>
                  </div>
              </div>

              <div class="form-group">
                  <label for="description" class="col-md-4 control-label">Deskripsi:</label>

                  <div class="col-md-6">
                      <textarea rows="6" class="form-control" name="description" placeholder="Jelaskan minat atau kelebihan mu dalam pekerjaan ini dapat menjadi nilai plus bagi HRD.."></textarea>
                  </div>
              </div>

              <div class="form-group">
                  <label for="cv" class="col-md-4 control-label">Upload CV:</label>

                  <div class="col-md-6">
                      <input class="form-control" type="file" name="cv">
                  </div>
              </div>
              <input type="hidden" name="job_id" value="{{ $job->id }}">
              <input type="hidden" name="user_id" value="{{ $user->id }}">

              <div class="form-group">
                  <div style="margin-left: 46em" class="col-md-6">
                      <button type="submit" class="btn btn-primary">
                          Submit
                      </button>
                  </div>
              </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
@endsection
