<center>
    <div class="text-xs font-weight-bold text-info text-uppercase"><b style="font-size: 25px">
            <center>Pengajuan Kehadiran</center>
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
                            <!-- <th>NIK</th>
                            <th>Nama</th> -->
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Tipe</th>
                            <th>Keterangan</th>
                            <th>Shift</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <!-- <th>NIK</th>
                            <th>Nama</th> -->
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Tipe</th>
                            <th>Keterangan</th>
                            <th>Shift</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var table;
    $(document).ready(function() {
        table = $('#myTable').DataTable({
            orderCellsTop: true,
            "processing": true,
            "serverSide": true,
            "ajax": "<?= base_url('employee/dataHistory'); ?>", //1 = approve, 2 = reject
            dom: 'lBfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "order": [
                [1, "asc"],
            ],
            "columns": [
                // {
                //     "data": "nik",
                //     className: "dt-center"
                // }, 
                // {
                //     "data": "nama_karyawan",
                // },
                {
                    "data": "iodate",
                    className: "dt-center"
                }, {
                    "data": "time",
                    className: "dt-center"
                }, {
                    "data": "description",
                }, {
                    "data": "shift",
                }, {
                    "data": "shift",
                }, {
                    "data": "status",
                    className: "dt-center",
                    "render": function(data, type, row) {
                        if (data = 1) {
                            return "<span class='badge badge-success'>Diterima</span>";
                        } else {
                            return "<span class='badge badge-warning'>Ditolak</span>";
                        }
                    }
                },
            ],
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
    });
</script>