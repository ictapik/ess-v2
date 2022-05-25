<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_master');
	}

	function index()
	{	
		$data=array('data_user'=>$this->model_master->getAllUserPeminjam(),
					'data_peminjam'=>$this->model_master->getAllPeminjam(),
					'data_buku'=>$this->model_master->getAllBukuPeminjam());
		$this->load->view('admin/v_peminjaman_buku',$data);
	}

	function printQr()
    {
        ini_set("session.auto_start", 0);
        $this->load->library('cfpdf');
        $pdf=new FPDF('P','mm','A6');
        $pdf->AddPage();
        $pdf->SetFont('Courier','B','L');
        $pdf->SetFontSize(16);
        $pdf->Text(28, 12, 'PERPUSTAKAAN PT. DEXA GROUP');
        $pdf->SetFont('Courier','','L');
        $pdf->SetFontSize(8);
        $pdf->Text(15, 18, 'Bintaro Jaya, Titan Center 3rd Floor Jl. Bulevard Bintaro Blok B7/B1');
        $pdf->Text(28, 21, 'No.5, Jl. Sektor Raya No.7, Pd. Jaya, Kec. Pd. Aren');
        $pdf->Text(41, 24, 'Kota Tangerang Selatan, Banten 15224');
		$pdf->Text(16, 27, 'Phone.(+62-21) 7454 111 Email: recruitment.corporate@dexagroup.com');
        $pdf->Text(10, 28, '___________________________________________________________________________', 1,1);
        $pdf->Text(10, 29, '___________________________________________________________________________', 1,1);
        $pdf->SetFont('Courier','','L');
        $pdf->SetFontSize(10);
        $pdf->Text(27, 20, '');
        $pdf->Text(10, 35, 'ID Karyawan');
        $pdf->Text(55, 35, ':');
        $pdf->Text(10, 40, 'Nama Karyawan');
        $pdf->Text(55, 40, ':');
        $pdf->Text(10, 45, 'Tanggal Peminjaman');
        $pdf->Text(55, 45, ':');
        $pdf->Text(10, 50, 'Tanggal Pengembalian');
        $pdf->Text(55, 50, ':');
        $id = $this->uri->segment(3);
        $data = $this->model_master->getPeminjamById($id);
        foreach($data as $row)
        {
            $pdf->Text(116, 62.2, $row->id_peminjam);
            $pdf->Text(60, 35, $row->id_karyawan);
            $pdf->Text(60, 40, $row->nama_karyawan);
            $pdf->Text(60, 45, $row->tgl_pinjaman);
            $pdf->Text(60, 50, $row->tgl_pengembalian);
            $pdf->Image('assets/qrcode/peminjam/'.$row->qr_code, 108, 29.9, 30);
        }
        $pdf->SetFont('Courier','','L');
        $pdf->SetFontSize(8);
        $pdf->Text(10, 65, '___________________________________________________________________________', 1,1);
        $pdf->Text(10, 66, '___________________________________________________________________________', 1,1);
        $pdf->Text(10, 70, '*Simpan bukti ini, untuk pengembalian buku.', 1,1);
        ob_end_clean();
        $pdf->Output();
    }

    function printPeriode()
    {
        ini_set("session.auto_start", 0);
        $this->load->library('cfpdf');
        $pdf=new FPDF('P','mm','A4');
        $pdf->AddPage();
        $pdf->SetFont('Courier','B','L');
        $pdf->SetFontSize(20);
        $pdf->Text(49, 18, 'PERPUSTAKAAN PT. DEXA GROUP');
        $pdf->SetFont('Courier','','L');
        $pdf->SetFontSize(8);
        $pdf->Text(13, 24, 'Bintaro Jaya, Titan Center 3rd Floor Jl. Bulevard Bintaro Blok B7/B1 No.5, Jl. Sektor Raya No.7, Pd. Jaya');
        $pdf->Text(38, 27, 'Kec. Pd. ArenKota Tangerang Selatan, Banten, 15224. Phone.(+62-21) 7454 111');
        $pdf->Text(67, 30, 'Email: recruitment.corporate@dexagroup.com');
        $pdf->Text(10, 36, '_____________________________________________________________________________________________________________', 1,1);
        $pdf->Text(10, 37, '_____________________________________________________________________________________________________________', 1,1);
        // detail
        $pdf->SetFontSize(10);
        $pdf->Cell(10, 30,'','',1);
        $pdf->Cell(10, 7, 'No', 1,0);
        $pdf->Cell(30, 7, 'ID Peminjaman', 1, 0);
        $pdf->Cell(30, 7, 'ID Karyawan', 1,0);
        $pdf->Cell(30, 7, 'Nama Karyawan', 1,0);
        $pdf->Cell(40, 7, 'Tanggal Peminjaman', 1,0);
        $pdf->Cell(45, 7, 'Tanggal Pengembalian', 1,1);
        // tampilkan dari database
        $pdf->SetFont('Courier','','L');
        $no = 1;
        $id = $this->uri->segment(3);
        $data = $this->model_master->getLaporan();
        foreach($data as $row)
        {
            $pdf->Cell(10, 7, $no, 1,0);
            $pdf->Cell(30, 7, $row->id_peminjam, 1,0);
            $pdf->Cell(30, 7, $row->id_karyawan, 1,0);
            $pdf->Cell(30, 7, $row->nama_karyawan, 1,0);
            $pdf->Cell(40, 7, $row->tgl_pinjaman, 1,0);
            $pdf->Cell(45, 7, $row->tgl_pengembalian, 1,1);
            $no++;
        }
        ob_end_clean();
        $pdf->Output();
    }
}
