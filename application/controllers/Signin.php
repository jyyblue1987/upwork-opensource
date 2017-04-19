<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends CI_Controller {

    public function index() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') == '1'){
                redirect(site_url("jobs-home"));
            }else{
                if(isset($_GET['redirect'])){
                    redirect(site_url("profile-settings").'?redirect='.$_GET['redirect']);
                }else{
                    redirect(site_url("find-jobs"));
                }
            }
        }else {
            $data = array(
                'title' => "Log In - Winjob",
                'page' => "signin",
                'js' => array(),
                'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
                'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
            );
            
            $newEmail='';
            if(isset($_GET['username'])){
            $username = $_GET['username']; 

            $this->db->select('*');
            $this->db->from('webuser');
            $this->db->where("(webuser_email = '$username' OR webuser_username = '$username')"); 

            $query = $this->db->get();
            $userdata = $query->row();
            $email = trim($userdata->webuser_email);
            $emailArray = explode("@",$email);
            $emailcharcount = strlen($emailArray[0]);
            $firstChar = substr($emailArray[0], 0, 1); 
            $lastChar = substr($emailArray[0], -1);
            // var_dump($lastChar);die();
            $newEmailText = '';
            
            for($i = 1;$i<=$emailcharcount; $i++){ 
                if($i == 1){
                    $newEmailText .= $firstChar;
                }elseif($i == $emailcharcount){
                    $newEmailText .= $lastChar;
                }else{
                    $newEmailText .='*';
                }
            }
            
            $newEmail = $newEmailText.'@'.$emailArray[1];
            $data['newemail'] = $newEmail;

        }
            $this->Admintheme->custom_webview("signin", $data);
        }
    }

}
