<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0">Pengajuan Kehadiran</h5>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <section class="content">
    <!-- Default box -->
    <div class="card card-primary card-outline">
      <div class="card-body table-responsive p-2">

        <table class="table table-bordered table-hover responsive nowrap" id="myTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th data-priority="1">Start</th>
              <th data-priority="2">End</th>
              <th>Jumlah</th>
              <th data-priority="3">Status</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Start</th>
              <th>End</th>
              <th>Jumlah</th>
              <th>Status</th>
            </tr>
          </tfoot>
        </table>

        <span class="badge badge-secondary"><i class="fa fa-clock"></i></span> = Menunggu<br>
        <span class="badge badge-primary"><i class="fa fa-check"></i></span> = Disetujui<br>
        <span class="badge badge-success"><i class="fa fa-check-double"></i></span> = Disahkan<br>
        <span class="badge badge-danger"><i class="fa fa-times-circle"></i></span> = Ditolak<br>

      </div>
      <div class="card-footer">
      </div>
    </div>
  </section>
</div>

<script type="text/javascript">
  let table;

  $(document).ready(function() {
    table = $('#myTable').DataTable({
      orderCellsTop: true,
      "processing": true,
      "serverSide": true,
      "ajax": "<?= base_url('employee/dataHistoryLeave'); ?>", //1 = approve, 2 = reject
      dom: 'lBfrtip',
      pagingType: 'simple',
      language: {
        search: "",
        searchPlaceholder: "Search..."
      },
      buttons: [{
        extend: 'copyHtml5',
        text: '<i class="fa fa-copy"></i>',
        titleAttr: 'Copy'
      }, {
        extend: 'csvHtml5',
        text: '<i class="fa fa-file-csv"></i>',
        titleAttr: 'CSV'
      }, {
        extend: 'excelHtml5',
        text: '<i class="fa fa-file-excel"></i>',
        titleAttr: 'Excel'
      }, {
        extend: 'pdfHtml5',
        text: '<i class="fa fa-file-pdf"></i>',
        titleAttr: 'PDF'
      }, {
        extend: 'print',
        text: '<i class="fa fa-print"></i>',
        titleAttr: 'Print'
      }, ],
      "order": [
        [0, "desc"],
      ],
      "columns": [{
        "data": "start_date",
        className: "dt-center"
      }, {
        "data": "end_date",
        className: "dt-center"
      }, {
        "data": "amount_leave",
        className: "dt-center"
      }, {
        "data": "status",
        className: "dt-center",
        "render": function(data, type, row) {
          if (data == 1) {
            return "<span class='badge badge-secondary'><i class='fa fa-clock'></i></span>"
          } else if (data == 2) {
            return "<span class='badge badge-primary'><i class='fa fa-check'></i></span>"
          } else if (data == 3) {
            return "<span class='badge badge-success'><i class='fa fa-check-double'></i></span>"
          } else {
            return "<span class='badge badge-danger'><i class='fa fa-times-circle'></i></span>"
          }
        }
      }],
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