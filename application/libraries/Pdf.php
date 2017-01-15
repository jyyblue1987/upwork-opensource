<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once FCPATH . 'phplib/tcpdf/tcpdf.php';

class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }
}