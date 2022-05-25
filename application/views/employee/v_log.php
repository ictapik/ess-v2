<center>
    <div class="text-xs font-weight-bold text-info text-uppercase"><b style="font-size: 25px">
            <center>Data Log</center>
            <?= $this->session->userdata('ses_nama'); ?>
        </b></div><br>
</center>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="">
                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <!-- <th>NIK</th>
                            <th>Nama</th> -->
                            <th>Tanggal</th>
                            <th>Tipe</th>
                            <th>Shift</th>
                            <th>Source</th>
                            <!-- <th>Aktif</th> -->
                        </tr>
                    </thead>
                    <?php
                    foreach ($log as $log) {
                    ?>
                        <tr>
                            <!-- <td><?= $log->nik; ?></td>
                            <td><?= $log->employee_name; ?></td> -->
                            <td><?= $log->timestamp; ?></td>
                            <td class="text-center">
                                <?php
                                $type = $log->inout_type;
                                if ($type == "0001000") {
                                    $type_text = "IN";
                                    $badge = "success";
                                } else {
                                    $type_text = "OUT";
                                    $badge = "danger";
                                }
                                ?>
                                <span class="badge badge-<?= $badge; ?>"><?= $type_text; ?></span>
                            </td>
                            <td><?= $log->shift_type_name; ?></td>
                            <td><?= $log->source; ?></td>
                            <!-- <td><?= $log->isactive; ?></td> -->
                        </tr>
                    <?php
                    }
                    ?>
                    <tfoot>
                        <tr>
                            <!-- <th>NIK</th>
                            <th>Nama</th> -->
                            <th>Tanggal</th>
                            <th>Tipe</th>
                            <th>Shift</th>
                            <th>Source</th>
                            <!-- <th>Aktif</th> -->
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<script type="text/javascript">
    var table;
    $(document).ready(function() {
        table = $('#myTable').DataTable({
            "order": [
                [0, 'desc']
            ],
            dom: 'lBfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
        });
    });
</script>