<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Webuser_model
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Webuser_model extends CI_Model {
    
    public function load_informations($sender_id) {
        $this->db->select('*');
        $this->db->from('webuser');
        $this->db->where('webuser.webuser_id', $sender_id);
        $query_status = $this->db->get();
        return $query_status->row();
    }
    
    public function get_username($id){
        
        $query = $this->db
                    ->select('webuser_username')
                    ->from('webuser')
                    ->where('webuser.webuser_id', $id)
                    ->get();
        
        $webuser  = $query->row();
        $username = '';
        
        if(isset($webuser)){
            $username = $webuser->webuser_username;
        }
        
        return $username;
    }
}
