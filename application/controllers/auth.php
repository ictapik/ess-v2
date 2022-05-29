<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['model_login', 'model_master']);
        // if ($this->session->userdata('masuk') != TRUE) {
        //     $url = base_url();
        //     redirect($url);
        // }
    }

    function index()
    {
        $this->load->view('v_login_2');
    }

    function login()
    {
        $username       = htmlspecialchars($this->input->post('id_karyawan', TRUE), ENT_QUOTES);
        $password       = htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES);

        if ($username == "") {
            $url = base_url('auth');
            redirect($url);
        } else {
            $cek_admin      = $this->model_login->auth($username, $password);
            if ($cek_admin->num_rows() > 0) { //jika login sebagai admin
                $data = $cek_admin->row_array();
                $this->session->set_userdata('masuk', TRUE);
                if ($data['User_Lvl'] == 'Doctor') { //Akses admin
                    $this->session->set_userdata('akses', '1');
                    $this->session->set_userdata('ses_id', $data['User_ID']);
                    $this->session->set_userdata('ses_nama', $data['User_Name']);
                    redirect('employee/dashboard');
                } else {
                    $this->session->set_userdata('masuk', TRUE);
                    $this->session->set_userdata('akses', '3');
                    $this->session->set_userdata('ses_id', $data['id']);
                    $this->session->set_userdata('ses_nik', $data['id_karyawan']);
                    $this->session->set_userdata('ses_nama', $data['nama_karyawan']);
                    $this->session->set_userdata('ses_jk', $data['jenis_kelamin']);
                    redirect('employee/dashboard');
                }
            } else { //jika login sebagai user
                // jika username dan password tidak ditemukan atau salah
                echo $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Username atau Password salah !!</div></div>");
                $url = base_url('auth');
                redirect($url);
            }
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        $url = base_url('auth');
        redirect($url);
    }

    //  FUNCTION DELETE ADMIN
    function deleteAdmin()
    {
        $id = $this->uri->segment(3);
        $this->model_master->deleteAdmin($id);
        redirect("admin/a_admin");
    }

    //  FUNCTION DELETE BUKU
    function deleteBuku()
    {
        $id = $this->uri->segment(3);
        /* query menampilkan gambar dibuat dulu agar gambarnya dihapus sebelum dihapus dari database */
        $path = 'assets/qrcode/';
        $ardel  = array('id_buku' => $id);
        $rowdel = $this->model_master->getBookById($id);
        /* file gambar dihapus dari folder */
        @unlink($path . $rowdel->qr_code);
        /* query hapus dilanjutkan ke model get_delete */
        $this->model_master->deleteBuku($id); //karna array where querynya sama, maka saya langsung include saja $ardel
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Berhasil hapus data buku dan file qr code dari folder !!</div></div>");
        redirect('admin/a_buku'); /* jika berhasil maka akan kembali ke home upload */
    }

    function deleteUser()
    {
        $id = $this->uri->segment(3);
        /* query menampilkan gambar dibuat dulu agar gambarnya dihapus sebelum dihapus dari database */
        $path = 'assets/qrcode/karyawan/';
        $ardel  = array('id_karyawan' => $id);
        $rowdel = $this->model_master->getUserById($id);
        /* file gambar dihapus dari folder */
        @unlink($path . $rowdel->qr_code);
        /* query hapus dilanjutkan ke model get_delete */
        $this->model_master->deleteUser($id); //karna array where querynya sama, maka saya langsung include saja $ardel
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Berhasil hapus data buku dan file qr code dari folder !!</div></div>");
        redirect('admin/a_user'); /* jika berhasil maka akan kembali ke home upload */
    }

    function deleteLaporan()
    {
        $id = $this->uri->segment(3);
        /* query menampilkan gambar dibuat dulu agar gambarnya dihapus sebelum dihapus dari database */
        $path = 'assets/qrcode/peminjam/';
        $ardel  = array('id_pinjaman' => $id);
        $rowdel = $this->model_master->getPeminjamById($id);
        /* file gambar dihapus dari folder */
        @unlink($path . $rowdel->qr_code);
        /* query hapus dilanjutkan ke model get_delete */
        $this->model_master->deletePinjaman($id); //karna array where querynya sama, maka saya langsung include saja $ardel
        $this->model_master->deleteDPinjaman($id);
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Berhasil hapus data buku dan file qr code dari folder !!</div></div>");
        redirect('admin/a_laporan'); /* jika berhasil maka akan kembali ke home upload */
    }

    // FUNCTION DELETE ITEM BUKU
    function deleteItemBuku()
    {
        $id =  $this->uri->segment(3);
        $this->model_master->deleteItemBuku($id);
        redirect('admin/a_peminjaman');
    }
}
