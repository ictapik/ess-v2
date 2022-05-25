<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_v2 extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    // if ($this->session->userdata('masuk') != TRUE) {
    //   $url = base_url();
    //   redirect($url);
    // }
    $this->load->model('model_employee', 'me');
  }

  function index()
  {
    $nik = $this->session->userdata('ses_nik');

    $month = date('Y-m');
    $end = $month . "-25";
    $endDate = strtotime($month . "-24");
    $start = date("Y-m-d", strtotime("-1 Months", $endDate));

    $data = array(
      'timeIn' => $this->me->timeIn($nik),
      'startDate' => $start,
      'endDate' => $end,
      'allIn' => $this->me->allIn($nik, $start, $end),
      'lateIn' => $this->me->lateIn($nik, $start, $end),
      'timelineHistory' => $this->me->timelineHistory($nik, $start, $end),
    );

    $this->load->view('employee_v2/v_header_v2');
    $this->load->view('employee_v2/v_dashboard_v2', $data);
    $this->load->view('employee_v2/v_footer_v2');
  }
}
