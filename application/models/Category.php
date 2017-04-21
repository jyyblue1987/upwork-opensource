<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends CI_Model
{
    public function get_categories()
    {
        $resultset = $this->db->get('job_categories');
        return $resultset->result();
    }
    
    public function get_subcategories($cat_id, $user_id=null)
    {
        $resultset = $this->db->get_where('job_subcategories', ['cat_id' => $cat_id]);
        return $resultset->result();
    }
    
    public function get_user_subcategories($user_id = null)
    {
        if($user_id == null){
            $resultset = $this->db->get('user_categories');
        }else{
            $resultset = $this->db->get_where('user_categories', ['user_id' => $user_id]);
        }

        return $resultset->result();
    }
    
    public function create_user_subcategories($data)
    {
        if($this->db->insert_batch('user_categories', $data)) {
            return true;
        }
        return false;
    }
    
    public function delete_user_categories($user_id)
    {
        $this->db->where('user_id', $user_id);
        if($this->db->delete('user_categories')) {
            return true;
        }
        return false;
    }
}