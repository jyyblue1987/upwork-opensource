<?php

/**
 * Queries for application, decline, interview, job offers, withdrawal processes
 *
 * @author avillanueva
 */
class Process extends CI_Model {

    function get_applications($job_id) {
        $this->db
                ->select('*')
                ->from('job_bids')
                ->where('job_id', $job_id)
                ->where('bid_reject', '0')
                ->where('status != 1')
                ->where('withdrawn', NULL)
                ->where('job_progres_status', '0');
        $query = $this->db->get();

        $return_array = array();
        $return_array['rows'] = $query->num_rows();
        if ($return_array['rows'] > 0) {
            $return_array['data'] = $query->result();
        }
        return $return_array;
    }

    function get_rejected($job_id) {
        $this->db
                ->select('*')
                ->from('job_bids')
                ->join('webuser', 'webuser.webuser_id = job_bids.user_id', 'inner')
                ->join('country', 'country.country_id = webuser.webuser_country', 'inner')
                ->join('jobs', 'jobs.id=job_bids.job_id', 'inner')
                ->where('job_bids.job_id', $job_id)
                ->where('job_bids.hired', '0')
                ->where('(job_bids.withdrawn = 1 OR job_bids.bid_reject = 1)');
        $query = $this->db->get();

        $return_array = array();
        $return_array['rows'] = $query->num_rows();
        if ($return_array['rows'] > 0) {
            $return_array['data'] = $query->result();
        }
        return $return_array;
    }

    function get_interviews($user_id, $job_id) {
        $this->db
                ->select('*')
                ->from('job_conversation')
                ->join('job_bids', 'job_conversation.bid_id = job_bids.id', 'inner')
                ->join('webuser', 'webuser.webuser_id=job_bids.user_id', 'left')
                ->where('job_conversation.sender_id', $user_id)
                ->where('job_conversation.job_id', $job_id)
                ->where('job_bids.bid_reject', 0)
                ->where('job_bids.job_progres_status', 1)
                ->where('job_bids.withdrawn', NULL)
                ->group_by('job_conversation.bid_id');
        $query = $this->db->get();

        $return_array = array();
        $return_array['rows'] = $query->num_rows();
        if ($return_array['rows'] > 0) {
            $return_array['data'] = $query->result();
        }
        return $return_array;
    }

    function get_offers($job_id) {
        $this->db
                ->select('*')
                ->from('job_bids')
                ->where('job_progres_status', 2)
                ->where('withdrawn',  NULL)
                ->where(array('job_id' => $job_id, 'hired' => '1'));
        $query = $this->db->get();

        $return_array = array();
        $return_array['rows'] = $query->num_rows();
        if ($return_array['rows'] > 0) {
            $return_array['data'] = $query->result();
        }
        return $return_array;
    }
    
    function get_hires($user_id, $job_id){
        $this->db
                ->select('*')
                ->from('job_accepted')
                ->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner')
                ->where('job_accepted.buser_id', $user_id)
                ->where('job_accepted.job_id', $job_id)
                ->where('job_bids.hired', '0')
                ->where('job_bids.jobstatus', '0')
                ->where('job_bids.job_progres_status', 3)
                ->where('job_bids.withdrawn', NULL);
        $query = $this->db->get();

        $return_array = array();
        $return_array['rows'] = $query->num_rows();
        if ($return_array['rows'] > 0) {
            $return_array['data'] = $query->result();
        }
        return $return_array;
    }
    
    function get_posted_jobs($user_id){
        $this->db
                ->join('webuser', 'webuser.webuser_id = jobs.user_id', 'left')
                ->order_by('jobs.id', 'desc');
        $query = $this->db->get_where('jobs', array('user_id' => $user_id, 'status' => 1));
        
        $return_array = array();
        $return_array['rows'] = $query->num_rows();
        if ($return_array['rows'] > 0) {
            $return_array['data'] = $query->result();
        }
        return $return_array;
    }
    
    function get_bids($job_id){
        $this->db
                ->join('webuser', 'webuser.webuser_id = job_bids.user_id', 'left')
                ->where('job_bids.job_progres_status', 0)
                ->where('job_bids.withdrawn',  NULL)
                ->where('job_id', $job_id)
                ->where('bid_reject', 0)
                ->where('status != 1')
                ->order_by('job_bids.id', 'desc');
        $query = $this->db->get('job_bids');
        
        $return_array = array();
        $return_array['rows'] = $query->num_rows();
        if ($return_array['rows'] > 0) {
            $return_array['data'] = $query->result();
        }
        return $return_array;
    }
    
    function get_job_details($job_id){
        $this->db->where('id', $job_id);
        $query = $this->db->get('jobs');
        return $query->row_array();
    }

    function cnt_ended_jobs($user_id){
        $this->db
                ->select('*')
                ->from('job_bids')
                ->where('user_id', $user_id)
                ->where('jobstatus',1) ;
        $query = $this->db->get();
        return $query->num_rows();
    }

    function accepted_jobs($user_id){
        $this->db
                ->select('*')
                ->from('job_accepted')
                ->join('job_bids', 'job_bids.id = job_accepted.bid_id', 'inner')
                ->join('jobs', 'jobs.id = job_bids.job_id', 'inner')
                ->where('job_accepted.fuser_id', $user_id);
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_feedbacks($fuser_id, $job_id){
        $this->db
                ->select('*')
                ->from('job_feedback')
                ->where('feedback_userid', $fuser_id)
                ->where('sender_id !=', $fuser_id)
                ->where('feedback_job_id', $job_id);
        $query = $this->db->get();
        return $query->row_array();
    }

}