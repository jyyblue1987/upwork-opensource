<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Category', 'Common_mod'));
        $this->load->model(array('common_mod'));
    }

    public function index() {
        if ($this->Adminlogincheck->checkx()) {

            $user_id = $this->session->userdata('id');

            $time = strtotime('monday this week 00:00 UCT');
            $cweek = date('Y/m/d', $time);
            $nweek = date('Y/m/d', strtotime($cweek . ' + 1 weeks'));
            $prevweek = date('Y/m/d', strtotime($cweek . ' - 1 weeks'));

            $this->db->select('*');
            $this->db->from('job_workdairy');
            $this->db->where('fuser_id', $user_id);
            $this->db->where('working_date <=', $prevweek);
            $query_available = $this->db->get();
            $job_available_hourly = $query_available->result();

            $this->db->select('*,job_bids.id as bid_id');
            $this->db->from('job_bids');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->where('jobs.job_type', 'fixed');
            $this->db->where('job_bids.start_date <=', $prevweek);
            $this->db->where('job_bids.user_id', $user_id);
            $query_available_fixed = $this->db->get();
            $job_available_fixed = $query_available_fixed->result();

            $this->db->select('*');
            $this->db->from('withdraw');
            $this->db->where('userid', $user_id);
            $query_withdraw = $this->db->get();
            $withdraws = $query_withdraw->result();
            $paymentDatas = array();
            $condition = " AND webuser_id=" . $this->session->userdata(USER_ID) . " AND current_status='active'";
            $paymentData = $this->common_mod->get(WB_PAYMENT_METHODS, null, $condition);
            if (!empty($paymentData) && sizeof($paymentData['rows']) > 0) {
                $paymentDatas = $paymentData['rows'];
            }

            $condition = " AND webuser_id=".$this->session->userdata(USER_ID);
            $webUserTaxdetails = $this->common_mod->get(WB_TAX_INFO,null,$condition);
            
            if(!empty($webUserTaxdetails->rows)){
                $tax_status = 1;
            }else{
                $tax_status = 0;
            }

            $data = array('tax_status' => $tax_status,'job_available_hourly' => $job_available_hourly, 'paymentData' => $paymentDatas,'job_available_fixed' => $job_available_fixed, 'withdraws' => $withdraws);
            $this->Admintheme->webview("withdraw", $data);
        }
    }

    public function withdrawamount() {
        $user_id = $this->session->userdata('id');
        parse_str($_POST['form'], $form);

        $payment_type = $form['payment_type'];
        $bal_withdraw = $form['bal_withdraw'];
        $bal_processfees = $form['bal_processfees'];


        $jobendpay_end = array(
            'userid' => $user_id,
            'amount' => $bal_withdraw,
            'payment_type' => $payment_type,
            'processingfees' => $bal_processfees,
        );

        $this->db->insert('withdraw', $jobendpay_end);
        $response['success'] = true;
        $response['message'] = "Sucessfully Withdraw the amount";
        print_r(json_encode($response));
    }

}
