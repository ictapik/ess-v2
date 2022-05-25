<?php
class Model_login extends CI_Model
{

    //  CEK ID & PASSWORD
    function auth($username, $password)
    {
        $pwd = md5($password);
        return $this->db->query("SELECT * FROM tb_user WHERE id_karyawan='$username' AND password='$pwd' LIMIT 1");
    }
}
