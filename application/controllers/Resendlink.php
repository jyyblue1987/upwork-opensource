<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resendlink extends CI_Controller {

    public function index(){

        if(isset($_GET['username'])){
            $username=$_GET['username'];
        }

        $this->db->select('*');
        $this->db->from('webuser');
        $this->db->where("(webuser_email = '$username' OR webuser_username = '$username')");
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $stud = $query->result()[0];
            if($stud->webuser_status=="1"){
                $fname = $stud->webuser_fname;
                $lname = $stud->webuser_lname;
                $token = $stud->webuser_token;
                $email = $stud->webuser_email;

                $resetlink = site_url()."verifyemail?token=".$token;
                $subject ='Please Verify Your Email Address';

                $data = array(
                    'fname' => $fname,
                    'company' => 'Winjob',
                    'verification' => $resetlink,
                    'slogan' => 'Hire Talented Freelancers For a Low Cost',
                    'greeting' => 'Hi '. $fname,
                    'para1' => 'Please click the button below to verify your email address.',
                    'para2' => 'If you did not sign up for this account, or you are having trouble with your account, please <a href="'.site_url().'contact" style="color: #0061A7; text-decoration: none;">contact us</a> and we will be happy to assist you.'
                );

                $response = $this->Sesmailer->sesemail($email,$subject,$this->Emailtemplate->emailview('verify_email', $data));
                redirect(site_url('resent'));
            }else{
                redirect(site_url('signin'));
            }
       }else{
            redirect(site_url());
       }
    }
}
