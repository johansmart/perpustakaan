<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pdf extends CI_Controller {

 	function __construct(){
	parent::__construct();
	$this->load->model('m_member','',TRUE);
	$this->load->library('fpdf/fpdf'); // load librari fpdf di folder aplication fpdf
	}
	


	public function kartu($no_induk){
	// ambil data anggota
		$member=$this->m_member->member_edit($this->uri->segment(3));
		foreach($member as $member)
				{
				
	// buat file pdf
		$pdf = new FPDF();
	//buka file
		$pdf->Open();
	// disable oto page break
		$pdf->SetAutoPageBreak(false);
		$pdf->AddPage();


		$i=0;

		$max=25;

		$row_height=5;

		$pdf->Image(base_url().'assets/images/ktm_depan.jpg',9.75,4.0,90,75);
		$pdf->SetFillColor(232,232,232);
		$pdf->SetFont('Arial','',10);
		$pdf->Rect(9.75, 4.0, 90, 75 , 'D') ;
		$pdf->Rect(105, 4.0, 90, 75 , 'D') ;


		$pdf->Cell(95);$pdf->Cell(89,6,'PERPUSTAKAAN MEZAGUS',0,0,'C',0);		
		$pdf->Ln();		
		
		$pdf->Cell(95);$pdf->Cell(89,6,'PERHATIAN',0,0,'C',0);		
		$pdf->Ln();
		$pdf->Cell(95);$pdf->Cell(5,5,'1. Kartu ini berlaku selama menjadi member.',0,0,'l',0);
		$pdf->Ln();
		$pdf->Cell(95);$pdf->Cell(5,5,'2. Apabila hilang harap segera lapor ke perpustakaan.',0,0,'l',0);
		$pdf->Ln();
		$pdf->Cell(95);$pdf->Cell(5,5,'3. Bagi yang menemukan Kartu ini, harap melaporkan . ',0,0,'l',0);
		$pdf->Ln();
		$pdf->Cell(100);$pdf->Cell(5,5,'ke perpustakaan mezagus ',0,0,'l',0);
		$pdf->Ln();
		$pdf->Cell(95);$pdf->Cell(5,5,'4. Penggantian Kartu akan dikenakan biaya cetak kartu.',0,0,'l',0);
		$pdf->SetFont('Arial','',11);
		$pdf->Ln();

		
		$pdf->Cell(35,5,'No. Induk',0,0,'l',0);$pdf->Cell(65,5,': '.$member->no_identitas_member.'',0,0,'l',0);
		$pdf->Ln();
		$pdf->Cell(35,5,'Nama Lengkap',0,0,'l',0);$pdf->Cell(65,5,': '.$member->nama_member.'',0,0,'l',0);
		$pdf->Ln();
		$pdf->Cell(35,5,'Program Studi',0,0,'l',0);$pdf->Cell(65,5,': '.$member->nama_kota.','.$member->tanggal_lahir_member,0,0,'l',0);
		$pdf->Ln();

		$pdf->SetFont('Arial','',10);


		$pdf->Output();	
}

	}

}
