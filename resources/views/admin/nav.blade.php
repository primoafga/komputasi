<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIAKAD</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Bootstrap 4.6.0 -->
  <link href="{{ asset('LTE/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('LTE/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('LTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

  @yield('link_rel')

  <!-- Bootstrap4 Duallistbox -->
  <!-- <link rel="stylesheet" href="{{ asset('LTE/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}"> -->

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('LTE/dist/css/adminlte.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link href="{{ asset('LTE/dist/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css" />

</head>
<!-- layout-footer-fixed -->
<!-- dark-mode  -->
<body class="hold-transition  sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed text-sm">
  <div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="LTE/dist/img/logo.png" alt="SIAKAD MAN 1" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="home" class="nav-link"> </a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
      <a class="nav-link" href="/logout" role="button">
      <td><span class="badge badge-danger"> LogOut </span></td>
          <!-- <i class="fas fa-expand-arrows-alt"> Logout</i> -->
          </a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-olive elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="/image/guru.jpg" alt="AdminLTE Logo" class="brand-image card-img" style="opacity: .8">
      <?php $nama = Session::get('nama') ?>
      <span class="brand-text font-weight-light">{{$nama}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('Admin.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-home "></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('/data_guru') }}" class="nav-link">
                    <i class="nav-icon fas fa-home "></i>
                    <p>Data Guru</p>
                </a>
            </li>
          <li class="nav-item menu-open">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Data Siswa
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item menu-open">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-edit "></i>
                        <p>
                            KELAS X
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach ($tingkat1 as $item)
                        <li class="nav-item">
                            <a href="/siswa/{{$item->ID_KELAS}}" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p>{{ $item->NAMA }}</p>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item menu-open">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-edit "></i>
                        <p>
                            KELAS XI
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach ($tingkat2 as $item)
                        <li class="nav-item">
                            <a href="/siswa/{{$item->ID_KELAS}}" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p>{{ $item->NAMA }}</p>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item menu-open">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-edit "></i>
                        <p>
                            KELAS XII
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach ($tingkat3 as $item)
                        <li class="nav-item">
                            <a href="/siswa/{{$item->ID_KELAS}}" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p>{{ $item->NAMA }}</p>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
          </li>
            <li class="nav-item">
                <a href="{{ route('/data_mapel') }}" class="nav-link">
                    <i class="nav-icon fas fa-home "></i>
                    <p>Data Mapel</p>
                </a>
            </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        @yield('title')
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        @yield('content')
     </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer small-text">
    <strong>Copyright &copy; 2021 Kelompok 4.</strong>
    </div>
  </footer>
</div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('LTE/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4.6.0 -->
  <script src="{{ asset('LTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('LTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <!-- jQuery Mapael -->
  <script src="{{ asset('LTE/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
  <script src="{{ asset('LTE/plugins/raphael/raphael.min.js') }}"></script>
  <script src="{{ asset('LTE/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
  <script src="{{ asset('LTE/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('LTE/plugins/chart.js/Chart.min.js') }}"></script>

  @yield('script_src')

  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('LTE/dist/js/pages/dashboard2.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('LTE/dist/js/adminlte.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('LTE/dist/js/demo.js') }}"></script>

  <script>
    function funUang2Float($nNom) {
      $nNom = $nNom.replace('.','')
      $nNom = $nNom.replace('.','')
      $nNom = $nNom.replace('.','')
      $nNom = $nNom.replace(',','.')
      return  parseFloat($nNom);
    }
  </script>
  @yield('script_e')


</body>
</html>
