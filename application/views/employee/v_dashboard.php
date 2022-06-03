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
                          <div class="progress-bar bg-primary" style="width: <?= $allIn / $workCal * 100; ?>%"></div>
                        </div>
                      </div>
                      <div class="progress-group">
                        Cuti
                        <span class="float-right"><b><?= $allLeave . "/" . $workCal; ?></b></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-info" style="width: <?= $allLeave / $workCal * 100; ?>%"></div>
                        </div>
                      </div>
                      <div class="progress-group">
                        Sakit
                        <span class="float-right"><b><?= $allSick . "/" . $workCal;  ?></b></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-success" style="width: <?= $allSick / $workCal * 100; ?>%"></div>
                        </div>
                      </div>
                      <div class="progress-group">
                        <span class="progress-text">
                          Izin
                        </span>
                        <span class="float-right"><b><?= $allPermit . "/" . $workCal;  ?></b></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-warning" style="width: <?= $allPermit / $workCal * 100; ?>%"></div>
                        </div>
                      </div>
                      <div class="progress-group">
                        Alpha
                        <span class="float-right"><b><?= $allAlpha . "/" . $workCal;  ?></b></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-danger" style="width: <?= $allAlpha / $workCal * 100; ?>%"></div>
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
                <a href="#" class="small-box-footer">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
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
                    <?= hari(date_format(date_create($th->iodate), 'D')); ?><br>
                    <?= $th->iodate == date('Y-m-d') ? 'Today' : date_format(date_create($th->iodate), 'd/m/Y'); ?>
                  </span>
                  <span class="time" style="font-size:15px; font-weight:bold">

                    <?php
                    if ($th->time_in != "00:00:00") {
                      echo substr($th->time_in, 0, 5) . "<br>";
                    } elseif ($th->time_in_m != "") {
                      echo $th->time_in_m . "<br>";
                    } else {
                      echo "00:00<br>";
                    }

                    if ($th->time_out != "00:00:00") {
                      echo substr($th->time_out, 0, 5);
                    } elseif ($th->time_out_m != "") {
                      echo $th->time_out_m;
                    } else {
                      echo "00:00";
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
                      if ($th->time_in != "00:00:00" && $th->time_in > $th->start) {
                        echo '<img src="' . base_url() . 'assets/img/icon-late.png" alt="">';
                      } elseif (($th->time_in != "00:00:00" && $th->time_in <= $th->start) || $th->time_in_m != "") {
                        echo '<img src="' . base_url() . 'assets/img/icon-double-checklist.png" alt="">';
                      } elseif ($th->time_in == "00:00:00" && ($th->calendar == 'H' || $th->calendar == 'RH' || $th->calendar == 'NH')) {
                        echo '<img src="' . base_url() . 'assets/img/icon-holiday.png" alt="">';
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
                      if ($th->late != "-") {
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
                          <div class="progress-bar bg-primary" style="width: <?= $allInLM / $workCalLM * 100; ?>%"></div>
                        </div>
                      </div>
                      <div class="progress-group">
                        Cuti
                        <span class="float-right"><b><?= $allLeaveLM . "/" . $workCalLM; ?></b></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-info" style="width: <?= $allLeaveLM / $workCalLM * 100; ?>%"></div>
                        </div>
                      </div>
                      <div class="progress-group">
                        Sakit
                        <span class="float-right"><b><?= $allSickLM . "/" . $workCalLM; ?></b></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-success" style="width: <?= $allSickLM / $workCalLM * 100; ?>%"></div>
                        </div>
                      </div>
                      <div class="progress-group">
                        <span class="progress-text">
                          Izin
                        </span>
                        <span class="float-right"><b><?= $allPermitLM . "/" . $workCalLM; ?></b></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-warning" style="width: <?= $allPermitLM / $workCalLM * 100; ?>%"></div>
                        </div>
                      </div>
                      <div class="progress-group">
                        Alpha
                        <span class="float-right"><b><?= $allAlphaLM . "/" . $workCalLM; ?></b></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-danger" style="width: <?= $allAlphaLM / $workCalLM * 100; ?>%"></div>
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
                <a href="#" class="small-box-footer">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
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
                    <?= hari(date_format(date_create($th->iodate), 'D')); ?><br>
                    <?= $th->iodate == date('Y-m-d') ? 'Today' : date_format(date_create($th->iodate), 'd/m/Y'); ?>
                  </span>
                  <span class="time" style="font-size:15px; font-weight:bold">

                    <?php
                    if ($th->time_in != "00:00:00") {
                      echo substr($th->time_in, 0, 5) . "<br>";
                    } elseif ($th->time_in_m != "") {
                      echo $th->time_in_m . "<br>";
                    } else {
                      echo "00:00<br>";
                    }

                    if ($th->time_out != "00:00:00") {
                      echo substr($th->time_out, 0, 5);
                    } elseif ($th->time_out_m != "") {
                      echo $th->time_out_m;
                    } else {
                      echo "00:00";
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
                      if ($th->time_in != "00:00:00" && $th->time_in > $th->start) {
                        echo '<img src="' . base_url() . 'assets/img/icon-late.png" alt="">';
                      } elseif (($th->time_in != "00:00:00" && $th->time_in <= $th->start) || $th->time_in_m != "") {
                        echo '<img src="' . base_url() . 'assets/img/icon-double-checklist.png" alt="">';
                      } elseif ($th->time_in == "00:00:00" && ($th->calendar == 'H' || $th->calendar == 'RH' || $th->calendar == 'NH')) {
                        echo '<img src="' . base_url() . 'assets/img/icon-holiday.png" alt="">';
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
                      if ($th->late != "-") {
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

<?php
function hari($hari)
{
  switch ($hari) {
    case 'Sun':
      $hari_ini = "Minggu";
      break;

    case 'Mon':
      $hari_ini = "Senin";
      break;

    case 'Tue':
      $hari_ini = "Selasa";
      break;

    case 'Wed':
      $hari_ini = "Rabu";
      break;

    case 'Thu':
      $hari_ini = "Kamis";
      break;

    case 'Fri':
      $hari_ini = "Jumat";
      break;

    case 'Sat':
      $hari_ini = "Sabtu";
      break;

    default:
      $hari_ini = "Tidak di ketahui";
      break;
  }

  return $hari_ini;
}
?>