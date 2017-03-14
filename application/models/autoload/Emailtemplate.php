<?php

class Emailtemplate extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function emailview($page, $data){
        $body = $this->load->view('admin/emailtemplates/header', $data, TRUE);
        $body .= $this->load->view('emailview/'.$page, $data, TRUE);
        $body .= $this->load->view('admin/emailtemplates/footer', $data, TRUE);

        return $body;
    }
    
    function emailtest($page, $data){
        $this->load->view('admin/emailtemplates/header', $data, false);
        $this->load->view('emailview/'.$page, $data, false);
        $this->load->view('admin/emailtemplates/footer', $data, false);
    }

}
