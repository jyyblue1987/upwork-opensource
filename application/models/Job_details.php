<?php
/**
 * Description of Job Created by Employer
 *
 * @author avillanueva
 */
class Job_details extends CI_Model {

    private $job_id;
    private $employer_id;
    private $title;
    private $category;
    private $job_desc;
    private $job_type;
    private $skills;
    private $job_duration;
    private $exp_level;
    private $budget;
    private $hrs_per_week;
    private $files;
    private $status;
    private $date_created;
    private $tid;
    private $created;
    
    function __construct($user_id = FALSE, $job_id = FALSE) {
        parent::__construct();
        if(is_numeric($user_id) && is_numeric($job_id)){
            return $this->init($user_id, $job_id);
        }
    }
    
    function init($user_id, $job_id) {
        $result = $this->db
                ->join('webuser', 'webuser.webuser_id = jobs.user_id', 'left')
                ->order_by("jobs.id", "desc")
                ->get_where('jobs', array('user_id' => $user_id, 'id' => $job_id));

        if ($result->num_rows() > 0) {
            $detail = $result->row_array();
            $this->job_id = $detail['id'];
            $this->employer_id = $detail['user_id'];
            $this->title = $detail['title'];
            $this->category = $detail['category'];
            $this->job_desc = $detail['job_description'];
            $this->job_type = $detail['job_type'];
            $this->skills = $this->get_skills();
            $this->job_duration = $detail['job_duration'];
            $this->exp_level = $detail['experience_level'];
            $this->budget = $detail['budget'];
            $this->hrs_per_week = $detail['hours_per_week'];
            $this->files = $detail['userfile'];
            $this->status = $detail['status'];
            $this->date_created = $detail['job_created'];
            $this->tid = $detail['tid'];
            $this->created = $detail['created'];
        }else{
            return FALSE;
        }
    }
    
    function get_jobid(){
        return $this->job_id;
    }
    
    function get_employerid(){
        return $this->employer_id;
    }
    
    function get_title(){
        return ucwords($this->title);
    }
    
    function get_category(){
        return $this->category;
    }
    
    function get_jobdesc(){
        return ucfirst($this->job_desc);
    }
    
    function get_jobtype(){
        return $this->job_type;
    }
    
    function get_skills(){
        $query = $this->db
                    ->select("skill_name")
                    ->from("job_skills")
                    ->where("job_id = ", $this->get_jobid())
                    ->get();
        
        $_skills = array();
        foreach($query->result() AS $skills){
            $_skills[] = $skills->skill_name;
        }
        return $_skills;
    }
    
    function get_duration(){
        switch($this->job_duration){
            case "not_sure":
            case "more_than_6_months":
            case "less_than_1_months":
            case "less_than_1_week":
                return ucfirst(str_replace('_', ' ', $this->job_duration));
                break;
            case "3_6_months":
            case "1_3_months":
                return substr(str_replace('_', '-', $this->job_duration), 0, 3).' months';
                break;
        }
    }
    
    function get_exp(){
        return ucfirst($this->exp_level);
    }
    
    function get_budget(){
        return $this->budget;
    }
    
    function get_hrs_perweek(){
        if($this->hrs_per_week == "not_sure"){
            return ucfirst(str_replace('_', ' ', $this->hrs_per_week));
        }else if($this->hrs_per_week == "40_plus"){
            return "40 +";
        }else{
            return $this->hrs_per_week;
        }
    }

    function get_attachments(){
        $files = array();
        $attachments = explode(",", $this->files);
        foreach($attachments AS $attachment){
            $files[] = str_replace('"','', $attachment);
        }
        return $files;
    }
    
    function get_status(){
        return $this->status;
    }
    
    function get_date_created(){
        return $this->date_created;
    }
    
    function get_tid(){
        return $this->tid;
    }
    
    function get_created(){
        return $this->date_created;
    }
    
    function get_subcategory(){
        $this->db
                ->select('*')
                ->from('job_subcategories')
                ->where('subcat_id',$this->get_category());
        $query = $this->db->get();
        $result= $query->row();
        return $result->subcategory_name;
    }
}
