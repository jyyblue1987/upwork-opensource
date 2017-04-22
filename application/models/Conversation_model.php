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
        if($this->db->insert('job_conversation', $data));
            return $this->db->insert_id();
        return null;
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
    
    public function mark_as_read( $bid_id )
    {
        $this->db->where('bid_id', $bid_id);
	$this->db->update('job_conversation', array('have_seen' => 0));
    }
    
    public function get_conversation( $bid_id )
    {
        $fields = array(
            'job_conversation.*',
            'webuser.*',
            'jobs.title',
            'wu.webuser_fname as fname',
            'wu.webuser_lname as lname',
            'wu.webuser_id as r_id',
            'job_conversation.created created', 
            '0 as is_ticket'
        );
        
        $query = $this->db->select( $fields )
                    ->from('job_conversation')
                    ->join('webuser', 'job_conversation.sender_id = webuser.webuser_id', 'inner')
                    ->join('jobs', 'jobs.id = job_conversation.job_id', 'inner')
                    ->join('webuser as wu', 'jobs.user_id = wu.webuser_id', 'inner')
                    ->where('job_conversation.bid_id', $bid_id)
                    ->order_by("job_conversation.id", "ASC")
                    ->get();
        
        return $query->result();
    }
}
