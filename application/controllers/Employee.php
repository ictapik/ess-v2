<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{
  public $CI = NULL;

  function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('masuk') != TRUE) {
      $url = base_url('auth');
      redirect($url);
    }
    $this->load->model('model_employee', 'me');
    $this->load->library('ssp');
    $this->CI = &get_instance();
  }

  public function dashboard()
  {
    $nik = $this->session->userdata('ses_nik');

    $month = date('Y-m');
    $end = $month . "-24";
    $endDate = strtotime($month . "-25");
    $start = date("Y-m-d", strtotime("-1 Months", $endDate));

    $endLM = date("Y-m-d", strtotime("-1 Months", strtotime($month . "-24")));
    $startLM = date("Y-m-d", strtotime("-2 Months", $endDate));

    $data = array(
      'timeIn' => $this->me->timeIn($nik),
      'startDate' => $start,
      'endDate' => $end,
      'startDateLM' => $startLM,
      'endDateLM' => $endLM,

      'workCal' => $this->me->workCal($nik, $start, $end),
      'allIn' => $this->me->allIn($nik, $start, $end),
      'allLeave' => $this->me->allLeave($nik, $start, $end),
      'allSick' => $this->me->allSick($nik, $start, $end),
      'allAlpha' => $this->me->allAlpha($nik, $start, $end),
      'allPermit' => $this->me->allPermit($nik, $start, $end),
      'lateIn' => $this->me->lateIn($nik, $start, $end),
      'manualAtt' => $this->me->manualAtt($nik, $start, $end),
      'timelineHistory' => $this->me->timelineHistory($nik, $start, $end),

      'workCalLM' => $this->me->workCal($nik, $startLM, $endLM),
      'allInLM' => $this->me->allIn($nik, $startLM, $endLM),
      'allLeaveLM' => $this->me->allLeave($nik, $startLM, $endLM),
      'allSickLM' => $this->me->allSick($nik, $startLM, $endLM),
      'allAlphaLM' => $this->me->allAlpha($nik, $startLM, $endLM),
      'allPermitLM' => $this->me->allPermit($nik, $startLM, $endLM),
      'lateInLM' => $this->me->lateIn($nik, $startLM, $endLM),
      'manualAttLM' => $this->me->manualAtt($nik, $startLM, $endLM),
      'timelineHistoryLM' => $this->me->timelineHistoryLM($nik, $startLM, $endLM),
    );

    $this->load->view('employee/v_header');
    $this->load->view('employee/v_dashboard', $data);
    $this->load->view('employee/v_footer');
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

    $this->load->view('employee/v_header');
    $this->load->view('employee/v_profile', $data);
    $this->load->view('employee/v_footer');
  }

  public function attendance()
  {
    $nik = $this->session->userdata('ses_nik');

    $data = array(
      'attendance' => $this->me->getAttendance($nik),
      'shift' => $this->me->getShiftByNIK($nik),
    );

    $this->load->view('employee/v_header');
    $this->load->view('employee/v_attendance', $data);
    $this->load->view('employee/v_footer');
  }

  public function log()
  {
    $nik = $this->session->userdata('ses_nik');

    $data = array(
      'log' => $this->me->getLog($nik),
    );

    $this->load->view('employee/v_header');
    $this->load->view('employee/v_log', $data);
    $this->load->view('employee/v_footer');
  }

  public function history()
  {
    $this->load->view('employee/v_header');
    $this->load->view('employee/v_history');
    $this->load->view('employee/v_footer');
  }

  public function detailIn($startDate, $endDate)
  {
    $nik = $this->session->userdata('ses_nik');

    $data = array(
      "detailAllIn" => $this->me->detailAllIn($nik, $startDate, $endDate),
    );

    $this->load->view('employee/v_header');
    $this->load->view('employee/v_detail_in', $data);
    $this->load->view('employee/v_footer');
  }

  public function detailLate($startDate, $endDate)
  {
    $nik = $this->session->userdata('ses_nik');

    $data = array(
      "detailLateIn" => $this->me->detailLateIn($nik, $startDate, $endDate),
    );

    $this->load->view('employee/v_header');
    $this->load->view('employee/v_detail_late', $data);
    $this->load->view('employee/v_footer');
  }

  public function detailManual($startDate, $endDate)
  {
    $nik = $this->session->userdata('ses_nik');

    $data = array(
      "detailManual" => $this->me->detailManual($nik, $startDate, $endDate),
    );

    $this->load->view('employee/v_header');
    $this->load->view('employee/v_detail_manual', $data);
    $this->load->view('employee/v_footer');

    // $data = $this->me->detailManual($nik, $startDate, $endDate);
    // echo json_encode($data);
  }

  public function showAttendance()
  {
    $nik = $this->session->userdata('ses_nik');

    // DB table to use
    $table = "(SELECT 
                        a.*,  CAST(SUBSTRING(a.attendance_id, 1,8) AS date) AS tanggal, UPPER(u.nama_karyawan) AS nama_karyawan, d.name AS department, s.name AS shift_name, ab.value as absent
                    FROM attendance a
                    JOIN tb_user u ON (a.nik = u.id_karyawan)
                    LEFT JOIN shift s ON (a.shift_id = s.shift_id)
                    LEFT JOIN absent ab ON (a.absent_id = ab.absent_id)
                    JOIN department d ON (u.department_id = d.department_id)
                    WHERE nik = '$nik') temp";

    // Table's primary key
    $primaryKey = 'attendance_id';

    // Array of database columns which should be read and sent back to DataTables.
    // The `db` parameter represents the column name in the database, while the `dt`
    // parameter represents the DataTables column identifier. In this case simple
    // indexes
    $columns = array(
      array('db' => 'attendance_id', 'dt' => 'attendance_id'),
      array('db' => 'nik', 'dt' => 'nik'),
      array('db' => 'nama_karyawan', 'dt' => 'nama_karyawan'),
      array('db' => 'department', 'dt' => 'department'),
      array('db' => 'tanggal', 'dt' => 'tanggal'),
      array('db' => 'calendar', 'dt' => 'calendar'),
      array('db' => 'absent', 'dt' => 'absent'),
      array('db' => 'time_in', 'dt' => 'time_in'),
      array('db' => 'time_in_m', 'dt' => 'time_in_m'),
      array('db' => 'time_out', 'dt' => 'time_out'),
      array('db' => 'time_out_m', 'dt' => 'time_out_m'),
      array('db' => 'shift_name', 'dt' => 'shift_name'),
    );

    // SQL server connection information
    $sql_details = array(
      'user' => 'root',
      'pass' => '',
      'db'   => 'db_absen',
      'host' => 'localhost'
    );

    echo json_encode(
      SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
    );
  }

  public function searchLog()
  {
    $nik = $this->session->userdata('ses_nik');
    $attendance_id = $this->input->post('id');
    $type = $this->input->post('type');
    $date = $this->input->post('dateAtt');

    $dataLog = $this->me->getAbsen($nik, $date);
    $employeeShift = $this->me->getShiftByNIK($nik);

    $response = '';
    $response .= '<select class="form-control" id="selectShift">';
    $response .= '<option value="0">-- pilih shift --</option>';
    foreach ($employeeShift as $es) {
      $response .= '<option value="' . $es['shift_id'] . '">' . $es['name'] . '</option>';
    }
    $response .= '</select><br>';
    $response .= '<div class="table-responsive">';
    $response .= '<table class="table table-bordered responsive nowrap" id="tableSearchLog" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>Tanggal</th>
                             <th class="text-center">Tipe</th>
                             <th>Shift</th>
                             <th>Source</th>
                             <th class="text-center"><span class=" fa fa-cogs"></span></th>
                         </tr>
                     </thead>';

    $response .= '<tbody>';
    foreach ($dataLog as $row) {
      $response .= '<tr>
            <td>' . $row['timestamp'] . '</td>
            <td class="text-center">' . ($row['inout_type'] == "0001000" ? "<span class='badge badge-success' >IN</span>" : "<span class='badge badge-danger'>OUT</span>") . '</td>
            <td>' . $row['shift_type_name'] . '</td>
            <td>' . $row['source'] . '</td>
            <td class="text-center"><button type="button" onclick="selectAtt2(' . $row['id'] . ',' . $attendance_id . ',' .  $type . ')" class="btn btn-sm btn-primary">Pilih</button></td>
            </tr>';
    }
    $response .= '</tbody>';

    $response .= '</table>';
    $response .= '<script>$("#tableSearchLog").DataTable({});</script>';
    $response .= '</div>';

    if (empty($dataLog)) {
      echo json_encode(
        array(
          "status" => false,
          "message" => "empty"
        )
      );
    } else {
      echo json_encode(
        array(
          "status" => true,
          "messsage" => "success",
          "data" => $dataLog,
          "response" => $response,
        )
      );
    }
  }

  public function getShiftByNIK($nik)
  {
    $data = $this->db->query(
      "SELECT 
          * 
      FROM shift 
      WHERE isactive = 'Y'
      AND shift_type_id = (
          SELECT shift_type_id
          FROM tb_user
          WHERE id_karyawan = '$nik'
      )"
    )->result();
    echo json_encode($data);
  }

  public function saveAttendance()
  {
    $attendance_id = $this->input->post('attendance_id');
    $nik = $this->session->userdata('ses_nik');
    $time = $this->input->post('new_time');
    $type = $this->input->post('add_type');
    $description = $this->input->post('new_description');

    if ($type == 1) {
      $type = "IN";
    } else {
      $type = "OUT";
    }
    $iodate = $this->input->post('iodate');
    $shift_id = $this->input->post('new_shift');

    // cek apakah ditanggal tersebut sudah melakukan pengajuan kehadiran
    $check = $this->db->query(
      "SELECT * 
      FROM attendance_manual
      WHERE iodate = '$iodate'
      AND type = '$type'"
    );

    if ($check->num_rows() == 0) {
      $data = array(
        'attendance_id' => $attendance_id,
        'nik' => $nik,
        'time' => $time,
        'type' => $type,
        'iodate' => $iodate,
        'shift_id' => $shift_id,
        'description' => $description,
        'created' => date('Y-m-d H:i:s'),
        'createdby' => $nik
      );

      $this->db->insert('attendance_manual', $data);

      echo json_encode(
        array(
          "status" => true,
          "messsage" => "success",
        )
      );
    } else {
      echo json_encode(
        array(
          "status" => false,
          "messsage" => "data already exists",
        )
      );
    }
  }

  public function selectAtt()
  {
    $id = $this->input->post('id');
    $attendance_id = $this->input->post('attendance_id');
    $type = $this->input->post('type');
    $shift_id = $this->input->post('shift');

    // 1. ambil data dari tabel tb_attempt berdasarkan id
    $data = $this->db->query("SELECT 
                                    a.id, a.nik,
                                    DATE_FORMAT(a.timestamp, '%Y-%m-%d') AS iodate,
                                    DATE_FORMAT(a.timestamp, '%H:%i:%s') AS time
                                FROM tb_attempt a
                                WHERE id = '$id'")->row();

    //2. persiapan data
    if ($type == 1) { //jika IN
      $updateData = array(
        'id_in' => $data->id,
        'nik' => $data->nik,
        'iodate' => $data->iodate,
        'calendar' => "WD",
        'time_in' => $data->time,
        'shift_id' => $shift_id,
      );
    } else { //jika OUT
      $updateData = array(
        'id_out' => $data->id,
        'nik' => $data->nik,
        'iodate' => $data->iodate,
        'calendar' => "WD",
        'time_out' => $data->time,
        'shift_id' => $shift_id,
      );
    }

    //3. update data
    $this->db->where('attendance_id', $attendance_id);
    $this->db->update('attendance', $updateData);

    echo json_encode(array(
      "status" => true,
      "message" => "success",
      "data" => $updateData,
    ));
  }

  public function dataHistory()
  {
    $nik = $this->session->userdata('ses_nik');

    // DB table to use
    $table = "(SELECT 
                    am.attendance_manual_id, am.nik, am.iodate, am.time, am.type, am.description, am.isapproved AS status, s.name AS shift, u.nama_karyawan, d.name AS department
                    FROM attendance_manual  am
                    JOIN tb_user u ON (am.nik = u.id_karyawan)
                    JOIN department d ON (u.department_id = d.department_id)
                    JOIN shift s ON (am.shift_id = s.shift_id)
                    WHERE nik = '$nik'
                    AND am.isactive = 'Y'
                    ORDER BY am.attendance_manual_id DESC) temp";

    // Table's primary key
    $primaryKey = 'attendance_manual_id';

    // Array of database columns which should be read and sent back to DataTables.
    // The `db` parameter represents the column name in the database, while the `dt`
    // parameter represents the DataTables column identifier. In this case simple
    // indexes
    $columns = array(
      array('db' => 'attendance_manual_id', 'dt' => 'attendance_manual_id'),
      array('db' => 'nik', 'dt' => 'nik'),
      array('db' => 'nama_karyawan', 'dt' => 'nama_karyawan'),
      array('db' => 'department', 'dt' => 'department'),
      array('db' => 'iodate', 'dt' => 'iodate'),
      array('db' => 'time', 'dt' => 'time'),
      array('db' => 'type', 'dt' => 'type'),
      array('db' => 'shift', 'dt' => 'shift'),
      array('db' => 'description', 'dt' => 'description'),
      array('db' => 'status', 'dt' => 'status'),
    );

    // SQL server connection information
    $sql_details = array(
      'user' => 'root',
      'pass' => '',
      'db'   => 'db_absen',
      'host' => 'localhost'
    );

    echo json_encode(
      SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
    );
  }

  public function getHistoryByID()
  {
    $id = $this->input->post('id');
    $data = $this->db->query(
      "SELECT *
      FROM attendance_manual
      WHERE attendance_manual_id = $id"
    )->row();
    echo json_encode($data);
  }

  public function changePassword()
  {
    $nik = $this->session->userdata('ses_nik');

    $old_password = md5(trim($this->input->post("old_password")));
    $new_password = md5(trim($this->input->post("new_password")));

    $check = $this->db->query(
      "SELECT * FROM tb_user WHERE id_karyawan = '$nik' AND password = '$old_password'"
    );

    if ($check->num_rows() >= 1) {
      $this->db->query(
        "UPDATE tb_user SET password = '$new_password'
              WHERE id_karyawan = '$nik'"
      );

      echo json_encode(
        array(
          "status" => true,
          "messsage" => "success",
        )
      );
    } else {
      echo json_encode(
        array(
          "status" => false,
          "messsage" => "wrong password",
        )
      );
    }
  }

  public function getUserByID($id)
  {
    $data = $this->db->query(
      "SELECT * FROM tb_user WHERE id = $id"
    )->row();

    echo json_encode($data);
  }

  public function processEdit()
  {
    $id = $this->input->post('id');
    $email = $this->input->post('email');
    $phone = $this->input->post('phone');

    $data = array(
      'email' => $email,
      'phone' => $phone
    );

    $this->db->where('id', $id);
    $this->db->update('tb_user', $data);

    echo json_encode(
      array(
        "status" => true,
        "messsage" => "success",
      )
    );
  }

  public function changeType()
  {
    $log_id = $this->input->post('log_id');
    $type = $this->input->post('type');

    $this->db->query("UPDATE tb_attempt SET type = '$type' WHERE id = $log_id");

    echo json_encode(
      array(
        "status" => true,
        "messsage" => "success",
      )
    );
  }

  public function history_leave()
  {
    $this->load->view('employee/v_header');
    $this->load->view('employee/v_history_leave');
    $this->load->view('employee/v_footer');
  }

  public function dataHistoryLeave()
  {
    $nik = $this->session->userdata('ses_nik');

    // DB table to use
    $table = "(SELECT
                lr.l_request_id, lr.start_date, lr.end_date, lr.amount_leave, lr.status
              FROM cuti_db.leave_request lr
              JOIN cuti_db.employe e ON (lr.employe_id = e.employe_id)
              WHERE e.nik = '$nik') temp";

    // Table's primary key
    $primaryKey = 'l_request_id';

    // Array of database columns which should be read and sent back to DataTables.
    // The `db` parameter represents the column name in the database, while the `dt`
    // parameter represents the DataTables column identifier. In this case simple
    // indexes
    $columns = array(
      array('db' => 'l_request_id', 'dt' => 'l_request_id'),
      array('db' => 'start_date', 'dt' => 'start_date'),
      array('db' => 'end_date', 'dt' => 'end_date'),
      array('db' => 'amount_leave', 'dt' => 'amount_leave'),
      array('db' => 'status', 'dt' => 'status'),
      // array('db' => 'iodate', 'dt' => 'iodate'),
      // array('db' => 'time', 'dt' => 'time'),
      // array('db' => 'type', 'dt' => 'type'),
      // array('db' => 'shift', 'dt' => 'shift'),
      // array('db' => 'description', 'dt' => 'description'),
      // array('db' => 'status', 'dt' => 'status'),
    );

    // SQL server connection information
    $sql_details = array(
      'user' => 'root',
      'pass' => '',
      'db'   => 'db_absen',
      'host' => 'localhost'
    );

    echo json_encode(
      SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
    );
  }

  public function holidayName($date)
  {
    return $this->db->query(
      "SELECT
        *
      FROM holiday
      WHERE holiday_date = '$date'"
    )->row();
  }

  public function saveLateReason()
  {
    $attendanceID = $this->input->post('attendance_id');
    $lateReason = $this->input->post('late_reason');

    $this->db->query(
      "UPDATE attendance SET late_reason = '$lateReason'
      WHERE attendance_id = $attendanceID"
    );

    echo json_encode(
      array(
        "status" => true,
        "messsage" => "success",
        // "data" => array(
        //   "id" => $attendanceID,
        //   "reason" => $lateReason
        // )
      )
    );
  }

  public function editManual()
  {
    $id = $this->input->post('attendance_manual_id');
    $time = $this->input->post('new_time');
    $description = $this->input->post('new_description');
    $shift_id = $this->input->post('new_shift');

    $data = array(
      'time' => $time,
      'description' => $description,
      'shift_id' => $shift_id
    );

    $this->db->where('attendance_manual_id', $id);
    $this->db->update('attendance_manual', $data);

    echo json_encode(
      array(
        "status" => true,
        "messsage" => "success",
        "data" => $data,
        "id" => $id
      )
    );
  }

  public function cancelManual()
  {
    $attendance_manual_id = $this->input->post('id');

    $this->db->query(
      "UPDATE attendance_manual SET isactive = 'N'
      WHERE attendance_manual_id = $attendance_manual_id"
    );

    echo json_encode(
      array(
        "status" => true,
        "messsage" => "success",
        "attendance_manual_id" => $attendance_manual_id
      )
    );
  }
}
