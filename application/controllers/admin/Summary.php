<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Summary extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_master', 'mm');
    }

    public function index()
    {
        $data['summary'] = $this->mm->getSummary();
        $this->load->view('admin/v_summary', $data);
    }

    public function monthlySummary()
    {
        //tahun dan bulan yang akan disummary berdasarkan input
        $month = $this->input->post('month');
        // $month = "2022/04/01";

        //cari tanggal terakhir di bulan tersebut
        $date = date_format(date_create($month), "Y-m-d");
        $year = date("Y", strtotime($date));
        $month = date("m", strtotime($date));
        $last_date = date("t", strtotime($date));

        //foreach semua karyawan yang statusnya aktif
        $employee = $this->db->query(
            "SELECT DISTINCT(id_karyawan)
            FROM tb_user
            WHERE isactive = 'Y'"
        )->result();

        foreach ($employee as $employee) {
            $nik = $employee->id_karyawan;
            //looping dari tanggal 1 sampai tanggal akhir bulan bulan
            for ($i = 1; $i <= $last_date; $i++) {
                //buat attendance ID untuk disimpan ke tabel
                $attendance_id = $year . $month . sprintf('%02d', $i) . $nik;
                // echo $attendance_id . "<br>";

                $tanggal = $year . "-" . $month . "-" . sprintf('%02d', $i);
                // echo $tanggal . "<br>";
                // echo $nik . "<br>";

                //cek ditanggal tersebut apakah karyawan ada absen in dan out
                $dataAttendance = $this->db->query(
                    "SELECT 
                        nik, nama_karyawan, cast(tanggal as date) tanggal, min(clockin) cin, max(clockout) cout,  name shift, department_name
                    FROM attemp_unprocessed
                    WHERE nik = '$nik' AND tanggal = '$tanggal'
                    GROUP BY nik, cast(tanggal as date), nama_karyawan, name"
                )->row();

                //time in
                if (isset($dataAttendance->cin)) {
                    $time_in = substr($dataAttendance->cin, 0, 5);
                } else {
                    $time_in = "";
                }

                //time out
                if (isset($dataAttendance->cout)) {
                    $time_out = substr($dataAttendance->cout, 0, 5);
                } else {
                    $time_out = "";
                }

                // echo $time_in . "<br>";
                // echo $time_out . "<br>";

                // echo "<hr>";

                //persiapan data
                // $user_id = $nik;
                // $iodate = "";
                // $calendar = ""; //Working Day, Holiday
                // $shift_id = "";
                // $id_in = "";
                // $id_out = "";
                // $created = date('Y-m-d H:i:s');
                // $createdby = 0;
                // $updated = date('Y-m-d H:i:s');
                // $updatedby = 0;

                // echo $time_in . "<br>";

                //cek apakah attendance ID tersebut sudah ada atau belum
                //jika ada maka update
                //jika tidak ada maka insert
                $this->db->query(
                    "INSERT INTO 
                    attendance(attendance_id, nik, time_in, time_out) 
                    VALUES('$attendance_id', '$nik', '$time_in', '$time_out')"
                );

                //jika tanggal sekarang sama dengan tanggal summary, maka hentikan looping
                if (date('Y-m-d') == $tanggal) {
                    break;
                }
            }
        }

        // echo json_encode($employee);



        echo json_encode(array(
            "status" => true,
            "message" => "success",
            //     "month" => $month,
            //     "last_date" => $last_date,
            //     // "data" => $data,
        ));
    }
}
