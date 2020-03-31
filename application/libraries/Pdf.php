<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
require_once('tcpdf/tcpdf.php');
class Pdf extends TCPDF
{
    public function __construct()
    {
        parent::__construct();
    }

    // public function Header()
    // {
    //     $this->SetFont('helvetica', 'B', 16);
    //     $this->Cell(100, 1, 'PT SUCOFINDO (PERSERO)', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    //     $this->Ln(8);
    //     $this->SetFont('helvetica', 'B', 14);
    //     $this->Cell(100, 1, 'Job Description', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    //     $logo = base_url('assets/img/logo.png');
    //     $this->Image($logo, 140, 10, 30, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    //     $this->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 4, 'color' => array(50, 0, 0)));
    // }
    // public function Footer() {
    // // Position at 15 mm from bottom
    // $this->SetY(-20);
    // $html = '<div style="width:100%;border-top: 1px solid #000"></div><table>'
    //         .'<tr>'
    //         .'<td>FOR/SCI-SDM/03'
    //         .'</td>'
    //         .'<td>Rev. 00'
    //         .'</td>'
    //         .'<td>Berlaku tgl : ...........'
    //         .'</td>'
    //         .'<td>Hal '.$this->getAliasNumPage().' dari '.$this->getAliasNbPages().' hal'
    //         .'</td>'
    //         .'</tr>'
    //         .'</table>';
    // $this->SetFont('helvetica','', 8);
    // $this->WriteHTML($html, true, false, false, false, '');
    // }
}