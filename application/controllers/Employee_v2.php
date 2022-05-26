<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_v2 extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('masuk') != TRUE) {
      $url = base_url('auth');
      redirect($url);
    }
    $this->load->model('model_employee', 'me');
  }

  public function dashboard()
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

  public function profile()
  {
    $nik = $this->session->userdata('ses_nik');

    $employee = $this->db->query(
      "SELECT u.*, d.name AS department, st.name AS shift
            FROM tb_user u            
            JOIN department d ON (u.department_id = d.department_id)
            JOIN shift_type st ON (u.shift_type_id = st.shift_type_id)
            WHERE id_karyawan = '$nik'"
    )->row();

    $data = array(
      "employee" => $employee
    );

    $this->load->view('employee_v2/v_header_v2');
    $this->load->view('employee_v2/v_profile_v2', $data);
    $this->load->view('employee_v2/v_footer_v2');
  }

  public function attendance()
  {
    $nik = $this->session->userdata('ses_nik');
    $getShift = $this->db->query("SELECT 
                                        * 
                                    FROM shift 
                                    WHERE isactive = 'Y'
                                    AND shift_type_id = (
                                        SELECT shift_type_id
                                        FROM tb_user
                                        WHERE id_karyawan = '$nik'
                                    )");

    $data = array(
      'attendance' => $this->me->getAttendance($nik),
      'shift' => $this->me->getShiftByNIK($nik),
      // 'shift' => $getShift
    );

    $this->load->view('employee_v2/v_header_v2');
    $this->load->view('employee_v2/v_attendance_v2', $data);
    $this->load->view('employee_v2/v_footer_v2');
  }

  public function history()
  {
    $nik = $this->session->userdata('ses_nik');

    $sql = "SELECT 
                    am.nik, am.iodate, am.time, am.type, am.description, am.isapproved, s.name AS shift, u.nama_karyawan, d.name AS department
                FROM attendance_manual  am
                JOIN tb_user u ON (am.nik = u.id_karyawan)
                JOIN department d ON (u.department_id = d.department_id)
                JOIN shift s ON (am.shift_id = s.shift_id)
                WHERE nik = '$nik' 
                -- AND isapproved <> 0
                ORDER BY am.attendance_manual_id DESC";
    $data = array(
      "history" => $this->db->query($sql)->result(),
    );

    $this->load->view('employee_v2/v_header_v2');
    $this->load->view('employee_v2/v_history_v2', $data);
    $this->load->view('employee_v2/v_footer_v2');
  }

  public function log()
  {
    $nik = $this->session->userdata('ses_nik');

    $data = array(
      'log' => $this->me->getLog($nik),
    );

    $this->load->view('employee_v2/v_header_v2');
    $this->load->view('employee_v2/v_log_v2', $data);
    $this->load->view('employee_v2/v_footer_v2');
  }
}
