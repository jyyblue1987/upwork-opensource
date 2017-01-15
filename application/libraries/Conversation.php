<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * File Uploading Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Uploads
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/file_uploading.html
 */
class Conversation  {
    
    
     public function index()
    {
        $this->CI =& get_instance();
       $user_id = $this->CI->session->userdata('id');
        
        $this->CI->db->select('*');
        $this->CI->db->from('job_conversation');
        $this->CI->db->where('job_conversation.receiver_id', $user_id);
        $this->CI->db->where('job_conversation.have_seen', 1);
        $this->CI->db->group_by('bid_id'); 
        
        $query=$this->CI->db->get();// assign to a variable
        $conversation_count = $query->num_rows();// then use num rows
        
        $notification_conversation = 0;
        if($conversation_count){
            $notification_conversation = $conversation_count;
        }
        return $notification_conversation;
    }
    public function details()
    {
        $this->CI =& get_instance();
       $user_id = $this->CI->session->userdata('id');
        
        $this->CI->db->select('*');
        $this->CI->db->from('job_conversation');
		$this->CI->db->join('webuser', 'job_conversation.sender_id = webuser.webuser_id', 'inner');
        $this->CI->db->where('job_conversation.receiver_id', $user_id);
        $this->CI->db->where('job_conversation.have_seen', 1);
        $this->CI->db->group_by('bid_id'); 
        
        $query=$this->CI->db->get();// assign to a variable
        $conversation_count = $query->num_rows();// then use num rows
        
        $notification_conversation = '';
        if($conversation_count){
            $notification_conversation = $query->result();;
        }
        return $notification_conversation;
    }
	
	public function job_alert()
    {
        $this->CI =& get_instance();
       $user_id = $this->CI->session->userdata('id');
        
        $this->CI->db->select('*');
        $this->CI->db->from('job_bids');
		//$this->CI->db->join('webuser', 'job_conversation.sender_id = webuser.webuser_id', 'inner');
        $this->CI->db->where('job_bids.user_id', $user_id);
        $this->CI->db->where('job_bids.hired', '1');
        
        $query=$this->CI->db->get();// assign to a variable
        $job_alert_count = $query->num_rows();// then use num rows
        
        $job_alert_data = '';
        if($job_alert_count){
            $job_alert_data = $query->result();
        }
        return $job_alert_count;
    }
    
     public function freelancerend(){
        $this->CI =& get_instance();
       $user_id = $this->CI->session->userdata('id');
	  
	   $this->CI->db->select('*');
        $this->CI->db->from('job_feedback');
	   $this->CI->db->join('job_bids', 'job_feedback.feedback_userid = job_bids.user_id', 'inner');
	   $this->CI->db->where('job_feedback.feedback_userid', $user_id);
	    $this->CI->db->where('job_feedback.sender_id !=', $user_id);
        $this->CI->db->where('job_bids.jobstatus', '1');
	   $this->CI->db->where('job_feedback.haveseen', 1);
	   $this->CI->db->group_by("job_feedback.feedback_id");
	    $query=$this->CI->db->get();
	    $job_end_data = $query->result();
	    
	  $this->CI->db->last_query();
        return $job_end_data;
        
    }
	
	public function clientend(){
		
		
		 $this->CI =& get_instance();
       $user_id = $this->CI->session->userdata('id');
	  
	   $this->CI->db->select('*');
        $this->CI->db->from('job_feedback');
	   $this->CI->db->join('job_bids', 'job_feedback.feedback_job_id = job_bids.job_id', 'inner');
	   $this->CI->db->where('job_feedback.feedback_clientid', $user_id);
	    $this->CI->db->where('job_feedback.sender_id !=', $user_id);
	    $this->CI->db->where('job_feedback.haveseen', 1);
        $this->CI->db->where('job_bids.jobstatus', '1');
	   $this->CI->db->group_by("job_feedback.feedback_id");
	    $query=$this->CI->db->get();
	    $job_end_data = $query->result();
	    
	  $this->CI->db->last_query();
        return $job_end_data;
		
        
    }
    
    public function checkstatus(){
		$user_id = $this->CI->session->userdata('id');
		$this->CI->db->select('*');
		$this->CI->db->from('webuser');
		$this->CI->db->where('webuser.webuser_id', $user_id);
		$query_status = $this->CI->db->get();
		$ststus = $query_status->row();
		return $ststus;
    }
    
    
    
    
   // --------------------------------------------------------------------
}

// END Upload Class

/* End of file Upload.php */
/* Location: ./system/libraries/Upload.php */
