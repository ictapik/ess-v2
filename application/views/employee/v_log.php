<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0">Data Log</h5>
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
              <th class="text-center">Tanggal</th>
              <th class="text-center">Tipe</th>
              <th>Shift</th>
              <th class="text-center">Source</th>
            </tr>
          </thead>
          <?php
          foreach ($log as $log) {
          ?>
            <tr>
              <td class="text-center"><?= $log->timestamp; ?></td>
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
              <td class="text-center"><?= $log->source; ?></td>
            </tr>
          <?php
          }
          ?>
          <tfoot>
            <tr>
              <th class="text-center">Tanggal</th>
              <th>Tipe</th>
              <th>Shift</th>
              <th>Source</th>
            </tr>
          </tfoot>
        </table>

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
      "order": [
        [0, 'desc']
      ],
      dom: 'lBfrtip',
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
    });
  });
</script>