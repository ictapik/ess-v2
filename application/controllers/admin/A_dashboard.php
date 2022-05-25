<?php
defined('BASEPATH') or exit('No direct script access allowed');

class A_dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_master');
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url();
			redirect($url);
		}
	}

	public function index()
	{
		$data = [
			'today' => $this->model_master->getCountAttendance(date('Y-m-d')),
			'yesterday' => $this->model_master->getCountAttendance(date('Y-m-d', strtotime('-1 day'))),
			'activeUser' => $this->model_master->getCountUser('active'),
			'nonactiveUser' => $this->model_master->getCountUser('nonactive'),
			'allUser' => $this->model_master->getCountUser('all'),
		];
		$this->load->view('admin/v_dashboard', $data);
	}

	public function attendance($date = null)
	{
		$data = [
			'attendance' => $this->model_master->getDetailAttendance($date),
		];
		$this->load->view('admin/v_attendance_detail', $data);
	}

	public function today()
	{
		$data = [
			'attendance_today' => $this->model_master->getDetailAttendanceToday(),
		];
		$this->load->view('admin/v_attendance_today', $data);
		// $this->model_master->getDetailAttendanceToday();
	}

	function exportData()
	{
		$absen = $this->db->get_where('tb_attempt', ['status' => 0])->result();

		// foreach ($absen as $row){
		// }
		// write_file('./assets/test.txt', $row['result'], 'r+');
		// foreach ($absen as $row){
		// 	write_file('./assets/test.txt', $row->result);
		// }

		$isi = 'Here is some text!';
		$nama_file = 'mytext.txt';

		force_download($nama_file, $isi);
	}
}
