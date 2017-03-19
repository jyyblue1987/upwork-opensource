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
}
