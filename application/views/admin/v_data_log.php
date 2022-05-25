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
                                            <th>Aktif</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Tanggal</th>
                                            <th>Tipe</th>
                                            <th>Shift</th>
                                            <th>Source</th>
                                            <th>Aktif</th>
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
        var table;

        $(document).ready(function() {
            $('#myTable thead th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" class="form-control" placeholder="' + title + '" />');
            });

            table = $('#myTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "<?= base_url('admin/a_log/show'); ?>",
                dom: 'lBfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "order": [
                    [2, "desc"],
                    [1, "asc"],
                ],
                "columns": [{
                    "data": "nik",
                    className: "dt-center"
                }, {
                    "data": "employee_name"
                }, {
                    "data": "timestamp",
                    className: "dt-center"
                }, {
                    "data": "inout_type",
                    className: "dt-center",
                    "render": function(data, type, row) {
                        let typeName, badge;
                        if (data == '0001000') {
                            badge = 'success';
                            typeName = 'IN';
                        } else {
                            badge = 'danger';
                            typeName = 'OUT';
                        }

                        return "<span class='badge badge-" + badge + "' onclick='changeType(" + row.id + "," + row.inout_type + ")'>" + typeName + "</span>";
                    }
                }, {
                    "data": "shift_type_name",
                    className: "dt-center",
                }, {
                    "data": "source",
                    className: "dt-center",
                }, {
                    "data": "isactive",
                    className: "dt-center",
                    "render": function(data, type, row) {
                        let checked;
                        if (data == 'Y')
                            checked = 'checked';
                        else
                            checked = '';

                        return "<div class='switch custom-control custom-switch' onchange='changeSwitch(" + row.id + ")'><input type='checkbox' data-value=" + row.id + " class='custom-control-input' id='customSwitch" + row.id + "' " + checked + "><label class='custom-control-label' for='customSwitch" + row.id + "'></label></div>";
                    }
                }, ],
                "lengthMenu": [
                    [10, 25, 50, 100, 500, -1],
                    [10, 25, 50, 100, 500, "All"]
                ],
                "columnDefs": [{
                    "targets": [], //last column
                    "orderable": false, //set not orderable
                }],

                initComplete: function() {
                    // Apply the search
                    this.api().columns().every(function() {
                        var that = this;

                        $('input', this.header()).on('keyup change clear', function() {
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
        });

        function changeSwitch(id) {
            $.ajax({
                type: "GET",
                cache: false,
                url: "<?php echo base_url('admin/a_log/ajax_switch') ?>",
                data: {
                    id: id
                },
                success: function(html) {}
            });
        }

        function reload_table() {
            table.ajax.reload(null, false); //reload datatable ajax 
        }

        function changeType(id, type) {
            if (confirm('Yakin akan mengubah data?') == true) {
                $.ajax({
                    type: "GET",
                    cache: false,
                    url: "<?php echo base_url('admin/a_log/change_type') ?>",
                    data: {
                        id: id,
                        type: type
                    },
                    success: function(html) {
                        reload_table();
                    }
                });
            }
        }
    </script>
</body>

</html>