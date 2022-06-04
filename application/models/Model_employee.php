<?php
class Model_employee extends CI_Model
{
    public function getLog($nik)
    {
        $data = $this->db->query(
            "SELECT 
                a.id, a.nik, a.timestamp, a.type as inout_type, a.source, u.nama_karyawan AS employee_name, st.name AS shift_type_name, a.isactive 
            FROM tb_attempt a 
            JOIN tb_user u ON a.nik = u.id_karyawan 
            JOIN shift_type st ON u.shift_type_id = st.shift_type_id 
            WHERE nik = '$nik'
            ORDER BY a.timestamp DESC"
        )->result();
        return $data;
    }

    public function getAttendance($nik)
    {
        $data = $this->db->query(
            "SELECT 
            nik, nama_karyawan, cast(tanggal as date) tanggal, min(clockin) cin, max(clockout) cout,  name shift, department_name
        FROM attempt_unprocessed
        WHERE nik = '$nik'
        GROUP BY nik, cast(tanggal as date), nama_karyawan, name"
        )->result();
        return $data;
    }

    function getAbsen($nik = null, $date = null)
    {
        if ($nik == null && $date == null) {
            $data = $this->db->query(
                "SELECT
                    a.id, a.nik, a.timestamp, a.type as inout_type, a.source, u.nama_karyawan AS employee_name, st.name AS shift_type_name, a.isactive
                FROM tb_attempt a
                JOIN tb_user u ON a.nik = u.id_karyawan
                JOIN shift_type st ON u.shift_type_id = st.shift_type_id"
            )->result_array();
            return $data;
        } else {
            $date_at_time = $date;
            $date = strtotime($date);
            $tomorrow = date('Y-m-d', strtotime("+1 days", $date));

            $data = $this->db->query(
                "SELECT
                    a.id, a.nik, a.timestamp, a.type as inout_type, a.source, u.nama_karyawan AS employee_name, st.name AS shift_type_name, a.isactive
                FROM tb_attempt a
                JOIN tb_user u ON a.nik = u.id_karyawan
                JOIN shift_type st ON u.shift_type_id = st.shift_type_id
                WHERE a.nik = '$nik'
                AND (CAST(a.timestamp AS DATE) BETWEEN '$date_at_time' AND '$tomorrow')
                AND a.id NOT IN (SELECT id_in FROM attendance WHERE id_in <> 0)
                AND a.id NOT IN (SELECT id_out FROM attendance WHERE id_out <> 0)
                ORDER BY a.timestamp DESC"
            )->result_array();
            return $data;
        }
    }

    public function getShiftByNIK($nik)
    {
        $data = $this->db->query(
            "SELECT 
                * 
            FROM shift 
            WHERE isactive = 'Y'
            AND shift_type_id = (
                SELECT shift_type_id
                FROM tb_user
                WHERE id_karyawan = '$nik'
            )"
        )->result_array();
        return $data;
    }

    public function timeIn($nik)
    {
        return $this->db->query(
            "SELECT 
                time_in, time_in_m
            FROM attendance
            WHERE nik = '$nik'
            AND iodate = DATE(NOW())"
        )->row();
    }

    public function workCal($nik, $start, $end)
    {
        return $this->db->query(
            "SELECT
                COUNT(attendance_id) as workCal
            FROM attendance
            WHERE nik = '$nik'
            AND calendar = 'WD'
            AND iodate BETWEEN '$start' AND '$end'"
        )->row()->workCal;
    }

    public function allIn($nik, $start, $end)
    {
        return $this->db->query(
            "SELECT
                count(time_in) AS allIn
            FROM attendance
            WHERE nik = '$nik'
            AND (time_in <> '00:00:00' OR time_in_m <> '')
            AND iodate BETWEEN '$start' AND '$end'"
        )->row()->allIn;
    }

    public function allLeave($nik, $start, $end)
    {
        return $this->db->query(
            "SELECT
                count(time_in) AS allIn
            FROM attendance
            WHERE nik = '$nik'
            AND (absent_id = 1 OR absent_id = 2)
            -- AND time_in <> '00:00:00'
            AND iodate BETWEEN '$start' AND '$end'"
        )->row()->allIn;
    }

    public function allSick($nik, $start, $end)
    {
        return $this->db->query(
            "SELECT
                count(time_in) AS allIn
            FROM attendance
            WHERE nik = '$nik'
            AND absent_id = 4
            -- AND time_in <> '00:00:00'
            AND iodate BETWEEN '$start' AND '$end'"
        )->row()->allIn;
    }

    public function allPermit($nik, $start, $end)
    {
        return $this->db->query(
            "SELECT
                count(time_in) AS allIn
            FROM attendance
            WHERE nik = '$nik'
            AND absent_id = 3
            -- AND time_in <> '00:00:00'
            AND iodate BETWEEN '$start' AND '$end'"
        )->row()->allIn;
    }

    public function allAlpha($nik, $start, $end)
    {
        return $this->db->query(
            "SELECT
                count(time_in) AS allIn
            FROM attendance
            WHERE nik = '$nik'
            AND (
                absent_id = 5
                OR
                (
                    calendar = 'WD'
                    AND time_in = '00:00:00'
                    AND time_out = '00:00:00'
                    AND time_in_m = ''
                    AND time_out_m = ''
                    AND absent_id NOT IN (1, 2, 3, 4, 6)
                )
            )
            AND iodate BETWEEN '$start' AND '$end'"
        )->row()->allIn;
    }

    public function detailAllIn($nik, $start, $end)
    {
        return $this->db->query(
            "SELECT
                a.*, s.name as shift
            FROM attendance a
            JOIN shift s ON (a.shift_id = s.shift_id)
            WHERE nik = '$nik'
            AND time_in <> '00:00:00'
            AND iodate BETWEEN '$start' AND '$end'"
        )->result();
    }

    public function lateIn($nik, $start, $end)
    {
        return $this->db->query(
            "SELECT
                TIME_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(a.time_in, s.start)))), '%H:%i:%s') AS lateIn
            FROM attendance a
            JOIN shift s ON (a.shift_id = s.shift_id)
            WHERE nik = '$nik'
            AND time_in <> '00:00:00'
            AND a.time_in > s.start
            AND iodate BETWEEN '$start' AND '$end'"
        )->row()->lateIn;
    }

    public function manualAtt($nik, $start, $end)
    {
        return $this->db->query(
            "SELECT
                COUNT(attendance_id) AS manualAtt
            FROM attendance
            WHERE nik = '$nik'
            AND (time_in_m <> '' OR time_out_m <> '')
            AND iodate BETWEEN '$start' AND '$end';"
        )->row()->manualAtt;
    }

    public function detailLateIn($nik, $start, $end)
    {
        return $this->db->query(
            "SELECT
                a.iodate, a.time_in, TIME_FORMAT(TIMEDIFF(a.time_in, s.start), '%H:%i:%s') AS late, s.name as shift
            FROM attendance a
            JOIN shift s ON (a.shift_id = s.shift_id)
            WHERE nik = '$nik'
            AND time_in <> '00:00:00'
            AND a.time_in > s.start
            AND iodate BETWEEN '$start' AND '$end'"
        )->result();
    }

    public function timelineHistory($nik, $start, $end)
    {
        return $this->db->query(
            "SELECT
                a.attendance_id, a.iodate, a.time_in, s.start,
                CASE
                	WHEN s.start IS NOT NULL AND a.time_in > s.start THEN TIME_FORMAT(TIMEDIFF(a.time_in, s.start), '%H:%i')
                	ELSE '-'
                END late,
                a.time_out, a.time_in_m, a.time_out_m, a.calendar, a.absent_id, ab.name as absent_name, s.name as shift, s.start
            FROM attendance a
            LEFT JOIN shift s ON (a.shift_id = s.shift_id)
            LEFT JOIN absent ab ON (a.absent_id = ab.absent_id)
            WHERE nik = '$nik'
            AND iodate BETWEEN '$start' AND date(now())
            ORDER BY iodate DESC"
        )->result();
    }

    public function timelineHistoryLM($nik, $start, $end)
    {
        return $this->db->query(
            "SELECT
                a.attendance_id, a.iodate, a.time_in, s.start,
                CASE
                	WHEN s.start IS NOT NULL AND a.time_in > s.start THEN TIME_FORMAT(TIMEDIFF(a.time_in, s.start), '%H:%i')
                	ELSE '-'
                END late,
                a.time_out, a.time_in_m, a.time_out_m, a.calendar, a.absent_id, ab.name as absent_name, s.name as shift, s.start
            FROM attendance a
            LEFT JOIN shift s ON (a.shift_id = s.shift_id)
            LEFT JOIN absent ab ON (a.absent_id = ab.absent_id)
            WHERE nik = '$nik'
            AND iodate BETWEEN '$start' AND '$end'
            ORDER BY iodate DESC"
        )->result();
    }

    public function getEmpByEmail($email)
    {
        return $this->db->query(
            "SELECT
                *
            FROM tb_user
            WHERE email = '$email'"
        )->row();
    }
}
