<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Logincheck extends CI_Controller {
    
    function generateRandomString($length = 16) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
//        echo "<pre>";print_r($randomString);exit;
        return $randomString;
    }

    public function index() {

        if(isset($_POST['redirect']) && $_POST['redirect'] !=0){
            $this->session->set_redirect($_POST['redirect']);
        }
        
        $username = $_POST['username'];
        $password = $_POST['password'];


        $this->db->select('*');
        $this->db->from('webuser');
        $this->db->where("(webuser_email = '$username' OR webuser_username = '$username')");
        $this->db->where('webuser_password', md5($password));

        $query = $this->db->get();

        if ($query->num_rows() > 0) {



            $stud = $query->result()[0];
            if ($stud->webuser_status == "1") {

                redirect(site_url('signin/?emailverify=true&username=' . $username));
            } else {

                if (isset($_POST['check2'])) {
                    $remember = $_POST['check2'];
                } else {
                    $remember = "off";
                }


                if ($remember == "on") {
                    $cookie = $this->input->cookie('ci_sessionx'); // we get the cookie
                    $this->input->set_cookie('ci_sessionx', $cookie, '35580000'); // and add one year to it's expiration
                }

                $this->session->set_userdata('loggedx', "1");
                $this->session->set_userdata('id', $stud->webuser_id);
                $this->session->set_userdata('fname', $stud->webuser_fname);
                $this->session->set_userdata('lname', $stud->webuser_lname);
                $this->session->set_userdata('username', $stud->webuser_username);
                $this->session->set_userdata('email', $stud->webuser_email);
                $this->session->set_userdata('type', $stud->webuser_type);
                $this->session->set_userdata('remember_mex', $remember);
                $this->session->set_userdata('webuser_country', $stud->webuser_country);
                $this->session->set_userdata('webuser_picture', $stud->webuser_picture);
                
                $this->load->model('common_mod');
                $webUserContactDetails = $this->common_mod->get(WEB_USER_ADDRESS, null, " AND webuser_id=" . $stud->webuser_id);
                $user_timezone         =  $webUserContactDetails['rows'][0]['timezone'];
                $this->session->set_userdata('user_timezone', validate_user_timezone( $user_timezone ));
                 
                if ($this->session->userdata('type') == '1'){
                    redirect(site_url("jobs-home"));
                }
                    
                else{
                    if(isset($this->session->redirect)){
                        redirect($this->session->redirect);
                    }else{
                        redirect(site_url("find-jobs"));
                    }
                    
                }
                    
            }
        }else {


            redirect(site_url('signin/?error=true'));
        }
    }

}
