<!-- Spinner Loding -->
<div id="spinner" class="loader loader-default" data-text="LOADING"></div>

<center>
    <div class="text-xs font-weight-bold text-info text-uppercase">
        <b style="font-size: 25px">
            <center>Gagal Absen</center>
        </b>
    </div><br>
</center>

<div class="container-fluid">
    <div class="card shadow mb-4">

        <div class="card-body">

            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modalFailedToAttend">
                <i class="fa fa-plus"></i> Gagal Absen
            </a>

            <hr>

            <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class='text-center'>Tanggal</th>
                        <th class='text-center'>Jam</th>
                        <th>Keterangan</th>
                        <th class='text-center'>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($failedattend as $fa) {
                    ?>
                        <tr>
                            <td class='text-center'><?= $fa->tanggal; ?></td>
                            <td class='text-center'><?= $fa->jam; ?></td>
                            <td><?= $fa->keterangan; ?></td>
                            <td class='text-center'><?= $fa->status; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalFailedToAttend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Gagal Absen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formFailedToAttend">
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Tanggal</label>
                        <div class="col-sm-9">
                            <input type="date" name="tanggal" class="form-control" id="inputPassword" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Jam</label>
                        <div class="col-sm-9">
                            <input type="time" name="jam" class="form-control" id="inputPassword" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <textarea name="keterangan" class="form-control" id="inputPassword"></textarea>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="addFailedToAttend()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    function addFailedToAttend() {
        let form = $("#formFailedToAttend").serialize();
        console.log('simpan');
        console.log(form);

        $('#spinner').addClass('is-active');

        $.ajax({
            url: "<?= base_url(); ?>employee/saveFailedToAttend",
            type: "post",
            data: $('#formFailedToAttend').serialize(),
            dataType: "JSON",
            success: function(data) {
                $('#modalFailedToAttend').modal('hide');
                $('#spinner').removeClass('is-active');
                console.log(data);
                reload();
                $('#formFailedToAttend').trigger("reset");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#spinner').removeClass('is-active');
            }
        });

    }
</script>