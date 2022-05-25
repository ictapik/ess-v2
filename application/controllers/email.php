<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

     public function send()
     {
          $this->load->library('email');
          $config = ['protocol' => 'smtp',
                     'smtp_host' => 'smtp.mailtrap.io',
                     'smtp_port' => 465,
                     'smtp_timeout' => 50, 
                     'smtp_user' => '4d6faa05b2fee9',
                     'smtp_pass' => 'c686513c698224',
                     'smtp_keepalive' => 'TRUE',
                     'mailtype' => 'html',
                     'charset' => 'iso-8859-1',
                     'newline' => "\r\n"];
          $this->email->initialize($config); # Menginisialisasi konfigurasi email
          $this->email->from('no-reply@bahasaweb.com', 'Sistem Bahasaweb.com'); # Nama pengirim
          $this->email->to('admin@bahasaweb.com'); # Akan dikirim ke email karyawan
          $this->email->subject('Pengajuan Penangguhan Anda'); # Subjeknya / Judul emailnya.
          $htmlContent = '<table>
                                <tr><td colspan="3">Dengan Hormat,</td></tr>
                                <tr><td colspan="3">Berdasarkan pengajuan penangguhan cuti yang anda ajukan, dengan data sebagai berikut :</td></tr>

                                <tr>
                                <td colspan="3" align="center">
                                <table>
                                <tr><td>Jumlah Hak Cuti</td><td>:</td><td><b>Hari</b></td></tr>
                                <tr><td>Periode Penangguhan</td><td>:</td><td><b></b></td></tr>
                                </table>
                                </td>
                                </tr>

                                <tr><td colspan="3" align="justify">Setelah meninjau pengajuan tersebut dan telah melalui beberapa pertimbangan maka kami memutuskan bahwa pengajuan penangguhan cuti anda telah :</td></tr>
                                
                                <tr></tr>
                                <tr><td colspan="3">Demikian yang bisa kami sampaikan, kurang lebihnya kami mohon maaf. Atas perhatiannya kami ucapkan terimakasih.</td></tr>
                                <tr><td rowspan="7" colspan="3" align="right">
                                Bekasi, 
                                <br>Hormat Kami<br><br></td>
                                </tr>
                                <tr><td></td></tr>
                                <tr><td></td></tr>
                                <tr><td></td></tr>
                                <tr><td></td></tr>
                                <tr><td></td></tr>
                                <tr><td></td></tr>
                                <tr><td colspan="3" align="right">TTD.<br>Manajemen Dept. </td></tr>

                              </table>';
              $this->email->message($htmlContent);
              # Mengirim Email 
              if($this->email->send()) {
               echo 'Email berhasil dikirim';
               }
               else {
                    echo 'Email tidak berhasil dikirim';
                    echo '<br />';
                    echo $this->email->print_debugger();
               }
     }

}