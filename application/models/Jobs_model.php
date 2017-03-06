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
}
