<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forgot_password extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    // if ($this->session->userdata('masuk') != TRUE) {
    //   $url = base_url('auth');
    //   redirect($url);
    // }
    $this->load->model('model_employee');
    $this->load->model('model_email');
  }

  public function index()
  {
    // Konfigurasi email
    $config = [
      'mailtype'  => 'html',
      'charset'   => 'utf-8',
      'protocol'  => 'smtp',
      'smtp_host' => 'ssl://mail.adyawinsa.com',
      'smtp_user' => 'sicuti@adyawinsa.com',  // Email gmail
      'smtp_pass'   => 'SICUTI@202204',  // Password gmail
      'smtp_crypto' => 'ssl',
      'smtp_port'   => 465,
      'crlf'    => "\r\n",
      'newline' => "\r\n"
    ];

    // Load library email dan konfigurasinya
    $this->load->library('email', $config);
    // Email dan nama pengirim
    $this->email->from('no-reply@masrud.com', 'MasRud.com');
    // Email penerima
    $this->email->to('wahyu.hidayat@gmail.com'); // Ganti dengan email tujuan
    // Lampiran email, isi dengan url/path file
    $this->email->attach('https://images.pexels.com/photos/169573/pexels-photo-169573.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');
    // Subject email
    $this->email->subject('Kirim Email dengan SMTP Gmail CodeIgniter | MasRud.com');
    // Isi email
    $this->email->message("Ini adalah contoh email yang dikirim menggunakan SMTP Gmail pada CodeIgniter.<br><br> Klik <strong><a href='https://masrud.com/kirim-email-codeigniter/' target='_blank' rel='noopener'>disini</a></strong> untuk melihat tutorialnya.");

    // Tampilkan pesan sukses atau error
    if ($this->email->send()) {
      echo 'Sukses! email berhasil dikirim.';
    } else {
      echo 'Error! email tidak dapat dikirim.';
    }
  }

  function sendEmail()
  {
    $dataEmail = $this->model_email->getAll();

    // $email = $this->input->post('email');
    $email = "wahyu.hidayat@adyawinsa.com";

    $dataUser = $this->model_employee->getEmpByEmail($email);
    $id = $dataUser->id;

    //kode pemulihan
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $generateCode = substr(str_shuffle($permitted_chars), 0, 255);

    //expired code 1x24 jam
    $date = date('Y-m-d H:i:s');
    $tomorrow = date('Y-m-d H:i:s', strtotime($date . "+1 days"));
    $pwd_recovery_exp = $tomorrow;

    // simpan kode pemulihan di database
    $this->db->query(
      "UPDATE 
        tb_user
      SET 
        pwd_recovery_code = '$generateCode', 
        pwd_recovery_exp = '$pwd_recovery_exp'
      WHERE id = $id"
    );

    $this->load->library('email');
    $config = [
      'protocol' => 'smtp',
      'smtp_host' => $dataEmail->host,
      'smtp_port' => $dataEmail->port,
      'smtp_timeout' => 5,
      'smtp_user' => $dataEmail->username,
      'smtp_pass' => $dataEmail->password,
      'smtp_keepalive' => 'TRUE',
      'mailtype' => 'html',
      'charset' => 'iso-8859-1'
    ];
    $this->email->initialize($config);

    $this->email->from('sicuti@adyawinsa.com', 'EMPLOYEE SELF SERVICE');
    $this->email->to($dataUser->email);
    $this->email->subject('ESS - Kode Pemulihan Kata Sandi');

    $htmlContent = "Hi, $dataUser->nama_karyawan<br><br>";
    $htmlContent .= "Kami menerima permintaan pemulihan kata sandi untuk akun Employee Self Service anda.<br>";
    $htmlContent .= "Link pemulihan anda:<br><br>";
    $htmlContent .= "<b><a href='" . base_url('forgot_password/change') . '/' . $id . '/' . $generateCode . "'>Klik Disini</a></b><br><br>";
    $htmlContent .= "Jika anda tidak merasa meminta pemulihan akun, maka abaikan pesan ini.<br><br><br>";
    $htmlContent .= "Employee Self Service<br>";
    $htmlContent .= "PT. Adyawinsa Plastics Industry";

    $this->email->message($htmlContent);

    if ($this->email->send()) { // Mengirim Email
      $sts = 'success';
    } else {
      $sts = 'error';
    }
    echo '{"status":"' . $sts . '"}';
  }

  public function change($id, $code)
  {
    // lakukan pengecekan apakah id tersebut
    // 1. kode sama
    // 2. expired date belum terlewat
    // jika true maka tampilkan halaman ubah password
    // jika false maka notif bahwa kode pemulihan tidak valid
    $today = date('Y-m-d H:i:s');

    $check = $this->db->query(
      "SELECT 
        *
      FROM tb_user
      WHERE id = $id
      AND pwd_recovery_code = '$code'
      and pwd_recovery_exp > '$today'"
    );

    if ($check->num_rows > 0) {
      $data = array(
        "id" => $id,
        "code" => $code
      );
      $this->load->view('change_pwd.php', $data);
    } else {
      echo "tidak valid";
    }

    // var_dump($check->row());
    // echo json_encode($check);
  }
}
