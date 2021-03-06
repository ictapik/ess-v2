<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ESS - PT. Adyawinsa Plastics Industry</title>
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/logo-rounded.png'); ?>">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte-template/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte-template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte-template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte-template/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte-template/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte-template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte-template/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte-template/plugins/summernote/summernote-bs4.min.css">

  <!-- jQuery -->
  <script src="<?= base_url(); ?>assets/adminlte-template/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url(); ?>assets/adminlte-template/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    // $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url(); ?>assets/adminlte-template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="<?= base_url(); ?>assets/adminlte-template/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="<?= base_url(); ?>assets/adminlte-template/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="<?= base_url(); ?>assets/adminlte-template/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?= base_url(); ?>assets/adminlte-template/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?= base_url(); ?>assets/adminlte-template/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?= base_url(); ?>assets/adminlte-template/plugins/moment/moment.min.js"></script>
  <script src="<?= base_url(); ?>assets/adminlte-template/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?= base_url(); ?>assets/adminlte-template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?= base_url(); ?>assets/adminlte-template/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?= base_url(); ?>assets/adminlte-template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url(); ?>assets/adminlte-template/dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <!-- <script src="<?= base_url(); ?>assets/adminlte-template/dist/js/demo.js"></script> -->
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?= base_url(); ?>assets/adminlte-template/dist/js/pages/dashboard.js"></script>

  <link rel="stylesheet" href="<?= base_url('assets/jquery.dataTables.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/buttons.dataTables.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte-template/plugins/datatables-responsive/css/responsive.bootstrap4.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/dataTables.bootstrap4.min.css') ?>">
  <!-- Spinner Loading -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/spinner/css-loader.css">

  <script src="<?= base_url('assets/jquery.dataTables.min.js') ?>"></script>
  <script src="<?= base_url('assets/dataTables.buttons.min.js') ?>"></script>
  <script src="<?= base_url('assets/buttons.flash.min.js') ?>"></script>
  <script src="<?= base_url('assets/jszip.min.js') ?>"></script>
  <script src="<?= base_url('assets/pdfmake.min.js') ?>"></script>
  <script src="<?= base_url('assets/vfs_fonts.js') ?>"></script>
  <script src="<?= base_url('assets/buttons.html5.min.js') ?>"></script>
  <script src="<?= base_url('assets/buttons.print.min.js') ?>"></script>
  <script src="<?= base_url('assets/adminlte-template/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
  <!-- Sweetalert -->
  <script src="<?= base_url('assets/adminlte-template/plugins/sweetalert2/sweetalert2.all.min.js') ?>"></script>

  <link rel="stylesheet" href="<?= base_url('assets/backtotop/css/scrolltotop_arrow_style.css'); ?>">
  <script src="<?= base_url('assets/backtotop/js/scrolltotop_arrow_code.js'); ?>"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

  <!-- Spinner Loding -->
  <div id="spinner" class="loader loader-default" data-text="LOADING"></div>

  <!-- Button back to top -->
  <div id="scrolltotop_parent" class="scrolltotop_hide_onload">
    <div tabindex="0" id="scrolltotop_arrow">
    </div>
  </div>

  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?= base_url(); ?>assets/img/logo-oval.png" alt="AdminLTELogo" width="120">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= base_url(); ?>" class="brand-link">
        <img src="<?= base_url(); ?>assets/img/logo-short.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 1">
        <span class="brand-text font-weight-light">Employee Self Service</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">

            <?php
            if ($this->session->userdata('ses_jk') == "Perempuan") {
              $img = "assets/img/default-woman.jpg";
            } else {
              $img = "assets/img/default-man.jpg";
            }
            ?>

            <img src="<?= base_url($img); ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="<?= base_url(); ?>employee/profile" class="d-block"><?= $this->session->userdata('ses_nama'); ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="<?= base_url(); ?>" class="nav-link">
                <i class="nav-icon fa fa-home"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url(); ?>employee/profile" class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Profil
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url(); ?>employee/attendance" class="nav-link">
                <i class="nav-icon far fa-clock"></i>
                <p>
                  Absensi
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url(); ?>employee/log" class="nav-link">
                <i class="nav-icon fa fa-file-alt"></i>
                <p>
                  Log In/Out
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-history"></i>
                <p>
                  Riwayat
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url(); ?>employee/history" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Log Manual</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url(); ?>employee/history_leave" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Cuti</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="<?= base_url(); ?>auth/logout" class="nav-link">
                <i class="nav-icon fa fa-power-off"></i>
                <p>
                  Keluar
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>