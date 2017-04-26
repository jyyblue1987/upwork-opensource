<?php

/**
 * Description of Employers
 *
 * @author avillanueva
 */
class Employer extends CI_Model {

    private $webuser_uid;
    private $fname;
    private $lname;
    private $email;
    private $username;
    private $type;
    private $company;
    private $status;
    private $position;
    private $country;
    private $phone;
    private $title;
    private $website;
    private $date_registered;
    private $is_active;
    private $emp_id;
    private $payment_set;
    private $total_spent;
    
    function __construct($user_id = false) {
        parent::__construct();
        if(is_numeric($user_id)){
            return $this->init($user_id);
        }else if($user_id !== false){
            $result = $this->db->query("SELECT webuser_id FROM webuser WHERE webuser_username = '$user_id'");
            $_uid = $result->row_array();
            return $this->init($_uid['webuser_id']);
        }
    }

    function init($user_id) {
        $result = $this->db
                ->select('*')
                ->from('webuser')
                ->where('webuser_id', $user_id)
                ->get();

        if ($result->num_rows() > 0) {
            $employer = $result->row_array();
            $this->webuser_uid = $employer['webuser_id'];
            $this->fname = $employer['webuser_fname'];
            $this->lname = $employer['webuser_lname'];
            $this->email = $employer['webuser_email'];
            $this->username = $employer['webuser_username'];
            $this->type = $employer['webuser_type'];
            $this->company = $employer['webuser_company'];
            $this->status = $employer['webuser_status'];
            $this->position = $employer['webuser_position'];
            $this->country = $employer['webuser_country'];
            $this->phone = $employer['webuser_phone'];
            $this->title = $employer['webuser_title'];
            $this->website = $employer['webuser_site'];
            $this->date_registered = $employer['created'];
            $this->is_active = $employer['isactive'];
            $this->emp_id = $this->get_job_employer($user_id);
            $this->payment_set = $this->is_payment_set($user_id);
            $this->total_spent = $this->total_spent($user_id);
        } else {
            return FALSE;
        }
    }

    function get_userid() {
        return $this->webuser_uid;
    }

    function get_fname() {
        return ucfirst($this->fname);
    }

    function get_lname() {
        return $this->lname;
    }

    function get_fullname() {
        return $this->fname . ' ' . $this->lname;
    }

    function get_email() {
        return $this->email;
    }

    function get_username() {
        return $this->username;
    }

    function get_type() {
        return $this->type;
    }

    function get_company() {
        return $this->company;
    }

    function get_status() {
        return $this->status;
    }

    function get_position() {
        return $this->position;
    }

    function get_country() {
        $this->db->where('country_id', $this->country);
	$query = $this->db->get('country');
        $result = $query->row_array();
        return $result['country_name'];
    }

    function get_phone() {
        return $this->phone;
    }

    function get_title() {
        return $this->title;
    }

    function get_site() {
        return $this->website;
    }

    function get_date_reg() {
        return $this->date_registered;
    }

    function is_active() {
        return $this->is_active;
    }

    function get_job_employer($user_id){
        $query = $this->db
                    ->select('*')
                    ->from('webuser')
                    ->join('jobs', 'user_id = webuser_id', 'left')
                    ->where('id', $user_id)
                    ->get();
        $employer = $query->row_array();
        return $employer['webuser_id'];
    }
    
    function is_payment_set(){
        $this->db
                ->select('*')
                ->from('jobs')
                ->join('billingmethodlist', 'billingmethodlist.belongsTo = jobs.user_id', 'inner')
                ->where('billingmethodlist.belongsTo', $this->get_userid())
                ->where('billingmethodlist.isDeleted', '0')
                ->where('jobs.status', 1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function total_spent($user_id){
        $query = $this->db->query("SELECT SUM(payment_gross) as total_spent 
            FROM payments 
            INNER JOIN webuser 
            ON webuser.webuser_id = payments.user_id 
            INNER JOIN jobs 
            ON jobs.id = payments.job_id 
            INNER JOIN job_accepted 
            ON job_accepted.job_id = payments.job_id 
            INNER JOIN job_bids 
            ON job_bids.job_id = payments.job_id 
            WHERE job_accepted.fuser_id = payments.user_id 
            AND job_bids.user_id = payments.user_id 
            AND payments.buser_id = $user_id");
        $total = $query->row();
        return $total->total_spent;
    }
}