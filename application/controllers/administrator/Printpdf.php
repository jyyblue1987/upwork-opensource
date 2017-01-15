<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Printpdf extends CI_Controller {

	
	public function index()
	{
            $this->load->library('Pdf');

$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('My Title');
$pdf->SetHeaderMargin(30);
$pdf->SetTopMargin(20);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true);
$pdf->SetAuthor('Author');
$pdf->SetDisplayMode('real', 'default');

$pdf->Write(5, 'Some sample text');
$pdf->Output('My-File-Name.pdf', 'I');
	}
}
