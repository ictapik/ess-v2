<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Absen Master PT API</title>

    <!-- Custom fonts for this template -->
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/magicthumb/magicthumb.css') ?>" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/jquery.dataTables.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/buttons.dataTables.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dataTables.bootstrap4.min.css') ?>">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin/a_dashboard') ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-book-reader"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Absen Master<sup> PT. API</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/a_dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Master
            </div>

            <!-- Nav Item - Data Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Data Master</span>
                </a>
                <div id="collapseUtilities" class="collapse show" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"></h6>
                        <a class="collapse-item" href="<?= base_url('admin/a_admin') ?>"><i class="fas fa-fw fa-table"></i> Data Admin</a>
                        <a class="collapse-item" href="<?= base_url('admin/a_user') ?>"><i class="fas fa-fw fa-table"></i> Data User</a>
                        <a class="collapse-item active" href="<?= base_url('admin/a_log') ?>"><i class="fas fa-fw fa-table"></i> Data Log</a>
                        <a class="collapse-item" href="<?= base_url('admin/attendance') ?>"><i class="fas fa-fw fa-table"></i> Data Absen</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <!-- <hr class="sidebar-divider d-none d-md-block">
      <div class="sidebar-heading">
        Menu
      </div>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/a_peminjaman'); ?>">
          <i class="fas fa-fw fa-book-open"></i>
          <span>Peminjaman Buku</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/a_pengembalian'); ?>">
          <i class="fas fa-fw fa-book"></i>
          <span>Pengembalian Buku</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/a_laporan'); ?>">
          <i class="fas fa-fw fa-folder"></i>
          <span>Laporan Perpustakaan</span></a>
      </li> -->
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('ses_nama') ?></span><i class="fa fa-angle-down"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

                <!-- End of Topbar -->
                <center>
                    <div class="text-xs font-weight-bold text-info text-uppercase"><b style="font-size: 25px">
                            <center>Data Log</center>
                        </b></div><br>
                </center>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- <div class="row no-arrow">
            <div class="btn">
              <a href="" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-list"></i> Export Absen</a>
            </div>
          </div> -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <!-- <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Log</h6>
            </div> -->

                        <div class="card-body">
                            <div class="">
                                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Tanggal</th>
                                            <th>Tipe</th>
                                            <th>Shift</th>
                                            <th>Source</th>
                                            <th>Active</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        use function PHPSTORM_META\type;

                                        $no = 1;
                                        foreach ($absen as $row) {
                                        ?>
                                            <tr>
                                                <!-- <td><?= $no++ ?></td> -->
                                                <td><?= $row['nik']; ?></td>
                                                <td><?= $row['employee_name']; ?></td>
                                                <td><?= $row['timestamp']; ?></td>
                                                <td class="text-center" id="typeInOut">
                                                    <?= $row['inout_type'] == "0001000" ? "<span class='badge badge-success' onclick='changeType(" . $row['id'] . ", " . $row['inout_type'] . ")'>IN</span>" : "<span class='badge badge-danger' onclick='changeType(" . $row['id'] . ", " . $row['inout_type'] . ")'>OUT</span>"; ?>
                                                </td>
                                                <!-- <td><?= $row['result']; ?></td> -->
                                                <td><?= $row['shift_type_name']; ?></td>
                                                <td class="text-center"><?= $row['source']; ?></td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($row['isactive'] == 'Y') {
                                                        $checked = "checked";
                                                    } else {
                                                        $checked = "";
                                                    }
                                                    ?>
                                                    <div class='switch custom-control custom-switch'>
                                                        <input type='checkbox' data-value="<?= $row['id']; ?>" class='custom-control-input' id='customSwitch<?= $row['id']; ?>' <?= $checked; ?>>
                                                        <label class='custom-control-label' for='customSwitch<?= $row['id']; ?>'></label>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Tanggal</th>
                                            <th>Tipe</th>
                                            <th>Shift</th>
                                            <th>Source</th>
                                            <th>Active</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; PT. API <?= date('Y'); ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ingin keluar ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih tombol "Keluar" dibawah ini jika anda ingin mengakhiri sesi kali ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="<?= site_url('auth/logout'); ?>">Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>
    <script src="<?= base_url('assets/magicthumb/magicthumb.js') ?>"></script>

    <!-- Page level custom scripts -->

    <script src="<?= base_url('assets/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= base_url('assets/buttons.flash.min.js') ?>"></script>
    <script src="<?= base_url('assets/jszip.min.js') ?>"></script>
    <script src="<?= base_url('assets/pdfmake.min.js') ?>"></script>
    <script src="<?= base_url('assets/vfs_fonts.js') ?>"></script>
    <script src="<?= base_url('assets/buttons.html5.min.js') ?>"></script>
    <script src="<?= base_url('assets/buttons.print.min.js') ?>"></script>
    <script type="text/javascript">
        MagicThumbOptions = {
            'expandSpeed': '200',
            'expandEffect': 'fade'
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable tfoot th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" class="form-control" placeholder="' + title + '" />');
            });

            $('#myTable').DataTable({
                // dom: 'Bfrtip',
                dom: 'lBfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                // responsive: true

                initComplete: function() {
                    // Apply the search
                    this.api().columns().every(function() {
                        var that = this;

                        $('input', this.footer()).on('keyup change clear', function() {
                            if (that.search() !== this.value) {
                                that
                                    .search(this.value)
                                    .draw();
                            }
                        });
                    });
                }

            });

            $('.form-checkbox').click(function() {
                if ($(this).is(':checked')) {
                    $('.password').attr('type', 'text');
                } else {
                    $('.password').attr('type', 'password');
                }
            });

            $('.switch').change(function() {
                let id = $(this).find('input').data('value');
                console.log(id);
                $.ajax({
                    type: "GET",
                    cache: false,
                    url: "<?php echo base_url('admin/a_log/ajax_switch') ?>",
                    data: {
                        id: id
                    },
                    success: function(html) {}
                });
            });
        });

        function changeType(id, type) {
            // console.log(id);
            // console.log(type);
            $.ajax({
                type: "GET",
                cache: false,
                url: "<?php echo base_url('admin/a_log/change_type') ?>",
                data: {
                    id: id,
                    type: type
                },
                success: function(html) {
                    // $("#typeInOut").html("<span class='badge badge-success'>IN</span>");
                    location.reload();
                }
            });
        }
    </script>
</body>

</html>