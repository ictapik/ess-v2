<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0">Data Kehadiran</h5>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <section class="content">
    <!-- Default box -->
    <div class="card card-primary card-outline">
      <div class="card-body p-2">

        <table class="table table-bordered table-hover responsive nowrap" id="myTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center" data-priority="1">Tanggal</th>
              <th class="text-center">Cal</th>
              <th class="text-center">Absen</th>
              <th class="text-center" data-priority="2">Masuk</th>
              <th class="text-center" data-priority="3">Keluar</th>
              <th class="text-center">Shift</th>
            </tr>
          </thead>
          <!-- <tfoot>
            <tr>
              <th class="text-center">Tanggal</th>
              <th class="text-center">Cl</th>
              <th class="text-center">Absen</th>
              <th class="text-center">Masuk</th>
              <th class="text-center">Keluar</th>
              <th class="text-center">Shift</th>
            </tr>
          </tfoot> -->
        </table>

      </div>
      <div class="card-footer">
      </div>
    </div>
    <!-- /.card -->
  </section>
</div>

<!-- modal add time -->
<div class="modal fade" id="modal_addtime" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Time <span id="typeTitle"></span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
      </div>

      <div class="modal-body form">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link font-weight-bold active" id="log-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Log</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link font-weight-bold" id="manual-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Manual</a>
          </li>
        </ul>

        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div id="response" class="mt-2"></div>
          </div>

          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div id="manualPropose" style="display: none;">
              <form action="" id="form" class="form-horizontal">
                <div class="form-body">
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
              <button type="button" id="btnSaveTimePropose" onclick="saveTimePropose()" class="btn btn-primary btn-block" style="display:none">Ajukan</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
  let table;

  $(document).ready(function() {
    table = $('#myTable').DataTable({
      orderCellsTop: true,
      "processing": true,
      "serverSide": true,
      "ajax": "<?= base_url('/employee/showAttendance'); ?>",
      dom: 'lBfrtip',
      pagingType: 'simple',
      language: {
        search: "",
        searchPlaceholder: "Search...",
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
        "data": "tanggal",
        className: "dt-center",
        "render": function(data, type, row) {
          let tgl = new Date(row.tanggal);
          let color;
          if (tgl.getDay() == 6) { //saturday
            color = '#0069d9';
          } else if (tgl.getDay() == 0) { //sunday
            color = '#dc3545';
          } else { //weekday
            color = '#28a745';
          }
          return "<span style='color:" + color + "'>" + data + "</span>";
        }
      }, {
        "data": "calendar",
        className: "dt-center",
      }, {
        "data": "absent",
        className: "dt-center",
        "render": function(data, type, row) {
          if (data == null) {
            return "-";
          } else {
            return data;
          }
        }
      }, {
        "data": "time_in",
        className: "dt-center",
        "render": function(data, type, row) {
          if (row.time_in == "00:00:00") {
            if (row.time_in_m == "") {
              return "<span onclick='showAddTime2(" + row.attendance_id + ", 1, \"" + row.tanggal + "\")'>--:--:--</span>";
            } else {
              return "<span class='bg-warning text-white'>" + row.time_in_m + "</span>";
            }
          } else {
            return row.time_in;
          }
        }
      }, {
        "data": "time_out",
        className: "dt-center",
        "render": function(data, type, row) {
          if (row.time_out == "00:00:00") {
            if (row.time_out_m == "") {
              return "<span onclick='showAddTime2(" + row.attendance_id + ", 2, \"" + row.tanggal + "\")'>--:--:--</span>";
            } else {
              return "<span class='bg-warning text-white'>" + row.time_out_m + "</span>";
            }
          } else {
            return row.time_out;
          }
        }
      }, {
        "data": "shift_name",
        "render": function(data, type, row) {
          if (data == null) {
            return "-";
          } else {
            return data;
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
    });
  });

  function showAddTime2(id, type, dateAtt) {
    if (type == 1) {
      $("#typeTitle").html("In");
    } else {
      $("#typeTitle").html("Out");
    }

    $.ajax({
      url: "<?= base_url(); ?>employee/searchLog",
      type: "post",
      data: {
        'id': id,
        'type': type,
        'dateAtt': dateAtt
      },
      dataType: "JSON",
      success: function(data) {
        $('#modal_addtime').modal('show'); //tampilkan modal

        if (data.status == true) {
          $('#response').html(data.response);
        } else {
          $('#response').html('');
        }

        $("#iodate").val('');
        $('#new_time').val('');
        $("#new_description").val('');

        $("#new_time").removeClass("is-invalid");
        $("#new_description").removeClass("is-invalid");

        $("#add_type").remove(); //jika sudah ada maka hapus terlebih dahulu
        $("#divrow").remove(); //jika sudah ada maka hapus terlebih dahulu
        $("#hari").remove(); //jika sudah ada maka hapus terlebih dahulu
        $("#iodate").remove(); //jika sudah ada maka hapus terlebih dahulu
        $("#add_shift").remove(); //jika sudah ada maka hapus terlebih dahulu
        $("#attendance_id").remove(); //jika sudah ada maka hapus terlebih dahulu

        $('#manualPropose').show();
        $('#btnSaveTimePropose').show();

        let nik = "<?= $this->session->userdata('ses_nik'); ?>";

        $.ajax({
          url: "<?php echo site_url('employee/getShiftByNIK/'); ?>/" + nik,
          type: "post",
          data: {
            "nik": nik
          },
          dataType: "json",
          success: function(data) {
            var html = '';
            for (var i = 0; i <= data.length - 1; i++) {
              html += '<option value=' + data[i].shift_id + '>' + data[i].name + '</option>';
            }
            $("#new_shift").html(html);
          }
        });

        $("#form").prepend('<input type="hidden" class="form-control" value="' + id + '" name="attendance_id" id="attendance_id" readonly><input type="hidden" class="form-control" value="' + type + '" name="add_type" id="add_type" readonly><div class="row pt-3 pb-3" id="divrow"><div class="col"><input name="iodate" value="' + hari(new Date(dateAtt).getDay()) + '"id="hari" class="form-control" id="iodate" type="text" readonly></div><div class="col"><input name="iodate" value="' + dateAtt + '"id="iodate" class="form-control" id="iodate" type="text" readonly></div></div>');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error adding / update data');
        $('#spinner').removeClass('is-active');
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

  function saveTimePropose() {
    let form = $("#form").serialize();
    console.log(form);

    //validasi input
    let new_time = $('#new_time').val();
    let new_description = $('#new_description').val();
    if (new_time == '' || new_description == '') {
      new_time == '' ? $("#new_time").addClass("is-invalid") : $("#new_time").removeClass("is-invalid");
      new_description == '' ? $("#new_description").addClass("is-invalid") : $("#new_description").removeClass("is-invalid");

      Swal.fire({
        title: 'Gagal',
        text: 'Semua data wajib diisi.',
        icon: 'error',
        timer: 2500
      });
      $('#spinner').removeClass('is-active');
    } else {
      $.ajax({
        url: "<?= base_url(); ?>employee/saveAttendance",
        type: "post",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data) {
          $('#modal_addtime').modal('hide');
          $('#spinner').removeClass('is-active');
          Swal.fire({
            title: 'Sukses',
            text: 'Pengajuan kehadiran berhasil.',
            icon: 'success',
            timer: 2500
          });
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error adding / update data');
          $('#spinner').removeClass('is-active');
        }
      });
    }
  }

  function selectAtt2(id, attendance_id, type) {
    let selectShift = $("#selectShift").val();

    if (selectShift == 0) {
      Swal.fire({
        title: 'Gagal',
        text: 'Silahkan pilih shift terlebih dahulu.',
        icon: 'error',
        timer: 2500
      });
      $("#selectShift").addClass("is-invalid");
    } else {
      Swal.fire({
        title: 'Pilih',
        text: "Yakin memilih tanggal tersebut?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "<?= base_url(); ?>employee/selectAtt",
            type: "post",
            data: {
              "id": id,
              "attendance_id": attendance_id,
              "type": type,
              "shift": selectShift,
            },
            dataType: "JSON",
            success: function(data) {
              $('#modal_addtime').modal('hide'); //sembunyikan modal
              Swal.fire({
                title: 'Sukses',
                text: 'Pengajuan kehadiran berhasil.',
                icon: 'success',
                timer: 2500
              });
              reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
              alert('Error adding / update data');
              $('#spinner').removeClass('is-active');
            }
          });
        }
      });
    }
  }

  function reload() {
    table.ajax.reload(null, false);
  }
</script>