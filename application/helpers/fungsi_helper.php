<?php

function chek_session(){
    $CI = & get_instance();
    $session = $CI->session->userdata('status_login');
    if($session!='oke')
    {
        redirect('login_user');
    }
}

function chek_session_adm(){
    $CI = & get_instance();
    $session = $CI->session->userdata('status_login');
    if($session!='oke')
    {
        redirect('admin');
    }
}

function chek_session_user(){
    $CI= & get_instance();
    $session = $CI->session->userdata('status_login');
    if($session=='oke')
    {
        redirect('home_user');
    }
}

function chek_session_admin(){
    $CI= & get_instance();
    $session = $CI->session->userdata('status_login');
    if($session=='oke')
    {
        redirect('admin/data');
    }
}

if (!function_exists('jin_date_ina')) {
    function jin_date_ina($date_sql, $tipe = 'full', $time = false) {
        $date = '';
        if($tipe == 'full') {
            $nama_bulan = array(1=>"Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        } else {
            $nama_bulan = array(1=>"Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des");
        }
        if($time) {
            $exp = explode(' ', $date_sql);
            $exp = explode('-', $exp[0]);
            if(count($exp) == 3) {
                $bln = $exp[1] * 1;
                $date = $exp[2].' '.$nama_bulan[$bln].' '.$exp[0];
            }       
            $exp_time = $exp = explode(' ', $date_sql);
            $date .= ' jam ' . substr($exp_time[1], 0, 5);
        } else {
            $exp = explode('-', $date_sql);
            if(count($exp) == 3) {
                $bln = $exp[1] * 1;
                if($bln > 0) {
                    $date = $exp[2].' '.$nama_bulan[$bln].' '.$exp[0];
                }
            }
        }
        return $date;
    }
}

if (!function_exists('jin_date')) {
    function jin_date($date_sql, $tipe = 'full', $time = false) {
        $date = '';
        if($tipe == 'full') {
            $nama_bulan = array(1=>"01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
        } else {
            $nama_bulan = array(1=>"Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des");
        }
        if($time) {
            $exp = explode(' ', $date_sql);
            $exp = explode('-', $exp[0]);
            if(count($exp) == 3) {
                $bln = $exp[1] * 1;
                $date = $exp[2].' '.$nama_bulan[$bln].' '.$exp[0];
            }       
            $exp_time = $exp = explode(' ', $date_sql);
            $date .= ' jam ' . substr($exp_time[1], 0, 5);
        } else {
            $exp = explode('-', $date_sql);
            if(count($exp) == 3) {
                $bln = $exp[1] * 1;
                if($bln > 0) {
                    $date = $exp[2].'-'.$nama_bulan[$bln].'-'.$exp[0];
                }
            }
        }
        return $date;
    }
}

?>



