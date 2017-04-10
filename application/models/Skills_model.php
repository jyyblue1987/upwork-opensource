<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Skills_model
 *
 * @author Hermannovich <donfack.hermann@gmail.com>
 */
class Skills_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_list()
    {
        $query = $this->db
                    ->select("skill_name")
                    ->from("skills")
                    ->get();
                    
        return $query->result();
    }
    
    public function get_skills($job_id)
    {
        $query = $this->db
                    ->select("skill_name")
                    ->from("job_skills")
                    ->where("job_id = ", $job_id)
                    ->get();
        return $query->result_array();
    }
    
    public function delete_skill($job_id){
        $this->db
                ->where('job_id', $job_id)
                ->delete('job_skills');
    }
}
