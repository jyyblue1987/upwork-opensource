<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conversation_model
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Conversation_model extends CI_Model {
    
    public function create($data){
        $this->db->insert('job_conversation', $data);
        return $this->db->insert_id();
    }
    
    public function count_message( $bid_id )
    {
        $query = $this->db->select('COUNT(*) as num_message')
                    ->from('job_conversation')
                    ->where('job_conversation.bid_id', $bid_id)
                    ->get();

        $result = $query->row();
        
        return ! empty($result) ? $result->num_message : 0;
    }
}
