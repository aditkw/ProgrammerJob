@extends('layouts.admin')

@section('title', 'Home')


@section('content')
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Create New Job</li>
    </ol>
    <div class="row">
      <div id="pesan" style="width: 100%; display:none">
        <p id='isi_pesan' style="margin-top:10px; line-height:10%; text-align: center"></p>
      </div>
        <div style="margin:0 auto" class="col-md-6">

                  @if (session('notice'))
                    <div class="alert alert-success">
                      <p style="text-align: center">{{ session('notice') }}</p>
                    </div>
                  @endif

                    <form class="form-horizontal" id="create" method="POST" enctype="multipart/form-data" action="{{ route('create.job') }}" csrf="{{csrf_token()}}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nama Pekerjaan:</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Deskripsi:</label>

                            <div class="col-md-12">
                                <textarea class="form-control" rows="5" name="description" >{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('salary') ? ' has-error' : '' }}">
                            <label for="salary" class="col-md-4 control-label">Gaji:</label>

                            <div class="col-md-12">
                                <input id="salary" type="text" class="form-control" name="salary" value="{{ old('salary') }}" required>
                                @if ($errors->has('salary'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('salary') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                            <label for="photo" class="col-md-4 control-label">Thumbnail:</label>

                            <div class="col-md-12">
                                <input id="photo" type="file" class="form-control" name="photo" required>
                                @if ($errors->has('photo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary btn-block">
                                </input>
                            </div>
                        </div>
                    </form>
    </div>
</div>
</div>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="{{asset('/js/job.js')}}"></script>
@endsection
