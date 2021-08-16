<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema | Inmobiliaria</title>

   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
   {{-- <link rel="stylesheet" href="{{ asset('plugins2/css/OverlayScrollbars.min.css') }}"> --}}
   {{-- <link rel="stylesheet" href="{{ asset('plugins2/css/tempusdominus-bootstrap-4.min.css') }}">
   <link rel="stylesheet" href="{{ asset('plugins2/css/icheck-bootstrap.min.css') }}">
   <link rel="stylesheet" href="{{ asset('plugins2/css/jqvmap.min.css') }}">
   <link rel="stylesheet" href="{{ asset('plugins2/css/daterangepicker.css') }}">
   <link rel="stylesheet" href="{{ asset('plugins2/css/summernote-bs4.min.css') }}"> --}}
   {{-- <link rel="stylesheet" href="{{ asset('plugins2/css/adminlte.min.css') }}"> --}}

  <link href="css/plantilla.css" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div id="app">
<div class="wrapper">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Escritorio</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Buscar -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notificaciones</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 nuevos mensajes
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">Todas las notificaciones</a>
        </div>
      </li>      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user-circle"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Cuenta</span>
          <div class="dropdown-divider"></div>
          <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
              <i class="fas fa-lock"></i><span>{{ __('Cerrar Session') }}</span>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf

          </form>          
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
      <img src="img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Inmobiliaria</span>
    </a>
    <div class="sidebar">
      @include('layouts.sidebar')
    </div>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('contenido')
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021-2025 <a href="https://adminlte.io">Valdivia</a>.</strong>
    Todo los derechos reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 2.0
    </div>
  </footer>

</div>
</div>
<!-- ./wrapper -->
{{-- <script>$.widget.bridge('uibutton', $.ui.button)</script> --}}
{{-- <script src="{{ asset('plugins2/js/jquery.min.js') }}"></script>
<script src="{{ asset('plugins2/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('plugins2/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins2/js/Chart.min.js') }}"></script>
<script src="{{ asset('plugins2/js/sparkline.js') }}"></script>
<script src="{{ asset('plugins2/js/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins2/js/jquery.vmap.usa.js') }}"></script>
<script src="{{ asset('plugins2/js/jquery.knob.min.js') }}"></script>
<script src="{{ asset('plugins2/js/moment.min.js') }}"></script>
<script src="{{ asset('plugins2/js/daterangepicker.js') }}"></script>
<script src="{{ asset('plugins2/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('plugins2/js/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('plugins2/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('plugins2/js/dashboard.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins2/js/adminlte.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins2/js/demo.js') }}"></script> --}} 
<script src="js/app.js"></script>
<script src="js/plantilla.js"></script>
<script src="js/sweetalert2.all.js"></script>

</body>
</html>
