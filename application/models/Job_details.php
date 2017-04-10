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
        return $this->title;
    }
    
    function get_category(){
        return $this->category;
    }
    
    function get_jobdesc(){
        return $this->job_desc;
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
        return $this->job_duration;
    }
    
    function get_exp(){
        return $this->exp_level;
    }
    
    function get_budget(){
        return $this->budget;
    }
    
    function get_hrs_perweek(){
        return $this->hrs_per_week;
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
}
