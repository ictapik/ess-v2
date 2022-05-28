<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0">Dashboard</h5>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-6 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h4>
                <?php
                if (!empty($timeIn)) {
                  if ($timeIn->time_in != "00:00:00") {
                    echo "$timeIn->time_in";
                  } elseif ($timeIn->time_in_m != "") {
                    echo "$timeIn->time_in_m";
                  } else {
                    echo "--:--:--";
                  }
                } else {
                  echo "--:--:--";
                }
                ?>
              </h4>
              <p>HADIR</p>
            </div>
            <div class="icon">
              <i class="fa fa-clock"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h4><?= $lateIn ?><sup style="font-size:10px">days</sup></h4>

              <p>TOTAL TERLAMBAT</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

  <!-- CSS untuk timeline, diletakan disini agar tidak 
  mempengaruhi/mengganggu tag-tag yang ada di atasnya -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/timeline.css">

  <!-- Timeline -->
  <div class="container">
    <ul class="timeline">
      <?php
      foreach ($timelineHistory as $th) {
      ?>
        <li>
          <div class="timeline-time">
            <span class="date"><?= $th->iodate == date('Y-m-d') ? 'Today' : $th->iodate; ?></span>
            <span class="time" style="font-size:13px">
              <?= $th->time_in; ?><br>
              <?= $th->time_out; ?>
            </span>
          </div>
          <div class="timeline-icon <?= $th->calendar == 'H' ? 'timeline-icon-holiday' : ''; ?>">
            <a href="javascript:;">&nbsp;</a>
          </div>
          <div class="timeline-body">
            <div class="timeline-header">
              <span class="userimage">
                <img src="<?= base_url(); ?>assets/img/<?= $this->session->userdata('ses_jk') == 'Perempuan' ? 'default-woman.jpg' : 'default-man.jpg'; ?>" alt="">
              </span>
              <span class="username"><a href="javascript:;"><?= $this->session->userdata('ses_nama') ?></a><small></small></span>
            </div>
            <div class="timeline-content">
              <p>
                <!-- disini content. -->
                <?= $th->shift != '' ? strtoupper($th->shift) . "<br>" : ''; ?>
                <?= $th->calendar == 'H' ? 'HOLIDAY<br>' : ''; ?>
                <?= $th->absent_id != '0' ? strtoupper($th->absent_name) : ''; ?>
              </p>
            </div>
          </div>
          <!-- end timeline-body -->
        </li>
      <?php
      }
      ?>
    </ul>
  </div>
  <!-- End timeline -->
</div>