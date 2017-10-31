@extends('layouts.user')

@section('title', 'Home')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading"><h1 style="text-align:center" class="panel-title">Update Profil</h1></div>

                <div class="panel-body">
                  @if (session('notice'))
                    <div class="alert alert-success">
                      <p style="text-align: center">{{ session('notice') }}</p>
                    </div>
                  @endif

                    <form class="form-horizontal" method="POST" action="{{ route('profile.update') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ ($user->detail_user) ? $user->detail_user->first_name : old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ ($user->detail_user) ? $user->detail_user->last_name : old('last_name') }}" required>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-4 control-label">Jenis Kelamin</label>

                            <div class="col-md-6">
                                <select name="gender" id="gender" class="form-control">
                                  @php
                                    $gender = $user->detail_user->gender
                                  @endphp
                                    <option value="Pria" {{ ($gender == 'Pria' ? 'selected' : '') }}>Pria</option>
                                    <option value="Wanita"{{ ($gender == 'Wanita' ? 'selected' : '') }}>Wanita</option>
                                </select>
                            </div>
                          </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">No. Telepon</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ ($user->detail_user) ? $user->detail_user->phone : old('phone') }}">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('birth') ? ' has-error' : '' }}">
                                <label for="birth" class="col-md-4 control-label">Tgl Lahir</label>
                            <div class="col-md-2">
                              @php
                                $sub_tgl = substr($user->detail_user->birth, 8, 2);
                                $sub_bln = substr($user->detail_user->birth, 5, 2);
                                $sub_thn = substr($user->detail_user->birth, 0, 4);
                              @endphp
                                <select name="tgl" id="tgl" class="form-control">
                                  @for ($i=31; $i>=1; $i--)
                                    <option value="{{$i}}" {{ ($i == $sub_tgl) ? 'selected' : '' }} >{{$i}}</option>
                                  @endfor
                                </select>
                              </div>
                              <div class="col-md-2">
                                  <select name="bln" id="bln" class="form-control">
                                    @for ($i=1; $i<=12; $i++)
                                      @php
                                        switch ($i) {
                                          case 1: $j = 'Januari'; break;
                                          case 2: $j = 'Febuari'; break;
                                          case 3: $j = 'Maret'; break;
                                          case 4: $j = 'April'; break;
                                          case 5: $j = 'Mei'; break;
                                          case 6: $j = 'Juni'; break;
                                          case 7: $j = 'Juli'; break;
                                          case 8: $j = 'Agustus'; break;
                                          case 9: $j = 'September'; break;
                                          case 10: $j = 'Oktober'; break;
                                          case 11: $j = 'November'; break;
                                          case 12: $j = 'Desember'; break;
                                        }
                                      @endphp
                                      <option value="{{$i}}" {{ ($i == $sub_bln) ? 'selected' : '' }}>{{$j}}</option>
                                    @endfor
                                  </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="thn" id="thn" class="form-control">
                                      @for ($i=2017; $i>=1945; $i--)
                                        <option value="{{$i}}" {{ ($i == $sub_thn) ? 'selected' : '' }}>{{$i}}</option>
                                      @endfor
                                    </select>
                                  </div>
                          </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Alamat</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ ($user->detail_user) ? $user->detail_user->address : old('address') }}" required/>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                            <label for="country" class="col-md-4 control-label">Negara Asal</label>

                            <div class="col-md-6">
                                <select name="country" id="country" class="form-control">
                                  @include('layouts.country')
                                </select>
                            </div>
                          </div>

                          <div class="form-group{{ $errors->has('last_education') ? ' has-error' : '' }}">
                              <label for="last_education" class="col-md-4 control-label">Pendidikan Terakhir</label>

                              <div class="col-md-6">
                                  <select name="last_education" id="last_education" class="form-control">
                                    @php
                                      $edu = $user->detail_user->last_education
                                    @endphp
                                    <option value="SMA" {{ ($edu == 'SMA') ? 'selected' : '' }}>SMA</option>
                                    <option value="SMK" {{ ($edu == 'SMK') ? 'selected' : '' }}>SMK</option>
                                    <option value="D3" {{ ($edu == 'D3') ? 'selected' : '' }}>D3</option>
                                    <option value="S1" {{ ($edu == 'S1') ? 'selected' : '' }}>S1</option>
                                    <option value="S2" {{ ($edu == 'S2') ? 'selected' : '' }}>S2</option>

                                  </select>
                              </div>
                            </div>

                        <div class="form-group">
                            <label for="institute_name" class="col-md-4 control-label">Nama Institut</label>

                            <div class="col-md-6">
                                <input id="institute_name" type="text" class="form-control" value="{{ ($user->detail_user) ? $user->detail_user->institute_name : old('institute_name') }}" name="institute_name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="majors" class="col-md-4 control-label">Jurusan</label>

                            <div class="col-md-6">
                                <input id="majors" type="text" class="form-control" name="majors" value="{{ ($user->detail_user) ? $user->detail_user->majors : old('majors') }}" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('graduate_year') ? ' has-error' : '' }}">
                            <label for="graduate_year" class="col-md-4 control-label">Lulus Tahun</label>

                            <div class="col-md-6">
                              @php
                                $grd_year = $user->detail_user->graduate_year
                              @endphp
                                <select name="graduate_year" id="graduate_year" class="form-control">
                                  @for ($i=2017; $i>=1999; $i--)
                                    <option value="{{$i}}" {{ ($grd_year == $i) ? 'selected' : '' }}>{{$i}}</option>
                                  @endfor
                                </select>
                            </div>
                          </div>

                        <input type="hidden" name="id" value="{{$user->id}}">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
