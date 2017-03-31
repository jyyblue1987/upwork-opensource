<?php
/**
 * Description of Jobs
 *
 * @author avillanueva
 */
class Job_details extends CI_Model {

    function get_jobs($jobType = null, $jobDuration = null, $jobHours = null, $category = null, $keywords = null, $val, $limit, $offset){
        if (!empty($jobType)) {
            $jobType = explode(",", $jobType);
            foreach ($jobType as $type) {
                $this->db->or_where('jobs.job_type', $type);
            }
        }
        if (!empty($jobDuration)) {
            $jobDuration = explode(",", $jobDuration);
            foreach ($jobDuration as $duretion) {
                $this->db->or_where('jobs.job_duration', $duretion);
            }
        }
        if (!empty($jobHours)) {
            $jobHours = explode(",", $jobHours);
            foreach ($jobHours as $hour) {
                $this->db->or_where('jobs.hours_per_week', $hour);
            }
        }
        if (empty($category)) {
            if ($sql != "" && strlen($sql) >= 1) {
                $this->db->where_in('jobs.category', $sql, FALSE);
                if (strlen($keywords) > 0) {
                    $this->db->like("jobs.title", $keywords);
                    $this->db->or_like("jobs.job_description", $keywords);
                }
            }
        }

        $query = $this->db->get_where('jobs', $val, $limit, $offset);
        return $query->result();
    }

    function sort_jobs($jobTypeQuery, $sort, $sql, $keywords, $limit, $offset){
        $this->db->where('jobs.status', 1);
        $this->db->where_in('jobs.category', $sql);
        $this->db->group_start();
        $this->db->where("jobs.title LIKE '%{$keywords}%'");
        $this->db->or_where("jobs.job_description LIKE '%{$keywords}%'");
        $this->db->group_end();
        $this->db->where_in('jobs.job_type', $jobTypeQuery);
        if($sort == 0){
            $this->db->order_by('jobs.created', 'ASC');
        }else{
            $this->db->order_by('jobs.created', 'DESC');
        }
        $this->db->limit($offset, $limit);
        $query = $this->db->get('jobs');
    }


}
