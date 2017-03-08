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
    
    public function load_job_status($sender_id, $user_id, $job_id, $with_country = false) {
        
        $this->db->select('*,jobs.status AS job_status,jobs.job_duration AS jobduration,jobs.created AS job_created');
        $this->db->from('job_accepted');
        $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
        $this->db->join('webuser', 'webuser.webuser_id=job_accepted.fuser_id', 'inner');
        $this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id=webuser.webuser_id', 'inner');
        $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
        
        if($with_country)
            $this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
        
        if($sender_id !== null)
            $this->db->where('job_accepted.buser_id', $sender_id);
        
        $this->db->where('job_accepted.fuser_id', $user_id);
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
        
        $this->db->select('*');
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
    
    public function get_all_freelancer_total_hour( $job_ids, $this_week_start, $today){
        
        $this->db
            ->select('fuser_id, jobid, SUM(total_hour) as total_hour')
            ->from('job_workdairy')
            ->where_in('jobid', $job_ids)
            ->where('working_date >=', $this_week_start)
            ->where('working_date <=', $today)
            ->group_by(array('fuser_id', 'jobid'));
        
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
    
}
