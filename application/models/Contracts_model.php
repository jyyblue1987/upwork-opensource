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
}
