<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class A_admin extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model('model_master');
	}

    function index() 
    {
        $data=array('id_admin'=>$this->model_master->getIdAdmin(),
					'data_admin'=>$this->model_master->getAllAdmin(),
                    'data_user'=>$this->model_master->getAllUser()
        );
        $this->load->view('admin/v_data_admin',$data);
    }

    //	FUNCTION INSERT ADMIN
    function insertAdmin()
    {
    	$data=array(
            'id'=>$this->model_master->getIdAdmin(),
			'id_karyawan'=>$this->input->post('id_karyawan'),
			'nama_admin'=>$this->input->post('nama_admin'),
            'password'=>$this->input->post('password'));
        $this->model_master->insertAdmin($data);
        redirect("admin/a_admin");
    }

    //	FUNCTION UPDATE ADMIN
    function updateAdmin(){
    	$id = $this->input->post('id');
    	$id_karyawan = $this->input->post('id_karyawan');
    	$nama_admin = $this->input->post('nama_admin');
    	$password = $this->input->post('password');
        $data=array('id_karyawan'=>$id_karyawan,
    				'nama_admin'=>$nama_admin,
    				'password'=>$password,);
        $this->model_master->updateAdmin($data,$id);
        redirect("admin/a_admin");
    }

}
