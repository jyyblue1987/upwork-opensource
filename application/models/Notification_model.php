<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notification_model
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Notification_model extends CI_Model {
    
    public function user_notification_count( $user_id ){
        
        $this->db
            ->select("COUNT('*') as notif_count")
            ->from('notification')
            ->where('user_id', $user_id)
            ->where('read_status', 0);
        
        $query = $this->db->get();
        $result = $query->result();
        
        return $result[0]->notif_count;
    }
    
    public function user_notification( $user_id ){
        
        $this->db
            ->select("*")
            ->from('notification')
            ->where('user_id', $user_id)
            ->where('read_status', 0);
        
        $query = $this->db->get();
        $result = $query->result();
        
        return $result;
    }
}
