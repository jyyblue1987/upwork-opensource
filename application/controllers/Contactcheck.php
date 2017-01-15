<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactcheck extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('common_mod'));
    }

    function generateRandomString($length = 16) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
//        echo "<pre>";print_r($randomString);exit;
        return $randomString;
    }
	
	
    public function index() {
		

	$fname=$_POST['fname'];
	$email=$_POST['email'];
	$body=$_POST['body'];

//added by Sergey start
    $lname=$_POST['lname'];
    $subject=$_POST['subject'];
    $captcha=$_POST['captcha'];
    if( strcasecmp($_SESSION['captchaWord'], $captcha) !== 0 ) {
        redirect(site_url('contact?error=The security code is not valid'));
        return false;
    }
    $user_id = $this->session->userdata('id');
    $error = "";
    //insert ticket
    $ticketID = $this->common_mod->insert('webuser_tickets',array(
        'webuser_id' => $user_id,
        'fname' => $fname,
        'lname' => $lname,
        'email' => $email,
        'subject' => $subject
    ));

    if ( empty($ticketID) ) {
        redirect(site_url('contact?error=Error create ticket row'));
        return false;
    }

// insert ticket message
    $ticketMessageID = $this->common_mod->insert('webuser_ticket_messages',array(
            'ticket_id' => $ticketID,
            'sender_id' => $user_id,
            'message' => $body,
            'status' => 'red',
            'created' => date("Y-m-d H:m:s")
    ));

    if ( empty($ticketMessageID) ) {
            redirect(site_url('contact?error=Error create ticket message row'));
            return false;
    }

    $uploadfiles = array(); // array for send email upload files
    if ( !empty($_FILES['userfiles']['name']) ) {
        $filesCount = count($_FILES['userfiles']['name']);
        for($i = 0; $i < $filesCount; $i++) {
            $origname = $_FILES['userfiles']['name'][$i];
            $filename = $origname;
            $extname = '';
            $pointpos = strrpos($origname,'.');
            if ($pointpos) {
                $extname = substr($origname,$pointpos+1);
                $filename = substr($origname,0,$pointpos);
            }
            $filename = md5(microtime()."_".$filename).".$extname";
            $_FILES['userfile']['name'] = $filename;
            $_FILES['userfile']['type'] = $_FILES['userfiles']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $_FILES['userfiles']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $_FILES['userfiles']['error'][$i];
            $_FILES['userfile']['size'] = $_FILES['userfiles']['size'][$i];

            $uploadPath = 'uploads/ticketfiles/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'gif|jpg|png|doc|pdf|txt';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('userfile')) {
                $fileData = $this->upload->data();
                $uploadfiles[] = array(
                    'path' => $fileData['full_path'],
                    'name' => $origname
                );
                // insert ticket message file
                $ticketMessageFileID = $this->common_mod->insert('webuser_ticket_message_files',array(
                    'message_id' => $ticketMessageID,
                    'name' => $filename,
                    'original_name' => $origname
                ));
                if ( empty($ticketMessageFileID) ) {
                    $error .= "<p>Error add message file row for file $origname </p>";
                }
            } else {
                $error .= $this->upload->display_errors('<p>', '</p>');
            }
        }
    }
//added by Sergey end

$body = 'Message from '.$fname.'<br>Email : '.$email.'<br> '.nl2br($body);
//$response=$this->Sesmailer->sesemail("canvasdevelopers@gmail.com","New Message From Winjob",$body);

    //added by Sergey start
    $response=$this->Sesmailer->sesemail("support@winjob.com","New Message From Winjob",$body, $uploadfiles);
    redirect(site_url('contact?sent=true&ticketID='.$ticketID));
	//added by Segrey end

			
	}
	
	
}
