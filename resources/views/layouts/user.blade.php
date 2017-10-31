@php
  use App\Models\User;
  $user_id = Sentinel::getUser()->id;
  $user = User::find($user_id);
  $jml_notif = $user->notifications()->where('seen', 0)->count();
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav style="background-color:#6B9DBB" class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a style="color:white;" class="navbar-brand" href="{{ url('/') }}">
                        Programmer Job
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Sentinel::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('signup') }}">Register</a></li>
                        @else
                          @php
                            $id = Sentinel::getUser()->id;
                            $user = User::where('id', $id)->first();
                          @endphp
                          @if ($user->status == 2 or $user->status == 3 )
                            <li><a style="color:white;" href="{{ route('profile.show') }}">Profil</a></li>
                            <li><a style="color:white;" href="{{ route('show.notif') }}">Notifikasi({{ $jml_notif }})</a></li>
                          @endif
                            <li class="dropdown">
                                <a style="color:white"; href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ $user->detail_user->first_name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                    <a href="{{ route('profile.update') }}">
                                        Edit Profil
                                    </a>
                                    </li>
                                    <li>
                                      <a href="{{ route('logout') }}">
                                          Logout
                                      </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <footer style="background-color:#6B9DBB;" class="panel-footer">
      <p style="font-size:17px; color: white; margin-top:10px; text-align: center;">
          Copyright &copy; ProgrammerJob 2017 created with ❤
      </p>
    </footer>
</body>
</html>
