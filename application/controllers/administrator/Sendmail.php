<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sendmail extends CI_Controller {

	
	public function index()
	{

echo "starting";
            $this->load->library('Mailer');

            
$mail = new Mailer();
$mail->isSMTP();
$mail->SMTPDebug = 1;
$mail->Debugoutput = 'html';
$mail->Host = "localhost";
$mail->Port = 25; 
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Username = "donotreply@winjob.com";
$mail->Password = "Winjob2016";
$mail->setFrom("Winjob.com", "donotreply@winjob.com");
$mail->addAddress("winjobllc@gmail.com", "winjobllc@gmail.com");
$mail->Subject = "test email";
$mail->msgHTML("test email");
$mail->AltBody = "test email";

echo $mail->send();


	}
}

?>
