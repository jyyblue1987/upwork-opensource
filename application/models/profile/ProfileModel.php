<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of ProfileModel
 *
 * @author Palash
 */
class ProfileModel extends CI_Model{
    
    public function getFreelancerSearch($keywords,$limit = 10,$offset = 0){
        
        $this->db->select("wu.webuser_id, wu.webuser_fname,wu.webuser_lname,wu.webuser_picture,c.country_name,".
               "wubp.tagline,wubp.hourly_rate,wubp.overview,wubp.overview,wubp.skills");
        $this->db->from(WEB_USER_TABLE." as wu");
        $this->db->join(COUNTEY_TABLE." as c","wu.webuser_country = c.country_id");
        $this->db->join(WEB_USER_BASIC_PROFILE_TABLE." as wubp","wu.webuser_id = wubp.webuser_id");
        $this->db->where("wu.webuser_type",2);
        $this->db->like("wu.webuser_fname",$keywords);
        $this->db->or_like("wu.webuser_lname",$keywords);
        $this->db->or_like("wubp.skills",$keywords);
        $this->db->or_like("wubp.tagline",$keywords);
        $this->db->or_like("wubp.overview",$keywords);
        $this->db->limit($offset,$limit);
        $query = $this->db->get();
        //$count = $this->db->count();
        $rows = $query->result();
        //echo $this->db->last_query();
        //print_r($rows);
        //die();
        return $rows;
    }
    function save_data_experience($data){
		if($data->id=='' || $data->id == 0){// for insert
			//print_r($data);
			$this->db->insert("user_experience", $data);
		}
		else{// for update
			//print_r($data);
			$this->db->where("id",$data->id);
			$this->db->update("user_experience", $data);
		}
	}
	
	function getExp($user_id){
		$sql = "SELECT * FROM user_experience WHERE user_id=$user_id";
		$query =$this->db->query($sql);
		$result = $query->result_object();
		return $result;
	}
}

?>
