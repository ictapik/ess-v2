<?php
defined('BASEPATH') or exit('No direct script access allowed');

class A_user extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_master');
    }

    function index()
    {
        $data = array(
            'data_user' => $this->model_master->getAllUser(),
            'department' => $this->db->query("SELECT * FROM department")->result(),
            'shift_type' => $this->db->query("SELECT * FROM shift_type")->result(),
        );
        $this->load->view('admin/v_data_user', $data);
    }

    public function detail($type)
    {
        $data = array(
            'data_user' => $this->model_master->getDataUser($type),
        );
        $this->load->view('admin/v_data_user_detail', $data);
    }

    //  FUNCTION INSERT USER
    function insertUser()
    {
        $id_karyawan = $this->input->post('id_karyawan');
        $nama_karyawan = $this->input->post('nama_karyawan');
        $department = $this->input->post('department');
        $shift_type = $this->input->post('shift_type');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $alamat = $this->input->post('alamat');
        $email = $this->input->post('email');

        $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/qrcode/karyawan/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $id_karyawan . '.png'; //buat name dari qr code sesuai dengan id_buku

        $params['data'] = $id_karyawan; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        $this->model_master->insertUser($id_karyawan, $nama_karyawan, $department, $shift_type, $jenis_kelamin, $alamat, $email, $image_name); //simpan ke database

        $this->load->library('email');
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.mailtrap.io',
            'smtp_port' => 465,
            'smtp_timeout' => 50,
            'smtp_user' => '4d6faa05b2fee9',
            'smtp_pass' => 'c686513c698224',
            'smtp_keepalive' => 'TRUE',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'newline' => "\r\n"
        ];
        $this->email->initialize($config); # Menginisialisasi konfigurasi email
        $this->email->from('no-reply@perpus.dexa.com', 'Perpustakaan PT. DEXA GROUP'); # Nama pengirim
        $this->email->to($email); # Akan dikirim ke email karyawan
        $this->email->subject('ID QR-Code'); # Subjeknya / Judul emailnya.
        $qrcode['base_url'] = "http://" . $_SERVER['HTTP_HOST'];
        $qrcode['base_url'] .= preg_replace('@/+$@', '', dirname($_SERVER['SCRIPT_NAME'])) . '/';
        $htmlContent = '<table>
                                <tr><td colspan="3">Dengan Hormat,</td></tr>
                                <tr><td colspan="3">Berikut ini QR-Code yang dapat digunakan saat melakukan peminjaman buku :</td></tr>
                                <tr>
                                <td colspan="3" align="center">
                                <table>
                                <tr>
                                    <td>ID Karyawan</td>
                                    <td>:</td>
                                    <td><b>' . $id_karyawan . '</b></td>
                                </tr>
                                <tr>
                                    <td>Nama Karyawan</td>
                                    <td>:</td>
                                    <td><b>' . $nama_karyawan . '</b></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Daftar</td>
                                    <td>:</td>
                                    <td><b>' . jin_date_ina(date('Y-m-d')) . '</b></td>
                                </tr>
                                <tr>
                                    <td>QR-Code</td>
                                    <td>:</td>
                                    <td><img style="width: 100px;" src="' . "http://" . $_SERVER['HTTP_HOST'] . '/assets/qrcode/karyawan/' . $id_karyawan . '.png"</td>
                                </tr>
                                </table>
                                </td>
                                </tr>
                                <tr><td colspan="3" align="justify">Bukti QR-Code tersebut harus dibawa saat peminjaman buku di Perpustakaan.</td></tr>
                                <tr></tr>
                                <tr><td colspan="3">Demikian yang bisa kami sampaikan, kurang lebihnya kami mohon maaf. Atas perhatiannya kami ucapkan terimakasih.</td></tr>
                              </table>';
        $this->email->message($htmlContent);
        # Mengirim Email 
        if ($this->email->send()) {
            echo 'Email berhasil dikirim';
        } else {
            echo 'Email tidak berhasil dikirim';
            echo '<br />';
            echo $this->email->print_debugger();
        }

        redirect('admin/a_user'); //redirect ke controller a_buku setelah simpan data
    }

    //  FUNCTION UPDATE USER
    function updateUser()
    {
        $id = $this->input->post('id_karyawan');
        $nama_karyawan = $this->input->post('nama_karyawan');
        $department = $this->input->post('edit_department');
        $shift = $this->input->post('edit_shift_type');
        $status = $this->input->post('edit_status');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $alamat = $this->input->post('alamat');
        $email = $this->input->post('email');
        $qr_code = $this->input->post('qr_code');

        $data = array(
            'nama_karyawan' => $nama_karyawan,
            'department_id' => $department,
            'shift_type_id' => $shift,
            'isactive'      => $status,
            'jenis_kelamin' => $jenis_kelamin,
            'alamat' => $alamat,
            'email' => $email,
            'qr_code' => $qr_code
        );

        $this->model_master->updateUser($data, $id);
        redirect("admin/a_user");
    }

    public function reGenerateQR($nik)
    {
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/qrcode/karyawan/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $nik . '.png'; //buat name dari qr code sesuai dengan id_buku

        $params['data'] = $nik; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        redirect('assets/qrcode/karyawan/' . $nik . '.png');
    }

    public function ajax_switch()
    {
        $id = $this->input->get('id');

        $cek = $this->model_master->ajax_cek_switch($id);
        if ($cek == 'Y') {
            $isactive = "N";
        } else {
            $isactive = "Y";
        }
        $this->model_master->ajax_switch($id, $isactive);
    }
}
