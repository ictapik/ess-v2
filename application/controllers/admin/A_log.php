<?php
defined('BASEPATH') or exit('No direct script access allowed');

class A_log extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_master');
        $this->load->library('ssp');
    }

    function index()
    {
        // $data = [
        //     'absen' => $this->model_master->getAbsen()
        // ];
        // $this->load->view('admin/v_data_log', $data);
        $this->load->view('admin/v_data_log');
    }

    public function show()
    {

        // DB table to use
        // $table = 'attemp_unprocessed';
        $table = "(SELECT a.id, a.nik, a.timestamp, a.type as inout_type, a.source, u.nama_karyawan AS employee_name, st.name AS shift_type_name, a.isactive FROM tb_attempt a JOIN tb_user u ON a.nik = u.id_karyawan JOIN shift_type st ON u.shift_type_id = st.shift_type_id) temp";
        // $table = "SELECT id, nik, nama_karyawan, cast(tanggal as date) tanggal, min(clockin) cin, max(clockout) cout,  name shift, department_name FROM attemp_unprocessed GROUP BY nik, cast(tanggal as date), nama_karyawan, name";

        // Table's primary key
        $primaryKey = 'id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array('db' => 'id', 'dt' => 'id'),
            array('db' => 'nik', 'dt' => 'nik'),
            array('db' => 'employee_name', 'dt' => 'employee_name'),
            array('db' => 'timestamp', 'dt' => 'timestamp'),
            array('db' => 'inout_type', 'dt' => 'inout_type'),
            array('db' => 'shift_type_name', 'dt' => 'shift_type_name'),
            array('db' => 'source', 'dt' => 'source'),
            array('db' => 'isactive', 'dt' => 'isactive'),
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

    public function find($nik, $date)
    {
        $data = [
            'absen' => $this->model_master->getAbsen($nik, $date)
        ];
        $this->load->view('admin/v_data_log_find', $data);
        // echo json_encode($this->model_master->getAbsen($nik, $date));
    }

    public function ajax_switch()
    {
        $id = $this->input->get('id');

        $cek = $this->model_master->ajax_cek_switch_log($id);
        if ($cek == 'Y') {
            $isactive = "N";
        } else {
            $isactive = "Y";
        }
        $this->model_master->ajax_switch_log($id, $isactive);
    }

    public function change_type()
    {
        $id = $this->input->get('id');
        $type = $this->input->get('type');

        if ($type == 512) { //in
            $type = "0002000"; //out
        } else {
            $type = "0001000";
        }

        return $this->db->query("UPDATE tb_attempt SET type = '$type' WHERE id = $id");
    }
}
