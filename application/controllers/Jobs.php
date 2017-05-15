<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Bids_model $Bids_model
 */
class Jobs extends Winjob_Controller {
    
    private $process;
    public $user_id;
    private $employer;
    
    public function __construct() {
        parent::__construct();
        
        // added by (Donfack Zeufack Hermann) start 
        // load the default language for the current user.
        $this->load_language();
        // added by (Donfack Zeufack Hermann) end
        $this->load->model(array('Category', 'Common_mod', 'Webuser_model', 'Process', 'Employer', 
            'profile/ProfileModel', 'Job_work_diary_model', 'Skills_model', 'jobs_model',
            'Job_details', 'payment_model', 'payment_methods_model', 'job/Bids_model'));
        $this->load->library('paypal_lib');
        $this->process = new Process();
        $this->user_id = $this->session->userdata('id');
        $this->employer = new Employer($this->user_id);
        /* check profile info is okay start */
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                // redirect(site_url("find-jobs"));
            }
            else
            {
            $this->db->select('*');
            $this->db->from('webuser');
            $this->db->where('webuser_id',$this->session->userdata('id')); 
            $query = $this->db->get();
            $webuser_info = $query->row();
            
            if(!($webuser_info->webuser_fname && $webuser_info->webuser_lname && $webuser_info->webuser_company && $webuser_info->webuser_title))
            {
                 redirect(site_url("profile-settings?profile=1")); 
            }
            
            $this->db->select('*');
            $this->db->from('webuseraddresses');
            $this->db->where('webuser_id',$this->session->userdata('id')); 
            $query = $this->db->get();
            $webuseraddresses_info = $query->row();

            if(!($webuseraddresses_info->address && $webuseraddresses_info->city && $webuseraddresses_info->state && $webuseraddresses_info->zipcode))
            {
                 redirect(site_url("profile-settings?profile=2")); 
            }
            


            }
        }
        /* check profile info is okay end */
    }
    
    protected function load_language(){
        parent::load_language();
        $this->lang->load('job', $this->get_default_lang());
    }

    public function index() {
        
    }

    public function create() {
        $this->checkForEmployer();
        $this->load->model( array( 'webuser_model', 'skills_model', 'jobs_model' ) );
        
        // check if account is suspend then redirect to payment start 
        $user_id = $this->session->userdata('id');
        
        if( ! $this->webuser_model->is_active( $user_id) )
            redirect(site_url("pay/methods_card"));
        
        if( is_get() )//For get http method only load the form.
        {   
            $data = array(
                'js'        => array(
                    'vendor/jquery.form.js', 
                    'internal/job_create.js'
                ),
                'skillList' => $this->skills_model->get_list(),
                'user_id' => $user_id,
                'tid' => time()
            );
            
            $this->Admintheme->custom_webview("jobs/post-job", $data);
        }
        else if($this->input->is_ajax_request() && is_post() && $this->input->post('title'))//Here we need to handle job creation
        {
            $data = array(
                'title' => $this->input->post('title'),
                'category' => $this->input->post('category'),
                'job_description' => $this->input->post('job_description'),
                'job_type' => $this->input->post('job_type'),
                'job_duration' => $this->input->post('job_duration'),
                'experience_level' => $this->input->post('experience_level'),
                'budget' => $this->input->post('budget'),
                'hours_per_week' => $this->input->post('hours_per_week'),
                'userfile' => $this->input->post('userfile'),
                'status' => 1,
                'job_created' => date('Y-m-d H:i:s'),
                'userfile' => $this->input->post('attachments'),
                'user_id'  => $user_id,
                'tid'  => $this->input->post('tid')
            );

            if ($this->input->post('submitbtn') == '0') //JOB PREVIEW
            {
                $data['skills'] = $this->input->post('skills');
                $this->session->set_userdata('preview', $data);
                $this->ajax_response( array('code' => '1', 'id' => '0') );
            }
            else // CREATE THE JOB
            {
                unset( $data['submitbtn'] );
                $job_id  = $this->jobs_model->create( $data );
                if( $job_id != null )
                {
                    $skills = $this->input->post('skills');
                    $this->jobs_model->link_to_skills( $job_id, $skills);                    
                    $this->ajax_response( array('code' => '0', 'id' => base64_encode($job_id), 'type' => $data['job_type']) );
                }
                else 
                {
                    $this->ajax_response( array('code' => '0', 'msg' => '<div class="alert alert-danger"><strong>Error!</strong> Error occured.Try again.</div>') );
                }
            }
        }
    }

    public function savePostSession() {
        $data = $this->session->userdata('preview');
        $skills = $data['skills'];
        unset($data['skills']);
        
        unset($data['submitbtn']);
        if ($this->input->post('submitbtn')) {
            if ($this->db->insert('jobs', $data)) {
                $insert_id = $this->db->insert_id();
                $this->jobs_model->link_to_skills( $insert_id, $skills);   
                redirect(site_url().'jobs-home');
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function download(){
        $this->load->helper('download');
        $data = file_get_contents(FCPATH . "uploads/" . $this->input->get('dir') . "/" . $this->input->get('file')); // Read the file's contents
        $name = $this->input->get('file');
        force_download($name, $data);
    }
    
    public function upload() {
        
        $target_path = FCPATH . "uploads/" . $this->input->post('uid') . "/";
        if (!file_exists($target_path)) {
            if (mkdir($target_path)) {
                $target_path = $target_path . $this->input->post('ident') . "/";
                $this->fileupload($_FILES, $target_path);
            } else
                echo "0";
        } else {
            $target_path = $target_path . $this->input->post('ident') . "/";
            $this->fileupload($_FILES, $target_path);
        }
    }

    public function removefile() {
        $this->load->helper('file');
        if ($this->input->post('formDiscard')) {
            $dir = FCPATH . "uploads/" . $this->input->post('formDiscard');
            if (file_exists($dir)) {
                delete_files($dir);
                rmdir($dir);
            }
        } else {
            $dir = FCPATH . "uploads/" . $this->input->post('tid');
            $path = FCPATH . "uploads/" . $this->input->post('tid') . "/" . $this->input->post('file');
            unlink($path);
            if (count(scandir($dir)) <= 2)
                rmdir($dir);
        }
    }


    private function fileupload(&$file, $path) {
        if (!file_exists($path)) {
            if (mkdir($path)) {
                if (filesize($file['files']['tmp_name']) <= 15728640) {
                    $new_file = preg_replace('/&/', '-', $file['files']['name']);
                    $path = $path . basename($new_file);
                    if (move_uploaded_file($file['files']['tmp_name'], $path)) {
                        echo $new_file;
                    } else {
                        echo "0";
                    }
                } else
                    echo "-1";
            }
        } else {
            if (filesize($file['files']['tmp_name']) <= 15728640) {
                $new_file = preg_replace('/&/', '-', $file['files']['name']);
                $path = $path . basename($new_file);
                if (file_exists($path)) {
                    echo "1";
                } else {
                    if (move_uploaded_file($file['files']['tmp_name'], $path)) {
                        echo $new_file;
                    } else {
                        echo "0";
                    }
                }
            } else
                echo "-1";
        }
    }

    public function find($url_rewrite = null, $sort = 1) {
        $this->isFreelancer();
        $url_rewrite = substr($url_rewrite, 1, -1);
        
        $id              = $this->user_id;
        $user_categories = $this->Category->get_user_subcategories($this->user_id);
        $jobCat          = $this->uri->segment(2);
        $jobCatPage      = false;
        $sql             = "";

        if (sizeof($user_categories) > 0) {
            foreach($user_categories AS $cat){
                $sql .= $cat->subcat_id . ",";
            }
        }

        $sql         = substr($sql, 0, strlen($sql) - 1);
        $sqlIn       = " AND subcat_id IN ( " . $sql . " ) ";
        $subCateList = $this->Common_mod->get(SUBCATEGORY_TABLE, null, $sqlIn);

        $limit = 10;
        $records = array();

        if ($this->input->is_ajax_request()) {

            $category    = array();
            $jobCat      = $this->input->post('jobCat');
            $jobType     = $this->input->post('jobtype');
            $jobDuration = $this->input->post('jobduratin');
            $jobHours    = $this->input->post('jobweekhour');
            $offsetId    = $this->input->post('limit');
            $keywords    = $this->input->post('keywords');

            if (intval($offsetId) >= 0 == false) {
                $offsetId = 0;
            }
            if (strlen($jobCat) > 0) {
                $catIds = explode(",", $jobCat);
                if (sizeof($catIds) > 0) {
                    foreach ($catIds as $cat) {
                        if (intval($cat) > 0) {
                            $category[] = $cat;
                        }
                    }
                }
            }

            $offset = $limit * $offsetId;
            $keywords = $this->input->post('keywords');

            if (empty($category)) {
                if ($sql != "" && strlen($sql) >= 1) {
                    if ($this->session->userdata('type') == '2') {

                        $query = $this->jobs_model->filter_jobs($jobType, $jobDuration, $jobHours, $category, $sql, $keywords, $limit, $offset, $category);

                    } else if ($this->session->userdata('type') == '1') {

                        $val = array(
                            'user_id' => $id,
                            'status' => 1
                        );

                        $query = $this->jobs_model->jobs_by_category($val, $limit, $offset);
                    }
                }
            } else {
                $query = $this->jobs_model->filter_jobs($jobType, $jobDuration, $jobHours, $category, $sql, $keywords, $limit, $offset, $category, $sort);
            }

                if ($query->num_rows() > 0 && is_object($query)){
                    $records = $query->result();

                    foreach ($records as $record) {
                        $employer = new Employer($record->user_id);
                        $job      = new Job_details($employer->get_userid(), $record->id);

                        $record->skills         = $this->Skills_model->get_skills($record->id);
                        $record->payment_set    = $this->payment_methods_model->get_primary($employer->get_userid());
                        $record->is_active      = $employer->is_active();
                        $record->total_spent    = $this->payment_model->get_amount_spent($employer->get_userid());
                        $record->rating         = $this->Webuser_model->get_total_rating($employer->get_userid(), true);
                        $record->country        = ucfirst($employer->get_country());
                        $record->job_created    = $this->process->time_elapsed_string($record->job_created);
                        $record->bids           = $this->process->get_job_bids($record->id);
                        $record->hrs_per_week   = $job->get_hrs_perweek();
                    }
                }

                $data = array('records' => $records, 'limit' => $limit);
                $content = $this->load->view('webview/jobs/content', $data, true);
                
                die (json_encode([
                    'result' => $content,
                    'count'  => count($records)
                ]));
            } else {

                $offset = 0;
                if (intval($jobCat) > 0) {
                    $val = array(
                        'category' => $jobCat,
                        'status'   => 1
                    );
                    $jobCatPage = true;
                    $query = $this->jobs_model->jobs_by_category($val, $limit, $offset);

                } else {

                    if($this->input->get('q')){
                        $keywords = $this->input->get('q');
                        $jobCatPage = true;
                    }

                    $query = $this->jobs_model->load_jobs($this->input->get('q'), $sql, $limit, $offset, $id);
                }

                if (is_object($query) && $query->num_rows() > 0) {
                    $records = $query->result();

                    foreach ($records as $record) {
                        $employer = new Employer($record->user_id);
                        $job      = new Job_details($employer->get_userid(), $record->id);

                        $record->skills         = $this->Skills_model->get_skills($record->id);
                        $record->payment_set    = $this->payment_methods_model->get_primary($employer->get_userid());
                        $record->is_active      = $employer->is_active();
                        $record->total_spent    = $this->payment_model->get_amount_spent($employer->get_userid());
                        $record->rating         = $this->Webuser_model->get_total_rating($employer->get_userid(), true);
                        $record->country        = ucfirst($employer->get_country());
                        $record->job_created    = $this->process->time_elapsed_string($record->job_created);
                        $record->bids           = $this->process->get_job_bids($record->id);
                        $record->hrs_per_week   = $job->get_hrs_perweek();
                    }

                } else {
                    $records = null;
                }

                $profile_progress = $this->ProfileModel->get_profile_completeness($this->user_id);
                $active_interview = $this->process->get_active_interviews($this->user_id);
                $offers           = $this->process->get_active_offers($this->user_id);
                $image            = $this->Webuser_model->load_informations($this->user_id);
                
                $data = array(
                    'js'                  => array('internal/find_job.js'), 
                    'records'             => $records, 
                    'offers'              => $offers['rows'], 
                    'limit'               => $limit, 
                    'int'                 => $active_interview['rows'], 
                    'profilecompleteness' => $profile_progress, 
                    'status'              => $this->Webuser_model->get_status($this->user_id),
                    'proposals'           => $this->process->get_proposed_bids($this->user_id),
                    'croppedImage'        => $image->webuser_picture
                );

                if (isset($subCateList) && !empty($subCateList)) {
                    $data['subCateList'] = $subCateList['rows'];
                } else {
                    $data['subCateList'] = "";
                }
                $data['jobCatSelected'] = $jobCat;
                
                if ($jobCatPage) {
                    if ((isset($keywords)) && (strlen($keywords) > 0)) {
                        $data['searchKeyword'] = $keywords;
                        $data['checkAll'] = TRUE;
                    } else {
                        $data['checkAll'] = FALSE;
                    }
                    $this->Admintheme->webview("jobs/category-jobs", $data);
                } else {
                    $data['page'] = "find-jobs";
                    $data['css']  = array("", "", "", "assets/css/pages/find-jobs.css");
                    $this->Admintheme->custom_webview("jobs/jobs-search", $data);
                }
            }
    }

    public function apply_hourly() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 2) {
                redirect(site_url("jobs-home"));
            }
            $data = [];
            $this->Admintheme->webview("jobs/apply_hourly", $data);
        }
    }

    public function apply_fixed() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 2) {
                redirect(site_url("jobs-home"));
            }
            $data = [];
            $this->Admintheme->webview("jobs/apply_fixed", $data);
        }
    }
    
    public function preview_job_posting(){
        if ($this->Adminlogincheck->checkx() && $this->session->userdata('preview')) {
            $data = array('data' => $this->session->userdata('preview'));
            $this->Admintheme->webview("jobs/preview-job-posting", $data);
        }
    }

    public function status() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }

            $jobs = $this->process->get_posted_jobs($this->user_id);
            $emp = $this->employer->is_active();
            $records = array();

            if($jobs['rows'] > 0){
                foreach($jobs['data'] AS $_jobs){
                    $applicants = $this->process->get_applications($_jobs->id);
                    $rejects = $this->process->get_rejected($_jobs->id);
                    $offers = $this->process->get_offers($_jobs->id);
                    $hires = $this->process->get_hires($this->user_id, $_jobs->id);
                    $interviews = $this->process->get_interviews($this->user_id, $_jobs->id);

                    $records[] = array(
                        'applicants' => $applicants['rows'],
                        'rejects' => $rejects['rows'],
                        'offers' => $offers['rows'],
                        'hires' => $hires['rows'],
                        'interviews' => $interviews['rows'],
                        'job_id' => base64_encode($_jobs->id),
                        'job_type' => ucfirst($_jobs->job_type),
                        'title' => ucwords($_jobs->title),
                        'job_created' => $this->time_elapsed_string($_jobs->job_created)
                    );
                }
            }
            $conversation = new Conversation();
            $data = array(
                'records' => $records,
                'status' => $emp,
                'page' => 'job_status',
                'notification' => $conversation->index(),
                'notification_details' => $conversation->details(),
                'job_alert_count' => $conversation->job_alert(),
                'freelancerend' => $conversation->freelancerend(),
                'clientend' => $conversation->clientend(),
                'css'       => array("","","","assets/css/pages/job_status.css")
            );

            $this->Admintheme->custom_webview("jobs/jobs-home", $data);
        }
    }
    
    private function time_elapsed_string($_ptime){
        $ptime = strtotime($_ptime);
        $etime = time() - $ptime;

        if ($etime < 1){
            return '0 seconds';
        }

        $a = array(365 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        $a_plural = array('year' => 'years',
            'month' => 'months',
            'day' => 'days',
            'hour' => 'hours',
            'minute' => 'minutes',
            'second' => 'seconds'
        );

        foreach ($a as $secs => $str){
            $d = $etime / $secs;
            if ($d >= 1){
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
            }
        }
    }

    public function view_hourly() {
        if ($this->Adminlogincheck->checkx()) {
            $data = [];
            $this->Admintheme->webview("jobs/view_hourly", $data);
        }
    }

    public function view_fixed() {
        if ($this->Adminlogincheck->checkx()) {
            $data = array('data' => $this->session->userdata('preview'));
            $this->Admintheme->webview("jobs/view_fixed", $data);
        }
    }

    public function view($title = NULL, $postId = NULL) {
            //$this->authorized();

            $postId   = base64_decode($postId);
            $employer = $this->jobs_model->load_client_infos($postId);
            $client   = new Employer($employer->webuser_id);
            $job      = new Job_details($client->get_userid(), $postId);

            $freelancer_active = $this->Webuser_model->is_active($this->user_id);
            $accepted_jobs     = $this->process->accepted_jobs($client->get_userid(), TRUE);
            $jobs_posted       = $this->jobs_model->num_sent_by($client->get_userid());
            $applicants        = $this->process->get_applications($postId);
            $interviews        = $this->process->get_interviews($client->get_userid(), $postId);
            $hires             = $this->process->get_hires($client->get_userid(), $postId);
            $jobids            = $this->process->get_job_ids($client->get_userid());

            foreach($accepted_jobs AS $_accepted){
                $jobfeedback = $this->process->get_feedbacks($_accepted->fuser_id, $_accepted->job_id);
                $total_work = $this->process->feedback_worked_hrs($_accepted->fuser_id, $_accepted->job_id);
                $amount = $_accepted->offer_bid_amount ? $_accepted->offer_bid_amount : $_accepted->bid_amount;

                $job_history[] = array(
                  'title'         => ucwords($_accepted->hire_title),
                  'start_date'    => $_accepted->start_date,
                  'job_status'    => $_accepted->jobstatus,
                  'end_date'      => $_accepted->end_date,
                  'job_type'      => $_accepted->job_type,
                  'pay'           => $_accepted->job_type == 'fixed' ? $_accepted->fixedpay_amount : $total_work,
                  'total_price'   => $total_work * $amount,
                  'rating'        => $jobfeedback['feedback_score'],
                  'rating_result' => ($jobfeedback['feedback_score'] / 5) * 100,
                  'comment'       => $jobfeedback['feedback_comment'],
                  'total_work'    => $total_work
                );
            }

            $data = array(
                'emp'           => $client,
                'time'          => $this->time_elapsed_string($job->get_date_created()),
                'value'         => $job,
                'skills'        => $this->Skills_model->get_skills($postId),
                'jobs_posted'   => $jobs_posted,
                'applicants'    => $applicants['rows'],
                'hires'         => $hires['rows'],
                'interviews'    => $interviews['rows'],
                'total_hired'   => $this->jobs_model->number_freelancer_hired($client->get_userid()),
                'workedhours'   => $this->Job_work_diary_model->get_hour_work_for($client->get_userid()),
                'payment_set'   => $this->payment_methods_model->get_primary($client->get_userid()),
                'total_spent'   => $this->payment_model->get_amount_spent($client->get_userid()),
                'rating'        => $this->Webuser_model->get_total_rating($client->get_userid(), true),
                'country'       => ucfirst($client->get_country()),
                'f_active'      => $freelancer_active,
                'is_applied'    => $this->process->is_applied($this->user_id, $postId),
                'accepted_jobs' => $accepted_jobs,
                'job_history'   => $job_history,
                'proposals'     => $this->process->get_freelancer_proposals($this->user_id),
                'css'           => array("", "", "", "assets/css/pages/view.css")
             );

            $this->Admintheme->custom_webview("jobs/jobs", $data);
    }

    public function apply($title = NULL, $postId = NULL) {
        $this->authorized();

        $postId   = base64_decode($postId);
        $employer = $this->jobs_model->load_client_infos($postId);
        $client   = new Employer($employer->webuser_id);
        $job      = new Job_details($client->get_userid(), $postId);

        $freelancer_active = $this->Webuser_model->is_active($this->user_id);
        $accepted_jobs     = $this->process->accepted_jobs($client->get_userid(), TRUE);
        $jobs_posted       = $this->jobs_model->num_sent_by($client->get_userid());
        $applicants        = $this->process->get_applications($postId);
        $interviews        = $this->process->get_interviews($client->get_userid(), $postId);
        $hires             = $this->process->get_hires($client->get_userid(), $postId);
        $rate              = $this->ProfileModel->get_profile($this->user_id);
        $proposals         = $this->process->get_freelancer_proposals($this->user_id);

        if ($this->input->post('job_id')) {
            $is_applied = $this->process->is_applied($this->input->post('job_id'), $this->user_id);
                if ($is_applied > 0) {

                    $rs = array(
                        'code' => '0',
                        'msg'  => '<div class="alert alert-warning"><strong>Warning!</strong> You have already applied for this job.</div>'
                        );
                    echo json_encode($rs);
                    die;
                } else if($proposals >= 30) {

                    $rs = array(
                        'code' => '0', 
                        'msg' => '<div class="alert alert-warning"><strong>Warning!</strong> You reach your monthly proposals limit.</div>');
                    echo json_encode($rs);
                    die;
                }

                $data = $this->input->post();

                unset($data['tid']);
                unset($data['attachments']);
                unset($data['requestor']);
                unset($data['files']);

                $data['user_id'] = $this->session->userdata('id');
                $title           = $data['job_title'];
                unset($data['job_title']);

                $data['bid_fee']     = round($data['bid_amount'] / 10, 2);
                $data['bid_earning'] = $data['bid_amount'] - $data['bid_fee'];
                $data['created']     = date('Y-m-d H:i:s');

                if ($this->db->insert('job_bids', $data)) {
                    $insert_id = $this->db->insert_id();

                    $dataAttach = array(
                        'job_bid_id' => $insert_id,
                        'path' => $this->input->post('attachments'),
                        'tid' => $this->input->post('tid')
                    );

                    $this->Bids_model->add_bid_attachment($dataAttach);

                    $rs = array(
                        'code' => '1',
                        'msg' => ''
                    );

                    $this->session->set_flashdata('msg', 'You have successfully submitted proposal for ' . $title);
                    echo json_encode($rs);

                } else {
                    $rs = array(
                        'code' => '0',
                        'msg' => '<div class="alert alert-warning"><strong>Warning!</strong>Something went wrong.</div>'
                    );
                    echo json_encode($rs);
                }
                die;
            }

        $data = array(
            'emp'         => $client,
            'user_id'     => $this->user_id,
            'tid'         => time(),
            'time'        => $this->time_elapsed_string($job->get_date_created()),
            'rate'        => $rate['hourly_rate'],
            'value'       => $job,
            'skills'      => $this->Skills_model->get_skills($postId),
            'jobs_posted' => $jobs_posted,
            'applicants'  => $applicants['rows'],
            'hires'       => $hires['rows'],
            'interviews'  => $interviews['rows'],
            'total_hired' => $this->jobs_model->number_freelancer_hired($client->get_userid()),
            'workedhours' => $this->Job_work_diary_model->get_hour_work_for($client->get_userid()),
            'payment_set' => $this->payment_methods_model->get_primary($client->get_userid()),
            'total_spent' => $this->payment_model->get_amount_spent($client->get_userid()),
            'rating'      => $this->Webuser_model->get_total_rating($client->get_userid(), true),
            'country'     => ucfirst($client->get_country()),
            'f_active'    => $freelancer_active,
            'js'          => array('dropzone.js', 'vendor/jquery.form.js', 'internal/job_apply.js'), 
            'css'         => array("","","","assets/css/pages/apply.css")
            );

            $this->Admintheme->custom_webview("jobs/apply", $data);
    }

    public function archived_bids_list() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 2) {
                redirect(site_url("jobs-home"));
            }
            $records = array();
            $records1 = array();
            $records2 = array();

            $id = $this->session->userdata('id');
            $this->db->select(array('job_bids.*', 'jobs.title', 'jobs.user_id as client_id', '(select webuser_company from webuser where webuser_id=jobs.user_id) as company'));
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'left');
            $this->db->where('job_bids.status', '1');
            
            // added by jahid start 
             //$this->db->where('job_bids.job_progres_status', '0');
             $this->db->where('(job_bids.withdrawn = 1 OR job_bids.bid_reject = 1)'); 
             // added by jahid end 
            
            $this->db->order_by("job_bids.id", "desc");
            $query = $this->db->get_where('job_bids', array('job_bids.user_id' => $id));
            if ($query->num_rows() > 0)
                $records1 = $query->result();

            $id = $this->session->userdata('id');
            $this->db->select(array('job_bids.*', 'jobs.title', 'jobs.user_id as client_id', '(select webuser_company from webuser where webuser_id=jobs.user_id) as company'));
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'left');
            $this->db->where('job_bids.status', 1);
            
             // added by jahid start 
             $this->db->where('job_bids.job_progres_status', 0);
             $this->db->where('job_bids.withdrawn = 1 OR job_bids.bid_reject = 1'); 
             // added by jahid end 
            
            $this->db->order_by("job_bids.id", "desc");
            $query = $this->db->get_where('job_bids', array('job_bids.user_id' => $id));
            if ($query->num_rows() > 0)
                $records2 = $query->result();
            $records = array_merge($records1, $records2);
            $data = array('records' => $records1, 'title' => 'Archived Jobs - Winjob', 'css' => array("","","","assets/css/pages/archived_bids_list.css"));
            $this->Admintheme->custom_webview("jobs/archived", $data);
        }
    }

    public function edit($postId = null) {
        $this->checkForEmployer();

        $postId = base64_decode($postId);
        $id = $this->session->userdata('id');

        if ($this->input->post('title')) {
 
            $this->Skills_model->delete_skill($this->input->post('id'));
            $this->jobs_model->link_to_skills($this->input->post('id'), $this->input->post('skills'));

            $data = array(
                'title' => $this->input->post('title'),
                'category' => $this->input->post('category'),
                'job_description' => $this->input->post('job_description'),
                'job_type' => $this->input->post('job_type'),
                'job_duration' => $this->input->post('job_duration'),
                'experience_level' => $this->input->post('experience_level'),
                'budget' => $this->input->post('budget'),
                'hours_per_week' => $this->input->post('hours_per_week'),
                'tid' => $this->input->post('tid'),
                'userfile' => $this->input->post('attachments'),
                'skills' => ""
            );
            
            if ($this->input->post('job_type') == 'hourly') {
                unset($data['budget']);
            } else {
                unset($data['hours_per_week']);
            }
            
            if ($this->jobs_model->update_job($this->input->post('id'), $data)) {
                $rs =  array('code' => '1', 'type' => $this->input->post('job_type'));
                $this->session->set_flashdata('msg', $this->input->post('title') . ' has been updated');
                echo json_encode($rs);
                die;
            } else {
                $rs = array('code' => '0', 'msg' => '<div class="alert alert-danger"><strong>Error!</strong> Error occured.Try again.</div>');
                echo json_encode($rs);
                die;
            }
        }

        $job = new Job_details($id, $postId);

        $job_skills = $this->Skills_model->get_skills($postId);
        $skillList = $this->Skills_model->get_list();

        $repeated = array();
        foreach ($skillList as $key => $value) {
            foreach ($job_skills as $index => $skill) {
                if($value->skill_name == $skill['skill_name']){
                    array_push($repeated,$value->skill_name);
                }
            }
        }

        $data = array(
            'repeated' => $repeated,
            'value' => $job,
            'skillList' => $skillList,
            'js' => array('vendor/jquery.form.js', 'internal/job_edit.js'));

        $this->Admintheme->custom_webview("jobs/edit-jobs", $data);
    }

    public function browse() {
        if ($this->Adminlogincheck->checkx()) {
            $data = [];
            $this->Admintheme->webview("jobs/browse", $data);
        }
    }
    
    // added by (Donfack Zeufack Hermann) start 
    // Merge code of {fixed|hourly}_{client|freelancer}_view
    
    
    private function _client_fixed_contract($job_status, $employer = null, $freelancer_feedback = null, $employer_feedback = null){
        
        if($job_status->contract_status == JOB_ENDED){
            
            //get total paid
            $total_paid = $this->jobs_model->get_total_paid( $job_status->bid_id, $job_status->fixedpay_amount );
            
        }else{
            
            $this->load->model('payment_model');
            $payments   = $this->payment_model->load_job_transactions($job_status->buser_id, $job_status->fuser_id, $job_status->job_id);
        }
        
        $this->twig->display('webview/jobs/twig/contract', compact(
            'job_status', 
            'employer', 
            'payments', 
            'total_paid',
            'freelancer_feedback', 
            'employer_feedback'    
        ));
    
    }
        
    private function _calculate_hourly_worked($job_id, $fuser_id){
        
        date_default_timezone_set("UTC");
        
        $today             = date( 'Y-m-d', strtotime('today') );
        $this_week_start   = date( 'Y-m-d', strtotime('monday this week') );
        
        $hour_this_week    = $this->jobs_model->get_work_total_hour($job_id, $fuser_id, $this_week_start, $today);
        
        
        $last_week_start = date( 'Y-m-d', strtotime('-1 week monday') );
        if($last_week_start == $this_week_start)
            $last_week_start = date( 'Y-m-d', strtotime('-2 week monday') );
        
        $last_week_end   = date( 'Y-m-d', strtotime('-1 week sunday') );
        $hour_last_week  = $this->jobs_model->get_work_total_hour($job_id, $fuser_id, $last_week_start, $last_week_end);
        
        $total_hour      = $this->jobs_model->get_work_total_hour($job_id, $fuser_id );
        
        return array($hour_this_week, $hour_last_week, $total_hour);
    }
    
    private function _client_contracts( $contract_id ){
        try{
            $this->load->model(array('jobs_model', 'webuser_model', 'contracts_model'));
        }catch(RuntimeException $e){
            log_message('debug', $e->getMessage());
            $this->session->set_flashdata('error', $this->lang->line('text_app_runtime_exception_message'));
            redirect(home_url());
        }
                      
        $contract_id      = (int) base64_decode( $contract_id );
        
        $job_status = $this->contracts_model->find($contract_id, false);
        
        //If contract does not exist or has been deleted redirect to referrer.
        if(empty($job_status)){
            $this->session->set_flashdata('error', $this->lang->line('text_job_contract_not_found'));
            redirect( back( ) );
        }
        
        if($job_status->buser_id != $this->session->userdata('id') ){
            $this->session->set_flashdata('error', $this->lang->line('text_job_contract_not_authorized'));
            redirect( back( ) );
        }

        $job_id      = $job_status->job_id;
        $employer_id = $job_status->buser_id;
        $user_id     = $job_status->fuser_id; 
        
        $employer_feedback   = null;
        $freelancer_feedback = null;
        
        //if contract is ended load feedback
        if($job_status->contract_status == JOB_ENDED){
            
            //has seen feedback
            $this->jobs_model->set_feedback_saw($job_id, $user_id);
            
            //get employer feeback 
            $employer_feedback = $this->jobs_model->get_feedbacks( $job_id, $employer_id, $user_id );

            //get freelancer feeback 
            $freelancer_feedback = $this->jobs_model->get_feedbacks( $job_id, $user_id, $user_id );
        }
        
        $employer   = $this->webuser_model->load_informations($job_status->buser_id);
                
        if($job_status->job_type == HOURLY_JOB_TYPE){
            return $this->_hourly_contract_display($job_status, $employer, $freelancer_feedback, $employer_feedback);
        }else{
            return $this->_client_fixed_contract($job_status, $employer, $freelancer_feedback, $employer_feedback);
        }    
    }
        
    private function _hourly_contract_display( $job_status, $employer, $freelancer_feedback, $employer_feedback ){
        
        $job_id   = $job_status->job_id; 
        $fuser_id = $job_status->fuser_id;
        
        if($job_status->contract_status == JOB_ENDED){
            //get gain
            $gain_infos = $this->jobs_model->get_final_paid_infos($job_id, $fuser_id);
            if($gain_infos['amount_by_hour'] === null){
                $gain_infos['amount_by_hour'] = !empty($job_status->offer_bid_amount) ? $job_status->offer_bid_amount : $job_status->bid_amount;
            }
        }else{
            list($hour_this_week, $hour_last_week, $total_hour) = $this->_calculate_hourly_worked($job_id, $fuser_id);
        }
        
        $this->twig->display('webview/jobs/twig/contract', compact(
                'job_status', 
                'hour_this_week', 
                'hour_last_week', 
                'total_hour', 
                'gain_infos',
                'employer',
                'freelancer_feedback', 
                'employer_feedback'
          ));
    }
    
    private function _freelancer_fixed_contract($job_status, $employer, $freelancer_feedback, $employer_feedback){
        
        $payments   = $this->payment_model->load_job_transactions($job_status->buser_id, $job_status->fuser_id, $job_status->job_id); 
        
        if($job_status->contract_status == JOB_ENDED){
            
            //get total paid
            $total_paid = $this->jobs_model->get_total_paid( $job_status->bid_id, $job_status->fixedpay_amount );
            
        }else{
            
            $this->load->model('payment_model');
            $payments   = $this->payment_model->load_job_transactions($job_status->buser_id, $job_status->fuser_id, $job_status->job_id);
        }
        
        $this->twig->display('webview/jobs/twig/contract', compact(
            'job_status', 
            'employer', 
            'payments', 
            'total_paid',
            'freelancer_feedback', 
            'employer_feedback'    
        ));
    }
    
    private function _freelancer_contracts( $contract_id ){
        
        try{
            $this->load->model(array('jobs_model', 'webuser_model', 'contracts_model', 'payment_model'));
        }catch(RuntimeException $e){
            log_message('debug', $e->getMessage());
            redirect(site_url("find-jobs"));
        }
        
        $contract_id      = (int) base64_decode( $contract_id );
        
        $job_status = $this->contracts_model->find($contract_id, true);
        
        //If contract does not exist or has been deleted redirect to referrer.
        if(empty($job_status)){
             $this->session->set_flashdata('error', $this->lang->line('text_job_contract_not_found'));
            redirect( back( ) );
        }
        
        if($job_status->fuser_id != $this->session->userdata('id') ){
            $this->session->set_flashdata('error', $this->lang->line('text_job_contract_not_authorized'));
            redirect( back( ) );
        }

        $job_id      = $job_status->job_id;
        $employer_id = $job_status->buser_id;
        $user_id     = $job_status->fuser_id; 
        $employer_feedback   = null;
        $freelancer_feedback = null;
        
        //if contract is ended load feedback
        if($job_status->contract_status == JOB_ENDED){
            
            //has seen feedback
            $this->jobs_model->set_feedback_saw($job_id, $user_id);
            
            //get employer feeback 
            $employer_feedback = $this->jobs_model->get_feedbacks( $job_id, $employer_id, $user_id );

            //get freelancer feeback 
            $freelancer_feedback = $this->jobs_model->get_feedbacks( $job_id, $user_id, $user_id );
        }
        
        $employer = $this->webuser_model->load_informations($job_status->buser_id);
        
        if($job_status->job_type == HOURLY_JOB_TYPE){
            $this->_hourly_contract_display($job_status, $employer, $freelancer_feedback, $employer_feedback);
        }else{
            $this->_freelancer_fixed_contract($job_status, $employer, $freelancer_feedback, $employer_feedback);
        }
    }
    
    /**
     * This will handled fixed and hourly job.
     * It will replace fixed_client_view, hourly_client_view, 
     * freelancer_client_view and freelancer_hourly_view method in this 
     * controller.
     */
    public function contracts(){
        
        $this->authorized();
        
        $contract_id = trim($this->input->get('fmJob'));
        
        //If contract identifier is not valid redirect to referrer.
        if(empty($contract_id)){
            $this->session->set_flashdata('error', $this->lang->line('text_job_invalid_contract'));
            return redirect( back( ) );
        }
        
        if ($this->session->userdata('type') == EMPLOYER) {
            return $this->_client_contracts( $contract_id );
        }elseif($this->session->userdata('type') == FREELANCER) {
            return $this->_freelancer_contracts( $contract_id );
        }else{
            redirect( home_url() );
        }
        
    }
    
    public function ended_contract(){
        $contract_id = $this->input->get('fmJob');
        if( ! empty( $contract_id ) && is_string( $contract_id ) ){
            $contract_id = base64_decode( $contract_id );
            $user_type   = $this->session->userdata('type');
            
            if($user_type == FREELANCER){
                return $this->client_end_contract( $contract_id );
            }else{
                return $this->client_end_contract( $contract_id );
            }
        }
        
        $this->session->set_flashdata('error', $this->lang->line('text_job_invalid_contract'));
        redirect( back( ) );
    }
    
    private function client_end_contract( $contract_id ){
        $this->load->model(array('contracts_model', 'jobs_model'));
        $buser_id = $this->session->userdata('id');
        
        $is_employer = $this->session->userdata('type') == EMPLOYER;
                
        //get contract
        $contract   = $this->contracts_model->find( $contract_id,  ( $is_employer ? false : true ) );
        
        if($contract == null){
            $this->session->set_flashdata('error', $this->lang->line('text_job_contract_not_found'));
            redirect( back( ) );
        }
        
        if($contract->job_type == HOURLY_JOB_TYPE){
            //get final paid of hourly worked.
            $gain_infos = $this->jobs_model->get_final_paid_infos( $contract->job_id, $contract->fuser_id );
        }else{
            //get total paid
            $total_paid = $this->jobs_model->get_total_paid( $contract->bid_id, $contract->fixedpay_amount );
        }
        
        $this->twig->display('webview/jobs/twig/end-contracts', compact('contract', 'total_paid', 'gain_infos'));
    }
    
    private function _update_bid_state( $state ){
        $this->authorized();
        
        if ($this->session->userdata('type') == 1) {
            
            $bid_id = base64_decode($this->input->get('fbid'));
            
            if(!is_numeric($bid_id))
                redirect( home_url() );
            
            $this->load->model('jobs_model');
            
            $bid = $this->jobs_model->load_bid( $bid_id );
            
            if(empty($bid)){
                $this->session->set_flashdata('error', $this->lang->item('text_app_bid_does_not_exists'));
                redirect( home_url() );
            }
            
            $this->jobs_model->update_bid_state($bid_id, $state);
            
            $encode_contract_id   = base64_encode($bid_id);
            
            redirect( site_url('contracts?' . http_build_query( array( 'fmJob' => $encode_contract_id ) ) ) );
            
        }else{
            redirect( home_url() );
        }
    }
    
    public function restart(){
        return $this->_update_bid_state( BID_STATE_APPLIED );
    }
    
    public function paused(){
        return $this->_update_bid_state( BID_STATE_PAUSED );
    }
    
    // added by (Donfack Zeufack Hermann) end
    
    
   // added by (Donfack Zeufack Hermann) start 
   // private function to sanitize $_GET fixed client view datas
    private function prepare_client_data(){
        
        $fm_job    = $this->input->get('fmJob');
        $fuser     = $this->input->get('fuser');

        if(empty($fm_job) || empty($fuser)){
            //TODO: set a message here to explain redirection.
            redirect(site_url('jobs/my-freelancers'));
        }
        
        return array(
          base64_decode($fm_job),
          $this->session->userdata('id'),
          base64_decode($fuser),
        ); 
        
    }
    // added by (Donfack Zeufack Hermann) end
    

    public function fixed_client_view() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }

            // added by (Donfack Zeufack Hermann) start load models
            try{
                $this->load->model(array('jobs_model', 'webuser_model', 'payment_model'));
            }catch(RuntimeException $e){
                log_message('debug', $e->getMessage());
            }
            // added by (Donfack Zeufack Hermann) end            
            
            // added by (Donfack Zeufack Hermann) start replace access to $_GET values with $this->input->get() and set standard
            list($job_id, $sender_id, $user_id) = $this->prepare_client_data();  
            $job_status = $this->jobs_model->load_job_status($sender_id, $user_id, $job_id);
            $ststus     = $this->webuser_model->load_informations($sender_id);
            $payments   = $this->payment_model->load_job_transactions($sender_id, $user_id, $job_id); 
            // added by (Donfack Zeufack Hermann) end
            
            // added by (Donfack Zeufack Hermann) start reduce the number line of code to pass data to the view.
            $this->Admintheme->webview_2("jobs/fixed_client_view", compact('job_status', 'ststus', 'payments'));
            // added by (Donfack Zeufack Hermann) end
        }
    }
    
    // added by (Donfack Zeufack Hermann) start private function to sanitize $_GET fixed freelancer view datas
    private function prepare_fixed_freelancer_data(){
        
        $fm_job    = $this->input->get('fmJob');

        if(empty($fm_job)){
            //TODO: set a message here to explain redirection.
            redirect(site_url('find-jobs'));
        }
        
        return array(
          base64_decode($fm_job),
          $this->session->userdata('id'),
        ); 
        
    }
    // added by (Donfack Zeufack Hermann) end

    public function fixed_freelancer_view() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 2) {
                redirect(site_url("jobs-home"));
            }
            
            // added by (Donfack Zeufack Hermann) start load models
            try{
                $this->load->model(array('jobs_model', 'webuser_model', 'payment_model'));
            }catch(RuntimeException $e){
                log_message('debug', $e->getMessage());
                redirect(site_url("find-jobs"));
            }
            // added by (Donfack Zeufack Hermann) end           
            
            
            // added by (Donfack Zeufack Hermann) start replace access to $_GET values with $this->input->get() and set standard
            list($job_id, $user_id) = $this->prepare_fixed_freelancer_data();  
            $job_status = $this->jobs_model->load_job_status(null, $user_id, $job_id);
            $ststus     = $this->webuser_model->load_informations($job_status->buser_id);
            $payments   = $this->payment_model->load_job_transactions($job_status->buser_id, $user_id, $job_id); 
            // added by (Donfack Zeufack Hermann) end

            // added by (Donfack Zeufack Hermann) start enhance code make it more compact to pass data to the view 
            $this->Admintheme->webview("jobs/fixed_freelancer_view", compact('job_status', 'ststus', 'payments'));
            // added by (Donfack Zeufack Hermann) end
        }
    }
    
    public function hourly_freelancer_view() {
        if ($this->Adminlogincheck->checkx()) {

            if ($this->session->userdata('type') != 2) {
                redirect(site_url("jobs-home"));
            }
            $jobId = base64_decode($_GET['fmJob']);
            $user_id = $this->session->userdata('id');

            $this->db->select('*,jobs.status AS job_status,jobs.job_duration AS jobduration,jobs.created AS job_created');
            $this->db->from('job_accepted');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->join('webuser', 'webuser.webuser_id=job_accepted.buser_id', 'inner');
            $this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id=webuser.webuser_id', 'inner');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
            $this->db->where('job_accepted.fuser_id', $user_id);
            $this->db->where('job_accepted.job_id', $jobId);

            $query = $this->db->get();
            $job_status = $query->row();
            $this->db->select('*');
            $this->db->from('webuser');
            $this->db->where('webuser.webuser_id', $job_status->buser_id);
            $query_status = $this->db->get();
            $ststus = $query_status->row();


            $data = array('job_status' => $job_status, 'ststus' => $ststus);
            $this->Admintheme->webview("jobs/hourly_freelancer_view", $data);
        }
    }

    public function hourly_client_view() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }

            $jobId = base64_decode($_GET['fmJob']);
            $sender_id = $this->session->userdata('id');
            $user_id = base64_decode($_GET['fuser']);
            $this->db->select('*,jobs.status AS job_status,jobs.job_duration AS jobduration,jobs.created AS job_created');
            $this->db->from('job_accepted');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->join('webuser', 'webuser.webuser_id=job_accepted.fuser_id', 'inner');
            $this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id=webuser.webuser_id', 'inner');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
            $this->db->where('job_accepted.buser_id', $sender_id);
            $this->db->where('job_accepted.fuser_id', $user_id);
            $this->db->where('job_accepted.job_id', $jobId);
            $query = $this->db->get();
            $job_status = $query->row();

            $this->db->select('*');
            $this->db->from('webuser');
            $this->db->where('webuser.webuser_id', $sender_id);
            $query_status = $this->db->get();
            $ststus = $query_status->row();

            $data = array('job_status' => $job_status, 'ststus' => $ststus);
            $this->Admintheme->webview("jobs/hourly_client_view", $data);
        }
    }

    public function applied($jobId = null) {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }

            $budget = 0;
            $total_work = 0;
            $feedbackScore = 0;

            $records = array();
            $_price = array();
            $_freelancer = array();
            
            $job_id = base64_decode($jobId);
            $bids = $this->process->get_bids($job_id);
            $emp = $this->employer->is_active();
            $job_details = $this->process->get_job_details($job_id);

            $applicants = $this->process->get_applications($job_id);
            $rejects = $this->process->get_rejected($job_id);
            $offers = $this->process->get_offers($job_id);
            $hires = $this->process->get_hires($this->user_id, $job_id);
            $interviews = $this->process->get_interviews($this->user_id, $job_id);
            
            if($bids['rows'] > 0){
                foreach($bids['data'] AS $_bids){
                   $ended_jobs = $this->process->cnt_ended_jobs($_bids->user_id);
                   $freelancer_profile = $this->ProfileModel->get_profile($_bids->user_id);
                   $accepted_jobs = $this->process->accepted_jobs($_bids->user_id);
                   $pic = $this->Adminforms->getdatax("picture", "webuser", $_bids->user_id);
                   $country = new Employer($_bids->user_id);
                   $skills = $this->ProfileModel->get_skills($_bids->user_id);
                   $user_rating = $this->Webuser_model->get_total_rating($_bids->user_id);
                   $_pic = $pic != "" ? $pic : "assets/user.png";

                   foreach($accepted_jobs AS $a_jobs){
                       $feedbacks = $this->process->get_feedbacks($a_jobs->fuser_id, $a_jobs->job_id);
                       $diary = $this->Job_work_diary_model->get_work_hours($a_jobs->fuser_id, $a_jobs->job_id);

                        foreach($diary AS $_diary){
                            $total_work += $_diary->total_hour;
                        }

                       if($a_jobs->jobstatus == 1){
                           if(!empty($feedbacks)){
                                if($a_jobs->job_type == 'fixed'){
                                    $price = $a_jobs->fixedpay_amount;
                                    $feedbackScore += ($feedbacks['feedback_score'] * $price);
                                    $budget += $price;
                                }else{

                                    if($a_jobs->offer_bid_amount){
                                        $amount = $a_jobs->offer_bid_amount;
                                    }else{
                                        $amount = $a_jobs->bid_amount;
                                    }

                                    $price = $a_jobs->fixedpay_amount * $amount;
                                    $feedbackScore += ($feedbacks['feedback_score'] * $price);
                                    $budget += $price;
                                }
                            }
                        }
                    }

                    $records[] = array(
                       'ended_jobs' => $ended_jobs,
                       'tagline' => ucfirst($freelancer_profile['tagline']),
                       'budget' => $budget,
                       'feedback_score' => $feedbackScore,
                       'total_work' => $total_work,
                       'pic' => $_pic,
                       'fname' => $_bids->webuser_fname,
                       'lname' => $_bids->webuser_lname,
                       'user_id' => $_bids->user_id,
                       'job_id' => $_bids->job_id,
                       'bid_id' => $_bids->id,
                       'bid_amount' => $_bids->bid_amount,
                       'country' => ucfirst($country->get_country()),
                       'letter' => $_bids->cover_latter,
                       'skills' => $skills,
                       'rating' => $user_rating
                    );
                }
            }

            $data = array(
                'records' => $records,
                'jobId' => base64_encode($job_id),
                'status' => $emp,
                'applicants' => $applicants['rows'],
                'rejects' => $rejects['rows'],
                'offers' => $offers['rows'],
                'hires' => $hires['rows'],
                'interviews' => $interviews['rows'],
                'job_type' => ucfirst($job_details['job_type']),
                'job_title' => ucwords($job_details['title']),
                'title' => 'Applications - Winjob'
            );
            $this->Admintheme->webview("jobs/applications", $data);
        }
    }

    public function interviews($jobId = null) {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }

            $budget = 0;
            $total_work = 0;
            $feedbackScore = 0;

            $records = array();
            $_price = array();
            $_freelancer = array();
            
            $job_id = base64_decode($jobId);
            $bids = $this->process->get_bids($job_id);
            $emp = $this->employer->is_active();
            $job_details = $this->process->get_job_details($job_id);

            $applicants = $this->process->get_applications($job_id);
            $rejects = $this->process->get_rejected($job_id);
            $offers = $this->process->get_offers($job_id);
            $hires = $this->process->get_hires($this->user_id, $job_id);
            $interviews = $this->process->get_interviews($this->user_id, $job_id);
            
            foreach($interviews['data'] AS $_interviews){
               $ended_jobs = $this->process->cnt_ended_jobs($_interviews->user_id);
               $freelancer_profile = $this->ProfileModel->get_profile($_interviews->user_id);
               $accepted_jobs = $this->process->accepted_jobs($_interviews->user_id);
               $pic = $this->Adminforms->getdatax("picture", "webuser", $_interviews->user_id);
               $country = new Employer($_interviews->user_id);
               $skills = $this->ProfileModel->get_skills($_interviews->user_id);
               $user_rating = $this->Webuser_model->get_total_rating($_interviews->user_id);
               $_pic = $pic != "" ? $pic : "assets/user.png";

               foreach($accepted_jobs AS $a_jobs){
                   $feedbacks = $this->process->get_feedbacks($a_jobs->fuser_id, $a_jobs->job_id);
                   $diary = $this->Job_work_diary_model->get_work_hours($a_jobs->fuser_id, $a_jobs->job_id);

                    foreach($diary AS $_diary){
                        $total_work += $_diary->total_hour;
                    }
                    
                   if($a_jobs->jobstatus == 1){
                       if(!empty($feedbacks)){
                            if($a_jobs->job_type == 'fixed'){
                                $price = $a_jobs->fixedpay_amount;
                                $feedbackScore += ($feedbacks['feedback_score'] * $price);
                                $budget += $price;
                            }else{
                                
                                if($a_jobs->offer_bid_amount){
                                    $amount = $a_jobs->offer_bid_amount;
                                }else{
                                    $amount = $a_jobs->bid_amount;
                                }

                                $price = $a_jobs->fixedpay_amount * $amount;
                                $feedbackScore += ($feedbacks['feedback_score'] * $price);
                                $budget += $price;
                            }
                        }
                    }
                }

                $records[] = array(
                   'ended_jobs' => $ended_jobs,
                   'tagline' => ucfirst($freelancer_profile['tagline']),
                   'budget' => $budget,
                   'feedback_score' => $feedbackScore,
                   'total_work' => $total_work,
                   'pic' => $_pic,
                   'fname' => $_interviews->webuser_fname,
                   'lname' => $_interviews->webuser_lname,
                   'user_id' => $_interviews->user_id,
                   'job_id' => $_interviews->job_id,
                   'bid_id' => $_interviews->id,
                   'bid_amount' => $_interviews->bid_amount,
                   'country' => ucfirst($country->get_country()),
                   'letter' => $_interviews->cover_latter,
                   'skills' => $skills,
                   'rating' => $user_rating
                );
            }

            $data = array(
                'records' => $records,
                'jobId' => base64_encode($job_id),
                'status' => $emp,
                'applicants' => $applicants['rows'],
                'rejects' => $rejects['rows'],
                'offers' => $offers['rows'],
                'hires' => $hires['rows'],
                'interviews' => $interviews['rows'],
                'job_type' => ucfirst($job_details['job_type']),
                'job_title' => ucwords($job_details['title']),
                'title' => 'Interviews - Winjob'
            );
            $this->Admintheme->webview("jobs/interviews", $data);
        }
    }

    public function accept_hourly() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 2) {
                redirect(site_url("jobs-home"));
            }

            $jobId = base64_decode($_GET['fmJob']);
            $user_id = $this->session->userdata('id');

            $this->db->select('jobs.*, job_bids.*,jobs.user_id AS offerduser_id,job_bids.status AS bid_status,jobs.job_duration AS jobduration,job_bids.id AS bid_id,job_bids.created AS bid_created');

            $this->db->join('job_bids', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->where('job_bids.user_id', $user_id);
            $this->db->where('job_bids.job_id', $jobId);
            $this->db->where('job_bids.hired', '1');
                        // added by jahid start 
            $this->db->where('job_bids.job_progres_status','2');
            // added by jahid end 
            $this->db->where('job_bids.status', 0);
            $query = $this->db->get('jobs');
            $job_details = $query->result();


            $this->db->select('webuser.*, webuser_basic_profile.*');
            $this->db->join('webuser_basic_profile', 'webuser.webuser_id=webuser_basic_profile.webuser_id', 'inner');
            $this->db->where('webuser.webuser_id', $user_id);
            $user_details = $this->db->get('webuser');
            $user_details = $user_details->row();



            if (isset($job_details[0])) {
                $this->db->select('webuser.*, webuser_basic_profile.*');
                $this->db->join('webuser_basic_profile', 'webuser.webuser_id=webuser_basic_profile.webuser_id', 'inner');
                $this->db->where('webuser.webuser_id', $job_details[0]->offerduser_id);
                $query_offerduser = $this->db->get('webuser');
                $offerduser_details = $query_offerduser->row();
            } else {
                $offerduser_details = null;
            }

            $data = array('job_details' => $job_details, 'offerduser_details' => $offerduser_details, 'user_details' => $user_details, 'title' => 'Accept Job Offer - Winjob');
            $this->Admintheme->webview("jobs/accept_hourly", $data);
        }
    }

    public function accept_fixed() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 2) {
                redirect(site_url("job_status"));
            }
            $data = [];
            $this->Admintheme->webview("jobs/accept_fixed", $data);
        }
    }

    public function accept_offer() {
        if ($this->Adminlogincheck->checkx()) {
            parse_str($_POST['form'], $form);
            //print_r($form); die;
            //mail send After accept the mail
            $client_id = $form['client_id'];
            $client_name = $form['client_name'];
            $client_email = $form['client_email'];
            $user_email = $form['user_email'];
            $user_id = $form['user_id'];
            $user_name = $form['user_name'];
            $job_name = $form['job_name'];
            $message = $form['confo_notes'];
            $jobId = $form['job_id'];
            $Bid_id = $form['bid_id'];

            $alphabets = range('A', 'Z');
            $numbers = range('0', '9');
            $final_array = array_merge($alphabets, $numbers);
            $rcovercode = '';
            $length = 10;
            while ($length--) {
                $key = array_rand($final_array);
                $rcovercode .= $final_array[$key];
            }
            $contact_id = $user_id . '_' . $rcovercode;

            $this->db->select('*');
            $this->db->from('job_accepted');
            $this->db->where('job_accepted.fuser_id', $user_id);
            $this->db->where('job_accepted.bid_id', $Bid_id);
            $this->db->where('job_accepted.buser_id', $client_id);
            $this->db->where('job_accepted.job_id', $jobId);
            $query = $this->db->get();
            $exist = $query->result();

            if (count($exist) > 0) {
                $this->db->where('job_accepted.fuser_id', $user_id);
                $this->db->where('job_accepted.bid_id', $Bid_id);
                $this->db->where('job_accepted.buser_id', $client_id);
                $this->db->where('job_accepted.job_id', $jobId);
                $this->db->delete('job_accepted');
            }

            $offer_confo_data = array(
                'fuser_id' => $user_id,
                'job_id' => $jobId,
                'buser_id' => $client_id,
                'bid_id' => $Bid_id,
                'comments' => $message,
                'contact_id' => $contact_id,
            );

            // var_dump($offer_confo_data);die();

            
            $this->db->select('*');
            $this->db->from('job_bids');
            $this->db->where('job_id', $jobId);
            $query = $this->db->get();
            $result = $query->row();

            if ($query->num_rows() > 0) {
                $payment = '$'.$result->bid_earning;
            }

            //Get Address of Client
            $this->db->select('*');
            $this->db->from('webuseraddresses');
            $this->db->where('webuser_id', $client_id);
            $query = $this->db->get();
            $result_client = $query->row();

            if ($query->num_rows() > 0) {
                $address = $result_client->address.' '.$result_client->address1;
                $address1 = $result_client->city.' '.$result_client->state.' '.$result_client->zipcode;
                $country = $result_client->country;
            }

            //Get Tax information of Freelancer
            $this->db->select('*');
            $this->db->from('webuser_tax_information');
            $this->db->where('webuser_id', $user_id);
            $query = $this->db->get();
            $result_fl = $query->row();

            if ($query->num_rows() > 0) {
                $fl_address = $result_fl->address.' '.$result_fl->address_line1;
                $fl_address1 = $result_fl->city.' '.$result_fl->state.' '.$result_fl->zipcode;
                $fl_country = $result_fl->country;
            }
            
            //Get Profile Address of Freelancer
            $this->db->select('*');
            $this->db->from('webuseraddresses');
            $this->db->where('webuser_id', $user_id);
            $query = $this->db->get();
            $result_add = $query->row();

            if ($query->num_rows() > 0) {
                $address_profile = $result_add->address.' '.$result_add->address1;
                $address1_profile = $result_add->city.' '.$result_add->state.' '.$result_add->zipcode;
                $country_profile = $result_add->country;
            }
            
            //Get Job Title
            
            $this->db->select('*');
            $this->db->from('jobs');
            $this->db->where('id', $job_id);
            $query = $this->db->get();
            $result_job = $query->row();

            if ($query->num_rows() > 0) {
                $job_title = $result_job->title;
            }

            $subject = "Invoice for Contract $contact_id";
            $company_name = $form['company'];

            $details = array(
                    'fname' => $user_name,
                    'company' => 'Winjob',
                    'verification' => site_url()."jobs/" . $title . "/" . base64_encode($job_id),
                    'slogan' => 'Hire Talented Freelancers For a Low Cost',
                    'para1' => 'You have successfully received '.$payment.' from '.$company_name.'. Please see details below.',
                    'payment' => $payment,
                    'company_name' => $company_name,
                    'client' => $client_name,
                    'date' => date('F j, Y'),
                    'contract' => $contact_id,
                    'invoice_no' => mt_rand() . "<br>",
                    'job_title' => $job_name
                );
            
            $details_employer = array(
                    'company' => 'Winjob',
                    'slogan' => 'Hire Talented Freelancers For a Low Cost',
                    'payment' => $payment,
                    'company_name' => $company_name,
                    'client' => $client_name,
                    'freelancer' => $user_name,
                    'date' => date('F j, Y'),
                    'contract' => $contract,
                    'invoice_no' => $invoice_no,
                    'job_title' => $job_name,
                    'address' => $address,
                    'address1' => $address1,
                    'country' => $country,
                    'fl_address' => $fl_address ? $fl_address : $address_profile,
                    'fl_address1' => $fl_address1 ? $fl_address1 : $address1_profile,
                    'fl_country' => $fl_country ? $fl_country : $country_profile
            );

            //Email sent to client when offer is accepted 
            $accept_subject = "Job Offer has been Accepted by $user_name";
            $accept_email = array(
                    'company' => 'Winjob',
                    'slogan' => 'Hire Talented Freelancers For a Low Cost',
                    'fname' => $client_name,
                    'verification' => site_url()."jobs/" . $job_title . "/" . base64_encode($jobId),
                    'para1' => 'Your contract has started with '.$user_name.'. Please review the job post below.',
            );
            
            //Email sent to freelancer when offer is accepted
            $accept_freelancer_sbj = "You have Accepted Job Offer from $client_name";
            $accept_freelancer = array(
                    'company' => 'Winjob',
                    'slogan' => 'Hire Talented Freelancers For a Low Cost',
                    'fname' => $user_name,
                    'verification' => site_url()."jobs/" . $job_title . "/" . base64_encode($jobId),
                    'para1' => 'Your contract has started with '.$client_name.'. Please review the job post below.',
            );    
            
            $this->Sesmailer->sesemail($user_email,$subject,$this->Emailtemplate->emailview('freelancer_invoice', $details));
            $this->Sesmailer->sesemail($client_email,$subject,$this->Emailtemplate->emailview('employer_invoice', $details_employer));
            $this->Sesmailer->sesemail($client_email,$accept_subject,$this->Emailtemplate->emailview('job_offer', $accept_email));
            $this->Sesmailer->sesemail($user_email,$accept_freelancer_sbj,$this->Emailtemplate->emailview('job_offer', $accept_freelancer));
            $this->db->insert('job_accepted', $offer_confo_data);
            // die();

            $sql = "UPDATE  job_bids set job_progres_status=3,hired = '0' WHERE user_id ='" . $user_id . "' AND job_id = '" . $jobId . "'";
            $this->db->query($sql);
            $response['success'] = true;
            print_r(json_encode($response));
        }
    }

    public function accept() {
        if ($this->Adminlogincheck->checkx()) {
            $jobId = base64_decode($_GET['fmJob']);
            $Bid_id = base64_decode($_GET['fmBiD']);
            $user_id = $this->session->userdata('id');


            $this->db->select('webuser.*, webuser_basic_profile.*');
            $this->db->join('webuser_basic_profile', 'webuser.webuser_id=webuser_basic_profile.webuser_id', 'inner');
            $this->db->where('webuser.webuser_id', $user_id);
            $user_details = $this->db->get('webuser');
            $user_details = $user_details->row();

            $this->db->select('jobs.*,webuser.*, webuser_basic_profile.*');
            $this->db->join('webuser', 'jobs.user_id=webuser.webuser_id', 'inner');
            $this->db->join('webuser_basic_profile', 'webuser.webuser_id=webuser_basic_profile.webuser_id', 'inner');
            $this->db->where('jobs.id', $jobId);
            $query_offerduser = $this->db->get('jobs');
            //$this->db->last_query();
            $offerduser_details = $query_offerduser->row();

            $data = array('user_details' => $user_details, 'offerduser_details' => $offerduser_details);
            $this->Admintheme->webview("jobs/accept", $data);
        }
    }

    public function paypal() {
        if ($this->Adminlogincheck->checkx()) {
            $data = [];
            $this->Admintheme->webview("jobs/paypal", $data);
        }
    }
    

    public function mystaff() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }
            
            // added by (Donfack Zeufack Hermann) start 
            
            // load models
            try{
                $this->load->model(array('jobs_model', 'webuser_model'));
            }catch(RuntimeException $e){
                log_message('debug', $e->getMessage());
                $this->session->set_flashdata('error', $this->lang->line('text_job_runtime_exception_message'));
                redirect(site_url(home_url()));
            }
            
            // fetch employer staff data
            $employer_id         = $this->session->userdata('id');
            $nb_freelancer_hired = $this->jobs_model->number_freelancer_hired( $employer_id );
            $jobs_accepted       = $this->jobs_model->load_all_jobs_freelancer_hired($employer_id);
                        
            date_default_timezone_set("UTC"); 
            $today               = date('y-m-d', strtotime('today'));
            $this_week_start     = date('y-m-d', strtotime('monday this week'));
            
            $job_ids             = $this->extrat_all_job_ids( $jobs_accepted );
            $freelancer_job_hour = $this->jobs_model->get_all_freelancer_total_hour($job_ids, $this_week_start, $today);
            
            $nb_offer            = $this->jobs_model->number_offer( $employer_id );
            $nb_past_hired       = $this->jobs_model->number_past_hired( $employer_id );
            $webuser             = $this->webuser_model->load_informations( $employer_id );
            
            $this->twig->display('webview/jobs/twig/my-staff', compact('nb_freelancer_hired', 'jobs_accepted', 'freelancer_job_hour', 'nb_offer', 'past_hired', 'webuser'));
            // added by (Donfack Zeufack Hermann) end
        }
    }

    public function activecontracts() {
        if ($this->Adminlogincheck->checkx()) {

            $user_id = $this->session->userdata('id');
            $this->db->select('*');
            $this->db->from('job_accepted');
            $this->db->join('webuser', 'webuser.webuser_id=job_accepted.fuser_id', 'inner');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
            $this->db->where('job_accepted.buser_id', $user_id);
            $this->db->where('job_bids.hired', '0');
            $this->db->where('job_bids.jobstatus', '0');
            $query = $this->db->get();
            $result = $query->result();

            $this->db->select('*,job_bids.id as bid_id');
            $this->db->from('job_bids');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->where('job_bids.status', 0);
            $this->db->where('jobs.user_id', $user_id);
            $this->db->where('job_bids.hired', '1');
            $this->db->group_by('bid_id');
            $query_offer = $this->db->get();
            $offer_count = $query_offer->num_rows();


            $this->db->select('*');
            $this->db->from('job_accepted');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->where('job_accepted.buser_id', $user_id);
            $this->db->where('job_bids.hired', '0');
            $this->db->where('job_bids.jobstatus', '1');
            $query = $this->db->get();
            $past_hire = $query->num_rows();



            $data = array('all_data' => $result, 'offer_count' => $offer_count, 'past_hire' => $past_hire, 'nb_item' => count($result) );
            //$this->Admintheme->webview("jobs/active-contracts", $data);
            $this->twig->display('webview/jobs/twig/active-contracts', $data);
        }
    }

    public function pasthire() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }

            $user_id = $this->session->userdata('id');
            $this->db->select('*');
            $this->db->from('job_accepted');
            $this->db->join('webuser', 'webuser.webuser_id=job_accepted.fuser_id', 'inner');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
            $this->db->where('job_accepted.buser_id', $user_id);
            $this->db->where('job_bids.hired', '0');
            $this->db->where('job_bids.jobstatus', '1');
            $query = $this->db->get();
            $result = $query->result();
            $past_hire = $query->num_rows();

            $this->db->select('*,job_bids.id as bid_id');
            $this->db->from('job_bids');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->where('job_bids.status', 0);
            $this->db->where('jobs.user_id', $user_id);
            $this->db->where('job_bids.hired', '1');
            $this->db->group_by('bid_id');
            $query_offer = $this->db->get();
            $offer_count = $query_offer->num_rows();
            
            $this->load->model('jobs_model');
            $job_ids             = $this->extrat_all_job_ids( $result );
            $freelancer_job_hour = $this->jobs_model->get_all_freelancer_total_hour($job_ids);
            
            $this->db->select('*');
            $this->db->from('job_accepted');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->where('job_accepted.buser_id', $user_id);
            $this->db->where('job_bids.hired', '0');
            $this->db->where('job_bids.jobstatus', '0');
            $query_myhire = $this->db->get();
            $myhire_count = $query_myhire->num_rows();

            $data = array(
                'messages' => $result, 
                'offer_count' => $offer_count, 
                'myhire_count' => $myhire_count, 
                'past_hire' => $past_hire, 
                'freelancer_job_hour' => $freelancer_job_hour
            );
            
            //$this->Admintheme->webview("jobs/pasthire", $data);
            $this->twig->display( 'webview/jobs/twig/pasthire', $data );
        }
    }

    public function endedcontracts() {
        if ($this->Adminlogincheck->checkx()) {
            $user_id = $this->session->userdata('id');
            $this->db->select('*');
            $this->db->from('job_accepted');
            $this->db->join('webuser', 'webuser.webuser_id=job_accepted.fuser_id', 'inner');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->join('country', 'country.country_id=webuser.webuser_country', 'inner');
            $this->db->where('job_accepted.buser_id', $user_id);
            $this->db->where('job_bids.hired', '0');
            $this->db->where('job_bids.jobstatus', '1');
            $query = $this->db->get();
            $result = $query->result();
            $past_hire = $query->num_rows();

            $this->db->select('*,job_bids.id as bid_id');
            $this->db->from('job_bids');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->where('job_bids.status', 0);
            $this->db->where('jobs.user_id', $user_id);
            $this->db->where('job_bids.hired', '1');
            $this->db->group_by('bid_id');
            $query_offer = $this->db->get();
            $offer_count = $query_offer->num_rows();

            $this->db->select('*');
            $this->db->from('job_accepted');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->where('job_accepted.buser_id', $user_id);
            $this->db->where('job_bids.hired', '0');
            $this->db->where('job_bids.jobstatus', '0');
            $query_myhire = $this->db->get();
            $myhire_count = $query_myhire->num_rows();


            $data = array('messages' => $result, 'offer_count' => $offer_count, 'myhire_count' => $myhire_count, 'past_hire' => $past_hire);
            //$this->Admintheme->webview("jobs/ended-contracts", $data);
            $this->twig->display('webview/jobs/twig/ended-contracts', $data);
        }
    }

    public function offersent() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }

            $user_id = $this->session->userdata('id');

            $this->db->select('*,job_bids.id as bid_id');
            $this->db->from('job_bids');
            $this->db->join('webuser', 'webuser.webuser_id = job_bids.user_id', 'inner');
            $this->db->join('country', 'country.country_id = webuser.webuser_country', 'inner');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->where('job_bids.status', 0);
            $this->db->where('jobs.user_id', $user_id);
            $this->db->where('job_bids.hired', '1');
            $this->db->group_by('bid_id');
            $query = $this->db->get();
            $offer_count = $query->num_rows();
            $result = $query->result();


            $this->db->select('*');
            $this->db->from('job_accepted');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->where('job_accepted.buser_id', $user_id);
            $this->db->where('job_bids.hired', '0');
            $this->db->where('job_bids.jobstatus', '0');
            $query_myhire = $this->db->get();
            $myhire_count = $query_myhire->num_rows();

            $this->db->select('*');
            $this->db->from('job_accepted');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->where('job_accepted.buser_id', $user_id);
            $this->db->where('job_bids.hired', '0');
            $this->db->where('job_bids.jobstatus', '1');
            $query = $this->db->get();
            $past_hire = $query->num_rows();


            $data = array('messages' => $result, 'offer_count' => $offer_count, 'myhire_count' => $myhire_count, 'past_hire' => $past_hire);
            //$this->Admintheme->webview("jobs/offersent", $data);
            $this->twig->display('webview/jobs/twig/offer-sent', $data);
        }
    }

    public function send_invitation($user_id = null) {
        if ($this->Adminlogincheck->checkx()) {
            $data = array();

            if ($user_id != null) {
                $data['user_id'] = $user_id;
            } else {
                if (isset($_POST)) {
                    $job_id = $this->input->post('job_id');
                    $message = $this->input->post('message');
                    $fuser_id = $this->input->post('fuser_id');
                    $sender_id = $this->session->userdata('id');
                    $data = "INSERT INTO job_conversation set job_id = '" . $job_id . "', bid_id = '0',  message_conversation = '" . $message . "', sender_id = '" . $sender_id . "', receiver_id = '" . $fuser_id . "', have_seen = 1 ";

                    redirect(site_url('my-offers'));
                }

                redirect(site_url('jobs-home'));
            }
            $this->Admintheme->webview("jobs/send_invitation", $data);
        }
    }
    
    public function change_proposal_term()
    {
        if( ! $this->Adminlogincheck->checkx() && $this->session->userdata('type') != FREELANCER){
            $this->ajax_response (array( 'code' => '-1', /* Not connected */ ));
        }
        
        $data = array();
        $data['bid_amount']  = $this->input->post('bid_amount');
        $bid_id              = $this->input->post('bid_id');
        $data['bid_fee']     = round($data['bid_amount'] / 10, 2);
        $data['bid_earning'] = $data['bid_amount'] - $data['bid_fee'];
        $this->db->where('id', $bid_id);
        
        //Update bid amount
        if ($this->db->update('job_bids', $data)) 
        {
            $result = array(
                'code' => '1', 
                'modal' => '#myModal2', 
                'amt' => '1', 
                'msg' => 'You proposal has been revised.');
        }
        else
        {
            $result = array(
                'code' => '0', 
                'msg' => 'Something went wrong.');
        }
        
        $this->ajax_response($result);
    }

    public function withdraw_system($bidId = null) {
        $this->isFreelancer();

        $job_id  = base64_decode($bidId);
        $bid    = $this->process->get_freelancer_bid($this->user_id, $job_id);
        $job    = new Job_details($bid['clientid'], $bid['job_id']);
        $client = new Employer($bid['clientid']);

        $freelancer_active = $this->Webuser_model->is_active($this->user_id);
        $accepted_jobs     = $this->process->accepted_jobs($client->get_userid(), TRUE);
        $jobs_posted       = $this->jobs_model->num_sent_by($client->get_userid());
        $applicants        = $this->process->get_applications($bid['job_id']);
        $interviews        = $this->process->get_interviews($client->get_userid(), $bid['job_id']);
        $hires             = $this->process->get_hires($client->get_userid(), $bid['job_id']);
        $rate              = $this->ProfileModel->get_profile($this->user_id);
    
        if ($this->input->post('proposal')) {
            $data = array();
            $data['bid_amount'] = $this->input->post('bid_amount');
            $bidId = $this->input->post('bid_id');
            $data['bid_fee'] = round($data['bid_amount'] / 10, 2);
            $data['bid_earning'] = $data['bid_amount'] - $data['bid_fee'];
        
            $this->db->where('id', $bidId);
            if ($this->db->update('job_bids', $data)) {
                $rs = array(
                    'code' => '1',
                    'modal' => '#myModal2',
                    'amt' => '1',
                    'msg' => '<div class="alert alert-success"><strong>Success!</strong> You proposal has been revised.</div>'
                );
            } else {
                $rs = array(
                    'code' => '0',
                    'msg' => '<div class="alert alert-danger"><strong>Warning!</strong> Something went wrong.</div>'
                );
            }
            echo json_encode($rs);
            die;
        }
        else if ($this->input->post('withdraw')) {
            $data = array();
            $data['status'] = '1';
            $data['withdrawn'] = '1';
            $data['withdrawn_by'] = '1';

            $bidId = $this->input->post('bid_id');
            $this->db->where('id', $bidId);
            if ($this->db->update('job_bids', $data)) {
                $rs = array(
                    'code' => '1',
                    'modal' => '#myModal',
                    'amt' => '0',
                    'msg' => '<div class="alert alert-success"><strong>Success!</strong> You have successfully withdraw with this job.</div>');
            } else {
                $rs = array(
                    'code' => '0',
                    'msg' => '<div class="alert alert-danger"><strong>Warning!</strong> Something went wrong.</div>');
            }
            echo json_encode($rs);
            die;
        }

        $data = array(
            'emp'         => $client,
			'bid_id'      => $bid['id'],
            'user_id'     => $this->user_id,
            'tid'         => time(),
            'bid_created' => $bid['bid_created'],
            'status'      => $bid['status'],
            'bid_earning' => $bid['bid_earning'],
            'bid_amount'  => $bid['bid_amount'],
            'cover_letter'=> $bid['cover_latter'],
            'tid'         => $bid['tid'],
            'freelancer'  => $bid['user_id'],
            'f_attachments' => $this->process->get_attachments($bidId),
            'time'        => $this->time_elapsed_string($job->get_date_created()),
            'rate'        => $rate['hourly_rate'],
            'value'       => $job,
            'skills'      => $this->Skills_model->get_skills($bid['job_id']),
            'jobs_posted' => $jobs_posted,
            'applicants'  => $applicants['rows'],
            'hires'       => $hires['rows'],
            'interviews'  => $interviews['rows'],
            'total_hired' => $this->jobs_model->number_freelancer_hired($client->get_userid()),
            'workedhours' => $this->Job_work_diary_model->get_hour_work_for($client->get_userid()),
            'payment_set' => $this->payment_methods_model->get_primary($client->get_userid()),
            'total_spent' => $this->payment_model->get_amount_spent($client->get_userid()),
            'rating'      => $this->Webuser_model->get_total_rating($client->get_userid(), true),
            'country'     => ucfirst($client->get_country()),
            'f_active'    => $freelancer_active,
			'is_expired' => $this->Bids_model->isExpired($bid, $job),
			'is_rejected' => $this->Bids_model->isRejected($bid),
			'is_withdrawn' => $this->Bids_model->isWithdrawn($bid),
			'is_offer'    => $this->Bids_model->isOffer($bid),
            'js'          => array('dropzone.js', 'vendor/jquery.form.js', 'internal/job_apply.js', 'internal/job_withdraw.js'),
            'css'         => array("","","","assets/css/pages/apply.css")
            );
        
        $this->Admintheme->custom_webview("jobs/proposals", $data);
    }

    public function confirm_hired_fixed() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }
            
    

            /* check if account is suspend then redirect to payment */
            
            $user_id = $this->session->userdata('id');
            $this->db->select('*');            
            $this->db->from('webuser');
            $this->db->where('isactive', 1);
            $this->db->where('webuser_id',$user_id);      
            $query = $this->db->get();   
            $accActive=0;
                if (is_object($query)) {
                    $accActive = $query->num_rows();
                }
                
            if(!$accActive)    
            {                    
                redirect(site_url("pay/methods_card"));                
            }
                        
            
           /* check payment method is set or not ? start */
                        
            $user_id = $this->session->userdata('id');
            $this->db->select('*');            
            $this->db->from('billingmethodlist');
            $this->db->where('billingmethodlist.belongsTo', $user_id);            
            $this->db->where('billingmethodlist.isDeleted', "0");
            $query = $this->db->get();   
            $paymentSet=0;
                if (is_object($query)) {
                    $paymentSet = $query->num_rows();
                }
                
            if(!$paymentSet)    
            {                
                redirect(site_url("pay/methods_card"));                
            }
            /* check payment method is set or not ? end */

            $data = [];
            if (isset($_GET['user_id']) && isset($_GET['job_id'])) {

                $applier_id = $_GET['user_id'];
                $job_id = $_GET['job_id'];
                $this->db->select('*');
                $this->db->from('jobs');
                $this->db->where('jobs.id', base64_decode($job_id));
                $query = $this->db->get();
                $result = $query->result();

                $this->db->select('*');
                $this->db->from('webuser');
                $this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id = webuser.webuser_id', 'inner');
                $this->db->where('webuser.webuser_id', base64_decode($applier_id));
                $query = $this->db->get();
                $result1 = $query->result();

                $this->db->select('*');
                $this->db->from('job_bids');
                $this->db->where('job_bids.user_id', base64_decode($applier_id));
                $this->db->where('job_bids.job_id', base64_decode($job_id));
                $query = $this->db->get();
                $result3 = $query->result();

                $data = array('applier_id' => $applier_id, 'job_id' => $job_id, 'job_details' => $result, 'user_details' => $result1, 'bid_details' => $result3);
            } else {
                redirect('/jobs-home');
            }


            $this->Admintheme->webview("jobs/confirm_hired_fixed", $data);
        }
    }

    public function confirm_hired_hourly() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }
            
            
            
            
            /* check if account is suspend then redirect to payment */
            
            $user_id = $this->session->userdata('id');
            $this->db->select('*');            
            $this->db->from('webuser');
            $this->db->where('isactive', 1);
            $this->db->where('webuser_id',$user_id);      
            $query = $this->db->get();   
            $accActive=0;
                if (is_object($query)) {
                    $accActive = $query->num_rows();
                }
                
            if(!$accActive)    
            {                    
                redirect(site_url("pay/methods_card"));                
            }
                        
            
           /* check payment method is set or not ? start */
                        
            $user_id = $this->session->userdata('id');
            $this->db->select('*');            
            $this->db->from('billingmethodlist');
            $this->db->where('billingmethodlist.belongsTo', $user_id);            
            $this->db->where('billingmethodlist.isDeleted', "0");
            $query = $this->db->get();   
            $paymentSet=0;
                if (is_object($query)) {
                    $paymentSet = $query->num_rows();
                }
                
            if(!$paymentSet)    
            {                
                redirect(site_url("pay/methods_card"));                
            }
            /* check payment method is set or not ? end */

            if ($this->input->post('proposal')) {
                $data = array();
                $data['offer_bid_amount'] = $this->input->post('bid_amount');
                $bidId = $this->input->post('bid_id');
                $data['offer_bid_fee'] = round($data['offer_bid_amount'] / 10, 2);
                $data['offer_bid_earning'] = $data['offer_bid_amount'] - $data['offer_bid_fee'];
                $this->db->where('id', $bidId);
                if ($this->db->update('job_bids', $data)) {
                    $rs = array('code' => '1', 'modal' => '#myModal2', 'amt' => '1', 'msg' => '<div class="alert alert-success">
                    <strong>Success!</strong> You proposal has been revised.
                  </div>');
                } else {
                    $rs = array('code' => '0', 'msg' => '<div class="alert alert-danger">
                    <strong>Warning!</strong> Something went wrong.
                  </div>');
                }
                echo json_encode($rs);

                die;
            }



            $data = [];
            if (isset($_GET['user_id']) && isset($_GET['job_id'])) {

                $applier_id = $_GET['user_id'];
                $job_id = $_GET['job_id'];


                $this->db->select('*');
                $this->db->from('jobs');
                $this->db->where('jobs.id', base64_decode($job_id));
                $query = $this->db->get();
                $result = $query->result();

                $this->db->select('*');
                $this->db->from('webuser');
                $this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id = webuser.webuser_id', 'inner');
                $this->db->where('webuser.webuser_id', base64_decode($applier_id));
                $query = $this->db->get();
                $result1 = $query->result();

                $this->db->select('*');
                $this->db->from('job_bids');
                $this->db->where('job_bids.user_id', base64_decode($applier_id));
                $this->db->where('job_bids.job_id', base64_decode($job_id));
                $query = $this->db->get();
                $result3 = $query->result();


                $data = array('applier_id' => $applier_id, 'job_id' => $job_id, 'job_details' => $result, 'user_details' => $result1, 'bid_details' => $result3, 'js' => array('vendor/jquery.form.js'));
            } else {
                redirect('/jobs-home');
            }

            $this->Admintheme->webview("jobs/confirm_hired_hourly", $data);
        }
    }

    public function confirm_hired() {
        $buser_id = $this->session->userdata('id');
        $response['success'] = false;
        $applier_id = $_POST['applier_id'];
        $payer_email = $_POST['payer_email'];
        $job_id = $_POST['job_id'];
        $title = $_POST['title'];
        if ($title == "") {
            $title = $_POST['default_title'];
        }
        $message = $_POST['message'];
        $start_date = $_POST['start_date'];

        if (isset($_POST['budget'])) {
            $jobs_data['hired_on'] = $_POST['budget'];
            $this->db->where('job_id', $job_id);
            $this->db->where('user_id', $applier_id);
            $this->db->update('job_bids', $jobs_data);
        }

        $this->db->select('*');
        $this->db->from('job_bids');
        $this->db->where('job_bids.user_id', $applier_id);
        $this->db->where('job_bids.job_id', $job_id);
        $query_bids = $this->db->get();
        $result3_bid = $query_bids->row();
        $bid_id = $result3_bid->id;


        if (isset($_POST['budget']) && isset($_POST['budget_type']) && $_POST['budget_type'] == 1) {
            $budget = $_POST['budget'];
            $budget_type = $_POST['budget_type'];
        } elseif (isset($_POST['budget']) && isset($_POST['budget_type']) && $_POST['budget_type'] == 2) {
            $budget = $_POST['milestone_input'];
            $budget_type = $_POST['budget_type'];
        } else {
            $weekly_limit = $_POST['limit'];
            if ($weekly_limit != 0) {
                $weekly_limit_amount = $_POST['weekly_limit_amount'];
            } else {
                $weekly_limit_amount = 0.00;
            }
            if (isset($_POST['allow_freelancer'])) {
                $allow_freelancer = $_POST['allow_freelancer'];
            } else {
                $allow_freelancer = 0;
            }
        }

        // addded by jahid start 
        if (isset($_POST['budget']) && isset($_POST['budget_type'])) {
            $sql = "UPDATE  job_bids set job_progres_status=2,hired = '1', hire_title = '" . $title . "', hire_message = '" . $message . "',fixedpay_amount = '" . $budget . "',fixed_pay_status= '" . $budget_type . "', payment_status = 0,  start_date = '" . $start_date . "' WHERE user_id ='" . $applier_id . "' AND job_id = '" . $job_id . "'";
        } else {
            $sql = "UPDATE  job_bids set job_progres_status=2,hired = '1', hire_title = '" . $title . "', hire_message = '" . $message . "', weekly_limit = '" . $weekly_limit . "', allow_freelancer = '" . $allow_freelancer . "', weekly_amount = '" . $weekly_limit_amount . "', payment_status = 0, start_date = '" . $start_date . "' WHERE user_id ='" . $applier_id . "' AND job_id = '" . $job_id . "'";
        }
        // addded by jahid end      

        if ($this->db->query($sql)) {
            if (isset($_POST['budget']) && isset($_POST['budget_type'])) {
                //updates by haseeburrehman.com starts
                $user_id = $this->session->userdata('id');
                $chargeUser = chargePrimary($user_id, $_POST['budget']);
                if ($chargeUser['status_code'] == 1) { 
                    $response['success'] = false;
                    $response['message'] = 'Failed payment for Insufficient funds';
                }else{
                    $response['success'] = true;
                    $response['message'] = 'Successfull';
                    
                    /* adding data at report start */
                    
                    $data_payment['job_id'] = (int) $job_id;
                    $data_payment['user_id'] = (int) $applier_id;
                    $data_payment['buser_id'] = (int) $user_id ;


                    if ($budget_type == 1) {
                        $data_payment['des'] = 'Full Paid';
                    } elseif ($budget_type == 2) {
                        $data_payment['des'] = 'Milestone';
                    }
                    $data_payment['payment_gross'] = $budget;

                    $this->db->insert('payments', $data_payment);
        redirect(site_url().'offered?job_id='.base64_encode($job_id));            
                    /* adding data at report end */
                }
                //updates by haseeburrehman.com ends     
            }
            redirect(site_url().'offered?job_id='.base64_encode($job_id));
        } else {
             $response['success'] = false;
             $response['message'] = 'Unsuccessfull';
        }


        echo json_encode($response);
    }
    
    public function notifications(){
        
        $this->authorized();
        
        $this->load->model('contracts_model');
        
        $user_id = $this->session->userdata('id');
        
        if($this->session->userdata('type') == FREELANCER){
            $contracts = $this->contracts_model->get_feedback_notification( $user_id );
        }else{
            $contracts = $this->contracts_model->get_feedback_notification( $user_id, true );
        }
        
        $nb_contracts = count($contracts);
        $this->twig->display('webview/jobs/twig/notifications-contract', compact('contracts', 'nb_contracts'));
    }

    public function freelancer_endjobnotification() {
        if ($this->Adminlogincheck->checkx()) {

            $user_id = $this->session->userdata('id');

            $this->db->select('*');
            $this->db->from('job_feedback');
            $this->db->join('job_bids', 'job_feedback.feedback_job_id = job_bids.job_id', 'inner');
            $this->db->join('webuser', 'webuser.webuser_id = job_feedback.feedback_clientid', 'inner');
            $this->db->join('jobs', 'job_bids.job_id=jobs.id', 'inner');
            $this->db->where('job_feedback.feedback_userid', $user_id);
            $this->db->where('job_bids.user_id', $user_id);
            $this->db->where('job_feedback.sender_id !=', $user_id);
            $this->db->where('job_bids.jobstatus', '1');
            $this->db->where('job_feedback.haveseen', 1);
            $this->db->group_by("job_feedback.feedback_id");
            $query = $this->db->get();
            $job_end_data = $query->result();

            $this->db->last_query();


            $data = array('job_end_data' => $job_end_data);
            $this->Admintheme->webview("jobs/freelancer_endjobnotification", $data);
        }
    }

    public function client_endjobnotification() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }

            $user_id = $this->session->userdata('id');

            $this->db->select('*');
            $this->db->from('job_feedback');
            $this->db->join('job_bids', 'job_feedback.feedback_job_id = job_bids.job_id', 'inner');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->where('job_feedback.feedback_clientid', $user_id);
            $this->db->where('job_feedback.sender_id !=', $user_id);
            $this->db->where('job_feedback.haveseen', 1);
            $this->db->where('job_bids.jobstatus', '1');
            $this->db->group_by("job_feedback.feedback_id");
            $query = $this->db->get();
            $job_end_data = $query->result();


            $data = array('job_end_data' => $job_end_data);
            $this->Admintheme->webview("jobs/client_endjobnotification", $data);
        }
    }

    public function workdairy_freelancer() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 2) {
                redirect(site_url("jobs-home"));
            }
            $user_id = $this->session->userdata('id');
            $client_id = base64_decode($_GET['buser']);
            $job_id = base64_decode($_GET['fmJob']);
            if (isset($_GET['date']) && $_GET['date'] != "") {
                $date = date('Y/m/d', strtotime($_GET['date']));
            } else {
                $date = date('Y/m/d');
            }

            $this->db->select('*, job_bids.status as bid_status');
            $this->db->from('job_accepted');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->where('job_accepted.fuser_id', $user_id);
            $this->db->where('job_bids.jobstatus', '0');
            $this->db->where('jobs.job_type', 'hourly');
            $query_list = $this->db->get();
            $job_list = $query_list->result();
            
            

            $this->db->select('jobs.*, job_bids.*,jobs.user_id AS offerduser_id,job_bids.status AS bid_status,jobs.job_duration AS jobduration,job_bids.id AS bid_id,job_bids.created AS bid_created');
            $this->db->join('job_bids', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->where('job_bids.user_id', $user_id);
            $this->db->where('job_bids.job_id', $job_id);
            $this->db->where('job_bids.status', BID_STATE_APPLIED);
            $this->db->or_where('job_bids.status', BID_STATE_PAUSED);
            $query = $this->db->get('jobs');
            $job_details = $query->row();
            
            //Total Worked(Hours)
            $this->db->select('*');
            $this->db->from('job_workdairy');
            $this->db->where('fuser_id', $user_id);
            $this->db->where('jobid', $job_id);
            $this->db->where('working_date', $date);
            $query_done = $this->db->get();
            $job_done = $query_done->result();

            //Total Worked(Hours) In this week mon-mon day

            $time = strtotime('monday this week 00:00 UCT');
            $cweek = date('Y/m/d', $time);
            $nweek = date('Y/m/d', strtotime($cweek . ' + 1 weeks'));

            $this->db->select('*');
            $this->db->from('job_workdairy');
            $this->db->where('fuser_id', $user_id);
            $this->db->where('jobid', $job_id);
            $this->db->where('working_date >=', $cweek);
            $this->db->where('working_date <=', $nweek);
            $query_done_weekly = $this->db->get();
            $job_doneweekly = $query_done_weekly->result();
            //echo   $this->db->last_query();



            $this->db->select('*');
            $this->db->from('job_workdairy');
            $this->db->where('fuser_id', $user_id);
            $this->db->where('jobid', $job_id);
            $this->db->where('working_date', $date);
            $query_working = $this->db->get();
            $job_working = $query_working->result();
            //   echo   $this->db->last_query();


            $this->db->select('*');
            $this->db->from('webuser');
            $this->db->where('webuser.webuser_id', $client_id);
            $query_status = $this->db->get();
            $ststus = $query_status->row();


            $data = array('job_details' => $job_details, 'job_done' => $job_done, 'job_list' => $job_list, 'job_working' => $job_working, 'job_doneweekly' => $job_doneweekly, 'ststus' => $ststus);
            $this->Admintheme->webview("jobs/workdairy_freelancer", $data);
        }
    }

    public function workdairy_client() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }

            $client_id = $this->session->userdata('id');
            $user_id = base64_decode($_GET['fuser']);
            $job_id = base64_decode($_GET['fmJob']);



            $this->db->select('jobs.*, job_bids.*,jobs.user_id AS offerduser_id,job_bids.status AS bid_status,jobs.job_duration AS jobduration,job_bids.id AS bid_id,job_bids.created AS bid_created');
            $this->db->join('job_bids', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->where('job_bids.user_id', $user_id);
            $this->db->where('job_bids.job_id', $job_id);
            $this->db->where('job_bids.status', 0);
            $query = $this->db->get('jobs');
            $job_details = $query->row();


            $this->db->select('*');
            $this->db->from('job_accepted');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->where('job_accepted.fuser_id', $user_id);
            $this->db->where('job_bids.jobstatus', '0');
            $this->db->where('jobs.job_type', 'hourly');
            $query_list = $this->db->get();
            $job_list = $query_list->result();



            $this->db->select('*');
            $this->db->from('job_workdairy');
            $this->db->where('cuser_id', $client_id);
            $this->db->where('fuser_id', $user_id);
            $this->db->where('jobid', $job_id);
            $query_done = $this->db->get();
            $job_done = $query_done->result();


            if (isset($_GET['date']) && $_GET['date'] != "") {
                $date = date('Y/m/d', strtotime($_GET['date']));
            } else {
                $date = date('Y/m/d');
            }

            $this->db->select('*');
            $this->db->from('job_workdairy');
            $this->db->where('fuser_id', $user_id);
            $this->db->where('jobid', $job_id);
            $this->db->where('working_date', $date);
            $query_working = $this->db->get();
            $job_working = $query_working->result();

            $this->db->select('*');
            $this->db->from('job_bids');
            $this->db->join('webuser', 'webuser.webuser_id=job_bids.user_id', 'inner');
            $this->db->where('job_bids.job_id', $job_id);
            $query_fuser = $this->db->get();
            $userlist = $query_fuser->result();
            $this->db->last_query();



            $data = array('job_details' => $job_details, 'job_done' => $job_done, 'job_list' => $job_list, 'userlist' => $userlist, 'job_working' => $job_working);
            $this->Admintheme->webview("jobs/workdairy_client", $data);
        }
    }

    public function work_hour() {
        if ($this->Adminlogincheck->checkx()) {
            // die();
            parse_str($_POST['form'], $form);

            date_default_timezone_set("UTC");

            $date = date('Y-m-d');

            $starttime = date('Y-m-d H:i:s', strtotime($form['staring_hour']));
            $endtime = date('Y-m-d H:i:s', strtotime($form['end_hour']));

            $job_workdairy = array(
                'jobid' => $form['job_id'],
                'bid_id' => $form['bid_id'],
                'cuser_id' => $form['clientid'],
                'fuser_id' => $form['user_id'],
                'starting_hour' => $starttime,
                'ending_hour' => $endtime,
                'total_hour' => $form['total_hour'],
                'working_date' => $date,
                'end_work' => $endtime,
            );



            $this->db->select('*');
            $this->db->from('job_workdairy');
            $this->db->where('fuser_id', $form['user_id']);
            $this->db->where('jobid', $form['job_id']);
            $this->db->where('working_date', $date);
            $this->db->order_by("workdairy_id", "desc");
            $this->db->limit('1');
            $query_check = $this->db->get();
            $check = $query_check->row();
            $lastened = strtotime($check->end_work);

            if (($lastened > strtotime($form['staring_hour'])) && ($lastened < strtotime($form['end_hour']))) {
                $response['message'] = 'You have work betwween this hour';
            } else {
                $this->db->insert('job_workdairy', $job_workdairy);

                $current_time = $starttime;
                $totalloop = round(((strtotime($endtime) - strtotime($starttime)) / 360));
                for ($i = 1; $i <= $totalloop; $i++) {
                    $capturetime = date('Y-m-d H:i:s', strtotime("+6 minutes", strtotime($current_time)));
                    $job_track = array(
                        'jobid' => $form['job_id'],
                        'bid_id' => $form['bid_id'],
                        'cuser_id' => $form['clientid'],
                        'fuser_id' => $form['user_id'],
                        'cpture_image' => NULL,
                        'capture_time' => $capturetime,
                        'working_date' => $date,
                    );

                    $this->db->insert('workdairy_tracker', $job_track);
                    $current_time = $capturetime;
                }


                $response['success'] = true;
                $response['message'] = 'You have successfully Add the hour';
                $response['todaywork'] = $form['total_hour'];
            }




            print_r(json_encode($response));
        }
    }

    public function removepost() {
        if ($this->Adminlogincheck->checkx()) {

            $job_id = $_POST['form'];
            $sql = "UPDATE  jobs set status = '0' WHERE id ='" . $job_id . "'";
            $this->db->query($sql);


            $response['success'] = true;
            print_r(json_encode($response));
        }
    }

    public function bid_decline($freelancer_hit_id = null) {
        if ($this->Adminlogincheck->checkx()) {

            $user_id = $this->session->userdata('id');
          // added by jahid start 
            if ($freelancer_hit_id != null) {
                $sql = "UPDATE  job_bids set status = '1',withdrawn=1,withdrawn_by=1 WHERE id = ?" ;
                $this->db->query($sql, [$freelancer_hit_id]);
                if(!$this->input->is_ajax_request()) {
                    redirect(site_url('my-offers'));
                }
            } else {
                $bid_id = $_POST['form'];
                $sql = "UPDATE  job_bids set bid_reject = '1',withdrawn_by=2  WHERE id ='" . $bid_id . "'";
                $this->db->query($sql);
            }
         // added by jahid end 
            $response['success'] = true;
            
          
            print_r(json_encode($response));
        }
    }
    
    public function jobs_no_auth($url_rewrite = null, $sort = 1){
        $jobCat          = $this->uri->segment(2);
        $url_rewrite     = substr($url_rewrite, 1, -1);
        $user_categories = $this->Category->get_categories();
        $jobCatPage      = false;
        $sql             = "";

        if (sizeof($user_categories) > 0) {
            foreach($user_categories AS $cat){
                $sql .= $cat->cat_id . ",";
            }
        }

        $sql     = substr($sql, 0, strlen($sql) - 1);
        $limit   = 25;
        $records = array();

        if ($this->input->is_ajax_request()) {
            
            $category    = array();
            $jobCat      = $this->input->post('jobCat');
            $jobType     = $this->input->post('jobtype');
            $jobDuration = $this->input->post('jobDuration');
            $jobHours    = $this->input->post('jobHours');
            $offsetId    = $this->input->post('limit');
            $keywords    = $this->input->post('keywords');

            if (intval($offsetId) >= 0 == false) {
                $offsetId = 0;
            }
            if (strlen($jobCat) > 0) {
                $catIds = explode(",", $jobCat);
                if (sizeof($catIds) > 0) {
                    foreach ($catIds as $cat) {
                        if (intval($cat) > 0) {
                            $category[] = $cat;
                        }
                    }
                }
            }

            $val = array(
                '1' => '1',
                'status' => 1
            );

            $offset = $limit * $offsetId;

            if (empty($category)) {
                if ($sql != "" && strlen($sql) >= 1) {
                    $query = $this->jobs_model->filter_random_jobs($jobType, $jobDuration, $jobHours, $category, $sql, $this->input->get('q'), $limit, $offset);
                }
            } else {
                $query = $this->jobs_model->filter_random_jobs($jobType, $jobDuration, $jobHours, $category, $sql, $this->input->get('q'), $limit, $offset, $sort);
            }

            if ($query->num_rows() > 0 && is_object($query)){
                $records = $query->result();
                
                foreach ($records as $record) {
                    $employer = new Employer($record->user_id);
                    $job      = new Job_details($employer->get_userid(), $record->id);

                    $record->skills         = $this->Skills_model->get_skills($record->id);
                    $record->payment_set    = $this->payment_methods_model->get_primary($employer->get_userid());
                    $record->is_active      = $employer->is_active();
                    $record->total_spent    = $this->payment_model->get_amount_spent($employer->get_userid());
                    $record->rating         = $this->Webuser_model->get_total_rating($employer->get_userid(), true);
                    $record->country        = ucfirst($employer->get_country());
                    $record->job_created    = $this->process->time_elapsed_string($record->job_created);
                    $record->bids           = $this->process->get_job_bids($record->id);
                    $record->hrs_per_week   = $job->get_hrs_perweek();
                }
            }

            $data = array(
                'records' => $records, 
                'limit'   => $limit
            );

            $content = $this->load->view('webview/jobs/no_auth_content', $data, true);
            die (json_encode([
                'result' => $content,
                'count' => count($records)
            ]));
        } else {

            $offset = 0;
            if (intval($jobCat) > 0) {
                $val = array(
                    'category' => $jobCat,
                    'status' => 1
                );

                $jobCatPage = true;
                $query      = $this->jobs_model->jobs_by_category($val, $limit, $offset);

            } else {
                if (isset($_GET['q'])) {
                    $keywords = $this->input->get("q");
                    $jobCatPage = true;
                }

                $query = $this->jobs_model->generate_random_jobs($this->input->get('q'), $sql, $limit, $offset);
            }
            if (is_object($query) && $query->num_rows() > 0) {
                $records = $query->result();
                
                foreach ($records as $record) {
                    $employer = new Employer($record->user_id);
                    $job      = new Job_details($employer->get_userid(), $record->id);

                    $record->skills         = $this->Skills_model->get_skills($record->id);
                    $record->payment_set    = $this->payment_methods_model->get_primary($employer->get_userid());
                    $record->is_active      = $employer->is_active();
                    $record->total_spent    = $this->payment_model->get_amount_spent($employer->get_userid());
                    $record->rating         = $this->Webuser_model->get_total_rating($employer->get_userid(), true);
                    $record->country        = ucfirst($employer->get_country());
                    $record->job_created    = $this->process->time_elapsed_string($record->job_created);
                    $record->bids           = $this->process->get_job_bids($record->id);
                    $record->hrs_per_week   = $job->get_hrs_perweek();
                }
            } else {
                $records = null;
            }

            $data = array(
                'records' => $records, 
                'limit'   => $limit,
                'js'      => array('internal/find_job.js')
            );

            if (isset($subCateList) && !empty($subCateList)) {
                $data['subCateList'] = $subCateList['rows'];
            } else {
                $data['subCateList'] = "";
            }
            $data['jobCatSelected'] = $jobCat;

            if ($jobCatPage) {

                if ((isset($keywords)) && (strlen($keywords) > 0)) {
                    $data['searchKeyword'] = $keywords;
                    $data['checkAll']      = true;
                } else {
                    $data['checkAll'] = false;
                }
                $data['categories'] = $this->Category->get_categories();
                $this->Admintheme->webview("jobs/freelance-jobs", $data);
            } else {
                $data['categories'] = $this->Category->get_categories();
                $this->Admintheme->webview("jobs/freelance-jobs", $data);
            }
        }
    }
    
    public function view_no_auth($title = NULL, $postId = NULL) {
            $postId   = base64_decode($postId);
            $employer = $this->jobs_model->load_client_infos($postId);
            $client   = new Employer($employer->webuser_id);
            $job      = new Job_details($client->get_userid(), $postId);

            $freelancer_active = $this->Webuser_model->is_active($this->user_id);
            $accepted_jobs     = $this->process->accepted_jobs($client->get_userid(), TRUE);
            $jobs_posted       = $this->jobs_model->num_sent_by($client->get_userid());
            $applicants        = $this->process->get_applications($postId);
            $interviews        = $this->process->get_interviews($client->get_userid(), $postId);
            $hires             = $this->process->get_hires($client->get_userid(), $postId);
            $jobids            = $this->process->get_job_ids($client->get_userid());

            foreach($accepted_jobs AS $_accepted){
                $jobfeedback = $this->process->get_feedbacks($_accepted->fuser_id, $_accepted->job_id);
                $total_work = $this->process->feedback_worked_hrs($_accepted->fuser_id, $_accepted->job_id);
                $amount = $_accepted->offer_bid_amount ? $_accepted->offer_bid_amount : $_accepted->bid_amount;

                $job_history[] = array(
                  'title'         => ucwords($_accepted->hire_title),
                  'start_date'    => $_accepted->start_date,
                  'job_status'    => $_accepted->jobstatus,
                  'end_date'      => $_accepted->end_date,
                  'job_type'      => $_accepted->job_type,
                  'pay'           => $_accepted->job_type == 'fixed' ? $_accepted->fixedpay_amount : $total_work,
                  'total_price'   => $total_work * $amount,
                  'rating'        => $jobfeedback['feedback_score'],
                  'rating_result' => ($jobfeedback['feedback_score'] / 5) * 100,
                  'comment'       => $jobfeedback['feedback_comment'],
                  'total_work'    => $total_work
                );
            }

            $data = array(
                'emp'           => $client,
                'time'          => $this->time_elapsed_string($job->get_date_created()),
                'value'         => $job,
                'skills'        => $this->Skills_model->get_skills($postId),
                'jobs_posted'   => $jobs_posted,
                'applicants'    => $applicants['rows'],
                'hires'         => $hires['rows'],
                'interviews'    => $interviews['rows'],
                'total_hired'   => $this->jobs_model->number_freelancer_hired($client->get_userid()),
                'workedhours'   => $this->Job_work_diary_model->get_hour_work_for($client->get_userid()),
                'payment_set'   => $this->payment_methods_model->get_primary($client->get_userid()),
                'total_spent'   => $this->payment_model->get_amount_spent($client->get_userid()),
                'rating'        => $this->Webuser_model->get_total_rating($client->get_userid(), true),
                'country'       => ucfirst($client->get_country()),
                'f_active'      => $freelancer_active,
                'is_applied'    => $this->process->is_applied($this->user_id, $postId),
                'accepted_jobs' => $accepted_jobs,
                'job_history'   => $job_history,
                'proposals'     => $this->process->get_freelancer_proposals($this->user_id),
                'css'           => array("", "", "", "assets/css/pages/view.css")
             );

            $this->Admintheme->custom_webview("jobs/view_no_auth", $data);
    }
}
