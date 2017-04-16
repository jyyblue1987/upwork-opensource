<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registercheck extends CI_Controller {

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
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $username=$_POST['username']; 
        $email=$_POST['email'];
        $type=$_POST['type'];
        $country=$_POST['country'];
        $password=$_POST['password'];
        
	$token = self::generateRandomString(30);
        
        $this->db->select('webuser_id');
        $this->db->from('webuser');
        $this->db->where('webuser_email', $email);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            redirect(site_url('signup?email=true'));
            exit();
        }

	$this->db->select('webuser_id');
        $this->db->from('webuser');
        $this->db->where('webuser_username', $username);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            redirect(site_url('signup?username=true'));
            exit();
        }

       $add_data = array(
            'webuser_fname' => $fname,
            'webuser_lname' => $lname,
            'webuser_username' => $username,
            'webuser_country' => $country,
            'webuser_password' => md5($password),
            'webuser_orpass' => $password,
            'webuser_email' => $email,
            'webuser_type' => $type,
            'webuser_token' => $token,
            'webuser_status' => "1",
        );

        $redirect_url = '';
        if($this->input->post('job_id') != NULL && $this->input->post('job_id') != 0){
            $job_id = base64_encode($this->input->post('job_id'));
            $title = $this->str_to_url($this->input->post('title'));
            $redirect_url = '&redirect='.site_url().'jobs/'.$title.'/'.$job_id.'/apply'; //temp placeholder
        }
        
	$resetlink=site_url()."verifyemail?token=".$token.$redirect_url;

        $this->db->insert('webuser', $add_data);
        $id=$this->db->insert_id();

        $subject ='Please Verify Your Email Address';

        //Added By Arjay
        $_type = $type == 1 ? "an Employer" : "a Freelancer";

        $data = array(
                'fname' => $fname,
                'company' => 'Winjob',
                'verification' => $resetlink,
                'slogan' => 'Hire Talented Freelancers For a Low Cost',
                'greeting' => 'Hi '. $fname,
                'para1' => 'Thank you for signing up as '.$_type.' on <a href="'.site_url().'" style="color: #0061A7; text-decoration: none;">Winjob.com</a>. Please click the button below to verify your email address.',
                'para2' => 'If you did not sign up for this account, or you are having trouble with your account, please <a href="'.site_url().'contact" style="color: #0061A7; text-decoration: none;">contact us</a> and we will be happy to assist you.'
            );

        $response = $this->Sesmailer->sesemail($email,$subject,$this->Emailtemplate->emailview('verify_email', $data));
        redirect(site_url('thanks'));
    }
    
    private function str_to_url($title){
        $result = strtolower($title);
        $result = str_replace(' ', '-', $result);
        return $result;
    }
}
