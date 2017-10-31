<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    Verifikasi link: <a href="{{ route('verification',  ['token' => $user->token, 'id' => $user->id, ]) }}">Klik untuk verifikasi</a>
  </body>
</html>
