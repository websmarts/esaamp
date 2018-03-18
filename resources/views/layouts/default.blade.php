<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Custom styles for this template -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
  </head>
<!-- NAVBAR
================================================== -->
  <body>

    @include('layouts.partials.navbar')


<section>
    @yield('content')
</section>

  @include('layouts.partials.footer')

  <script src="{{ asset('js/app.js') }}"></script>

  @yield('scripts')

  </body>
</html>
