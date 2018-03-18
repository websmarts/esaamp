<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>


<nav class="navbar is-transparent">
  <div class="navbar-brand">
     <a class="navbar-item" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>

    <div class="navbar-burger burger" data-target="navbar">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>

  <div id="navbar" class="navbar-menu">
    <div class="navbar-end">
        @guest

        <a  class="navbar-item is-hoverable" href="{{ route('login') }}">Login</a>
        <a class="navbar-item is-hoverable" href="{{ route('register') }}">Register</a>

        @else
        <div class="navbar-item has-dropdown is-hoverable">

            <a href="#" class="navbar-link">
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>
            <div class="navbar-dropdown is-boxed">

                    <a class="navbar-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form class="navbar-item" id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
            </div>
        </div>

        @endguest
      </div>
    </div>
</nav>

<div id="app">
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
