<?php

class Adminlogincheck extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function checkx() {

        if ($this->session->userdata('remember_mex') == "on") {
            $cookie = $this->input->cookie('ci_sessionx');
            $this->input->set_cookie('ci_sessionx', $cookie, '35580000');
        }
        
        if ($this->session->userdata('loggedx') == 1) {
            
            $this->db->select('webuser_id');
            $this->db->from('webuser');
            $this->db->where('webuser_id', $this->session->userdata('id'));
            $this->db->where('webuser_status', '2');

            $query = $this->db->get();

            if ($query->num_rows() == 1) {

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function check() {

        if ($this->session->userdata('remember_me') == "on") {
            $cookie = $this->input->cookie('ci_session');
            $this->input->set_cookie('ci_session', $cookie, '35580000');
        }
        if ($this->session->userdata('logged') == 1) {
            $this->db->select('id');
            $this->db->from('user');
            $this->db->where('id', $this->session->userdata('id'));
            $this->db->where('status', '1');

            $query = $this->db->get();

            if ($query->num_rows() == 1) {
                if ($this->session->userdata('type') == "1") {
                    return true;
                } else {
                    if ($this->Adminforms->getdata("value", "site", 1) == '1') {
                        return true;
                    } else {
                        $this->session->sess_destroy();
                        redirect(site_url("login/error/type/offline"));
                    }
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function checkper($p) {

        if ($this->session->userdata('type') == "1") {
            return true;
        } else {

            $this->db->select('id');
            $this->db->from('usersubpageaccess');
            $this->db->where('user', $this->session->userdata('id'));
            $this->db->where('subpage', $p);
            $query = $this->db->get();

            if ($query->num_rows() == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

}

?>
