<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Allow to access/update/delete job's informations from database
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Jobs_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_type( $job_id ){
        $this->db
            ->select('job_type')
            ->from('jobs')
            ->where('jobs.id', $job_id);
        
        $query = $this->db->get();
        return $query->row();
    }
    
    public function load_job_status($sender_id, $user_id, $job_id, $with_country = false) {
        
        $this->db->select('*, job_bids.created AS bid_created, job_bids.id as bid_id, jobs.status AS job_status,jobs.job_duration AS jobduration,jobs.created AS job_created, webuser.cropped_image, job_bids.status as bid_status');
        $this->db->from('job_accepted');
        $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
        
        if($sender_id !== null){
            $this->db->join('webuser', 'webuser.webuser_id=job_accepted.fuser_id', 'inner');
        }else{
            $this->db->join('webuser', 'webuser.webuser_id=job_accepted.buser_id', 'inner');
        }
        
        $this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id=webuser.webuser_id', 'inner');
        $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
        
        if($with_country)
            $this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
        
        if($sender_id !== null){
            $this->db->where('job_accepted.buser_id', $sender_id);
            $this->db->where('job_accepted.fuser_id', $user_id);    
        }else{
            $this->db->where('job_accepted.fuser_id', $user_id);    
        }
        
        $this->db->where('job_accepted.job_id', $job_id);
        
        $query      = $this->db->get();
        return $query->row();
    }
    
    /**
     * Count the number of hired freelance by an employer.
     * 
     * @return int $nb_hired
     */
    public function number_freelancer_hired($employer_id){
        
        if(empty($employer_id) || !is_numeric($employer_id))
            return null;
        
        $this->db->select('COUNT(*) as nb_freelancer_hired');
        $this->db->from('job_accepted');
        $this->db->join('webuser', 'webuser.webuser_id=job_accepted.fuser_id', 'inner');
        $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
        $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
        $this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
        $this->db->where('job_accepted.buser_id', $employer_id);
        $this->db->where('job_bids.hired', '0');
        $this->db->where('job_bids.jobstatus', '0');
        $query = $this->db->get();
        $result = $query->result();
        
        return $result[0]->nb_freelancer_hired;
    }
    
    public function load_all_jobs_freelancer_hired( $employer_id ){
        
        if(empty($employer_id) || !is_numeric($employer_id))
            return null;
        
        $this->db->select('*, job_bids.status as bid_status');
        $this->db->from('job_accepted');
        $this->db->join('webuser', 'webuser.webuser_id=job_accepted.fuser_id', 'inner');
        $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
        $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
        $this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
        $this->db->where('job_accepted.buser_id', $employer_id);
        $this->db->where('job_bids.hired', '0');
        $this->db->where('job_bids.jobstatus', '0');
        $query = $this->db->get();
        $result = $query->result();
        
        return $result;
    }
    
    public function number_offer( $employer_id ){
        
        if(empty($employer_id) || !is_numeric($employer_id))
            return null;
        
        $this->db->select('COUNT(*) as number_offer');
        $this->db->from('job_bids');
        $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
        $this->db->where('job_bids.status', 0);
        $this->db->where('jobs.user_id', $employer_id);
        $this->db->where('job_bids.hired', 1);
        //$this->db->group_by('job_bids.bid_id');
        
        $query  = $this->db->get();
        $result = $query->result();
        
        return $result[0]->number_offer;
    }
    
    public function number_past_hired($employer_id){
        
        if(empty($employer_id) || !is_numeric($employer_id))
            return null;
        
        $this->db->select('COUNT(*) as nb_pas_hired');
        $this->db->from('job_accepted');
        $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
        $this->db->where('job_accepted.buser_id', $employer_id);
        $this->db->where('job_bids.hired', '0');
        $this->db->where('job_bids.jobstatus', '1');
        
        $query = $this->db->get();
        $result = $query->result();
        
        return $result[0]->nb_pas_hired;
    }
    
    public function get_all_freelancer_total_hour( $job_ids, $this_week_start = null, $today = null){
        
        $this->db
            ->select('fuser_id, jobid, SUM(total_hour) as total_hour')
            ->from('job_workdairy')
            ->where_in('jobid', $job_ids);
        
        if( $this_week_start != null )
            $this->db->where('working_date >=', $this_week_start);
        
        if( $today != null )
            $this->db->where('working_date <=', $today);
        
        $this->db->group_by(array('fuser_id', 'jobid'));
        
        $query    = $this->db->get();
        $job_done = $query->result();

        $result = array();  
        
        if($job_done != null){
            foreach($job_done as $job){
                $result[$job->jobid][$job->fuser_id] =  (int) $job->total_hour;
            }
        }
        return $result;
    }
    
    public function get_final_paid_infos($job_id, $user_id){
        $infos = $this->get_each_work_total_hour(array($job_id), $user_id, null, null, true);        
        if(isset($infos[$job_id]) && isset($infos[$job_id][$user_id]))
            return $infos[$job_id][$user_id];
        return array( 'total_hour' => 0, 'amount_by_hour' => null, 'amount' => 0.00 );
    }
    
    public function get_work_total_hour($job_id, $user_id, $begin = null, $end = null){
        $result = $this->get_each_work_total_hour(array($job_id), $user_id, $begin, $end);
        
        if(isset($result[$job_id]) && isset($result[$job_id][$user_id]))
            return $result[$job_id][$user_id];
        return 0;
    }
    
    public function get_each_work_total_hour( $job_ids, $user_id, $begin = null, $end = null, $with_amount = false ){
        $this->db
            ->select('job_bids.offer_bid_amount, job_bids.bid_amount, job_bids.user_id, job_bids.job_id, SUM(job_workdairy.total_hour) as total_hour')
            ->from('job_bids')
            ->join('job_workdairy', 'job_workdairy.jobid=job_bids.job_id', 'inner')
            ->where('user_id', $user_id)
            ->where_in('job_id', $job_ids);
        
        if( $begin != null )
            $this->db->where('working_date >=', $begin);
        
        if( $end != null )
            $this->db->where('working_date <=', $end);
        
        $this->db->group_by(array('job_bids.user_id', 'job_bids.job_id'));
        
        $query    = $this->db->get();
        $job_done = $query->result();
                
        $result = array();  
        
        if($job_done != null){
            if($with_amount === false){
                foreach($job_done as $job){
                    $result[$job->job_id][$job->user_id] =  (int) $job->total_hour;
                }
            }else{
                foreach($job_done as $job){
                    
                    $total_hour     = (int) $job->total_hour;
                    $amount_by_hour = !empty($job->offer_bid_amount) ? $job->offer_bid_amount : $job->bid_amount;
                    $amount         = $total_hour * $amount_by_hour; 
                    
                    $result[$job->job_id][$job->user_id] =  array( 'total_hour' => $total_hour, 'amount_by_hour' => $amount_by_hour, 'amount' => $amount );
                }
            }
        }
        return $result;
    }
    
    public function update_bid_state($bid_id, $state ){
        
        $this->db->where('id', $bid_id);
        
        return $this->db->update('job_bids', array( 'status' => $state )); 
    }
    
    public function load_bid( $bid_id, $hired = false ){
        
        $this->db
                ->select('*')
                ->from('job_bids')
                ->where('id', $bid_id );
        
        if($hired)
            $this->db->where('hired', 1);
        
        $query   = $this->db->get();
        return $query->row();
    }
    
    public function set_feedback_saw( $job_id, $user_id ){
        
        $this->db->where('feedback_userid', $user_id)
            ->where('feedback_job_id', $job_id)
            ->where('sender_id !=', $user_id)
            ->where('haveseen', 1)
            ->update('job_feedback', array( 'haveseen' => 0 ));
    }
    
    public function get_total_paid( $bid_id, $job_amount = 0.0 ){
        
        $this->db
            ->select('SUM( fixedpay_amount ) as amount')
            ->from('job_hire_end')
            ->where('bid_id', $bid_id);
        
        $query = $this->db->get();
        $result = $query->result();
        
        return round( ( $result[0]->amount + $job_amount ), 2);
    }
    
    public function get_feedbacks($job_id, $sender_id, $receiver_id){
        
        $this->db
            ->select('feedback_score, feedback_comment')
            ->from('job_feedback')
            ->where('job_feedback.feedback_job_id', $job_id)
            ->where('job_feedback.feedback_userid', $receiver_id)
            ->where('job_feedback.sender_id', $sender_id)
            ->order_by('job_feedback.feedback_id', "desc")
            ->limit(1, 0);
        
        $query    = $this->db->get();
        $feedback = $query->row();
        
        if(!empty($feedback)){
            
            $rating  = ($feedback->feedback_score/5)*100;
            $score   = $feedback->feedback_score;
            $comment = $feedback->feedback_comment;
            
            return array(
                'rating'  => $rating,
                'score'   => $score,
                'comment' => $comment
            );
        }
        
        return null;
    }
}
