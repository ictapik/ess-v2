<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0">Profil</h5>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-body">

        <center>
          <a href="<?= base_url(); ?>assets/qrcode/karyawan/1631745.png" target="_blank">
            <img src="<?= base_url(); ?>assets/qrcode/karyawan/1631745.png" width="100px"></img>
          </a>
        </center>
        <br>
        <table class="table" style="font-size: 14px;">
          <tr>
            <th><i class="fa fa-qrcode"></i></th>
            <td><?= $employee->id_karyawan; ?></td>
          </tr>
          <tr>
            <th><i class="fa fa-user"></th>
            <td><?= $employee->nama_karyawan; ?></td>
          </tr>
          <tr>
            <th><i class="fa fa-venus-mars"></i></th>
            <td><?= $employee->jenis_kelamin; ?></td>
          </tr>
          <tr>
            <th><i class="fa fa-at"></th>
            <td><?= $employee->email; ?></td>
          </tr>
          <tr>
            <th><i class="fa fa-building"></i></th>
            <td><?= $employee->department; ?></td>
          </tr>
          <tr>
            <th><i class="fa fa-calendar-alt"></i></th>
            <td><?= $employee->shift; ?></td>
          </tr>
          <tr>
            <th><i class="fa fa-map-marker-alt"></i></th>
            <td><?= $employee->alamat; ?></td>
          </tr>
        </table>
        <hr>
        <button type="button" class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#changePasswordModal">
          <i class="fa fa-key"></i> Ganti Password
        </button>

      </div>
    </div>
  </section>
</div>

<!-- Modal ganti password -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="form_change_password">
          <div class="form-group">
            <label for="exampleInputEmail1">Password Lama</label>
            <input type="password" name="old_password" class="form-control" id="exampleInputEmail1" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password Baru</label>
            <input type="password" name="new_password" class="form-control" id="exampleInputPassword1" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Ulangi Password Baru</label>
            <input type="password" name="new_password2" class="form-control" id="exampleInputPassword1" required>
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" onclick="changePassword()" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>

<script>
  function changePassword() {
    $('#spinner').addClass('is-active');

    $.ajax({
      url: "<?= base_url(); ?>employee/changePassword",
      type: "post",
      data: $('#form_change_password').serialize(),
      dataType: "JSON",
      success: function(data) {
        $('#changePasswordModal').modal('hide');
        $('#spinner').removeClass('is-active');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error adding / update data');
        $('#spinner').removeClass('is-active');
      }
    });
  }
</script>