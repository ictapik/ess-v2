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
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/magicthumb/magicthumb.css') ?>" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">

  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

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
            <a class="collapse-item active" href="<?= base_url('admin/a_user') ?>"><i class="fas fa-fw fa-table"></i> Data User</a>
            <a class="collapse-item" href="<?= base_url('admin/a_log') ?>"><i class="fas fa-fw fa-table"></i> Data Log</a>
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
        <!-- Start Add Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b>Tambah User</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="<?= site_url('admin/a_user/insertUser') ?>" method="post">
                  <div class="form-group">
                    <label class="col-form-label"><b>ID Karyawan</b></label>
                    <input type="text" class="form-control" name="id_karyawan" placeholder="masukkan id karyawan" required="" autofocus>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label"><b>Nama Karyawan</b></label>
                    <input type="text" class="form-control" name="nama_karyawan" placeholder="masukkan nama karyawan" required="">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label"><b>Departemen</b></label>
                    <select name="department" class="form-control">
                      <option>-- Pilih Departemen --</option>
                      <?php
                      foreach ($department as $row) {
                      ?>
                        <option value="<?= $row->department_id; ?>"><?= $row->name; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label"><b>Tipe Shift</b></label>
                    <select name="shift_type" class="form-control">
                      <option>-- Pilih Tipe Shift --</option>
                      <?php
                      foreach ($shift_type as $row) {
                      ?>
                        <option value="<?= $row->shift_type_id ?>"><?= $row->name; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label"><b>Jenis Kelamin</b></label>
                    <select class="form-control" name="jenis_kelamin" required="">
                      <option>-- Pilih jenis kelamin --</option>
                      <option name="Laki-laki">Laki - laki</option>
                      <option name="Perempuan">Perempuan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label"><b>Alamat</b></label>
                    <textarea class="form-control" name="alamat" placeholder="masukkan alamat"></textarea>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label"><b>Email</b></label>
                    <input type="email" class="form-control" name="email" placeholder="masukkan email">
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Simpan</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- End Add Modal -->
        <?php
        $no = 1;
        foreach ($data_user as $row) {
        ?>
          <!-- Start Edit Modal -->
          <div class="modal fade" id="exampleModalEdit<?= $row->id_karyawan; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><b>Edit User</b></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="<?= site_url('admin/a_user/updateUser') ?>" method="post">
                    <div class="form-group">
                      <label class="col-form-label"><b>ID Karyawan</b></label>
                      <input type="text" class="form-control" name="id_karyawan" value="<?= $row->id_karyawan; ?>">
                    </div>
                    <div class="form-group">
                      <label class="col-form-label"><b>Nama Karyawan</b></label>
                      <input type="text" class="form-control" name="nama_karyawan" value="<?= $row->nama_karyawan; ?>">
                    </div>
                    <div class="form-group">
                      <label class="col-form-label"><b>Departemen</b></label>
                      <select name="edit_department" class="form-control">
                        <option>-- Pilih Departemen --</option>
                        <?php
                        foreach ($department as $dept) {
                        ?>
                          <option value="<?= $dept->department_id; ?>" <?= $dept->department_id == $row->department_id ? 'selected' : '' ?>><?= $dept->name; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="col-form-label"><b>Tipe Shift</b></label>
                      <select name="edit_shift_type" class="form-control">
                        <option>-- Pilih Shift --</option>
                        <?php
                        foreach ($shift_type as $shift) {
                        ?>
                          <option value="<?= $shift->shift_type_id; ?>" <?= $shift->shift_type_id == $row->shift_type_id ? 'selected' : '' ?>><?= $shift->name; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="col-form-label"><b>Status</b></label>
                      <select name="edit_status" class="form-control">
                        <option>-- Pilih Status --</option>
                        <option value="1" <?= $row->isactive == 'Y' ? 'selected' : '' ?>>Aktif</option>
                        <option value="2" <?= $row->isactive == 'N' ? 'selected' : '' ?>> Non Aktif</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="col-form-label"><b>Jenis Kelamin</b></label>
                      <select class="form-control" name="jenis_kelamin">
                        <option><?= $row->jenis_kelamin; ?></option>
                        <option name="Laki-laki">Laki - laki</option>
                        <option name="Perempuan">Perempuan</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="col-form-label"><b>Alamat</b></label>
                      <textarea class="form-control" name="alamat" required=""><?= $row->alamat; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label class="col-form-label"><b>Email</b></label>
                      <input type="email" class="form-control" name="email" value="<?= $row->email; ?>">
                      <input type="text" class="form-control" name="qr_code" value="<?= $row->qr_code; ?>" hidden>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-success">Simpan</button>
                </div>
                </form>
              </div>
            </div>
          </div>
          <!-- End Edit Modal -->
        <?php
        }
        ?>

        <!-- End of Topbar -->
        <center>
          <div class="text-xs font-weight-bold text-info text-uppercase"><b style="font-size: 25px">
              <center>Data User</center>
            </b></div>
        </center>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="row no-arrow">
            <div class="btn">
              <a href="" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-list"></i> Tambah User</a>
            </div>
          </div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <!-- <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
            </div> -->

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <!-- <th>No.</th> -->
                      <th>Kode QR</th>
                      <th>Nama</th>
                      <th>Departemen</th>
                      <th>Shift</th>
                      <th>Aktif</th>
                      <!-- <th>Jenis Kelamin</th> -->
                      <!-- <th>Alamat</th> -->
                      <!-- <th>Email</th> -->
                      <!-- <th>QR Code</th> -->
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($data_user as $row) {
                    ?>
                      <tr>
                        <!-- <td><?= $no++ ?></td> -->
                        <td class="text-center"><?= $row->id_karyawan; ?></td>
                        <td><?= $row->nama_karyawan; ?></td>
                        <td><?= $row->department; ?></td>
                        <td><?= $row->shift; ?></td>
                        <td class="text-center">
                          <?php
                          if ($row->isactive == 'Y') {
                            $checked = "checked";
                          } else {
                            $checked = "";
                          }
                          ?>
                          <div class='switch custom-control custom-switch'>
                            <input type='checkbox' data-value="<?= $row->id; ?>" class='custom-control-input' id='customSwitch<?= $row->id; ?>' <?= $checked; ?>>
                            <label class='custom-control-label' for='customSwitch<?= $row->id; ?>'></label>
                          </div>
                        </td>
                        <!-- <td><?= $row->jenis_kelamin; ?></td> -->
                        <!-- <td><?= $row->alamat; ?></td> -->
                        <!-- <td><?= $row->email; ?></td> -->
                        <!-- <td>
                          <img style="width: 100px;" src="<?= base_url() . 'assets/qrcode/karyawan/' . $row->qr_code; ?>">
                        </td> -->
                        <td class="text-center">
                          <div class="dropdown">
                            <button class="btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">

                              <a href="<?= base_url('admin/a_user/reGenerateQR/' . $row->id_karyawan); ?>" target="_blank" title="Re-generate QR" class="dropdown-item btn btn-success"><i class="fa fa-qrcode mr-3"></i> QR Code</a>
                              <a href="" class="dropdown-item btn btn-success" data-toggle="modal" data-target="#exampleModalEdit<?= $row->id_karyawan; ?>"><i class="fa fa-user-edit mr-2"></i> Edit</a>
                              <!-- <a href="<?= site_url('auth/deleteUser/' . $row->id_karyawan); ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="dropdown-item btn btn-danger "><i class="fa fa-trash mr-3"></i> Delete</a> -->

                            </div>
                          </div>
                        </td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
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
  <script src="<?= base_url('assets/js/wheelzoom.js') ?>"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url('assets/js/demo/datatables-demo.js') ?>"></script>
  <script type="text/javascript">
    MagicThumbOptions = {
      'expandSpeed': '200',
      'expandEffect': 'fade'
    }
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.form-checkbox').click(function() {
        if ($(this).is(':checked')) {
          $('.password').attr('type', 'text');
        } else {
          $('.password').attr('type', 'password');
        }
      });
    });
  </script>
  <!-- Start ajax Switch -->
  <script>
    $(document).on("change", ".switch", function() {
      let id = $(this).find('input').data('value');
      $.ajax({
        type: "GET",
        cache: false,
        url: "<?php echo base_url('admin/a_user/ajax_switch') ?>",
        data: {
          id: id
        },
        success: function(html) {}
      });
    });
  </script>
  <!-- End ajax switch -->
</body>

</html>