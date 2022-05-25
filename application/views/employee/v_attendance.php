 <!-- Spinner Loding -->
 <div id="spinner" class="loader loader-default" data-text="LOADING"></div>

 <center>
     <div class="text-xs font-weight-bold text-info text-uppercase"><b style="font-size: 25px">
             <center>Data Absen</center>
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
                             <!-- <th class="text-center">NIK</th> -->
                             <!-- <th>Nama</th> -->
                             <!-- <th>Department</th> -->
                             <th class="text-center">Tanggal</th>
                             <th class="text-center">Masuk</th>
                             <th class="text-center">Keluar</th>
                             <th class="text-center">Shift</th>
                         </tr>
                     </thead>

                     <tfoot>
                         <tr>
                             <!-- <th class="text-center">NIK</th> -->
                             <!-- <th>Nama</th> -->
                             <!-- <th>Department</th> -->
                             <th class="text-center">Tanggal</th>
                             <th class="text-center">Masuk</th>
                             <th class="text-center">Keluar</th>
                             <th class="text-center">Shift</th>
                         </tr>
                     </tfoot>
                 </table>
             </div>
         </div>
     </div>
 </div>
 <!-- /.container-fluid -->

 <!-- modal add time -->
 <div class="modal fade" id="modal_addtime" role="dialog">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Add Time <span id="typeTitle"></span></h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
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
                         </div>
                     </div>
                 </div>
             </div>

             <div class="modal-footer">
                 <button type="button" id="btnSaveTimePropose" onclick="saveTimePropose()" class="btn btn-info" style="display:none">Ajukan</button>
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
             </div>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>
 <!-- /.modal -->

 <script type="text/javascript">
     var table;

     $(document).ready(function() {
         table = $('#myTable').DataTable({
             orderCellsTop: true,
             "processing": true,
             "serverSide": true,
             "ajax": "<?= base_url('/employee/showAttendance'); ?>",
             dom: 'lBfrtip',
             buttons: [
                 'copy', 'csv', 'excel', 'pdf', 'print'
             ],
             "order": [
                 [3, "desc"],
                 [1, "asc"],
             ],
             "columns": [
                 //      {
                 //      "data": "nik",
                 //      className: "dt-center"
                 //  }, 
                 //  {
                 //      "data": "nama_karyawan",
                 //      className: "dt-center"
                 //  }, 
                 //  {
                 //      "data": "department",
                 //      className: "dt-center"
                 //  }, 
                 {
                     "data": "tanggal",
                     className: "dt-center",
                     "render": function(data, type, row) {
                         let tgl = new Date(row.tanggal);
                         let color;
                         if (tgl.getDay() == 6) { //saturday
                             color = 'blue';
                         } else if (tgl.getDay() == 0) { //sunday
                             color = 'red';
                         } else { //weekday
                             color = '';
                         }
                         return "<span style='color:" + color + "'>" + data + "</span>";
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
                     className: "dt-center"
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
         });

         $("#btnSearchLog").click(function() {
             $("#formSearchLog").toggle();
             $("#btnSaveTimeLog").toggle();

             $("#formAddTime").hide();
             $("#btnSaveTimePropose").hide();
         });

         $("#btnAddPropose").click(function() {
             $("#formAddTime").toggle();
             $("#btnSaveTimePropose").toggle();

             $("#formSearchLog").hide();
             $("#btnSaveTimeLog").hide();
         });
     });

     function showAddTime(id, type, dateAtt) {
         $("#iodate").val('');
         $('#new_time').val('');
         $("#new_description").val('');

         console.log('id : ' + id);
         console.log('tipe : ' + type);
         console.log(dateAtt);

         if (type == 1) {
             $("#typeTitle").html("IN");
             console.log("IN");
         } else {
             $("#typeTitle").html("OUT");
             console.log("OUT");
         }

         let nik = "<?= $this->session->userdata('ses_nik'); ?>"

         $("#add_type").remove(); //jika sudah ada maka hapus terlebih dahulu
         $("#iodate").remove(); //jika sudah ada maka hapus terlebih dahulu
         $("#add_shift").remove(); //jika sudah ada maka hapus terlebih dahulu
         $("#attendance_id").remove(); //jika sudah ada maka hapus terlebih dahulu

         $("#showBtnLog").html('<a href="find/' + nik + '/' + dateAtt + '/' + id + '/' + type + '/" target="_blank" id="btnSearchLog" class="btn btn-primary btn-block mb-2">Cari Log</a>');

         $("#form").prepend('<p><input type="hidden" class="form-control" value="' + id + '" name="attendance_id" id="attendance_id" readonly></p><p><input type="hidden" class="form-control" value="' + type + '" name="add_type" id="add_type" readonly></p><p><input name="iodate" value="' + dateAtt + '"id="iodate" class="form-control" id="iodate" type="text" readonly></p>');

         $('#modal_form').modal('show'); // show bootstrap modal
     }

     function saveTimePropose() {
         // alert("Mohon maaf, fitur ini masih dalam proses pengembangan.");
         let form = $("#form").serialize();
         //  console.log(form);
         //  $('#spinner').addClass('is-active');

         //validasi input
         let new_time = $('#new_time').val();
         let new_description = $('#new_description').val();
         if (new_time == '' && new_description == '') {
             alert('Jam masuk/keluar dan keterangan wajib diisi!');
             $('#spinner').removeClass('is-active');
         } else {
             $.ajax({
                 url: "<?= base_url(); ?>employee/saveAttendance",
                 type: "post",
                 data: $('#form').serialize(),
                 dataType: "JSON",
                 success: function(data) {
                     console.log(data);
                     $('#modal_addtime').modal('hide');
                     $('#spinner').removeClass('is-active');
                     alert('Pengajuan kehadiran berhasil!');
                 },
                 error: function(jqXHR, textStatus, errorThrown) {
                     alert('Error adding / update data');
                     $('#spinner').removeClass('is-active');
                 }
             });
         }
     }

     function showAddTime2(id, type, dateAtt) {
         console.log('id : ' + id);
         console.log('tipe : ' + type);
         console.log(dateAtt);

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

                 $("#add_type").remove(); //jika sudah ada maka hapus terlebih dahulu
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
                         console.log(data);
                         var html = '';
                         for (var i = 0; i <= data.length - 1; i++) {
                             html += '<option value=' + data[i].shift_id + '>' + data[i].name + '</option>';
                         }
                         $("#new_shift").html(html);
                     }
                 });

                 $("#form").prepend('<p><input type="hidden" class="form-control" value="' + id + '" name="attendance_id" id="attendance_id" readonly></p><p><input type="hidden" class="form-control" value="' + type + '" name="add_type" id="add_type" readonly></p><p><input name="iodate" value="' + dateAtt + '"id="iodate" class="form-control" id="iodate" type="text" readonly></p>');
             },
             error: function(jqXHR, textStatus, errorThrown) {
                 alert('Error adding / update data');
                 $('#spinner').removeClass('is-active');
             }
         });
     }

     function selectAtt2(id, attendance_id, type) {
         console.log(id);
         console.log(attendance_id);
         console.log(type);

         let selectShift = $("#selectShift").val();

         if (selectShift == 0) {
             alert('Silahkan pilih shift terlebih dahulu');
             $("#selectShift").addClass("is-invalid");
         } else {
             if (confirm('Yakin memilih tanggal tersebut?') == true) {
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
                         console.log(data);
                         $('#modal_addtime').modal('hide'); //sembunyikan modal
                         // $('#spinner').removeClass('is-active');
                         // $('#modalAddAbsent').modal('hide');
                         // console.log(data);
                         reload();
                     },
                     error: function(jqXHR, textStatus, errorThrown) {
                         alert('Error adding / update data');
                         $('#spinner').removeClass('is-active');
                     }
                 });
             }
         }
     }

     function reload() {
         table.ajax.reload(null, false);
     }
 </script>