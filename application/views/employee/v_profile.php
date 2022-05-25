<center>
    <div class="text-xs font-weight-bold text-info text-uppercase"><b style="font-size: 25px">
            <center>Data Karyawan</center>
        </b></div><br>
</center>
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-md">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <?= $this->session->userdata('ses_nama'); ?>
                    </h6>
                </div>
                <div class="card-body">

                    <center>
                        <img src="<?= base_url(); ?>assets/qrcode/karyawan/1631745.png" width="125px"></img>
                    </center>
                    <table>
                        <tr>
                            <th>NIK</th>
                            <td>: <?= $employee->id_karyawan; ?></td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>: <?= $employee->nama_karyawan; ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>: <?= $employee->jenis_kelamin; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: <?= $employee->email; ?></td>
                        </tr>
                        <tr>
                            <th>Department</th>
                            <td>: <?= $employee->department; ?></td>
                        </tr>
                        <tr>
                            <th>Shift</th>
                            <td>: <?= $employee->shift; ?></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>: <?= $employee->alamat; ?></td>
                        </tr>
                    </table>
                    <hr>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changePasswordModal">
                        Ganti Password
                    </button>

                </div>
            </div>

        </div>
    </div>

</div>

<!-- Modal -->
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

        // console.log("ubah password");
        // let form = $("#form_change_password").serialize();
        // console.log(form);

        $.ajax({
            url: "<?= base_url(); ?>employee/changePassword",
            type: "post",
            data: $('#form_change_password').serialize(),
            dataType: "JSON",
            success: function(data) {
                $('#changePasswordModal').modal('hide');
                $('#spinner').removeClass('is-active');
                // console.log(data);
                // reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#spinner').removeClass('is-active');
            }
        });
    }
</script>