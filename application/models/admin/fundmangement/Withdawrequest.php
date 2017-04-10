<?php

class Withdawrequest extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('withdraw_model');
        $this->load->model('payment_methods_model');
    }

    function check($permission) {

        if ($this->Adminlogincheck->checkper($permission['withdawlrequest'])) {
            return true;
        } else {
            redirect(site_url());
            exit();
        }
    }

    function load($permission, $mod, $status = WITHDRAW_PENDING) {

        $page = $this->uri->uri_to_assoc();
        $permission_id = $status == WITHDRAW_PENDING ? 26 : 31;
        $title = $this->Adminforms->getdata("name", "usersubpage", $permission_id);

        if (isset($_GET['q'])) {
            $q = $_GET['q'];
        } else {
            $q = false;
        }

        $this->db->select('*');
        $this->db->from('webuser');
        $this->db->where('webuser.webuser_type', '1');
        $this->db->where('webuser.isactive', 1);
        $this->db->where('webuser.isdelete', 0);
        $query = $this->db->get();
        $result = $query->result();
        
        $from      = $this->input->get('from');
        $to        = $this->input->get('to');
        $user_type = $this->input->get('user_type');
        $criteria  = $this->input->get('criteria');

        $record = $this->withdraw_model->get_by_all_user($status, array(
            'from'      => $from,
            'to'        => $to,
            'user_type' => $user_type,
            'criteria'  => $criteria
        ));
        
        foreach ($record as $key => $value) {
            $data = $this->payment_methods_model->get_email_by_user_and_method($value['webuser_id'], strtolower($value['payment_type']));

            $record[$key]['email_payment'] = $data->account_id;
        }

        $this->load->model('payment_model');
        $data = array(
            'title' => $title,
            'permission' => $permission,
            'loadpage' => $page['loadpage'],
            'subpage' => $page['subpage'],
            'result' => $result,
            'record' => $record,
            'payment_model' => $this->payment_model,
            'from' => $from,
            'to' => $to,
            'user_type' => $user_type,
            'criteria' => $criteria,
        );

        $this->Admintheme->loadview($page['loadpage'] . "/withdawlrequest", $data);
    }

}

?>
