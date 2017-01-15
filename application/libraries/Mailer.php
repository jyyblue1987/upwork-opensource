<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once FCPATH . 'phplib/phpmailer/PHPMailerAutoload.php';

class Mailer extends PHPMailer
{
    function __construct()
    {
        parent::__construct();
    }
}