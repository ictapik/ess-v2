<?php
class Model_master extends CI_Model
{
    //  GET DATA
    function getAbsen($nik = null, $date = null)
    {
        if ($nik == null && $date == null) {
            // return $this->db->get_where('tb_attempt', ['status' => 0])->result_array();
            // return $this->db->get_where('tb_attempt')->result_array();
            $data = $this->db->query(
                "SELECT
                    a.id, a.nik, a.timestamp, a.type as inout_type, a.source, u.nama_karyawan AS employee_name, st.name AS shift_type_name, a.isactive
                FROM tb_attempt a
                JOIN tb_user u ON a.nik = u.id_karyawan
                JOIN shift_type st ON u.shift_type_id = st.shift_type_id"
            )->result_array();
            return $data;
        } else {
            $date = strtotime($date);
            $tomorrow = date('Y-m-d', strtotime("+1 days", $date));
            $yesterday = date('Y-m-d', strtotime("-1 days", $date));

            // $today = date('Y-m-d');
            // $yesterday = date('Y-m-d', strtotime("-1 days"));

            $data = $this->db->query(
                "SELECT
                    a.id, a.nik, a.timestamp, a.type as inout_type, a.source, u.nama_karyawan AS employee_name, st.name AS shift_type_name, a.isactive
                FROM tb_attempt a
                JOIN tb_user u ON a.nik = u.id_karyawan
                JOIN shift_type st ON u.shift_type_id = st.shift_type_id
                WHERE a.nik = '$nik' AND (CAST(a.timestamp AS DATE) BETWEEN '$yesterday' AND '$tomorrow')
                ORDER BY a.timestamp DESC"
            )->result_array();
            return $data;
        }
    }

    function getAllAdmin()
    {
        return $this->db->query("SELECT * FROM tb_admin")->result();
    }
    function getAllUser()
    {
        // return $this->db->query("SELECT * FROM tb_user")->result();
        return $this->db->query(
            "SELECT 
                u.*, d.name AS department, st.name AS shift
            FROM tb_user u
            LEFT JOIN department d ON u.department_id = d.department_id
            LEFT JOIN shift_type st ON u.shift_type_id = st.shift_type_id"
        )->result();
    }
    function getAllBuku()
    {
        return $this->db->query("SELECT * FROM tb_buku")->result();
    }
    function getAllPeminjam()
    {
        return $this->db->query("SELECT * FROM tb_peminjam")->result();
    }
    function getAllData($id)
    {
        return $this->db->query("SELECT p.id_peminjam, p.id_karyawan, p.tgl_pinjaman, p.qr_code, u.id_karyawan, u.nama_karyawan FROM tb_peminjam AS p, tb_detail_peminjam AS d, tb_user AS u WHERE p.id_peminjam = d.id_peminjam AND u.id_karyawan = p.id_karyawan LIMIT 1")->result();
    }

    function getAllUserPeminjam()
    {
        return $this->db->query("SELECT * FROM tb_user INNER JOIN tb_peminjam ON tb_user.id_karyawan=tb_peminjam.id_karyawan ORDER BY tb_peminjam.id_karyawan DESC LIMIT 1")->result();
    }
    function getAllBukuPeminjam()
    {
        return $this->db->query("SELECT * FROM tb_buku INNER JOIN tb_detail_peminjam ON tb_buku.id_buku=tb_detail_peminjam.id_buku WHERE status='0'")->result();
    }
    function getAllBukuPengembalian()
    {
        if (isset($_GET['id_peminjam'])) {
            $peminjam = $_GET['id_peminjam'];
        } else {
            $peminjam = 'null';
        }
        return $this->db->query("SELECT * FROM tb_peminjam AS p, tb_detail_peminjam AS d, tb_buku AS b 
            WHERE p.id_peminjam = '$peminjam' AND b.id_buku = d.id_buku")->result();
    }


    //  GET DATA BY ID
    function getAdminById($id)
    {
        $param = array('id' => $id);
        return $this->db->get_where('tb_admin', $param);
    }
    function getBookById($id)
    {
        $this->db->from('tb_buku');
        $this->db->where('id_buku', $id);
        $query = $this->db->get();
        //cek apakah ada data
        if ($query->num_rows() == 1) {
            return $query->row();
        }
    }
    function getUserById($id)
    {
        $this->db->from('tb_user');
        $this->db->where('id_karyawan', $id);
        $query = $this->db->get();
        //cek apakah ada data
        if ($query->num_rows() == 1) {
            return $query->row();
        }
    }
    function getPeminjamById($id)
    {
        $this->db->select('*');
        $this->db->from('tb_peminjam');
        $this->db->where('id_peminjam =', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $out = $query->result();
            return $out;
        } else {
            return FALSE;
        }
    }
    function getDPeminjamById($id)
    {
        $this->db->select('*');
        $this->db->from('tb_peminjam');
        $this->db->where('id_peminjam =', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $out = $query->result();
            return $out;
        } else {
            return FALSE;
        }
    }
    function getLaporan()
    {
        if (isset($_GET['tgl_awal']) && isset($_GET['tgl_akhir'])) {
            $tgl_awal = $_GET['tgl_awal'];
            $tgl_akhir = $_GET['tgl_akhir'];
        } else {
            $tgl_awal = date('Y') . '-01-01';
            $tgl_akhir = date('Y') . '-12-31';
        }
        $this->db->select('*');
        $this->db->from('tb_peminjam');
        $this->db->where('tgl_pinjaman >= ', '' . $tgl_awal . '');
        $this->db->where('tgl_pengembalian <= ', '' . $tgl_akhir . '');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $out = $query->result();
            return $out;
        } else {
            return array();
        }
    }

    //  INSERT DATA
    function insertAdmin($data)
    {
        return $this->db->insert('tb_admin', $data);
    }
    function insertUser($id_karyawan, $nama_karyawan, $department, $shift_type, $jenis_kelamin, $alamat, $email, $image_name)
    {
        $data = array(
            'id_karyawan'   => $id_karyawan,
            'nama_karyawan' => $nama_karyawan,
            'department_id' => $department,
            'shift_type_id'    => $shift_type,
            'jenis_kelamin' => $jenis_kelamin,
            'alamat'        => $alamat,
            'email'         => $email,
            'qr_code'       => $image_name
        );
        $this->db->insert('tb_user', $data);
    }
    function insertBuku($id_buku, $judul_buku, $tahun_terbit, $jenis_buku, $penerbit, $image_name)
    {
        $data = array(
            'id_buku'      => $id_buku,
            'judul_buku'   => $judul_buku,
            'tahun_terbit' => $tahun_terbit,
            'jenis_buku'   => $jenis_buku,
            'penerbit'     => $penerbit,
            'qr_code'      => $image_name
        );
        $this->db->insert('tb_buku', $data);
    }

    function insertDataUser($id_peminjam, $id_karyawan, $tgl_pinjaman, $status, $image_name)
    {
        $idkaryawan = $this->input->post('id_karyawan');
        $nama = $this->db->get_where('tb_user', array('id_karyawan' => $idkaryawan))->row_array();
        $data = array(
            'id_peminjam'   => $id_peminjam,
            'id_karyawan'   => $nama['id_karyawan'],
            'nama_karyawan' => $nama['nama_karyawan'],
            'tgl_pinjaman'  => $tgl_pinjaman,
            'status'        => '0',
            'qr_code'       => $image_name
        );
        $this->db->insert('tb_peminjam', $data);
    }
    function insertDataBuku($data)
    {
        return $this->db->insert('tb_detail_peminjam', $data);
    }


    //  UPDATE DATA
    function updateAdmin($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_admin', $data);
    }
    function updateUser($data, $id)
    {
        $this->db->where('id_karyawan', $id);
        $this->db->update('tb_user', $data);
    }
    function updateBuku($data, $id)
    {
        $this->db->where('id_buku', $id);
        $this->db->update('tb_buku', $data);
    }
    function savePeminjam($data)
    {
        $last_kd = $this->db->query("SELECT id_peminjam FROM tb_peminjam ORDER BY id_peminjam DESC")->row_array();
        $this->db->query("UPDATE tb_detail_peminjam SET id_peminjam='" . $last_kd['id_peminjam'] . "' WHERE status='0'");
        $this->db->query("UPDATE tb_detail_peminjam SET status='1' WHERE status='0'");
    }
    function updatePengembalian($data)
    {
        if (isset($_GET['id_peminjam'])) {
            $peminjam = $_GET['id_peminjam'];
        } else {
            $peminjam = 'null';
        }
        return $this->db->query("UPDATE tb_peminjam SET tgl_pengembalian = CURDATE() WHERE id_peminjam = '$peminjam' AND status='0'");
    }

    //  DELETE DATA
    function deleteAdmin($id)
    {
        $this->db->where('id', $id);
        $delete = $this->db->delete('tb_admin');
        return $delete;
    }
    function deleteUser($id)
    {
        $this->db->where('id_karyawan', $id);
        $delete = $this->db->delete('tb_user');
        return $delete;
    }
    function deleteBuku($id)
    {
        $this->db->where('id_buku', $id);
        $delete = $this->db->delete('tb_buku');
        return $delete;
    }
    function deleteItemBuku($id)
    {
        $this->db->where('id_buku', $id);
        $delete = $this->db->delete('tb_detail_peminjam');
        return $delete;
    }
    function deletePinjaman($id)
    {
        $this->db->where('id_peminjam', $id);
        $delete = $this->db->delete('tb_peminjam');
        return $delete;
    }
    function deleteDPinjaman($id)
    {
        $this->db->where('id_peminjam', $id);
        $delete = $this->db->delete('tb_detail_peminjam');
        return $delete;
    }


    //  GET AUTO CODE FOR ID
    function getIdAdmin()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(id,3)) AS kd_max FROM tb_admin");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }
        return "ADM-" . $kd;
    }

    function getIdBuku()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(id_buku,3)) AS kd_max FROM tb_buku");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }
        return "BOOK-" . $kd;
    }

    function getIdPeminjam()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(id_peminjam,3)) AS kd_max FROM tb_detail_peminjam");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }
        return "PJM-" . $kd;
    }

    //25 Maret 2022
    public function getAttendance()
    {
        $data = $this->db->query(
            "SELECT 
                nik, nama_karyawan, cast(tanggal as date) tanggal, min(clockin) cin, max(clockout) cout,  name shift, department_name
            FROM attemp_unprocessed
            GROUP BY nik, cast(tanggal as date), nama_karyawan, name"
        )->result();
        return $data;
    }

    public function getCountAttendance($date)
    {
        $data = $this->db->query(
            "SELECT 
                nik
            FROM att_daily
            WHERE tanggal = '$date' AND cin <> ''"
        )->num_rows();

        return $data;
    }

    // public function getDetailAttendanceToday()
    // {
    //     $data = $this->db->query(
    //         "SELECT
    //             nik, nama_karyawan, cin, shift, department_name, tanggal
    //         FROM att_daily
    //         WHERE tanggal = DATE(NOW()) AND cin <> ''"
    //     )->result();

    //     return $data;
    // }

    public function getDetailAttendance($date)
    {
        if ($date == null) {
            $dateWhere = "";
        } else {
            $dateWhere = "AND tanggal = '" . date_format(date_create($date), 'Y-m-d') . "'";
        }

        $data = $this->db->query(
            "SELECT
                nik, nama_karyawan, cin, cout, shift, department_name, tanggal
            FROM att_daily
            WHERE cin <> '' $dateWhere"
        )->result();

        return $data;
    }

    public function ajax_cek_switch($id)
    {
        return $this->db->query("SELECT isactive FROM tb_user WHERE id = '$id'")->row()->isactive;
    }

    public function ajax_switch($id, $isactive)
    {
        return $this->db->query("UPDATE tb_user SET isactive = '$isactive' WHERE id = '$id'");
    }

    public function ajax_cek_switch_log($id)
    {
        return $this->db->query("SELECT isactive FROM tb_attempt WHERE id = '$id'")->row()->isactive;
    }

    public function ajax_switch_log($id, $isactive)
    {
        return $this->db->query("UPDATE tb_attempt SET isactive = '$isactive' WHERE id = '$id'");
    }

    public function getSummary()
    {
        $data = $this->db->query(
            "SELECT 
                a.*,  CAST(SUBSTRING(a.attendance_id, 1,8) AS date) AS tanggal, u.nama_karyawan, d.name AS department
            FROM attendance a
            JOIN tb_user u ON (a.nik = u.id_karyawan)
            JOIN department d ON (u.department_id = d.department_id)"
        )->result();

        return $data;
    }

    public function getCountUser($type)
    {
        if ($type == 'active') {
            $data = $this->db->query(
                "SELECT 
                    DISTINCT(id_karyawan)
                FROM tb_user WHERE isactive = 'Y'"
            )->num_rows();
        } else if ($type == 'nonactive') {
            $data = $this->db->query(
                "SELECT 
                    DISTINCT(id_karyawan)
                    FROM tb_user WHERE isactive = 'N'"
            )->num_rows();
        } else if ($type == 'all') {
            $data = $this->db->query(
                "SELECT 
                    DISTINCT(id_karyawan)
                FROM tb_user"
            )->num_rows();
        }

        return $data;
    }

    public function getDataUser($type)
    {
        if ($type == 'active') {
            $where = "WHERE u.isactive = 'Y'";
        } else if ($type == 'nonactive') {
            $where = "WHERE u.isactive = 'N'";
        } else {
            $where = '';
        }

        $data = $this->db->query(
            "SELECT 
                u.*, d.name AS department, st.name AS shift
            FROM tb_user u
            LEFT JOIN department d ON u.department_id = d.department_id
            LEFT JOIN shift_type st ON u.shift_type_id = st.shift_type_id
            $where"
        )->result();

        return $data;
    }
}
