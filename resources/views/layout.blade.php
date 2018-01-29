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
              <img src="images/logo-white.png" alt="Logo">
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
      <span class="tag is-primary">New</span> Now with support for wingdings as well as slingdings.
    </p>
  </div>

  <section class="container">
    <div class="columns features">
      <div class="column is-4">
        <div class="card">
          <div class="card-image has-text-centered">
                <i class="fa fa-database"></i>
          </div>
          <div class="card-content">
            <div class="content">
              <h4>DATA CENTRALISATION </h4>
              <p>Purus semper eget duis at tellus at urna condimentum mattis. Non blandit massa enim nec. Integer enim neque volutpat ac tincidunt vitae semper quis. Accumsan tortor posuere ac ut consequat semper viverra nam. Purus semper eget duis.</p>
              <p><a href="#">Learn more</a></p>
            </div>
          </div>
        </div>
      </div>
      <div class="column is-4">
        <div class="card">
          <div class="card-image has-text-centered">
              <i class="fa fa-id-card-o"></i>
          </div>
          <div class="card-content">
            <div class="content">
              <h4>SAFTETY SOLUTION.</h4>
              <p>Ut venenatis tellus in metus vulputate. Amet consectetur adipiscing elit pellentesque. Sed arcu non odio euismod lacinia at quis risus. Faucibus turpis in eu mi bibendum neque egestas cmonsu songue. Phasellus vestibulum lorem sed risus.</p>
              <p><a href="#">Learn more</a></p>
            </div>
          </div>
        </div>
      </div>
      <div class="column is-4">
        <div class="card">
          <div class="card-image has-text-centered">
              <i class="fa fa-table"></i>
          </div>
          <div class="card-content">
            <div class="content">
              <h4> ASSET MANAGEMENT.  </h4>
              <p>Imperdiet dui accumsan sit amet nulla facilisi morbi. Fusce ut placerat orci nulla pellentesque dignissim enim. Libero id faucibus nisl tincidunt eget nullam. Commodo viverra maecenas accumsan lacus vel facilisis.</p>
              <p><a href="#">Learn more</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="intro column is-8 is-offset-2 has-text-centered">
      <h2 class="title">eSAAMP Basics</h2><br>
      <p class="subtitle">Vel fringilla est ullamcorper eget nulla facilisi. Nulla facilisi nullam vehicula ipsum a. Neque egestas congue quisque egestas diam in arcu cursus.</p>
    </div>

  </section>

  <section class="container">
    <div class="columns features">
      <div class="column is-3">
        <div class="card">

          <div class="card-content">
            <div class="content">
              <h4>What is eSAAMP? </h4>
              <p>Purus semper eget duis at tellus at urna condimentum mattis. Non blandit massa enim nec. Integer enim neque volutpat ac tincidunt vitae semper quis. Accumsan tortor posuere ac ut consequat semper viverra nam. Purus semper eget duis.</p>
              <p><a href="#">Learn more</a></p>
            </div>
          </div>
        </div>
      </div>
      <div class="column is-3">
        <div class="card">

          <div class="card-content">
            <div class="content">
              <h4>Why eSAAMP?</h4>
              <p>Ut venenatis tellus in metus vulputate. Amet consectetur adipiscing elit pellentesque. Sed arcu non odio euismod lacinia at quis risus. Faucibus turpis in eu mi bibendum neque egestas cmonsu songue. Phasellus vestibulum lorem sed risus.</p>
              <p><a href="#">Learn more</a></p>
            </div>
          </div>
        </div>
      </div>
      <div class="column is-3">
        <div class="card">

          <div class="card-content">
            <div class="content">
              <h4> eSAAMP benefits  </h4>
              <p>Imperdiet dui accumsan sit amet nulla facilisi morbi. Fusce ut placerat orci nulla pellentesque dignissim enim. Libero id faucibus nisl tincidunt eget nullam. Commodo viverra maecenas accumsan lacus vel facilisis. mperdiet dui accumsan sit amet nulla facilisi.</p>
              <p><a href="#">Learn more</a></p>
            </div>
          </div>
        </div>
      </div>

      <div class="column is-3">
        <div class="card">

          <div class="card-content">
            <div class="content">
              <h4> How do I get started?  </h4>
              <p>Imperdiet dui accumsan sit amet nulla facilisi morbi. Fusce ut placerat orci nulla pellentesque dignissim enim. Libero id faucibus nisl tincidunt eget nullam. Commodo viverra maecenas accumsan lacus vel facilisis. mperdiet dui accumsan sit amet nulla facilisi.</p>
              <p><a href="#">Learn more</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
  <footer class="footer">
    <div class="container">
      <div class="content has-text-centered">
        <p>
          <strong>eSAAMP</strong> by <a href="https://github.com/dansup">Warragul Line Service</a>.
        </p>


      </div>
    </div>
  </footer>
  </div>
    @yield('scripts')
  </body>
</html>
