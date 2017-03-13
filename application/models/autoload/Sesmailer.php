<?php

class Sesmailer extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


function sesemail($email, $subject, $body, $attachments = array()){

$this->load->library('Mailer');


$mail = new Mailer();
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
//$mail->Host = "localhost";
//$mail->Port = 25;
    //added by Sergey start
    $mail->Host = "sg2plcpnl0030.prod.sin2.secureserver.net";
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    if (count($attachments) > 0 ){
        foreach( $attachments as $attach) {
            $mail->addAttachment($attach['path'], $attach['name']);
        }
    }
    //added by Sergey end

$mail->SMTPAuth = true;
//$mail->SMTPSecure = 'tls';
$mail->Username = "donotreply@winjob.com";
$mail->Password = "Winjob2016";
$mail->setFrom("donotreply@winjob.com", "Winjob.com");
$mail->addAddress($email, $email);
$mail->Subject = $subject;
$mail->msgHTML($body);
$mail->AltBody = $subject;


if ($mail->send()) {
return true;
}else {
return false;
}

}

    //  added by Sergey start
    function sesemailfromsupport($email, $subject, $body, $attachments = array()){

        $this->load->library('Mailer');
        $mail = new Mailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host = "sg2plcpnl0030.prod.sin2.secureserver.net";
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        if (count($attachments) > 0 ){
            foreach( $attachments as $attach) {
                $mail->addAttachment($attach['path'], $attach['name']);
            }
        }
        $mail->SMTPAuth = true;
        $mail->Username = "support@winjob.com";
        $mail->Password = "Winjob2016";
        $mail->setFrom("support@winjob.com", "support@winjob.com");
        $mail->addAddress($email, $email);
        $mail->Subject = $subject;
        $mail->msgHTML($body);
        $mail->AltBody = $subject;


        if ($mail->send()) {
            return true;
        }else {
            return false;
        }

    }
    //added by Sergey end

}

?>
