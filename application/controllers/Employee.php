<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_employee', 'me');
        $this->load->library('ssp');
    }

    public function index()
    {
        $this->load->view('employee/header');
        $this->load->view('employee/v_dashboard');
        $this->load->view('employee/footer');
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

        $this->load->view('employee/header');
        $this->load->view('employee/v_dashboard', $data);
        $this->load->view('employee/footer');
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

        $this->load->view('employee/header');
        $this->load->view('employee/v_attendance', $data);
        $this->load->view('employee/footer');
    }

    public function log()
    {
        $nik = $this->session->userdata('ses_nik');

        $data = array(
            'log' => $this->me->getLog($nik),
        );

        $this->load->view('employee/header');
        $this->load->view('employee/v_log', $data);
        $this->load->view('employee/footer');
    }

    public function find($nik, $date, $attendance_id, $type)
    {
        //type 1 = IN; type 2 = OUT
        $data = [
            'absen' => $this->me->getAbsen($nik, $date),
            'attendance_id' => $attendance_id,
            'type' => $type
        ];

        $this->load->view('employee/header');
        $this->load->view('employee/v_find_log', $data);
        $this->load->view('employee/footer');
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

        $this->load->view('employee/header');
        $this->load->view('employee/v_profile', $data);
        $this->load->view('employee/footer');
    }

    public function changePassword()
    {
        $nik = $this->session->userdata('ses_nik');
        $old_password = md5(trim($this->input->post("old_password")));
        $new_password = md5(trim($this->input->post("new_password")));
        $new_password2 = md5(trim($this->input->post("new_password2")));

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
    }

    public function failedtoattend()
    {
        $nik = $this->session->userdata('ses_nik');

        $data = array(
            "failedattend" => $this->db->get_where("failed_to_attend", array("nik" => $nik))->result()
        );

        $this->load->view('employee/header');
        $this->load->view('employee/v_failedtoattend', $data);
        $this->load->view('employee/footer');
    }

    public function saveFailedToAttend()
    {
        $nik = $this->session->userdata('ses_nik');

        $tanggal = $this->input->post('tanggal');
        $jam = $this->input->post('jam');
        $keterangan = $this->input->post('keterangan');
        // $tanggal = "2022-04-16";
        // $jam = "15:35";
        // $keterangan = "Percobaan";

        $data = array(
            "nik" => $nik,
            "tanggal" => $tanggal,
            "jam" => $jam,
            "keterangan" => $keterangan,
            "created" => date('Y-m-d H:i:s'),
            "createdby" => $nik
        );

        $insert = $this->db->insert('failed_to_attend', $data);

        if ($insert) {
            echo json_encode(array(
                'status' => true,
                'message' => 'success'
            ));
        } else {
            echo json_encode(array(
                'status' => false,
                'message' => 'error'
            ));
        }
    }

    public function showAttendance()
    {
        $nik = $this->session->userdata('ses_nik');

        // DB table to use
        // $table = 'attemp_unprocessed';
        $table = "(SELECT 
                        a.*,  CAST(SUBSTRING(a.attendance_id, 1,8) AS date) AS tanggal, UPPER(u.nama_karyawan) AS nama_karyawan, d.name AS department, s.name AS shift_name
                    FROM attendance a
                    JOIN tb_user u ON (a.nik = u.id_karyawan)
                    LEFT JOIN shift s ON (a.shift_id = s.shift_id)
                    JOIN department d ON (u.department_id = d.department_id)
                    WHERE nik = '$nik') temp";
        // $table = "SELECT id, nik, nama_karyawan, cast(tanggal as date) tanggal, min(clockin) cin, max(clockout) cout,  name shift, department_name FROM attemp_unprocessed GROUP BY nik, cast(tanggal as date), nama_karyawan, name";

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

    public function getShiftByNIK($nik)
    {
        // $nik = $this->input->post('nik');
        $data = $this->db->query("SELECT 
                                    * 
                                FROM shift 
                                WHERE isactive = 'Y'
                                AND shift_type_id = (
                                    SELECT shift_type_id
                                    FROM tb_user
                                    WHERE id_karyawan = '$nik'
                                )")->result();
        echo json_encode($data);
    }

    public function ajaxLog()
    {
        echo json_encode(array(
            "status" => true,
            "message" => "success",
            "data" => "data"
        ));
    }

    public function saveAttendance()
    {
        // INSERT INTO attendance_manual (attendance_id, nik, time, type, iodate, shift_id, created, createdby)
        // VALUES (202205091631745, '1631745', '07:15:25', 'IN', '2022-05-09', 1, NOW(), 100);

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

        $this->load->view('employee/header');
        $this->load->view('employee/v_history', $data);
        $this->load->view('employee/footer');
    }

    public function dataHistory()
    {
        // $data = $this->me->getAllHistory();
        $nik = $this->session->userdata('ses_nik');

        // DB table to use
        $table = "(SELECT 
                    am.attendance_manual_id, am.nik, am.iodate, am.time, am.type, am.description, am.isapproved AS status, s.name AS shift, u.nama_karyawan, d.name AS department
                    FROM attendance_manual  am
                    JOIN tb_user u ON (am.nik = u.id_karyawan)
                    JOIN department d ON (u.department_id = d.department_id)
                    JOIN shift s ON (am.shift_id = s.shift_id)
                    WHERE nik = '$nik' 
                    AND isapproved <> 0
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
            // array('db' => 'processed', 'dt' => 'processed'),
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

    public function getAllLateDate($nik, $start, $end)
    {
        $data = $this->db->query(
            "SELECT
            a.attendance_id, a.iodate, a.time_in, a.time_out, s.name as shift
        FROM attendance a
        JOIN shift s ON (a.shift_id = s.shift_id)
        WHERE nik = '$nik'
        AND a.time_in > s.start
        AND iodate BETWEEN '$start' AND '$end'"
        )->result();

        echo json_encode($data);
    }
}
