@extends('layouts.user')

@section('title', 'Profile')

@section('content')
<div class="container">
  <div class="row">
  <div class="col-md-8 col-md-offset-2">
  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 style="text-align:center" class="panel-title">Notifikasi</h3>
    </div>
    <div class="panel-body">
      <div class="alert alert-success">
        <ul style="list-style:none; text-align:center">
          @foreach ($notif as $notif)
            @php
            $created = $notif->created_at;
            $sub_tgl = substr($created, 8, 2);
            $sub_bln = substr($created, 5, 2);
            $sub_thn = substr($created, 0, 4);
            @endphp
            <br><li>{{ $notif->subject }} <br> dikirim tgl: {{ $sub_tgl.' - '.$sub_bln.' - '.$sub_thn }}</li><br>
          @endforeach
        </ul>
      </div>

    </div>
  </div>

</div>
</div>
</div>

@endsection
