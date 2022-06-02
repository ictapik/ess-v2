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
                <span onclick="changeType(<?= $log->id; ?>,'<?= $log->inout_type; ?>')" class="badge badge-<?= $badge; ?>"><?= $type_text; ?></span>
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
    });
  });

  function changeType(log_id, type) {
    Swal.fire({
      title: 'Ubah Tipe',
      text: "Yakin akan mengubah?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Tidak'
    }).then((result) => {
      if (result.value) {
        $('#spinner').addClass('is-active');

        if (type == '0001000') {
          ch_type = '0002000';
        } else {
          ch_type = '0001000';
        }

        $.ajax({
          url: "<?= base_url(); ?>employee/changeType",
          type: "post",
          data: {
            log_id: log_id,
            type: ch_type
          },
          dataType: "JSON",
          success: function(data) {
            console.log(data);
            Swal.fire({
              title: 'Sukses',
              text: 'Tipe berhasil diubah.',
              icon: 'success',
              timer: 2500
            });
            setTimeout(location.reload(), 3000);
            $('#spinner').removeClass('is-active');
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Error adding / update data');
            $('#spinner').removeClass('is-active');
          }
        });
      }
    });
  }
</script>