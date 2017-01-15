<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Changepassword extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('common_mod'));
    }
    public function index()
    {

        
        if ($this->Adminlogincheck->checkx())
        {

            $condition = " AND webuser_id=".$this->session->userdata(USER_ID);
                $webUserContactDetails = $this->common_mod->get(WEB_USER_ADDRESS,null,$condition);
                if(empty($webUserContactDetails['rows'])){
                    $webUserContactDetails['rows'][0] = "";
                }

                //webuser contact details//
                $webuserCountry = $this->common_mod->getSpecificColVal(COUNTEY_TABLE,"country_name"," AND country_id  =".$this->session->userdata('webuser_country'));
                $countryList = $this->common_mod->get(COUNTEY_TABLE,null," AND country_status=1");
               
            $data = array(
                'title' => "Change Password",
                'page' => "changepassword",
                'open' => "security",
                'name' => $this->session->userdata('fname') . " " . $this->session->userdata('lname'),
                'id' => $this->session->userdata('id'),
                'js' => array('vendor/jquery.form.js','internal/pwdchange.js'),
                'jsf' => array("assets/js/layerslider.transitions.js", "assets/js/layerslider.kreaturamedia.jquery.js", "assets/js/owl.carousel.min.js", "assets/js/homepage.js"),
                'css' => array("assets/css/layerslider.css", "assets/css/owl.carousel.css", "assets/css/owl.theme.css"),
                'countryList' => $countryList['rows'],
                    'open' => 'account',
                    'openSub' =>'profile-basic',
                    'webuserContactDetails' =>$webUserContactDetails['rows'][0],
                    'webuserCountry'=>$webuserCountry,
                );
            $this->Admintheme->webview("changepassword", $data);
        } else
        {
            redirect(site_url("dashboard"));
        }
    }
    public function update()
    {
        $old_pwd = md5($this->input->post('old_password'));
        $pwd = md5($this->input->post('password'));
        $id = $this->session->userdata('id');
        $this->db->select(array('webuser_password'));
        $this->db->from('webuser');
        $this->db->where('webuser_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            $userPassword = $query->row()->webuser_password;
            if ($old_pwd == $userPassword)
            {
                $data = array(
                    'webuser_password' => $pwd
                );
                $this->db->where('webuser_id', $this->session->userdata('id'));
                $this->db->update('webuser', $data);
                echo '<div class="alert alert-success">
                    <strong>Success!</strong> Password is updated successfully.
                  </div>';
            } 
            else
            {
                echo '<div class="alert alert-danger">
                    <strong>Error!</strong> Password is invalid.
                  </div>';
            }
        } else
        {
            echo '<div class="alert alert-danger">
                    <strong>Error!</strong> No user found.
                  </div>';
        }
    }

}
