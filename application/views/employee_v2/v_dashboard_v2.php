<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
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
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h4><?= $timeIn; ?></h4>

              <p>HADIR</p>
            </div>
            <div class="icon">
              <i class="fa fa-clock"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h4><?= $lateIn ?><sup style="font-size:10px">days</sup></h4>

              <p>TERLAMBAT</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h4>44</h4>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h4>65</h4>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

  <style>
    body {
      /* margin-top: 20px; */
      background: #eee;
    }

    .timeline {
      list-style-type: none;
      margin: 0;
      padding: 0;
      position: relative
    }

    .timeline:before {
      content: '';
      position: absolute;
      top: 5px;
      bottom: 5px;
      width: 5px;
      background: #2d353c;
      left: 20%;
      margin-left: -2.5px
    }

    .timeline>li {
      position: relative;
      min-height: 50px;
      padding: 20px 0
    }

    .timeline .timeline-time {
      position: absolute;
      left: 0;
      width: 15%;
      text-align: right;
      top: 25px
    }

    .timeline .timeline-time .date,
    .timeline .timeline-time .time {
      display: block;
      font-weight: 300
    }

    .timeline .timeline-time .date {
      line-height: 10px;
      font-size: 10px
    }

    .timeline .timeline-time .time {
      line-height: 20px;
      font-size: 15px;
      color: #242a30
    }

    .timeline .timeline-icon {
      left: 15%;
      position: absolute;
      width: 10%;
      text-align: center;
      top: 40px
    }

    .timeline .timeline-icon a {
      text-decoration: none;
      width: 20px;
      height: 20px;
      display: inline-block;
      border-radius: 20px;
      background: #d9e0e7;
      line-height: 10px;
      color: #fff;
      font-size: 14px;
      border: 5px solid #2d353c;
      transition: border-color .2s linear
    }

    .timeline .timeline-body {
      margin-left: 28%;
      margin-right: 17%;
      background: #fff;
      position: relative;
      padding: 20px 25px;
      border-radius: 6px
    }

    .timeline .timeline-body:before {
      content: '';
      display: block;
      position: absolute;
      border: 10px solid transparent;
      border-right-color: #fff;
      left: -20px;
      top: 20px
    }

    .timeline .timeline-body>div+div {
      margin-top: 15px
    }

    .timeline .timeline-body>div+div:last-child {
      margin-bottom: -20px;
      padding-bottom: 20px;
      border-radius: 0 0 6px 6px
    }

    .timeline-header {
      padding-bottom: 10px;
      border-bottom: 1px solid #e2e7eb;
      line-height: 30px
    }

    .timeline-header .userimage {
      float: left;
      width: 34px;
      height: 34px;
      border-radius: 40px;
      overflow: hidden;
      margin: -2px 10px -2px 0
    }

    .timeline-header .username {
      font-size: 12px;
      font-weight: 600
    }

    .timeline-header .username,
    .timeline-header .username a {
      color: #2d353c
    }

    .timeline img {
      max-width: 100%;
      display: block
    }

    .timeline-content {
      letter-spacing: .2px;
      line-height: 10px;
      font-size: 10px;
    }

    .timeline-content:after,
    .timeline-content:before {
      content: '';
      display: table;
      clear: both
    }

    .timeline-title {
      margin-top: 0
    }

    .timeline-footer {
      background: #fff;
      border-top: 1px solid #e2e7ec;
      padding-top: 15px
    }

    .timeline-footer a:not(.btn) {
      color: #575d63
    }

    .timeline-footer a:not(.btn):focus,
    .timeline-footer a:not(.btn):hover {
      color: #2d353c
    }

    .timeline-likes {
      color: #6d767f;
      font-weight: 600;
      font-size: 12px
    }

    .timeline-likes .stats-right {
      float: right
    }

    .timeline-likes .stats-total {
      display: inline-block;
      line-height: 20px
    }

    .timeline-likes .stats-icon {
      float: left;
      margin-right: 5px;
      font-size: 9px
    }

    .timeline-likes .stats-icon+.stats-icon {
      margin-left: -2px
    }

    .timeline-likes .stats-text {
      line-height: 20px
    }

    .timeline-likes .stats-text+.stats-text {
      margin-left: 15px
    }

    .timeline-comment-box {
      background: #f2f3f4;
      margin-left: -25px;
      margin-right: -25px;
      padding: 20px 25px
    }

    .timeline-comment-box .user {
      float: left;
      width: 34px;
      height: 34px;
      overflow: hidden;
      border-radius: 30px
    }

    .timeline-comment-box .user img {
      max-width: 100%;
      max-height: 100%
    }

    .timeline-comment-box .user+.input {
      margin-left: 44px
    }

    .lead {
      margin-bottom: 20px;
      font-size: 21px;
      font-weight: 300;
      line-height: 1.4;
    }

    .text-danger,
    .text-red {
      color: #ff5b57 !important;
    }
  </style>

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
          <div class="timeline-icon">
            <a href="javascript:;">&nbsp;</a>
          </div>
          <div class="timeline-body">
            <div class="timeline-header">
              <!-- <span class="userimage"><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt=""></span> -->
              <span class="username"><a href="javascript:;"><?= $this->session->userdata('ses_nama') ?></a><small></small></span>
            </div>
            <div class="timeline-content">
              <p>
                <!-- disini content. -->
                <?= $th->shift != '' ? strtoupper($th->shift) . "<br>" : ''; ?>
                <?= $th->calendar == 'H' ? '<span class="text-danger">HOLIDAY</span><br>' : ''; ?>
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