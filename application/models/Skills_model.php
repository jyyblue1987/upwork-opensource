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
}
