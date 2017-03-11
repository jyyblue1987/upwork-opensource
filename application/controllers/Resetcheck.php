<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resetcheck extends CI_Controller {

    function generateRandomString($length = 16) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function index() {
        $email = $_POST['email'];
        $token=self::generateRandomString(30);

        $mkt = $_SERVER["REQUEST_TIME"];
        $emkt=$mkt+10800;

        $this->db->select('*');
        $this->db->from('webuser');
        $this->db->where('webuser_email', $email);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $stud=$query->result()[0];
            $fname=$stud->webuser_fname;
            $lname=$stud->webuser_lname;
            $email=$stud->webuser_email;

            $data = array(
                'webuser_resettoken' => $token,
                'webuser_resetexpire' => $emkt
            );

            $this->db->where('webuser_email', $email);
            $this->db->update('webuser', $data);

            $resetlink = site_url()."resetpassword?token=".$token;
            $subject ='Reset Your Password';

            $data = array(
                    'fname' => $fname,
                    'company' => 'Winjob',
                    'verification' => $resetlink,
                    'slogan' => 'Hire Talented Freelancers For a Low Cost',
                    'greeting' => 'Hi '. $fname,
                    'para1' => 'As requested, here is the link to reset your account password. Please click the button below.',
                    'para2' => 'If you did not request for a password reset, please ignore this email or <a href="'.site_url().'contact" style="color: #0061A7; text-decoration: none;">contact us</a>.'
                );

            $response = $this->Sesmailer->sesemail($email,$subject,$this->Emailtemplate->emailview('password_reset', $data));
            redirect(site_url('resetsent'));

        }else{
            redirect(site_url('resetpass?error=true'));
        }
   }
}
