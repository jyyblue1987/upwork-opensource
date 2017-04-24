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
                ->select('*, job_bids.id as bid_id')
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
                ->select('*, job_bids.id as bid_id')
                ->from('job_bids')
                ->join('webuser', 'webuser.webuser_id = job_bids.user_id', 'inner')
                ->join('country', 'country.country_id = webuser.webuser_country', 'inner')
                ->join('jobs', 'jobs.id=job_bids.job_id', 'inner')
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
                ->join('webuser', 'webuser.webuser_id=job_accepted.fuser_id', 'inner')
                ->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id=webuser.webuser_id', 'inner')
                ->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner')
                ->join('jobs', 'jobs.id=job_bids.job_id', 'inner')
                ->join('country', 'country.country_id=webuser.webuser_country', 'inner')
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

    function accepted_jobs($user_id, $buser_id = false){

        $this->db->select('*');
        $this->db->from('job_accepted');
        $this->db->join('job_bids', 'job_bids.id = job_accepted.bid_id', 'inner');
        $this->db->join('jobs', 'jobs.id = job_bids.job_id', 'inner');
        $this->db->join('webuser', 'webuser.webuser_id=jobs.user_id', 'left');

        if($buser_id){
            $this->db->where('job_accepted.buser_id', $user_id);
        }else{
            $this->db->where('job_accepted.fuser_id', $user_id);
        }

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
    
    function get_withdrawn_by($user_id, $bid_id, $job_id){
        $this->db
                ->select('job_progres_status, withdrawn, bid_reject, withdrawn_by')
                ->from('job_bids')
                ->where('job_bids.id', $bid_id)
                ->where('job_bids.user_id', $user_id)
                ->where('job_bids.job_id', $job_id);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    function get_conversation($job_id, $bid_id){
        $this->db
            ->select('job_conversation.*,job_conversation.created as conversation_date,webuser.*,jobs.title')
            ->from('job_conversation')
            ->join('webuser', 'job_conversation.sender_id = webuser.webuser_id', 'inner')
            ->join('jobs', 'jobs.id = job_conversation.job_id', 'inner')
            ->where('job_conversation.job_id', $job_id)
            ->where('job_conversation.bid_id', $bid_id);
        $query = $this->db->get();
        
        $return_array         = array();
        $return_array['rows'] = $query->num_rows();
        if ($return_array['rows'] > 0) {
            $return_array['data'] = $query->result();
        }
        return $return_array;
    }
    
    function get_convo_images($id){
        $this->db
            ->select('*')
            ->from('job_conversation_files')
            ->where('job_conversation_id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function get_all_images_of_each_message( $ids )
    {
        $query = $this->db
                    ->select('*')
                    ->from('job_conversation_files')
                    ->where_in('job_conversation_id', $ids)
                    ->order_by('job_conversation_id')
                    ->get();
        
        $result = $query->result();
        
        $images = array();
        if( ! empty($result) )
        {
            foreach($result as $item)
            {
                $image_item = new stdClass;
                $image_item->name = $item->name;
                $images[ $item->job_conversation_id ][] = $image_item;
            }
        }
        return $images;
    }
    
    function get_job_info($user_id, $job_id){
        $this->db
                ->select('job_bids.*, jobs.job_type, jobs.title, job_bids.id AS bid_id')
                ->from('job_bids')
                ->join('jobs', 'jobs.id = job_bids.job_id', 'inner')
                ->where('job_bids.user_id', $user_id)
                ->where('job_bids.job_id', $job_id); 
        $query = $this->db->get();
        return $query->row_array();
    }
    
    function get_job_ids($user_id){
        $this->db
                ->select('*')
                ->from('jobs')
                ->where('user_id', $user_id);
        $query = $this->db->get();

        $jobids = array();
        foreach ($query->result() as $jobs) {
            $jobids[] = $jobs->id;
        }

        return implode(",", $jobids);
    }

    function total_hired($jobids){
        $this->db
                ->select('*')
                ->from('job_bids')
                ->where_in('job_id', $jobids, FALSE)
                ->where('hired', '1');
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_worked_hours($user_id){
        $this->db
                ->select('*')
                ->from('job_workdairy')
                ->where_in('cuser_id', $user_id);
        $query = $this->db->get();

        $total_work = 0;
        if($query->num_rows()){
            foreach($query->result() as $work){
                $total_work += $work->total_hour;
            }
            return $total_work." hours";
        }else{
            return "0.00 hours";
        }
    }
    
    function get_jobs($emp_id){
        $this->db
                ->select('*')
                ->from('jobs')
                ->where('user_id', $emp_id);
        $query = $this->db->get();

        $return_array = array();
        $return_array['rows'] = $query->num_rows();
        if ($return_array['rows'] > 0) {
            $return_array['data'] = $query->result();
        }
        return $return_array;
    }
    
    function get_total_offers($user_id){
        $this->db
                ->select('*, job_bids.id as bid_id')
                ->from('job_bids')
                ->join('jobs', 'jobs.id=job_bids.job_id', 'inner')
                ->where('job_bids.job_progres_status', 2)
                ->where('job_bids.hired', '1')
                ->where('job_bids.bid_reject', '0')
                ->where('job_bids.status', '0')
                ->where('jobs.status', '1')
                ->where('job_bids.user_id', $user_id);
        $query = $this->db->get();

        $return_array = array();
        $return_array['rows'] = $query->num_rows();
        if ($return_array['rows'] > 0) {
            $return_array['data'] = $query->result();
        }
        return $return_array;
    }
    
    function is_applied($user_id, $job_id){
        $query = $this->db->get_where('job_bids', array('job_id' => $job_id, 'user_id' => $user_id, 'status!=1' => null));
        return $query->num_rows();
    }
    
    function get_freelancer_proposals($user_id){
        $monthStart = date('Y-m-01');
        $monthEnd = date('Y-m-t');

        $this->db
                ->select('id')
                ->where("(created BETWEEN '{$monthStart}' AND '{$monthEnd}')");
        $query = $this->db->get_where('job_bids', array('job_bids.user_id' => $user_id));
        return $query->num_rows();
    }
    
    function get_attachments($bid_id){
        $this->db
                ->select("*")
                ->from("job_bid_attachments")
                ->where("job_bid_id = ", $bid_id);
        $query = $this->db->get();
        $attachments = $query->result_array();
        
        $files = array();
        if($query->num_rows() > 0){
            $attachments = explode(",", $attachments[0]['path']);
            foreach($attachments AS $attachment){
                $files[] = str_replace('"','', $attachment);
            }
        }
        return $files;
    }
    
    public function time_elapsed_string($_ptime){
        $ptime = strtotime($_ptime);
        $etime = time() - $ptime;

        if ($etime < 1){
            return '0 seconds';
        }

        $a = array(365 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        $a_plural = array('year' => 'years',
            'month' => 'months',
            'day' => 'days',
            'hour' => 'hours',
            'minute' => 'minutes',
            'second' => 'seconds'
        );

        foreach ($a as $secs => $str){
            $d = $etime / $secs;
            if ($d >= 1){
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
            }
        }
    }
    
    public function feedback_worked_hrs($user_id, $job_id){
        $this->db
                ->select('*')
                ->from('job_workdairy')
                ->where('fuser_id', $user_id)
                ->where('jobid', $job_id);
        $query = $this->db->get();
        $result = $query->result();
        $total_work = 0;

        if(!empty($result)){
            foreach($result as $work){
                $total_work += $work->total_hour;
            }
            return $total_work;
        }else{
            return "0.00";
        }
    }
    
    public function get_freelancer_bid($user_id, $bidId){
        $this->db
                ->select(array('job_bids.*', 'jobs.title', 'jobs.job_type', 'jobs.id as jobid',
                        'jobs.budget', 'jobs.hours_per_week', 'jobs.job_duration', 'jobs.category',
                        'jobs.experience_level', 'jobs.skills', 'jobs.job_description', 'jobs.user_id as clientid', 'jobs.userfile', 'jobs.tid', 'jobs.job_created'))
                ->join('jobs', 'jobs.id=job_bids.job_id', 'left')
                ->order_by("job_bids.id", "desc");
        $query = $this->db->get_where('job_bids', array('job_bids.user_id' => $user_id, 'job_bids.id' => $bidId));
        return $query->row_array();
    }
    
    public function get_active_interviews($user_id){
        $this->db
                ->select('jobs.*, job_bids.*,webuser.*,job_bids.user_id AS bid_user_id,job_bids.status AS bid_status,job_bids.created AS bid_created,job_conversation.bid_id AS jbid_id')
                ->join('job_bids', 'jobs.id=job_bids.job_id', 'inner')
                ->join('webuser', 'jobs.user_id=webuser.webuser_id', 'inner')
                ->join('job_conversation', 'job_bids.id=job_conversation.bid_id', 'left')
                ->where('job_bids.user_id',$user_id)
                ->where('job_bids.status','0')
                ->where('job_bids.bid_reject','0')
                ->where('job_bids.job_progres_status', '1')
                ->where('job_bids.withdrawn',  NULL)
                ->group_by('jbid_id')
                ->order_by("jobs.id", "desc");
        $query = $this->db->get('jobs');

        $return_array = array();
        $return_array['rows'] = $query->num_rows();
        if ($return_array['rows'] > 0) {
            $return_array['data'] = $query->result();
        }
        return $return_array;
    }
    
    public function get_proposed_bids($user_id){
        $this->db
                ->select('*')
                ->from('job_bids')
                ->where(array('bid_reject' => 0, 'status!=1' => null))
                ->where('user_id', $user_id)
                ->where('job_progres_status', 0)
                ->where(array('withdrawn' => NULL));
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function get_job_bids($job_id){
        $this->db
                ->select('*')
                ->from('job_bids')
                ->where(array('job_id' => $job_id, 'bid_reject' => 0, 'status!=1' => null));
        $query = $this->db->get();
        return $query->num_rows();
    }
}