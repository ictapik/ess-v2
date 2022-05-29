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
      <div class="row">
        <div class="col-lg-6 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h4>
                <?php
                echo $allIn;
                ?>
              </h4>
              <p>HADIR</p>
            </div>
            <div class="icon">
              <i class="fa fa-clock"></i>
            </div>
            <a href="<?= base_url('employee/detailIn/' . $startDate . '/' . $endDate); ?>" class="small-box-footer">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-6 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h4><?= isset($lateIn) ? $lateIn : '--:--:--' ?></sup></h4>
              <p>TELAT</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?= base_url('employee/detailLate/' . $startDate . '/' . $endDate); ?>" class="small-box-footer">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
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