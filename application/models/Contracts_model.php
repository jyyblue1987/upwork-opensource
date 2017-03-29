<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Allow to access/update/delete contract's informations from database
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Contracts_model extends CI_Model {
   
    public function find( $contract_id, $with_client = false ){
        
        $join_field = 'fuser_id';
        if($with_client)
            $join_field = 'buser_id';
        
        $fields = array(
            'webuser.cropped_image', 
            'webuser.webuser_id', 
            'job_accepted.job_id', 
            'job_accepted.fuser_id',
            'job_accepted.buser_id',
            'job_bids.id as bid_id', 
            'end_date',
            'start_date',
            'tagline',
            'job_type',
            'webuser_fname', 
            'webuser_lname', 
            'webuser_company',
            'hire_title', 'title',
            'contact_id', 'hired_on',
            'fixedpay_amount',
            'job_bids.jobstatus as contract_status',
            'job_accepted.created as start_contract_date',
            'offer_bid_amount',
            'bid_amount',
            'weekly_limit',
            'job_bids.status as bid_status'
        );
        
        $this->db->select($fields)
                ->from('job_accepted')
                ->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner')
                ->join('webuser', 'webuser.webuser_id=job_accepted.'. $join_field, 'inner')
                ->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id=webuser.webuser_id', 'inner')
                ->join('jobs', 'jobs.id=job_bids.job_id', 'inner')
                ->join('country', 'country.country_id=webuser.webuser_country', 'inner')
                ->where('job_accepted.bid_id', $contract_id);
        
        $query = $this->db->get();
        return $query->row();
    }
    
    public function get_ended_of( $user_id, $is_employer = true ){
        
        $this->db->select('*');
        $this->db->from('job_accepted');
        $this->db->join('webuser', 'webuser.webuser_id=job_accepted.fuser_id', 'inner');
        $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
        $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
        $this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
        $this->db->where('job_accepted.buser_id', $user_id);
        $this->db->where('job_bids.hired', '0');
        $this->db->where('job_bids.jobstatus', JOB_ENDED);
        $query = $this->db->get();
        return $query->result();
        
    }
    
    
    public function get_all_freelancer_in_hourly_contract( $employer_id ){
        
        $query = $this->db
                    ->select('DISTINCT(webuser.webuser_id), webuser.webuser_fname, webuser.webuser_lname')
                    ->from('job_accepted')
                    ->join('jobs', 'jobs.id=job_accepted.job_id', 'inner')
                    ->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner')
                    ->join('webuser', 'webuser.webuser_id=job_accepted.fuser_id', 'inner')
                    ->where('job_accepted.buser_id', $employer_id)
                    ->where('job_bids.jobstatus !=', JOB_ENDED)
                    ->where('jobs.job_type =', HOURLY_JOB_TYPE)
                    ->get();
        
        return $query->result();
    }
    
    public function get_hourly_contract_with_employer( $employer_id, $freelancer_id ){
        $this->db->select('bid_id, title')
                ->from('job_accepted')
                ->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner')
                ->join('jobs', 'jobs.id=job_bids.job_id', 'inner')
                ->where('job_accepted.fuser_id', $freelancer_id)
                ->where('job_accepted.buser_id', $employer_id)
                ->where('job_bids.jobstatus !=', JOB_ENDED)
                ->where('jobs.job_type', HOURLY_JOB_TYPE);
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
    public function get_all_hourly_freelancer_contracts( $freelancer_id ){
        
        $this->db->select('bid_id, title')
                ->from('job_accepted')
                ->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner')
                ->join('jobs', 'jobs.id=job_bids.job_id', 'inner')
                ->where('job_accepted.fuser_id', $freelancer_id)
                ->where('job_bids.jobstatus !=', JOB_ENDED)
                ->where('jobs.job_type', HOURLY_JOB_TYPE);
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
    public function load_all_details( $contract_id ){
     
        $fields = "jobs.*, " 
                . "job_bids.*,"
                . "jobs.user_id AS offerduser_id,"
                . "job_bids.status AS bid_status,"
                . "jobs.job_duration AS jobduration,"
                . "job_bids.id AS bid_id,"
                . "job_bids.created AS bid_created";
        
        $this->db->select( $fields )
                ->join('job_bids', 'jobs.id=job_bids.job_id', 'inner')
                ->where('job_bids.id', $contract_id)
                ->where('job_bids.status', BID_STATE_APPLIED)
                ->or_where('job_bids.status', BID_STATE_PAUSED);
        
        $query = $this->db->get('jobs');
        return $query->row();
        
    }
    
    
    public function get_total_hour( $contract_id ){
        
        $query = $this->db->select('SUM(total_hour) as total_hour')
                    ->from('job_workdairy')
                    ->where('bid_id', $contract_id)
                    ->get();
        
        $row = $query->row();
        
        if(!empty($row))
            return (int) $row->total_hour;
        
        return 0;
    }
    
    public function get_total_hour_worked_at( $contract_id, $date ){
        
        $query = $this->db->select('SUM(total_hour) as total_hour')
                    ->from('job_workdairy')
                    ->where('bid_id', $contract_id)
                    ->where('working_date', $date)
                    ->get();
        
        $row = $query->row();
        
        if(!empty($row))
            return (int) $row->total_hour;
        
        return 0;
    }
    
    public function get_hours_worked_this_week( $contract_id ){
        
        $time = strtotime('monday this week 00:00 UTC');
        $cweek = date('Y-m-d', $time);
        $nweek = date('Y-m-d', strtotime($cweek . ' + 1 weeks'));

        $query = $this->db->select('SUM(total_hour) as total_hour')
                    ->from('job_workdairy')
                    ->where('bid_id', $contract_id)
                    ->where('working_date >=', $cweek)
                    ->where('working_date <=', $nweek)
                    ->get();
        
        $result = $query->row();
        
        if( ! empty($result))
            return $result->total_hour;
        return 0;
    }
    
    public function get_work_diary( $contract_id, $date = null ){
        
        $this->db->select('DISTINCT(starting_hour), total_hour, jobid, fuser_id')
            ->from('job_workdairy')
            ->where('bid_id', $contract_id);
        
        if( $date !== null)
            $this->db->where('working_date', $date);
        
        $query = $this->db->order_by('starting_hour DESC')->get();
        
        $diaries =  $query->result();
        $result  = array();
        
        if(!empty($diaries)){
            
            $count = 0;
            
            foreach($diaries as $key => $working){

                for ($hourshown = 0; $hourshown < $working->total_hour; $hourshown ++) {

                    $hourdiff    = '+' . $hourshown . ' hour';
                    $currentHour = date('H A ', strtotime($hourdiff, strtotime($working->starting_hour)));
                    $presenthour = date('Y-m-d H:i:s', strtotime($hourdiff, strtotime($working->starting_hour)));
                    $nexthour    = date('Y-m-d H:i:s', strtotime('+1 hour', strtotime($presenthour)));
                    
                    $query = $this->db->select('cpture_image as capture_image, capture_time')
                                ->from('workdairy_tracker')
                                ->where('fuser_id', $working->fuser_id)
                                ->where('jobid', $working->jobid)
                                ->where('working_date', $date)
                                ->where('capture_time >=', $presenthour)
                                ->where('capture_time <=', $nexthour)
                                ->get();
                    
                    $tracker_infos = $query->result();
                    
                    if( ! empty( $tracker_infos )){
                        $count += 1;
                        $result[$count]['current_hour'] = $currentHour;
                        $result[$count]['captures']     = $tracker_infos;
                    }
                }
            }
        }
        
        return $result;
    }
    
    public function get_feedback_notification( $user_id, $is_client = false) {
        
        $fields = array(
            'hire_title',
            'title',
            'end_date',
            'job_bids.id as bid_id',
        );
        
        if( ! $is_client ){
            $fields[] = 'webuser_company';
        }
        
        $this->db->select($fields)
            ->from('job_feedback')
            ->join('job_bids', 'job_feedback.feedback_job_id = job_bids.job_id', 'inner');
        
        
        if( ! $is_client )
            $this->db->join('webuser', 'webuser.webuser_id = job_feedback.feedback_clientid', 'inner');
        
        $this->db->join('jobs', 'job_bids.job_id=jobs.id', 'inner');
        
        if($is_client){
            
            $this->db
                ->where('job_feedback.feedback_clientid', $user_id)
                ->where('job_feedback.sender_id !=', $user_id);
            
        }else{
            $this->db
                ->where('job_feedback.feedback_userid', $user_id)
                ->where('job_bids.user_id', $user_id)
                ->where('job_feedback.sender_id !=', $user_id);
        }
        
        $this->db
            ->where('job_bids.jobstatus', '1')
            ->where('job_feedback.haveseen', 1)
            ->group_by("job_feedback.feedback_id");
        
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_all_work_diary_of( $working_date )
    {
        $fields = array(
            'job_bids.offer_bid_amount',
            'job_bids.bid_amount',
            'sum(job_workdairy.total_hour) as total_hour',
            'job_workdairy.cuser_id',
            'job_workdairy.fuser_id',
            'job_accepted.contact_id'
        );
        
        $query = $this->db->select( $fields )
                    ->from('job_workdairy')
                    ->join('job_accepted', 'job_accepted.job_id = job_workdairy.jobid', 'inner')
                    ->join('job_bids', 'job_bids.job_id = job_workdairy.jobid', 'inner')
                    ->join('webuser', 'webuser.webuser_id = job_workdairy.cuser_id', 'inner')
                    ->where("working_date ='{$working_date}'")
                    ->where("job_bids.user_id = job_workdairy.fuser_id")
                    ->where("webuser.isactive !=", 0)
                    ->where("job_bids.jobstatus !=", JOB_ENDED)
                    ->group_by('jobid,fuser_id')
                    ->get();
        
        return $query->result();
    }
}
