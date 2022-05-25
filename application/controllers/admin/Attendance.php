<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attendance extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_master', 'mm');
        $this->load->library('ssp');
    }

    function index()
    {
        // $data['attendance'] = $this->mm->getAttendance();
        // $this->load->view('admin/v_attendance', $data);
        $this->load->view('admin/v_attendance');
    }

    public function show()
    {
        // DB table to use
        // $table = 'attemp_unprocessed';
        $table = "(SELECT id, nik, nama_karyawan, cast(tanggal as date) tanggal, min(clockin) cin, max(clockout) cout,  name shift, department_name FROM attemp_unprocessed GROUP BY nik, cast(tanggal as date), nama_karyawan, name) temp";
        // $table = "SELECT id, nik, nama_karyawan, cast(tanggal as date) tanggal, min(clockin) cin, max(clockout) cout,  name shift, department_name FROM attemp_unprocessed GROUP BY nik, cast(tanggal as date), nama_karyawan, name";

        // Table's primary key
        $primaryKey = 'id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array('db' => 'nik', 'dt' => 'nik'),
            array('db' => 'nama_karyawan', 'dt' => 'nama_karyawan'),
            array('db' => 'department_name', 'dt' => 'department_name'),
            array('db' => 'tanggal', 'dt' => 'tanggal'),
            array('db' => 'cin', 'dt' => 'cin'),
            array('db' => 'cout', 'dt' => 'cout'),
            array('db' => 'shift', 'dt' => 'shift'),
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

    public function monthlySummary()
    {
        // $unprocessed = $this->db->query(
        //     "SELECT * FROM attemp_unprocessed"
        // )->result();

        $unprocessed = $this->db->query(
            "SELECT 
                -- nik, nama_karyawan, cast(tanggal as date) tanggal, min(clockin) cin, max(clockout) cout,  name shift, department_name
                tanggal, min(clockin) cin, max(clockout) cout, 
            FROM attemp_unprocessed
            GROUP BY nik, cast(tanggal as date), nama_karyawan, name LIMIT 20"
        )->result();

        $array = array();

        foreach ($unprocessed as $row) {
            //query data lain
            //query data lain

            echo $row->tanggal . "<br>";
            echo $row->cin . "<br>";
            echo $row->cout . "<br>";
            echo "<hr>";

            $data = array(
                //
            );

            // array_push($array, $data);
        }

        //insert batch here

        // echo json_encode($unprocessed);

        // echo json_encode(array(
        //     'status' => 'success',
        //     'message' => 'ajax berhasil'
        // ));
    }
}
