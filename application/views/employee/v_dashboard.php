<!-- Begin Page Content -->
<div class="container">

  <!-- Page Heading -->
  <div class=" d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="row">
    <!-- <div class="col-md">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Time In</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?= $timeIn; ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clock fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div> -->

    <div class="col-md">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                <!-- $startDate, $endDate -->
                Hadir
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?= $allIn; ?> Hari
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clock fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Terlambat</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?= $lateIn; ?> Days
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clock fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- modal-->
<div class="modal fade" id="modal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>

      <div class="modal-body form">
        <table class="table" id="myTable">
          <tr>
            <td>Tanggal</td>
            <td>Masuk</td>
            <td>Keluar</td>
            <td>Shift</td>
          </tr>
        </table>
      </div>

      <div class="modal-footer">
        <button type="button" id="btnSaveTimePropose" onclick="saveTimePropose()" class="btn btn-info" style="display:none">Ajukan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
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
    width: 18%;
    text-align: right;
    top: 30px
  }

  .timeline .timeline-time .date,
  .timeline .timeline-time .time {
    display: block;
    font-weight: 600
  }

  .timeline .timeline-time .date {
    line-height: 16px;
    font-size: 12px
  }

  .timeline .timeline-time .time {
    line-height: 24px;
    font-size: 20px;
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
    margin-left: 23%;
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
    font-size: 16px;
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
    letter-spacing: .25px;
    line-height: 18px;
    font-size: 13px
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
<!-- <div class="container"> -->
<ul class="timeline">
  <?php
  foreach ($timelineHistory as $th) {
  ?>
    <li>
      <div class="timeline-time">
        <span class="date"><?= $th->iodate == date('Y-m-d') ? 'Today' : $th->iodate; ?></span>
        <span class="time" style="font-size:13px">
          IN <?= $th->time_in; ?><br>
          OUT <?= $th->time_out; ?>
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
        <div class="timeline-likes">
          <!-- disini likes -->
        </div>
        <div class="timeline-footer">
          <!-- disini footer -->
        </div>
      </div>
      <!-- end timeline-body -->
    </li>
  <?php
  }
  ?>
</ul>
<!-- </div> -->
<!-- End timeline -->