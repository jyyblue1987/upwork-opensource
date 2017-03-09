<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of bids_model
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Bids_model extends CI_Model {
    
    public function load($job_id, $fuser_id){
        
        $this->db->select('*');
        $this->db->from('job_bids');
        $this->db->where('user_id', $fuser_id);
        $this->db->where('job_id', $job_id);

        $query = $this->db->get();
        $result = $query->result();
        return $result[0];    
    }
   
    public function remaing_to_pay($job_id, $fuser_id) {
        
        $bid = $this->load($job_id, $fuser_id);
        $remaining = $bid->bid_amount - $bid->fixedpay_amount ;
        
        if($remaining < 0)
            return 0;
        
        return $remaining;
    }
    
    public function update_fixedpay_amount($job_id, $fuser_id, $amount){
        
        $bid = $this->load($job_id, $fuser_id);
        $updated_data['fixedpay_amount'] = $bid->fixedpay_amount + (int) $amount;
        
        $this->db->where('user_id', $fuser_id);
        $this->db->where('job_id', $job_id);
        $this->db->update('job_bids', $updated_data);
    }
}