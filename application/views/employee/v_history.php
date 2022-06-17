<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0">Pengajuan Kehadiran</h5>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <section class="content">
    <div class="card card-primary card-outline">
      <div class="card-body table-responsive p-2">

        <table class="table table-bordered table-hover responsive nowrap" id="myTable" width="100%" cellspacing="0">
          <thead>
            <tr>
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
              <th>Tanggal</th>
              <th>Jam</th>
              <th>Tipe</th>
              <th>Keterangan</th>
              <th>Shift</th>
              <th>Status</th>
            </tr>
          </tfoot>
        </table>

        <span class="badge badge-secondary"><i class="fa fa-clock"></i></span> = Menunggu<br>
        <span class="badge badge-success"><i class="fa fa-check"></i></span> = Disetujui<br>
        <span class="badge badge-danger"><i class="fa fa-times-circle"></i></span> = Ditolak<br>

      </div>
      <div class="card-footer">
      </div>
    </div>
  </section>
</div>

<!-- modal edit history -->
<div class="modal fade" id="modal_addtime" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Time <span id="typeTitle"></span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
      </div>

      <div class="modal-body form">
        <form action="" id="formEdit" class="form-horizontal">
          <div class="form-body">
            <div class="form-group row">
              <div class="col-md-12">
                <input type="hidden" name="attendance_manual_id" id="attendance_manual_id">
                <input name="" class="form-control" id="day" type="text" readonly>
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-12">
                <input name="" class="form-control" id="date" type="text" readonly>
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-12">
                <input name="new_time" class="form-control" id="new_time" type="time">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-12">
                <textarea name="new_description" id="new_description" class="form-control" placeholder="Keterangan"></textarea>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-12">
                <select name="new_shift" id="new_shift" class="form-control">
                </select>
                <span class="help-block"></span>
              </div>
            </div>
          </div>
        </form>
        <button type="button" id="btnSaveTimePropose" onclick="saveEdit()" class="btn btn-primary btn-block">Simpan</button>
      </div>

      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  let table;

  $(document).ready(function() {
    table = $('#myTable').DataTable({
      orderCellsTop: true,
      "processing": true,
      "serverSide": true,
      "ajax": "<?= base_url('employee/dataHistory'); ?>", //1 = approve, 2 = reject
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
        "data": "iodate",
        className: "dt-center"
      }, {
        "data": "time",
        className: "dt-center"
      }, {
        "data": "type",
        className: "dt-center"
      }, {
        "data": "description",
      }, {
        "data": "shift",
      }, {
        "data": "status",
        className: "dt-center",
        "render": function(data, type, row) {
          if (data == 1) {
            return "<span class='badge badge-success'><i class='fa fa-check'></i></span>";
          } else if (data == 2) {
            return "<span class='badge badge-danger'><i class='fa fa-times-circle'></i></span>";
          } else {
            let topDropdown = '<div class="dropdown"><button class="btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="badge badge-secondary"><i class="fa fa-clock"></i></span></button><div class="dropdown-menu dropdown-menu-right">';
            let menuDropdown = '<a href="#" class="dropdown-item btn btn-success" onclick="editManual(' + row.attendance_manual_id + ')"><i class="fa fa-edit mr-2"></i> Edit</a><a href="#" class="dropdown-item btn btn-success" onclick="cancelManual(' + row.attendance_manual_id + ')"><i class="fa fa-times-circle mr-2"></i> Batal</a>';
            let bottomDropdown = '</div></div>';
            return topDropdown + menuDropdown + bottomDropdown;
          }
        }
      }, ],
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

  function reload() {
    table.ajax.reload(null, false);
  }

  function editManual(id) {

    $.ajax({
      url: "<?= base_url(); ?>employee/getHistoryByID",
      type: "post",
      data: {
        'id': id
      },
      dataType: "JSON",
      success: function(data) {
        let shift_id = data.shift_id;
        $("#modal_addtime").modal('show');
        $("#attendance_manual_id").val(data.attendance_manual_id);
        $("#day").val(hari(new Date(data.iodate).getDay()));
        $("#date").val(data.iodate);
        $("#new_time").val(data.time);
        $("#new_description").val(data.description);

        let nik = "<?= $this->session->userdata('ses_nik'); ?>";

        $.ajax({
          url: "<?php echo site_url('employee/getShiftByNIK/'); ?>/" + nik,
          type: "get",
          dataType: "json",
          success: function(data) {
            var html = '';
            for (var i = 0; i <= data.length - 1; i++) {
              if (data[i].shift_id == shift_id) {
                selected = 'selected';
              } else {
                selected = '';
              }
              html += '<option value="' + data[i].shift_id + '"' + selected + '>' + data[i].name + '</option>';
            }
            $("#new_shift").html(html);
          }
        });

      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error adding / update data');
        $('#spinner').removeClass('is-active');
      }
    });
  }

  function saveEdit() {
    $.ajax({
      url: "<?= base_url(); ?>employee/editManual",
      type: "post",
      data: $('#formEdit').serialize(),
      dataType: "JSON",
      success: function(data) {
        console.log(data);
        Swal.fire({
          title: 'Sukses',
          text: 'Pembatalan pengajuan kehadiran berhasil.',
          icon: 'success',
          timer: 2500
        });
        $("#modal_addtime").modal('hide');
        reload();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error adding / update data');
      }
    });
  }

  function cancelManual(id) {
    Swal.fire({
      title: 'Pilih',
      text: "Yakin akan membatalkan pengajuan?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Tidak'
    }).then((result) => {
      if (result.value) {
        console.log('cancel');
        console.log(id);

        $.ajax({
          url: "<?= base_url(); ?>employee/cancelManual",
          type: "post",
          data: {
            "id": id,
          },
          dataType: "JSON",
          success: function(data) {
            Swal.fire({
              title: 'Sukses',
              text: 'Pembatalan pengajuan kehadiran berhasil.',
              icon: 'success',
              timer: 2500
            });
            reload();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Error adding / update data');
          }
        });

      }
    });
  }

  function hari(hari) {
    switch (hari) {
      case 0:
        hari = "Minggu";
        break;
      case 1:
        hari = "Senin";
        break;
      case 2:
        hari = "Selasa";
        break;
      case 3:
        hari = "Rabu";
        break;
      case 4:
        hari = "Kamis";
        break;
      case 5:
        hari = "Jum'at";
        break;
      case 6:
        hari = "Sabtu";
        break;
    }
    return hari;
  }
</script>