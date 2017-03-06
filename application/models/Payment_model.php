<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Payment_model
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Payment_model extends CI_Model {
    
    public function load_job_transactions($sender_id, $user_id, $job_id) {
        $this->db->select('*');
        $this->db->from('payments');
        $this->db->where('payments.buser_id', $sender_id);
        $this->db->where('payments.user_id', $user_id);
        $this->db->where('payments.job_id', $job_id);
        $this->db->order_by("payment_create", "DESC");
        $query = $this->db->get();
        return $query->result();
    }
    
    public function save_job_transaction($job_id, $fuser_id, $buser_id, $amount) {
        $this->db->insert('payments', array(
            'job_id'        => $job_id,
            'user_id'       => $fuser_id,
            'buser_id'      => $buser_id,
            'des'           => 'Payment',
            'payment_gross' => $amount,
        ));
    }
}