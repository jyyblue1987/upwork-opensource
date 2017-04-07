<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Freelance_jobs
 *
 * @author avillanueva
 */
class Freelance_jobs extends CI_Controller {

    private $category;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category');
        $this->category = new Category();
    }

    public function index(){
        $this->find_jobs();
    }

    public function find_jobs($url_rewrite = null, $sort = 1){
        $result = $this->category->get_subcategories();

        if ($result != null) {
            $offsetId = $result->subcat_id;
        } else {
            $offsetId = $url_rewrite;
        }
    }
   
    public function view($title = null, $postId = null) {
        if ($this->Adminlogincheck->checkx()) {
            $postId = base64_decode($postId);
            $emp = new Employer($this->user_id);
            $employer = new Employer($postId);

            $emp_id = $employer->get_job_employer($postId);
            $client_id = new Employer($emp_id);
            $skills = $this->Skills_model->get_skills($postId);

            $applicants = $this->process->get_applications($postId);
            $interviews = $this->process->get_interviews($emp_id, $postId);
            $hires = $this->process->get_hires($emp_id, $postId);
            $jobids = $this->process->get_job_ids($emp_id);
            $jobs_posted = $this->process->get_jobs($emp_id);
            $country = $this->ProfileModel->get_country($emp->get_country());

            $data = array(
                'skills' => $skills,
                'jobs_posted' => $jobs_posted['rows'],
                'applicants' => $applicants['rows'],
                'hires' => $hires['rows'],
                'interviews' => $interviews['rows'],
                'total_hired' => $this->process->total_hired($jobids),
                'workedhours' => $this->process->get_worked_hours($emp_id),
                'status' => $emp->get_status(),
                'css' => array("", "", "", "assets/css/pages/view.css"),
                'payment_set' => $employer->is_payment_set($emp_id),
                'total_spent' => $client_id->total_spent($emp_id),
                'rating' => $this->Webuser_model->get_total_rating($emp_id),
                'job_id' => $postId,
                'fname' => $emp->get_fname(),
                'lname' => $emp->get_lname(),
                'country' => ucfirst($country['country_name'])
             );

            $this->Admintheme->custom_webview("jobs/view", $data);
        }
    }

}
