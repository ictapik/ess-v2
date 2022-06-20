<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0">Dashboard</h5>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">

      <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?= date("M"); ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><?= date("M", strtotime("-1 month", strtotime(date('Y-m-d')))); ?></a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <!-- Current Month -->
          <div class="row">
            <div class="col-md">
              <div class="card card-success card-outline">
                <div class="card-body p-2">
                  <div class="row">
                    <div class="col-md">
                      <!-- <p class="text-center">
                    <strong>Bulan Ini</strong>
                    </p> -->
                      <div class="progress-group">
                        Hadir
                        <span class="float-right"><b><?= $allIn . "/" . $workCal;  ?></b></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-primary" style="width: <?= $allIn / ($workCal == 0 ? 1 : $workCal) * 100; ?>%"></div>
                        </div>
                      </div>
                      <div class="progress-group">
                        Cuti
                        <span class="float-right"><b><?= $allLeave . "/" . $workCal; ?></b></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-info" style="width: <?= $allLeave / ($workCal == 0 ? 1 : $workCal) * 100; ?>%"></div>
                        </div>
                      </div>
                      <div class="progress-group">
                        Sakit
                        <span class="float-right"><b><?= $allSick . "/" . $workCal;  ?></b></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-success" style="width: <?= $allSick / ($workCal == 0 ? 1 : $workCal) * 100; ?>%"></div>
                        </div>
                      </div>
                      <div class="progress-group">
                        <span class="progress-text">
                          Izin
                        </span>
                        <span class="float-right"><b><?= $allPermit . "/" . $workCal;  ?></b></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-warning" style="width: <?= $allPermit / ($workCal == 0 ? 1 : $workCal) * 100; ?>%"></div>
                        </div>
                      </div>
                      <div class="progress-group">
                        Alpha
                        <span class="float-right"><b><?= $allAlpha . "/" . $workCal;  ?></b></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-danger" style="width: <?= $allAlpha / ($workCal == 0 ? 1 : $workCal) * 100; ?>%"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg col">
              <div class="small-box <?= isset($lateIn) && $lateIn > '00:10:00' ? 'bg-danger' : 'bg-success' ?>">
                <div class="inner">
                  <h4><?= isset($lateIn) ? $lateIn : '--:--:--' ?></sup></h4>
                  <p>TERLAMBAT</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?= base_url('employee/detailLate/' . $startDate . '/' . $endDate); ?>" class="small-box-footer">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg col">
              <div class="small-box bg-success">
                <div class="inner">
                  <h4><?= isset($manualAtt) ? $manualAtt : '0' ?></sup></h4>
                  <p>KEHADIRAN MANUAL</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?= base_url('employee/detailManual/' . $startDate . '/' . $endDate); ?>" class="small-box-footer">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>

          <!-- CSS untuk timeline, diletakan disini agar tidak 
             mempengaruhi/mengganggu tag-tag yang ada di atasnya -->
          <link rel="stylesheet" href="<?= base_url(); ?>assets/css/timeline.css">

          <ul class="timeline pb-3">
            <?php
            foreach ($timelineHistory as $th) {
            ?>
              <li>
                <div class="timeline-time">
                  <span class="date">
                    <?php
                    $hari = hari(date_format(date_create($th->iodate), 'D'));
                    if ($hari == "Minggu") {
                      echo "<font style='color:red'>$hari</font>";
                    } else {
                      echo $hari;
                    }
                    ?>
                    <br>
                    <?php
                    $tanggal = $th->iodate == date('Y-m-d') ? 'Today' : date_format(date_create($th->iodate), 'd/m/Y');
                    if ($hari == "Minggu") {
                      echo "<font style='color:red'>$tanggal</font>";
                    } else {
                      echo $tanggal;
                    }
                    ?>
                  </span>
                  <span class="time" style="font-size:15px; font-weight:bold">

                    <?php
                    if ($th->time_in != "00:00:00") {
                      echo substr($th->time_in, 0, 5) . "<br>";
                    } elseif ($th->time_in_m != "") {
                      echo $th->time_in_m . "<br>";
                    } else {
                      echo "<span onclick='showAddTime($th->attendance_id, 1, \"$th->iodate\")'>00:00</span><br>";
                    }

                    if ($th->time_out != "00:00:00") {
                      echo substr($th->time_out, 0, 5);
                    } elseif ($th->time_out_m != "") {
                      echo $th->time_out_m;
                    } else {
                      echo "<span onclick='showAddTime($th->attendance_id, 2, \"$th->iodate\")'>00:00</span><br>";
                    }
                    ?>
                  </span>
                </div>
                <div class="timeline-icon <?= $th->calendar == 'H' || $th->calendar == 'NH' || $th->calendar == 'RH' ? 'timeline-icon-holiday' : ''; ?>">
                  <a href="javascript:;">&nbsp;</a>
                </div>
                <div class="timeline-body">
                  <div class="timeline-header">
                    <span class="userimage">
                      <?php
                      if ($th->time_in != "00:00:00" && $th->time_in > $th->start && $th->calendar == 'WD') {
                        echo '<img onclick="lateReason(' . $th->attendance_id . ', \'' . $th->iodate . '\')" src="' . base_url() . 'assets/img/icon-late.png" alt="">';
                      } elseif (($th->time_in != "00:00:00" && $th->time_in <= $th->start) || $th->time_in_m != "") {
                        echo '<img src="' . base_url() . 'assets/img/icon-double-checklist.png" alt="">';
                      } elseif ($th->time_in == "00:00:00" && $th->calendar == 'H') {
                        echo '<img src="' . base_url() . 'assets/img/icon-holiday.png" alt="">';
                      } elseif ($th->calendar == 'NH') {
                        echo '<img src="' . base_url() . 'assets/img/icon-national-holiday.png" alt="">';
                      } elseif ($th->calendar == 'RH') {
                        echo '<img src="' . base_url() . 'assets/img/icon-religion-holiday.png" alt="">';
                      } elseif ($th->time_in == "00:00:00" && ($th->absent_id == '1' || $th->absent_id == '2')) {
                        echo '<img src="' . base_url() . 'assets/img/icon-leave.png" alt="">';
                      } elseif ($th->calendar != "RH" && $th->calendar != "NH" && $th->calendar != 'H' && $th->time_in == "00:00:00" && $th->time_out == "00:00:00") {
                        echo '<img src="' . base_url() . 'assets/img/icon-alfa.png" alt="">';
                      }
                      ?>
                    </span>
                    <span class="username">
                      <?php
                      echo $th->shift != '' ? strtoupper($th->shift) . "" : '';
                      if ($th->late != "-" && $th->calendar == "WD") {
                        echo " - <i style='font-weight:bold'>" . $th->late . "</i><br>";
                      }
                      ?>
                      <?= $th->calendar == 'H' ? 'HOLIDAY<br>' : ''; ?>

                      <?php
                      if ($th->calendar == "RH") {
                        echo "RELIGION HOLIDAY<br>";
                        echo "<i style='font-size:10px; pading-top:-100px'>" . $this->CI->holidayName($th->iodate)->name . "</i>";
                      }
                      if ($th->calendar == "NH") {
                        echo "NATIONAL HOLIDAY<br>";
                        echo "<i style='font-size:10px;'>" . $this->CI->holidayName($th->iodate)->name . "</i>";
                      }
                      if ($th->calendar != "RH" && $th->calendar != "NH" && $th->calendar != 'H' && $th->absent_id != 1 && $th->absent_id != 2 && $th->time_in == "00:00:00" && $th->time_in_m == "") {
                        echo "ALPHA";
                      }
                      if ($th->time_in_m != "" && $th->shift == "") {
                        echo "-";
                      }
                      ?>

                      <?= $th->absent_id != '0' ? strtoupper($th->absent_name) : ''; ?>
                      <?= "<i style='font-size:10px;'>" . $th->late_reason . "</i>"; ?>
                    </span>
                  </div>
                </div>
                <!-- end timeline-body -->
              </li>
            <?php
            }
            ?>
            <li>
              <div class="timeline-time">
                <span class="time" style="font-size:18px">
                  <a href="<?= base_url(); ?>employee/attendance"><span class="badge badge-secondary">Lihat Selengkapnya</span></a>
                </span>
              </div>
            </li>
          </ul>

        </div>

        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <!-- Last Month -->
          <div class="row">
            <div class="col-md">
              <div class="card card-success card-outline">
                <div class="card-body p-2">
                  <div class="row">
                    <div class="col-md">
                      <!-- <p class="text-center">
                    <strong>Bulan Ini</strong>
                    </p> -->
                      <div class="progress-group">
                        Hadir
                        <span class="float-right"><b><?= $allInLM . "/" . $workCalLM; ?></b></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-primary" style="width: <?= $allInLM / ($workCalLM == 0 ? 1 : $workCalLM) * 100; ?>%"></div>
                        </div>
                      </div>
                      <div class="progress-group">
                        Cuti
                        <span class="float-right"><b><?= $allLeaveLM . "/" . $workCalLM; ?></b></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-info" style="width: <?= $allLeaveLM / ($workCalLM == 0 ? 1 : $workCalLM) * 100; ?>%"></div>
                        </div>
                      </div>
                      <div class="progress-group">
                        Sakit
                        <span class="float-right"><b><?= $allSickLM . "/" . $workCalLM; ?></b></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-success" style="width: <?= $allSickLM / ($workCalLM == 0 ? 1 : $workCalLM) * 100; ?>%"></div>
                        </div>
                      </div>
                      <div class="progress-group">
                        <span class="progress-text">
                          Izin
                        </span>
                        <span class="float-right"><b><?= $allPermitLM . "/" . $workCalLM; ?></b></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-warning" style="width: <?= $allPermitLM / ($workCalLM == 0 ? 1 : $workCalLM) * 100; ?>%"></div>
                        </div>
                      </div>
                      <div class="progress-group">
                        Alpha
                        <span class="float-right"><b><?= $allAlphaLM . "/" . $workCalLM; ?></b></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-danger" style="width: <?= $allAlphaLM / ($workCalLM == 0 ? 1 : $workCalLM) * 100; ?>%"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg col">
              <div class="small-box <?= isset($lateInLM) && $lateInLM > '00:10:00' ? 'bg-danger' : 'bg-success' ?>">
                <div class="inner">
                  <h4><?= isset($lateInLM) ? $lateInLM : '--:--:--' ?></sup></h4>
                  <p>TERLAMBAT</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?= base_url('employee/detailLate/' . $startDateLM . '/' . $endDateLM); ?>" class="small-box-footer">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg col">
              <div class="small-box bg-success">
                <div class="inner">
                  <h4><?= isset($manualAttLM) ? $manualAttLM : '0' ?></sup></h4>
                  <p>KEHADIRAN MANUAL</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?= base_url('employee/detailManual/' . $startDateLM . '/' . $endDateLM); ?>" class="small-box-footer">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>

          <!-- CSS untuk timeline, diletakan disini agar tidak 
             mempengaruhi/mengganggu tag-tag yang ada di atasnya -->
          <link rel="stylesheet" href="<?= base_url(); ?>assets/css/timeline.css">

          <ul class="timeline pb-3">
            <?php
            foreach ($timelineHistoryLM as $th) {
            ?>
              <li>
                <div class="timeline-time">
                  <span class="date">
                    <?php
                    $hari = hari(date_format(date_create($th->iodate), 'D'));
                    if ($hari == "Minggu") {
                      echo "<font style='color:red'>$hari</font>";
                    } else {
                      echo $hari;
                    }
                    ?>
                    <br>
                    <?php
                    $tanggal = $th->iodate == date('Y-m-d') ? 'Today' : date_format(date_create($th->iodate), 'd/m/Y');
                    if ($hari == "Minggu") {
                      echo "<font style='color:red'>$tanggal</font>";
                    } else {
                      echo $tanggal;
                    }
                    ?>
                  </span>
                  <span class="time" style="font-size:15px; font-weight:bold">
                    <?php
                    if ($th->time_in != "00:00:00") {
                      echo substr($th->time_in, 0, 5) . "<br>";
                    } elseif ($th->time_in_m != "") {
                      echo $th->time_in_m . "<br>";
                    } else {
                      echo "<span onclick='showAddTime($th->attendance_id, 1, \"$th->iodate\")'>00:00</span><br>";
                    }

                    if ($th->time_out != "00:00:00") {
                      echo substr($th->time_out, 0, 5);
                    } elseif ($th->time_out_m != "") {
                      echo $th->time_out_m;
                    } else {
                      echo "<span onclick='showAddTime($th->attendance_id, 2, \"$th->iodate\")'>00:00</span><br>";
                    }
                    ?>
                  </span>
                </div>
                <div class="timeline-icon <?= $th->calendar == 'H' || $th->calendar == 'NH' || $th->calendar == 'RH' ? 'timeline-icon-holiday' : ''; ?>">
                  <a href="javascript:;">&nbsp;</a>
                </div>
                <div class="timeline-body">
                  <div class="timeline-header">
                    <span class="userimage">
                      <?php
                      if ($th->time_in != "00:00:00" && $th->time_in > $th->start && $th->calendar == 'WD') {
                        echo '<img onclick="lateReason(' . $th->attendance_id . ', \'' . $th->iodate . '\')" src="' . base_url() . 'assets/img/icon-late.png" alt="">';
                      } elseif (($th->time_in != "00:00:00" && $th->time_in <= $th->start) || $th->time_in_m != "") {
                        echo '<img src="' . base_url() . 'assets/img/icon-double-checklist.png" alt="">';
                      } elseif ($th->time_in == "00:00:00" && ($th->calendar == 'H' || $th->calendar == 'NH')) {
                        echo '<img src="' . base_url() . 'assets/img/icon-holiday.png" alt="">';
                      } elseif ($th->calendar == 'NH') {
                        echo '<img src="' . base_url() . 'assets/img/icon-national-holiday.png" alt="">';
                      } elseif ($th->calendar == 'RH') {
                        echo '<img src="' . base_url() . 'assets/img/icon-religion-holiday.png" alt="">';
                      } elseif ($th->time_in == "00:00:00" && ($th->absent_id == '1' || $th->absent_id == '2')) {
                        echo '<img src="' . base_url() . 'assets/img/icon-leave.png" alt="">';
                      } elseif ($th->calendar != "RH" && $th->calendar != "NH" && $th->calendar != 'H' && $th->time_in == "00:00:00" && $th->time_out == "00:00:00") {
                        echo '<img src="' . base_url() . 'assets/img/icon-alfa.png" alt="">';
                      }
                      ?>
                    </span>
                    <span class="username">
                      <?php
                      echo $th->shift != '' ? strtoupper($th->shift) . "" : '';
                      if ($th->late != "-" && $th->calendar == "WD") {
                        echo " - <i style='font-weight:bold'>" . $th->late . "</i><br>";
                      }
                      ?>
                      <?= $th->calendar == 'H' ? 'HOLIDAY<br>' : ''; ?>

                      <?php
                      if ($th->calendar == "RH") {
                        echo "RELIGION HOLIDAY<br>";
                        echo "<i style='font-size:10px; pading-top:-100px'>" . $this->CI->holidayName($th->iodate)->name . "</i>";
                      }
                      if ($th->calendar == "NH") {
                        echo "NATIONAL HOLIDAY<br>";
                        echo "<i style='font-size:10px; pading-top:-100px'>" . $this->CI->holidayName($th->iodate)->name . "</i>";
                      }
                      if ($th->calendar != "RH" && $th->calendar != "NH" && $th->calendar != 'H' && $th->absent_id != 1 && $th->absent_id != 2 && $th->time_in == "00:00:00" && $th->time_in_m == "") {
                        echo "ALPHA";
                      }
                      if ($th->time_in_m != "" && $th->shift == "") {
                        echo "-";
                      }
                      ?>

                      <?= $th->absent_id != '0' ? strtoupper($th->absent_name) : ''; ?>
                      <?= "<i style='font-size:10px;'>" . $th->late_reason . "</i>"; ?>
                    </span>
                  </div>
                </div>
                <!-- end timeline-body -->
              </li>
            <?php
            }
            ?>
            <li>
              <div class="timeline-time">
                <span class="time" style="font-size:18px">
                  <a href="<?= base_url(); ?>employee/attendance"><span class="badge badge-secondary">Lihat Selengkapnya</span></a>
                </span>
              </div>
            </li>
          </ul>
        </div>
      </div>

    </div>
  </section>

</div>

<!-- Modal -->
<div class="modal fade" id="lateReasonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alasan Terlambat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa fa-times-circle"></i></span>
        </button>
      </div>
      <div class="modal-body">

        <form action="" id="formLateReason" class="form-horizontal">
          <div class="form-body">
            <div class="form-group row">
              <div class="col-md-12">
                <input name="attendance_id" class="form-control" id="attendance_id" type="hidden" readonly>
                <input name="attendance_date" class="form-control" id="attendance_date" type="text" readonly>
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-12">
                <textarea name="late_reason" id="late_reason" class="form-control" placeholder="Alasan Terlambat"></textarea>
              </div>
            </div>
          </div>
        </form>
        <button type="button" onclick="saveLateReason()" class="btn btn-primary btn-block">Simpan</button>

      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
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
        <span id="hariTanggal">
          <!-- disini nanti muncul hari dan tanggal ketika diklik absen manual -->
        </span>

        <ul class="nav nav-tabs" id="myTabManual" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link font-weight-bold active" id="logTab" data-toggle="tab" href="#log" role="tab" aria-controls="home" aria-selected="true">Log</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link font-weight-bold" id="manualTab" data-toggle="tab" href="#manual" role="tab" aria-controls="profile" aria-selected="false">Manual</a>
          </li>
        </ul>

        <div class="tab-content" id="myTabManualContent">
          <div class="tab-pane fade show active" id="log">
            <div id="response" class="mt-2"></div>
          </div>

          <div class="tab-pane fade" id="manual">
            <div id="manualPropose">
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
  function lateReason(attendance_id, attendance_date) {
    console.log("ALASAN TERLAMBAT");
    console.log(attendance_id);
    $('[name="attendance_id"]').val(attendance_id);
    $('[name="attendance_date"]').val(attendance_date);
    $('[name="late_reason"]').removeClass('is-invalid');
    $("#lateReasonModal").modal('show');
  }

  function saveLateReason() {
    let late_reason = $('[name="late_reason"]').val();
    if (late_reason == "") {

      $('[name="late_reason"]').addClass('is-invalid');

      Swal.fire({
        title: 'Gagal',
        text: 'Alasan terlambat wajib diisi.',
        icon: 'error',
        timer: 2500
      });
    } else {
      $.ajax({
        url: "<?= base_url(); ?>employee/saveLateReason",
        type: "post",
        data: $('#formLateReason').serialize(),
        dataType: "JSON",
        success: function(data) {
          console.log(data);
          $('#lateReasonModal').modal('hide');

          $('#spinner').removeClass('is-active');
          Swal.fire({
            title: 'Sukses',
            text: 'Pengajuan kehadiran berhasil.',
            icon: 'success',
            timer: 2500
          });
          location.reload()
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error adding / update data');
        }
      });
    }
  }

  function showAddTime(id, type, dateAtt) {
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

        console.log(data);

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

        $(".showDivDayDate").remove(); //jika sudah ada maka hapus terlebih dahulu
        $(".showDay").remove(); //jika sudah ada maka hapus terlebih dahulu
        $(".showDate").remove(); //jika sudah ada maka hapus terlebih dahulu
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

            console.log(data);

            var html = '';
            for (var i = 0; i <= data.length - 1; i++) {
              html += '<option value=' + data[i].shift_id + '>' + data[i].name + '</option>';
            }
            $("#new_shift").html(html);
          }
        });

        $("#hariTanggal").prepend('<div class="row mb-2 showDivDayDate"><div class="col"><input value="' + hari(new Date(dateAtt).getDay()) + '" class="form-control showDay" type="text" readonly></div><div class="col"><input value="' + dateAtt + '" class="form-control showDate" type="text" readonly></div></div>');

        $("#form").prepend('<input type="hidden" class="form-control" value="' + id + '" name="attendance_id" id="attendance_id" readonly><input type="hidden" class="form-control" value="' + type + '" name="add_type" id="add_type" readonly><div class="row pt-3 pb-3" id="divrow"><div class="col"><input name="iodate" value="' + hari(new Date(dateAtt).getDay()) + '"id="hari" class="form-control" id="iodate" type="hidden" readonly></div><div class="col"><input name="iodate" value="' + dateAtt + '"id="iodate" class="form-control" id="iodate" type="hidden" readonly></div></div>');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error adding / update data');
        $('#spinner').removeClass('is-active');
      }
    });
  }

  function saveTimePropose() {
    let form = $("#form").serialize();

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
          console.log(data);
          if (data.status == true) {
            Swal.fire({
              title: 'Sukses',
              text: 'Pengajuan kehadiran berhasil.',
              icon: 'success',
              timer: 2500
            });
          } else {
            Swal.fire({
              title: 'Gagal',
              text: 'Pengajuan sudah pernah dilakukan, status masih menunggu.',
              icon: 'error',
              timer: 2500
            });
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error adding / update data');
          $('#spinner').removeClass('is-active');
        }
      });
    }
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