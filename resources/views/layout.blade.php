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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
  </head>
<!-- NAVBAR
================================================== -->
  <body>
<div id="app">

    <section class="hero is-info is-medium is-bold">
    <div class="hero-head">
      <nav class="navbar">
        <div class="container">
          <div class="navbar-brand">
            <a class="navbar-item" href="../">
              <img src="images/logo-with-tick-white.png" alt="Logo">
            </a>
            <span class="navbar-burger burger" data-target="navbarMenu">
              <span></span>
              <span></span>
              <span></span>
            </span>
          </div>
          <div id="navbarMenu" class="navbar-menu">
            <div class="navbar-end">
              <a class="navbar-item is-active">
                Home
              </a>
              <a class="navbar-item">
                About
              </a>
              <a class="navbar-item">
                Benefits
              </a>
              <a class="navbar-item">
                Docs
              </a>

              </a>
              <span class="navbar-item">
                <a class="button is-white is-outlined is-small" href="#login">

                  <span>Login / Register</span>
                </a>
              </span>
            </div>
          </div>
        </div>
      </nav>
    </div>
    <div class="hero-body">
      <div class="container has-text-centered">
        <h1 class="title">
          EQUIPMENT SAFETY AUDIT &amp; ASSET MANAGEMENT PORTAL
        </h1>
        <h2 class="subtitle">
          The Equipment Safety Audit and Asset Maanagement Portal is a tool to manage the acquisition, safe use and replacement of hospital equipment to ensure optimal patient use and care.
        </h2>
      </div>
    </div>

  </section>

  <div class="box cta">
    <p class="has-text-centered">
      <span class="tag is-danger">New</span> Now with support for wingdings as well as slingdings.
    </p>
  </div>

<section class="container">
    @yield('content')
</section>

  <footer class="footer">
    <div class="container">
      <div class="content has-text-centered">
        <p>
          <strong>eSAAMP</strong> by <a href="#">Warragul Linen Service</a>.
        </p>


      </div>
    </div>
  </footer>
  </div>
  <!-- Bulm menu support -->
 <script>
    (function() {
    var burger = document.querySelector('.burger');
    var menu = document.querySelector('#'+burger.dataset.target);
    burger.addEventListener('click', function() {
        burger.classList.toggle('is-active');
        menu.classList.toggle('is-active');
    });
})();
</script>
    @yield('scripts')
  </body>
</html>
