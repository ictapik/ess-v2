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
    <div class="card card-primary card-outline">
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
            <td><?= $employee->email != '' ? $employee->email : '-'; ?></td>
          </tr>
          <tr>
            <th><i class="fa fa-phone"></th>
            <td><?= $employee->phone != '' ? $employee->phone : '-'; ?></td>
          </tr>
          <tr>
            <th><i class="fa fa-building"></i></th>
            <td><?= $employee->department; ?></td>
          </tr>
          <tr>
            <th><i class="fa fa-calendar-alt"></i></th>
            <td><?= $employee->shift; ?></td>
          </tr>
          <!-- <tr>
            <th><i class="fa fa-map-marker-alt"></i></th>
            <td><?= $employee->alamat; ?></td>
          </tr> -->
        </table>
        <hr>
        <button type="button" class="btn btn-primary btn-block" onclick="showEditModal(<?= $employee->id; ?>);">
          <i class="fa fa-edit"></i> Ubah Data
        </button>
        <button type="button" class="btn btn-primary btn-block" onclick="showChangPWDModal();">
          <i class="fa fa-key"></i> Ganti Password
        </button>

      </div>
      <div class="card-footer">
      </div>
    </div>
  </section>
</div>

<!-- Modal edit data -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="post" id="formEdit">
          <div class=" form-group">
            <label for="exampleInputEmail1">NIK</label>
            <input type="hidden" name="id" class="form-control" id="exampleInputEmail1" readonly>
            <input type="text" name="nik" class="form-control" id="exampleInputEmail1" readonly>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Nama</label>
            <input type="text" name="nama" class="form-control" id="exampleInputEmail1" readonly>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Telpon</label>
            <input type="text" name="phone" class="form-control" id="exampleInputEmail1" required>
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" onclick="processEdit()" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
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
        <button type="button" onclick="changePassword()" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>

<script>
  function showChangPWDModal() {
    $('#changePasswordModal').modal('show');

    $('[name="old_password"]').val('');
    $('[name="new_password"]').val('');
    $('[name="new_password2"]').val('')

    $('[name="old_password"]').removeClass('is-invalid');
    $('[name="new_password"]').removeClass('is-invalid');
    $('[name="new_password2"]').removeClass('is-invalid')
  }

  function changePassword() {
    $('#spinner').addClass('is-active');

    // Validasi
    let oldPassword = $('[name="old_password"]').val();
    let newPassword = $('[name="new_password"]').val();
    let newPassword2 = $('[name="new_password2"]').val();

    if (oldPassword == "" || newPassword == "" || newPassword2 == "") {
      oldPassword == "" ? $('[name="old_password"]').addClass('is-invalid') : "";
      newPassword == "" ? $('[name="new_password"]').addClass('is-invalid') : "";
      newPassword2 == "" ? $('[name="new_password2"]').addClass('is-invalid') : "";
      $('#spinner').removeClass('is-active');
      Swal.fire({
        title: 'Gagal',
        text: 'Semua data wajib diisi.',
        icon: 'error',
        timer: 2500
      });
    } else {
      if (newPassword !== newPassword2) {
        $('[name="old_password"]').removeClass('is-invalid');
        newPassword == "" ? $('[name="new_password"]').addClass('is-invalid') : "";
        newPassword2 == "" ? $('[name="new_password2"]').addClass('is-invalid') : "";
        $('#spinner').removeClass('is-active');
        Swal.fire({
          title: 'Gagal',
          text: 'Password baru tidak cocok.',
          icon: 'error',
          timer: 2500
        });
      } else {
        $.ajax({
          url: "<?= base_url(); ?>employee/changePassword",
          type: "post",
          data: $('#form_change_password').serialize(),
          dataType: "JSON",
          success: function(data) {
            if (data.status === false) {
              $('[name="old_password"]').val('');
              $('[name="old_password"]').addClass('is-invalid');

              Swal.fire({
                title: 'Gagal',
                text: 'Password lama salah.',
                icon: 'error',
                timer: 2500
              });
            } else {
              $('#changePasswordModal').modal('hide');
              Swal.fire({
                title: 'Sukses',
                text: 'Password berhasil diubah.',
                icon: 'success',
                timer: 2500
              });
            }
            $('#spinner').removeClass('is-active');
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Error adding / update data');
            $('#spinner').removeClass('is-active');
          }
        });
      }
    }
  }

  function showEditModal(id) {
    $('[name="email"]').removeClass('is-invalid')
    $('[name="phone"]').removeClass('is-invalid')

    $('#editModal').modal('show');
    $.ajax({
      url: "<?php echo site_url('employee/getUserByID'); ?>/" + id,
      type: "post",
      dataType: "json",
      success: function(data) {
        $('[name="id"]').val(data.id);
        $('[name="nik"]').val(data.id_karyawan);
        $('[name="nama"]').val(data.nama_karyawan);
        $('[name="email"]').val(data.email);
        $('[name="phone"]').val(data.phone);

      },
    });
  }

  function processEdit() {
    $('#spinner').addClass('is-active');

    let email = $('[name="email"]').val();
    let phone = $('[name="phone"]').val();

    if (email == '' || phone == '') {
      email == '' ? $('[name="email"]').addClass('is-invalid') : '';
      phone == '' ? $('[name="phone"]').addClass('is-invalid') : '';
      $('#spinner').removeClass('is-active');
      Swal.fire({
        title: 'Gagal',
        text: 'Semua data wajib diisi.',
        icon: 'error',
        timer: 2500
      });
    } else {
      $.ajax({
        url: "<?= base_url(); ?>employee/processEdit",
        type: "post",
        data: $('#formEdit').serialize(),
        dataType: "JSON",
        success: function(data) {
          console.log(data);
          $('#changePasswordModal').modal('hide');
          Swal.fire({
            title: 'Sukses',
            text: 'Data berhasil diubah.',
            icon: 'success',
            timer: 2500
          });
          setTimeout(location.reload(), 2500);
          // }
          $('#spinner').removeClass('is-active');
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error adding / update data');
          $('#spinner').removeClass('is-active');
        }
      });
    }
  }
</script>