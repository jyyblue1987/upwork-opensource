<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of ProfileModel
 *
 * @author Palash
 */
class ProfileModel extends CI_Model{
    
    public function getFreelancerSearch($keywords,$limit = 10,$offset = 0){
        
        $this->db->select(array(
            'wu.webuser_id',
            'wu.webuser_fname',
            'wu.webuser_lname',
            'wu.webuser_username',
            'wu.webuser_picture',
            'c.country_name',
            'wubp.tagline',
            'wubp.hourly_rate',
            'wubp.overview',
            'wubp.overview',
            'wubp.skills',
            'GROUP_CONCAT(DISTINCT "", webuser_skills.skill_name) AS wuser_skills',
        ));
        $this->db->from(WEB_USER_TABLE." as wu");
        $this->db->join(COUNTEY_TABLE." as c","wu.webuser_country = c.country_id");
        $this->db->join(WEB_USER_BASIC_PROFILE_TABLE." as wubp","wu.webuser_id = wubp.webuser_id");
        $this->db->join('webuser_skills', 'wu.webuser_id=webuser_skills.webuser_id', 'left');
        $this->db->where("wu.webuser_type",2);
        $this->db->like("wu.webuser_fname",$keywords);
        $this->db->or_like("wu.webuser_lname",$keywords);
        //$this->db->or_like("wubp.skills",$keywords);
        $this->db->or_like("wubp.tagline",$keywords);
        $this->db->or_like("wubp.overview",$keywords);
        $this->db->group_by("wu.webuser_id");
        $this->db->limit($offset,$limit);
        $query = $this->db->get();
        //$count = $this->db->count();
        $rows = $query->result();
        //echo $this->db->last_query();
        //print_r($rows);
        //die();
        return $rows;
    }
    function save_data_experience($data) {
        // for insert
        if ($data->id=='' || $data->id == 0){
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

    /**
     * 2017-02-21 Kalskov Vladimir (spirit@taganlife.ru)
     * @input $id int - Experience ID
     **/
    public function remove_data_experience($id) {
        $this->db->where("id", $id);
        $this->db->delete("user_experience");

        return true;
    }

    /**
     * 2017-02-21 Kalskov Vladimir (spirit@taganlife.ru)
     * @input $id int - Education ID
     **/
    public function remove_data_education($id) {
        $this->db->where("id", $id);
        $this->db->delete("freelancer_education");

        return true;
    }
    
    public function get_profile($user_id){
        $this->db->where('webuser_id', $user_id);
        $query = $this->db->get('webuser_basic_profile');
        return $query->row_array();
    }
    
    public function get_country($country){
        $this->db->where('country_id', $country);
	$query = $this->db->get('country');
        return $query->row_array();
    }
    
    public function get_skills($user_id){
        $this->db
                ->select("skill_name")
                ->from("webuser_skills")
                ->where("webuser_id = ", $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_profile_completeness($user_id){
        $profilecompleteness = array();
        $pcompleteness = 0;

        $this->db
                ->select('*')
                ->from('webuser')
                ->where('webuser.webuser_id', $user_id)
                ->where('webuser.webuser_picture !=', "");
        $query_img = $this->db->get();
        $checkimage = $query_img->row();
 
        if (!empty($checkimage)) {
            $pcompleteness += 10;
            $profilecompleteness['addpicture'] = 1;
        } else {
            $profilecompleteness['addpicture'] = 0;
            $pcompleteness += 0;
        }

        $this->db
                ->select('*')
                ->from('user_categories')
                ->where('user_categories.user_id', $user_id);
        $query_category = $this->db->get();
        $checkcat = $query_category->row();
        
        if (!empty($checkcat)) {
            $pcompleteness += 25;
            $profilecompleteness['addcat'] = 1;
        } else {
            $pcompleteness += 0;
            $profilecompleteness['addcat'] = 0;
        }

        $this->db
                ->select('*')
                ->from('webuser_portfolio')
                ->where('webuser_portfolio.webuser_id', $user_id)
                ->where('webuser_portfolio.project_url !=', "");
        $query_portfolio = $this->db->get();
        $checkport = $query_portfolio->row();

        if (!empty($checkport)) {
            $pcompleteness += 25;
            $profilecompleteness['addportfolio'] = 1;
        } else {
            $pcompleteness += 0;
            $profilecompleteness['addportfolio'] = 0;
        }

        $this->db
                ->select('*')
                ->from('user_experience')
                ->where('user_experience.user_id', $user_id);
        $query_exp = $this->db->get();
        $checkexp = $query_exp->row();

        if (!empty($checkexp)) {
            $pcompleteness += 25;
            $profilecompleteness['addexp'] = 1;
        } else {
            $pcompleteness += 0;
            $profilecompleteness['addexp'] = 0;
        }

        $this->db
                ->select('*')
                ->from('freelancer_education')
                ->where('freelancer_education.fuser_id', $user_id)
                ->where('freelancer_education.degree !=', "");
        $query_exp = $this->db->get();
        $checkexp = $query_exp->row();
        
        if (!empty($checkexp)) {
            $pcompleteness += 15;
            $profilecompleteness['addedu'] = 1;
        } else {
            $pcompleteness += 0;
            $profilecompleteness['addedu'] = 0;
        }

        $return_array = array();
        
        $return_array = array(
            'pcompleteness' => $pcompleteness,
            'profilecompleteness' => $profilecompleteness
        );
        
        return $return_array;
    }
}

?>
