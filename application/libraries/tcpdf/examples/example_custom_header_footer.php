<?php
// File name   : example_custom_header_footer.php
// Begin       : 2013-12-03
// Last Update : 2013-12-03
//
// Description : Example to overwite header, footer of TCPDF class

ini_set("display_errors", 1);

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// Extend the TCPDF class to create custom Header and Footer
    class Cetakjd_c extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = 'images/tcpdf_logo.jpg'; // *** Very IMP: make sure this image is available on given path on your server
        $this->Image($image_file,15,6,30);
        // Set font
        $this->SetFont('helvetica', 'C', 12);
    
        // Line break
        $this->Ln();        
        $this->Cell(294, 15, 'ABC test company', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(5);        
        $this->Cell(300, 0, 'Company tag line here', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        // We need to adjust the x and y positions of this text ... first two parameters
        
    }

    // Page footer
    public function Footer() {
        // Position at 25 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        
        $this->Cell(0, 0, 'Product Company - ABC test company, Phone : +91 1122 3344 55, TIC : TESTTEST', 0, 0, 'C');
        $this->Ln();
        $this->Cell(0,0,'www.clientsite.com - T : +91 1 123 45 64 - E : info@clientsite.com', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
    
}

?>