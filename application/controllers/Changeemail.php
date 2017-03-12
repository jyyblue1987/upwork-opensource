<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Changeemail extends CI_Controller {

    public function __construct() {
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
        return $randomString;
    }

    public function index() {
        if ($this->Adminlogincheck->checkx()) {
            $condition = " AND webuser_id=" . $this->session->userdata(USER_ID);
            $webUserContactDetails = $this->common_mod->get(WEB_USER_ADDRESS, null, $condition);

            if (empty($webUserContactDetails['rows'])) {
                $webUserContactDetails['rows'][0] = "";
            }

            //webuser contact details//
            $webuserCountry = $this->common_mod->getSpecificColVal(COUNTEY_TABLE, "country_name", " AND country_id  =" . $this->session->userdata('webuser_country'));
            $countryList = $this->common_mod->get(COUNTEY_TABLE, null, " AND country_status=1");

            $data = array(
                'title' => "Update Email Address",
                'page' => "changeemail",
                'open' => "security",
                'name' => $this->session->userdata('fname') . " " . $this->session->userdata('lname'),
                'id' => $this->session->userdata('id'),
                'js' => array('vendor/jquery.form.js', 'internal/emailchange.js'),
                'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
                'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
                'countryList' => $countryList['rows'],
                'open' => 'account',
                'openSub' => 'profile-basic',
                'webuserContactDetails' => $webUserContactDetails['rows'][0],
                'webuserCountry' => $webuserCountry,
            );

            $this->Admintheme->webview("changeemail", $data);
        } else {
            redirect(site_url("dashboard"));
        }
    }

    public function updateEmail() {
        $token = self::generateRandomString(30);
        $email = $this->input->post('old_email');
        $pwd = md5($this->input->post('password'));
        $id = $this->session->userdata('id');

        $this->db->select(array('webuser_password', 'webuser_email', 'webuser_fname'));
        $this->db->from('webuser');
        $this->db->where('webuser_id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $userPassword = $query->row()->webuser_password;
            $userEmail = $query->row()->webuser_email;
            $fname = $query->row()->webuser_fname;


            if (($pwd == $userPassword) && ($email == $userEmail)) {
                $data = array(
                    'webuser_email' => $this->input->post('email'),
                    'webuser_status' => '1',
                    'webuser_token' => $token
                );

                $this->db->where('webuser_id', $this->session->userdata('id'));
                $this->db->update('webuser', $data);

                $resetlink = site_url() . "verifyemail?token=" . $token;

                $notif = array(
                    'user_id' => $id,
                    'read_status' => 0,
                    'description' => 'Updated email address',
                    'link' => site_url().'profile-settings'
                );

                $this->db->insert('notification', $notif);

                $subject = "Change Email Address Request";
                $data = array(
                    'fname' => $fname,
                    'company' => 'Winjob',
                    'verification' => $resetlink,
                    'slogan' => 'Hire Talented Freelancers For a Low Cost',
                    'greeting' => 'Hi ' . $fname,
                    'para1' => 'You have updated your email address to ' . $this->input->post('email') . '. Please verify this new email address by clicking the button below.',
                    'para2' => 'If you did not request to change your email address, please <a href="' . site_url() . 'contact" style="color: #0061A7; text-decoration: none;">contact us</a>.'
                );

                echo '<div class="alert alert-success"><strong>Your Email Address has been successfully updated!</strong><br> We sent you a verification link to the new email.</div>';

                $response = $this->Sesmailer->sesemail($this->input->post('email'), $subject, $this->Emailtemplate->emailview('verify_email', $data));
                $this->session->sess_destroy();
            } else if ($email != $userEmail) {
                echo '<div class="alert alert-danger"><strong>Error!</strong> Old email is invalid.</div>';
            } else {
                echo '<div class="alert alert-danger"><strong>Error!</strong> Password is invalid.</div>';
            }
        } else {
            echo '<div class="alert alert-danger"><strong>Error!</strong> No user found.</div>';
        }
    }
}
