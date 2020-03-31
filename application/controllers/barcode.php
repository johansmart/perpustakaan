<?php
class Barcode extends CI_Controller
{
function gambar($kode)
	{
		$height = isset($_GET['height']) ? mysql_real_escape_string($_GET['height']) : '50';	
		$width = isset($_GET['width']) ? mysql_real_escape_string($_GET['width']) : '1'; //1,2,3,dst
		$this->load->library('zend');
        $this->zend->load('Zend/Barcode');
 		$barcodeOPT = array(
		    'text' => $kode, 
		    'barHeight'=> $height, 
		    'factor'=>$width,
		);
				
			$renderOPT = array();
	$render = Zend_Barcode::factory(
'code39', 'image', $barcodeOPT, $renderOPT
)->render();
	}

function index()
{
	redirect(base_url('index.php/page'),"refresh");
}
}
