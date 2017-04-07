<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Freelancerinvite extends CI_Controller {
	
	  public function __construct()
    {
        parent::__construct();
        //$this->load->model(array('Category', 'Common_mod'));
        $this->load->model(array('common_mod', 'Category', 'profile/ProfileModel', 'Process',));
        $this->load->model(array('timezone'));
        $this->process = new Process();
      
    }
	

	public function index() {

            if($this->session->userdata('type') != 2){
            redirect(site_url("jobs-home"));
        }
		if ($this->Adminlogincheck->checkx()){
              $postId = base64_decode($_GET['fmJob']);
			
			$id = $this->session->userdata('id');

            $this->db->select('webuser.*,jobs.*,jobs.created created');
            $this->db->join('webuser', 'webuser.webuser_id=jobs.user_id', 'left');
            $this->db->order_by("jobs.id", "desc");
            $query = $this->db->get_where('jobs', array('id' => $postId));
            $record = $query->row();
            $query = $this->db->get_where('job_bids', array('job_id' => $postId, 'user_id' => $id));
            $bids_details = $query->row();
            $is_applied  = $query->num_rows();

            //conversation
            $conversation_count = 0;
            $conversation = array();
            
            if( $is_applied ){     
                $this->db->select('*');
                $this->db->from('job_conversation');
                $this->db->where('job_conversation.receiver_id', $id);
                $this->db->where('job_conversation.job_id', $postId);
                $this->db->where('job_conversation.bid_id', $bids_details->id);
                
                $query=$this->db->get();// assign to a variable
                $conversation_count = $query->num_rows();// then use num rows

                }
               
                if( $conversation_count ){
                
                    $this->db->select('job_conversation.*,job_conversation.created as conversation_date,webuser.*');
                    $this->db->from('job_conversation');
                    $this->db->join('webuser', 'job_conversation.sender_id = webuser.webuser_id', 'inner');
                    $this->db->where('job_conversation.job_id', $postId);
                    $this->db->where('job_conversation.bid_id', $bids_details->id);
                    $this->db->order_by("job_conversation.id", "ASC");
                    $query_conversation=$this->db->get();
                    $conversation =  $query_conversation->result();
                
                    
                    

                foreach ($conversation as $key => $value) {
                    $this->db->select('*');
                    $this->db->from('job_conversation_files');
                    $this->db->where('job_conversation_id', $value->id);
                    $query = $this->db->get();
                    $images = $query->result();
                    $conversation[$key]->images_array = $images;
                }
            }
		
		
		$this->db->select('*,job_bids.id as bid_id,job_bids.status AS bid_status,jobs.job_duration AS jobduration,job_bids.created AS bid_created');
		$this->db->from('job_accepted');
		$this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
		$this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
		$this->db->where('job_accepted.buser_id',$record->user_id);
		$query=$this->db->get();
		$accepted_jobs = $query->result();
		//echo $this->db->last_query();
		
		$this->db->select('*');
            $this->db->from('jobs');
            $this->db->where('user_id', $record->user_id);
            $query_sidebar = $this->db->get();
            $record_sidebar = $query_sidebar->result();

            $jobids = array();
            foreach ($record_sidebar as $jobs) {
                $jobids[] = $jobs->id;
            }
            $jobids = implode(",", $jobids);

            $_jobids = array_map('intval',$jobids);
            
            $this->db->select('*');
            $this->db->from('job_bids');
            $this->db->where_in('job_id', $_jobids);
            $this->db->where('hired', 1);
            $query_hire = $this->db->get();
            $record_hire = $query_hire->num_rows();
            
//            /var_dump($record_hire);
            
             $this->db->select('*');
            $this->db->from('job_workdairy');
            $this->db->where_in('cuser_id',$record->user_id);
            $queryhour=$this->db->get();
            $workedhours = $queryhour->result();

            $condition = " AND webuser_id=" . $this->session->userdata(USER_ID);
            $webUserContactDetails = $this->common_mod->get(WEB_USER_ADDRESS,null,$condition);
            $timezone = $this->timezone->get($webUserContactDetails['rows'][0]['timezone']);
            $data['timezone'] = $timezone;
            
            $this->db->select("skill_name");
            $this->db->from("job_skills");
            $this->db->where("job_id = ", $postId);
            $query = $this->db->get();
            $job_skills = $query->result_array();
            $record->job_skills = $job_skills;
            
            $applicants = $this->process->get_applications($postId);
            $interviews = $this->process->get_interviews($record->user_id, $postId);
            $hires = $this->process->get_hires($record->user_id, $postId);

            $data = array('value' => $record, 'hire' => $record_hire, 'receiver' => $record->user_id,  'applied' => $is_applied, 'conversations' => $conversation, 'conversation_count' => $conversation_count, 'withdrawn' =>$bids_details->withdrawn, 'withdrawn_by' =>$bids_details->withdrawn_by,  'bid_details'=>$bids_details,'js' => array('vendor/jquery.form.js', 'internal/job_withdraw.js'),'accepted_jobs'=>$accepted_jobs,'record_sidebar' => $record_sidebar,'hire'=>$record_hire,'workedhours'=>$workedhours, 'applicants' => $applicants['rows'], 'hires' => $hires['rows'], 'interviews' => $interviews['rows'], 'skills' => $job_skills,);
            $this->Admintheme->webview("freelancerinvite", $data);
        }

	}
}
