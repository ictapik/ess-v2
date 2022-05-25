<center>
    <div class="text-xs font-weight-bold text-info text-uppercase"><b style="font-size: 25px">
            <center>Data Log</center>
        </b></div><br>
</center>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- <div class="row no-arrow">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

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
                            <th class="text-center"><span class=" fa fa-cogs"></span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        echo $attendance_id;
                        foreach ($absen as $row) {
                        ?>
                            <tr>
                                <td><?= $row['nik']; ?></td>
                                <td><?= $row['employee_name']; ?></td>
                                <td><?= $row['timestamp']; ?></td>
                                <td class="text-center" id="typeInOut">
                                    <?= $row['inout_type'] == "0001000" ? "<span class='badge badge-success' >IN</span>" : "<span class='badge badge-danger'>OUT</span>"; ?>
                                </td>
                                <td><?= $row['shift_type_name']; ?></td>
                                <td class="text-center"><?= $row['source']; ?></td>
                                <td class="text-center">
                                    <button type="button" onclick="selectAtt(<?= $row['id'] . ',' . $attendance_id . ',' .  $type; ?>)" class="btn btn-sm btn-primary">Pilih</button>
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
                    // $("#typeInOut").html("<span class='badge badge-success'>IN</span>");
                    location.reload();
                }
            });
        }
    }

    function selectAtt(id, attendance_id, type) {

        console.log(id);
        console.log(attendance_id);
        console.log(type);

        if (confirm('Yakin memilih tanggal tersebut?') == true) {
            $.ajax({
                url: "<?= base_url(); ?>employee/selectAtt",
                type: "post",
                data: {
                    "id": id,
                    "attendance_id": attendance_id,
                    "type": type,
                },
                dataType: "JSON",
                success: function(data) {
                    console.log(data);
                    // $('#spinner').removeClass('is-active');
                    // $('#modalAddAbsent').modal('hide');
                    // console.log(data);
                    // reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#spinner').removeClass('is-active');
                }
            });
        }
    }
</script>