<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Active_interview  extends CI_Controller{
    
      public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Category', 'Common_mod'));
      
    }
    public function index()
    {
        if ($this->Adminlogincheck->checkx())
        {
            if($this->session->userdata('type') != 2){
            redirect(site_url("jobs-home"));
        }
            
            $user_id = $this->session->userdata('id');
            
            // $this->db->select('*');
            //,job_conversation.bid_id AS jbid_id $this->db->join('job_conversation', 'job_bids.id=job_conversation.bid_id', 'left');
             $this->db->select('jobs.*, job_bids.*,webuser.*,job_bids.user_id AS bid_user_id,job_bids.status AS bid_status,job_bids.created AS bid_created,job_conversation.bid_id AS jbid_id');
             
             $this->db->join('job_bids', 'jobs.id=job_bids.job_id', 'left');
             $this->db->join('webuser', 'jobs.user_id=webuser.webuser_id', 'left');
             $this->db->join('job_conversation', 'job_bids.id=job_conversation.bid_id', 'left');
            $this->db->where('job_bids.user_id',$user_id);
            $this->db->where('job_bids.status',0);
            $this->db->group_by('jbid_id'); 
            $this->db->order_by("jobs.id", "desc");
            $query=$this->db->get('jobs');
            
            $record = $query->result();
            
            
            $this->db->select('jobs.*, job_bids.*,webuser.*,job_bids.user_id AS bid_user_id,job_bids.status AS bid_status,job_bids.created AS bid_created');
             
            $this->db->join('job_bids', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->join('webuser', 'jobs.user_id=webuser.webuser_id', 'inner');
            $this->db->where('job_bids.user_id',$user_id);
            $this->db->where('job_bids.hired','1');
            $this->db->where('job_bids.status',0);
            $this->db->order_by("jobs.id", "desc");
            $query=$this->db->get('jobs');
          //$this->db->last_query();
            $record_offer = $query->result();
            
            $data = array('active_interview' => $record,'active_offer'=>$record_offer);
            $this->Admintheme->webview("jobs/active_interview", $data);
        }
    }
}

?>
