<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends Winjob_Controller {

    public function __construct() {
        parent::__construct();
        
        // added by (Donfack Zeufack Hermann) start 
        // load the default language for the current user.
        $this->load_language();
        // added by (Donfack Zeufack Hermann) end
        
        
        $this->load->model(array('Category', 'Common_mod'));
        $this->load->library('paypal_lib');
        
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
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }
			
			/* check if account is suspend then redirect to payment start */
            
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
            
            /* check if account is suspend then redirect to payment end */
            // Added by Armen
            // Get all skills
            $this->db->select("skill_name");
            $this->db->from("skills");
            $query_files = $this->db->get();
            $skillList = $query_files->result();
            // Added by Armen end
            $data = array('js' => array('vendor/jquery.form.js', 'internal/job_create.js'),
                'skillList' => $skillList);
            $this->Admintheme->webview("jobs/create_job", $data);
        }
        if ($this->input->post('title')) {

            if (isset($_FILES['userfile']['name']) && ($_FILES['userfile']['name'] != '')) {
                $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
                $newFileName = time() . rand(0000, 9999) . $this->session->userdata('id') . '.' . $ext;
                $source = $_FILES['userfile']['tmp_name'];
                $dest = './uploads/' . $newFileName;
                if (move_uploaded_file($source, $dest)) {
                    $dbPath = '/uploads/' . $newFileName;
                } else {
                    $rs = array('code' => '0', 'msg' => '<div class="alert alert-danger">
  <strong>Error!</strong> Error in uploading file.
</div>');
                    echo json_encode($rs);
                    die;
                }
            }
            if ($this->input->post('submitbtn') == '0') {
                $data = $this->input->post();
                if (isset($dbPath))
                    $data['userfile'] = $dbPath;
                $data['user_id'] = $this->session->userdata('id');
                $this->session->set_userdata('preview', $data);
                $rs = array('code' => '1', 'id' => '0');
                echo json_encode($rs);
            }
            else {

                //save
                $data = $this->input->post();
                $skills = $this->input->post('skills');

                $skillNames = '';
                if (isset($dbPath))
                    $data['userfile'] = $dbPath;
                $data['user_id'] = $this->session->userdata('id');
                $data['skills'] = $skillNames;
                $data['job_created'] = $data['created'];

                unset($data['submitbtn']);
                if ($this->db->insert('jobs', $data)) {
                    $insert_id = $this->db->insert_id();
                    // Added by Armen start
                    foreach ($skills as $key => $value) {
                        $this->db->insert('job_skills',array(
                            'job_id' => $insert_id,
                            'skill_name' => $value
                        ));
                        $ticketMessageID = $this->db->insert_id();
                    }
                    // Added by Armen End
                    $rs = array('code' => '0', 'id' => base64_encode($insert_id), 'type' => $data['job_type']);
                    echo json_encode($rs);
                } else {
                    $rs = array('code' => '0', 'msg' => '<div class="alert alert-danger">
  <strong>Error!</strong> Error occured.Try again.
</div>');
                    echo json_encode($rs);
                }
            }
            die();
        }
    }

    public function savePostSession() {

        $data = $this->session->userdata('preview');
        unset($data['submitbtn']);
        if ($this->input->post('submitbtn')) {
            if ($this->db->insert('jobs', $data)) {
                $insert_id = $this->db->insert_id();
                redirect("/jobs/view_" . $data['job_type'] . "/" . base64_encode($insert_id));
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function find($url_rewrite = null) {

        $url_rewrite = substr($url_rewrite, 1, -1);
        $this->db->select('*');
        $this->db->from('job_subcategories');
        $this->db->where('url_rewrite', "mobile-development");
        $query = $this->db->get();
        $result = $query->row();

        if ($result != null) {
            $offsetId = $result->subcat_id;
        } else {
            $offsetId = $url_rewrite;
        }

        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 2) {
                redirect(site_url("jobs-home"));
            }

            $id = $this->session->userdata(USER_ID);
            $jobCat = $this->uri->segment(2);

            $jobCatPage = false;
            //get users job category//

            $user_categories = $this->Category->get_user_subcategories($this->session->userdata('id'));
            
            if (sizeof($user_categories) > 0) {
                $sql = "";
                foreach ($user_categories as $sub) {
                    $sql .= $sub->subcat_id . ",";
                }
                $sql = substr($sql, 0, strlen($sql) - 1);
                $sqlIn = " AND subcat_id IN ( " . $sql . " ) ";
                $subCateList = $this->Common_mod->get(SUBCATEGORY_TABLE, null, $sqlIn);
            }

            $limit = 10;
            $records = array();
         
            $this->db->join('webuser', 'webuser.webuser_id=jobs.user_id', 'left');
            $this->db->order_by("jobs.id", "desc");

            if ($this->input->is_ajax_request()) {
                //die("limit is 10");
                $category = array();
                $jobCat = $this->input->post('jobCat');

                $jobType = $this->input->post('jobtype');
                $jobDuration = $this->input->post('jobduratin');
                $jobHours = $this->input->post('jobweekhour');

                $offsetId = $this->input->post('limit');
                $keywords = $this->input->post('keywords');
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
                // var_dump($catIds);
                // var_dump($category);
                if (!empty($jobType)) {
                    $jobType = explode(",", $jobType);
                    foreach ($jobType as $type) {
                        //$jobType[] = $type;
                        $this->db->or_where('jobs.job_type', $type);
                    }
                }
                if (!empty($jobDuration)) {
                    $jobDuration = explode(",", $jobDuration);
                    foreach ($jobDuration as $duretion) {
                        //$jobDuration[] = $duretion;
                        $this->db->or_where('jobs.job_duration', $duretion);
                    }
                }
                if (!empty($jobHours)) {

                    $jobHours = explode(",", $jobHours);
                    foreach ($jobHours as $hour) {
                        ///   $jobHours[] = $hour;
                        $this->db->or_where('jobs.hours_per_week', $hour);
                    }
                }

                $val = array(
                    '1' => '1',
                        //  'status' => 1
                );
                $offset = $limit * $offsetId;
                $keywords = $this->input->post('keywords');



                if (empty($category)) {

                    if ($sql != "" && strlen($sql) >= 1) {
                        if ($this->session->userdata('type') == '2') {
                            $val = array(
                                '1' => '1',
                                'status' => 1
                            );
                            $this->db->where_in('jobs.category', $sql, FALSE);
                            if (strlen($keywords) > 0) {
                                $this->db->like("jobs.title", $keywords);
                                $this->db->or_like("jobs.job_description", $keywords);
                            }
                            $query = $this->db->get_where('jobs', $val, $limit, $offset);

                            // Davit start
                            $jobTypeQuery = '';
                            if (!empty($jobType)) {
                                $jobTypeQuery = implode(',', array_map(function($arr){
                                    return "'" . $arr . "'";
                                }, $jobType));

                                $jobTypeQuery = ' AND (jobs.job_type IN (' . $jobTypeQuery . '))';

                            }
                            $query = $this->db->query("SELECT * FROM jobs LEFT JOIN webuser ON webuser.webuser_id=jobs.user_id WHERE jobs.category in(" . $sql . ") AND (jobs.title like '%" . $keywords . "%' OR jobs.job_description like '%" . $keywords . "%') {$jobTypeQuery} LIMIT " . $offset . ',' . $limit);
                            // Davit end

                            //   var_dump($keywords);die();
                        } else if ($this->session->userdata('type') == '1') {
                            $val = array(
                                'user_id' => $id,
                                'status' => 1
                            );
                            $query = $this->db->get_where('jobs', $val, $limit, $offset);
                        }
                    }
                } else {

//                    $this->db->where_in('jobs.category', $sql, FALSE);
//                    if (strlen($keywords) > 0) {
//                        var_dump($keywords);die();
//                        $this->db->like("jobs.title", $keywords);
//                       $this->db->or_like("jobs.job_description", $keywords);
//                    }
//
//                  //  $this->db->where_in('jobs.category', $category);
//                    $query = $this->db->get_where('jobs', $val, $limit, $offset);
//
                    // Davit start
                    $jobTypeQuery = '';
                    if (!empty($jobType)) {
                        $jobTypeQuery = implode(',', array_map(function($arr){
                            return "'" . $arr . "'";
                        }, $jobType));

                        $jobTypeQuery = ' AND (jobs.job_type IN (' . $jobTypeQuery . '))';

                    }

                    $query = $this->db->query("SELECT * FROM jobs LEFT JOIN webuser ON webuser.webuser_id=jobs.user_id WHERE jobs.category in(" . implode(',', $category) . ") AND (jobs.title like '%" . $keywords . "%' OR jobs.job_description like '%" . $keywords . "%') {$jobTypeQuery} LIMIT " . $offset . ',' . $limit);
                    // Davit end
                }


                if ($query->num_rows() > 0 && is_object($query)){

                    $records = $query->result();
                    $s=array();
                    foreach ($records as $record) {
                        $q="SELECT job_skills.skill_name from job_skills where job_skills.job_id ='";
                        $q.=$record->id."'";
                        $skills = $this->db->query($q)->result();
                        if(!empty($skills)){
                            foreach($skills as $skill){
                                array_push($s,$skill->skill_name);
                            }
                        }
                        else{
                            continue;
                        }
                        $record->skills=$s;
                        $s=[];
                        }
                
                }

                $data = array('records' => $records, 'limit' => $limit);
                // Davit start
                //$this->load->view('webview/jobs/content', $data);
                $content = $this->load->view('webview/jobs/content', $data, true);
                die (json_encode([
                    'result' => $content,
                    'count' => count($records)
                ]));
                // Davit end
            } else {

                $offset = 0;
                if (intval($jobCat) > 0) {
                    $val = array(
                        'category' => $jobCat,
                        'status' => 1
                    );
                    $jobCatPage = true;
                    $query = $this->db->get_where('jobs', $val, $limit, $offset);
                } else {
                    $keywords = "";
                    if (!empty($_POST)) {
                        $keywords = $this->input->post("jobsearchbykeywords");
                    }

                    if (isset($sql) && $sql != "" && strlen($sql) >= 1) {

                        if ($this->session->userdata('type') == '2') {
                            $val = array(
                                '1' => '1',
                                'status' => 1
                            );
                            if (strlen($keywords) > 0) {
                                //   die("dkkd");

                                $jobCatPage = true;
                                $this->db->like("jobs.title", $keywords);
                                //$data['totalJobFound'] = $this->db->count_all_results();
                            } else {
                                $this->db->where_in('jobs.category', $sql, FALSE);
                            }
                            $query = $this->db->get_where('jobs', $val, $limit, $offset);
                        } else if ($this->session->userdata('type') == '1') {
                            $val = array(
                                'user_id' => $id,
                                'status' => 1
                            );
                            $query = $this->db->get_where('jobs', $val, $limit, $offset);
                        }
                    } else {
                        $query = "";
                    }
                }
                if (is_object($query) && $query->num_rows() > 0) {
                    $records = $query->result();
                    $s=array();
                    foreach ($records as $record) {
                        $q="SELECT job_skills.skill_name from job_skills where job_skills.job_id ='";
                        $q.=$record->id."'";
                        $skills = $this->db->query($q)->result();
                        if(!empty($skills)){
                            foreach($skills as $skill){
                                array_push($s,$skill->skill_name);
                            }
                        }
                        else{
                            continue;
                        }
                        $record->skills=$s;
			$s=[];
                    }
                } else {
                    $records = null;
                }
                $user_id = $this->session->userdata('id');
                $this->db->select('*');
                $this->db->from('job_bids');
                $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
                $this->db->join('job_conversation', 'job_conversation.job_id=jobs.id', 'inner');
                $this->db->where('job_bids.user_id', $user_id);
                $this->db->where('job_bids.status', 0);
                // added by jahid start 
                $this->db->where('job_bids.job_progres_status', 1);
                $this->db->where(array('job_bids.withdrawn' => NULL));  
                // added by jahid end 
                $this->db->where('jobs.status', 1);
                $this->db->where('job_bids.bid_reject', 0);
                $this->db->group_by('job_conversation.job_id');
                $query = $this->db->get();
                if (is_object($query)) {
                    $intervier_no = $query->num_rows();
                } else {
                    $intervier_no = null;
                }

                //$record = $query->result();
                $this->db->select('*');
                $this->db->from('job_bids');
                $this->db->where('job_bids.user_id', $user_id);
                $this->db->where('job_bids.status', 0);
                // added by jahid start 
                $this->db->where('job_bids.job_progres_status', 0);
                $this->db->where(array('job_bids.withdrawn' => NULL));                
                // added by jahid end 
                
                $this->db->group_by('job_bids.id');
                $query_proposal = $this->db->get();
                
                if (is_object($query)) {
                    $proposal_no = $query_proposal->num_rows();
                } else {
                    $proposal_no = null;
                }


                $profilecompleteness = array();
                $pcompleteness = 0;
                //progress for image
                $this->db->select('*');
                $this->db->from('webuser');
                $this->db->where('webuser.webuser_id', $id);
                $this->db->where('webuser.webuser_picture !=', "");
                $query_ing = $this->db->get();
                $checkimage = $query_ing->row();
                //$this->db->last_query();
                if (!empty($checkimage)) {
                    $pcompleteness += 10;
                    $profilecompleteness['addpicture'] = 1;
                } else {
                    $profilecompleteness['addpicture'] = 0;
                    $pcompleteness += 0;
                }

                //progress for category
                $this->db->select('*');
                $this->db->from('user_categories');
                $this->db->where('user_categories.user_id', $id);
                $query_category = $this->db->get();
                $checkcat = $query_category->row();
                if (!empty($checkcat)) {
                    $pcompleteness += 25;
                    $profilecompleteness['addcat'] = 1;
                } else {
                    $pcompleteness += 0;
                    $profilecompleteness['addcat'] = 0;
                }

                //progress for portfolio
                $this->db->select('*');
                $this->db->from('webuser_portfolio');
                $this->db->where('webuser_portfolio.webuser_id', $id);
                $this->db->where('webuser_portfolio.project_url !=', "");
                $query_port = $this->db->get();
                $checkport = $query_port->row();
                if (!empty($checkport)) {
                    $pcompleteness += 25;
                    $profilecompleteness['addportfolio'] = 1;
                } else {
                    $pcompleteness += 0;
                    $profilecompleteness['addportfolio'] = 0;
                }

                //progress for Experience
                $this->db->select('*');
                $this->db->from('user_experience');
                $this->db->where('user_experience.user_id', $id);
                $query_exp = $this->db->get();
                $checkexp = $query_exp->row();
                if (!empty($checkexp)) {
                    $pcompleteness += 25;
                    $profilecompleteness['addexp'] = 1;
                } else {
                    $pcompleteness += 0;
                    $profilecompleteness['addexp'] = 0;
                }

                //progress for Eaducation
                $this->db->select('*');
                $this->db->from('freelancer_education');
                $this->db->where('freelancer_education.fuser_id', $id);
                $this->db->where('freelancer_education.degree !=', "");
                $query_exp = $this->db->get();
                $checkexp = $query_exp->row();
                if (!empty($checkexp)) {
                    $pcompleteness += 15;
                    $profilecompleteness['addedu'] = 1;
                } else {
                    $pcompleteness += 0;
                    $profilecompleteness['addedu'] = 0;
                }
                $profilecompleteness['profileprogress'] = $pcompleteness;


                $this->db->select('*');
                $this->db->from('webuser');
                $this->db->where('webuser.webuser_id', $id);
                $query_status = $this->db->get();
                $ststus = $query_status->row();


                $data = array('js' => array('internal/find_job.js'), 'records' => $records, 'limit' => $limit, 'no_of_interview' => $intervier_no, 'proposal_no' => $proposal_no, 'profilecompleteness' => $profilecompleteness, 'ststus' => $ststus);

                if (isset($subCateList) && !empty($subCateList)) {
                    $data['subCateList'] = $subCateList['rows'];
                } else {
                    $data['subCateList'] = "";
                }
                $data['jobCatSelected'] = $jobCat;

                // Davit start
                $this->db->select('id');
                $monthStart = date('Y-m-01');
                $monthEnd = date('Y-m-t');
                $this->db->where("(created BETWEEN '{$monthStart}' AND '{$monthEnd}')");
                $query = $this->db->get_where('job_bids', array('job_bids.user_id' => $id));
                $proposals = $query->num_rows();
                $data['proposals'] = $proposals;

                $sql = "SELECT cropped_image FROM webuser WHERE webuser_id =  " . $this->session->userdata(USER_ID);
                $croppedImage =    $this->db->query($sql)->row();
                $data['croppedImage'] = $croppedImage;
                // Davit end
                if ($jobCatPage) {

                    if ((isset($keywords)) && (strlen($keywords) > 0)) {
                        $data['searchKeyword'] = $keywords;
                        $data['checkAll'] = true;
                    } else {
                        $data['checkAll'] = false;
                    }

                    $this->Admintheme->webview("jobs/category-jobs", $data);
                } else {
                    $this->Admintheme->webview("jobs/find-jobs", $data);
                }
            }
        } else {
            redirect(site_url("signin"));
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

    public function preview_fixed() {
        if ($this->Adminlogincheck->checkx() && $this->session->userdata('preview')) {
            $data = array('data' => $this->session->userdata('preview'));
            $this->Admintheme->webview("jobs/job_preview_fixed", $data);
        }
    }

    public function preview_hourly() {
        if ($this->Adminlogincheck->checkx() && $this->session->userdata('preview')) {
            $data = array('data' => $this->session->userdata('preview'));
            $this->Admintheme->webview("jobs/job_preview_hourly", $data);
        }
    }

    public function status() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }

            $id = $this->session->userdata('id');
            $this->db->join('webuser', 'webuser.webuser_id=jobs.user_id', 'left');
            $this->db->order_by("jobs.id", "desc");
            $query = $this->db->get_where('jobs', array('user_id' => $id, 'status' => 1));
            $records = $query->result();

            $this->db->select('*');
            $this->db->from('webuser');
            $this->db->where('webuser.webuser_id', $id);
            $query_status = $this->db->get();
            $ststus = $query_status->row();

            $data = array('records' => $records, 'ststus' => $ststus);
            $this->Admintheme->webview("jobs/job_status", $data);
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

    public function view($title = null, $postId = null) {
        if ($this->Adminlogincheck->checkx()) {
            $postId = base64_decode($postId);
            $id = $this->session->userdata('id');


//            $this->db->join('webuser', 'webuser.webuser_id=jobs.user_id', 'left');
//            $this->db->order_by("jobs.id", "desc");
//            $query = $this->db->get_where('jobs', array('id' => $postId));
//            $record = $query->row();

            $this->db->select('*');
            $this->db->from('webuser w');
            $this->db->join('jobs j', 'j.user_id=w.webuser_id', 'left');
            $this->db->where('j.id', $postId);
            $this->db->order_by('j.id', 'asc');
            $query = $this->db->get();
            $record = $query->row();
            
            $this->db->select("skill_name");
            $this->db->from("job_skills");
            $this->db->where("job_id = ", $postId);
            $query = $this->db->get();
            $job_skills = $query->result_array();
            $record->job_skills = $job_skills;

            $query = $this->db->get_where('job_bids', array('job_id' => $postId, 'user_id' => $id, 'status!=1' => null));
            $bids_details = $query->row();
            $is_applied = $query->num_rows();


            //conversation
            $conversation_count = 0;
            $conversation = array();

            if ($is_applied) {
                $this->db->select('*');
                $this->db->from('job_conversation');
                $this->db->where('job_conversation.receiver_id', $id);
                $this->db->where('job_conversation.job_id', $postId);
                $this->db->where('job_conversation.bid_id', $bids_details->id);

                $query = $this->db->get(); // assign to a variable
                $conversation_count = $query->num_rows(); // then use num rows



                if ($conversation_count) {

                    $this->db->select('job_conversation.*,webuser.*');
                    $this->db->from('job_conversation');
                    $this->db->join('webuser', 'job_conversation.sender_id = webuser.webuser_id', 'inner');
                    $this->db->where('job_conversation.job_id', $postId);
                    $this->db->where('job_conversation.bid_id', $bids_details->id);
                    $this->db->order_by("job_conversation.id", "ASC");
                    $query_conversation = $this->db->get();
                    $conversation = $query_conversation->result();
                }
            }


            $this->db->select('*,job_bids.id as bid_id,job_bids.status AS bid_status,jobs.job_duration AS jobduration,job_bids.created AS bid_created');
            $this->db->from('job_accepted');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'inner');
            $this->db->where('job_accepted.buser_id', $record->user_id);
            $query = $this->db->get();
            $accepted_jobs = $query->result();

            $this->db->select('*');
            $this->db->from('jobs');
            $this->db->where('user_id', $record->user_id);
            $query_sidebar = $this->db->get();
            $record_sidebar = $query_sidebar->result();

            $jobids = array();
            foreach ($record_sidebar as $jobs) {
                $jobids[] = $jobs->id;
            }
            $jobids = implode(",", $jobids);


            $this->db->select('*');
            $this->db->from('job_bids');
            $this->db->where_in('job_id', $jobids);
            $this->db->where('hired', 1);
            $query_hire = $this->db->get();
            $record_hire = $query_hire->result();

            $this->db->select('*');
            $this->db->from('job_workdairy');
            $this->db->where_in('cuser_id', $record->user_id);
            $queryhour = $this->db->get();
            $workedhours = $queryhour->result();

            $this->db->select('*');
            $this->db->from('webuser');
            $this->db->where('webuser.webuser_id', $id);
            $query_status = $this->db->get();
            $ststus = $query_status->row();

            // Davit start
            $this->db->select('id');
            $monthStart = date('Y-m-01');
            $monthEnd = date('Y-m-t');
            $this->db->where("(created BETWEEN '{$monthStart}' AND '{$monthEnd}')");
            $query = $this->db->get_where('job_bids', array('job_bids.user_id' => $id));
            $proposals = $query->num_rows();

            $data = array('value' => $record, 'proposals' => $proposals, 'applied' => $is_applied, 'conversations' => $conversation, 'conversation_count' => $conversation_count, 'bid_details' => $bids_details, 'accepted_jobs' => $accepted_jobs, 'record_sidebar' => $record_sidebar, 'hire' => $record_hire, 'workedhours' => $workedhours, 'ststus' => $ststus);
            // Davit end
            $this->Admintheme->webview("jobs/view", $data);
        }
    }

    public function apply($title = null, $postId = null) {
        if ($this->Adminlogincheck->checkx()) {
            $id = $this->session->userdata('id');
            

            // Davit start
            $this->db->select('id');
            $monthStart = date('Y-m-01');
            $monthEnd = date('Y-m-t');
            $this->db->where("(created BETWEEN '{$monthStart}' AND '{$monthEnd}')");
            $query = $this->db->get_where('job_bids', array('job_bids.user_id' => $id));
            $proposals = $query->num_rows();
            // Davit end

            if ($this->input->post('job_id')) {

                $check = $this->db->get_where('job_bids', array('job_id' => $this->input->post('job_id'), 'user_id' => $id, 'status!=1' => null));

                // Davit start
                if ($check->num_rows() > 0) {
                    $rs = array('code' => '0', 'msg' => '<div class="alert alert-warning">
                    <strong>Warning!</strong> You have already applied for this job.
                  </div>');
                    echo json_encode($rs);
                    die;
                } elseif ($proposals >= 30) {
                    $rs = array('code' => '0', 'msg' => '<div class="alert alert-warning">
                    <strong>Warning!</strong> You reach your monthly proposals limit.
                  </div>');
                    echo json_encode($rs);
                    die;
                }
                // Davit end
                $data = $this->input->post();

                $data['user_id'] = $this->session->userdata('id');
                $title = $data['job_title'];
                unset($data['job_title']);
                $data['bid_fee'] = round($data['bid_amount'] / 10, 2);
                $data['bid_earning'] = $data['bid_amount'] - $data['bid_fee'];
                //    var_dump($data);die();
                if ($this->db->insert('job_bids', $data)) {
                    $insert_id = $this->db->insert_id();
                    if (isset($_FILES['file']['name']) && (!empty($_FILES['file']['name']))) {
                        for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
                            $ext = pathinfo($_FILES['file']['name'][$i], PATHINFO_EXTENSION);
                            $newFileName = time() . rand(0000, 9999) . $this->session->userdata('id') . '.' . $ext;
                            $source = $_FILES['file']['tmp_name'][$i];
                            $dest = './uploads/' . $newFileName;
                            move_uploaded_file($source, $dest);
                            $dbPath = '/uploads/' . $newFileName;
                            $dataAttach = array('job_bid_id' => $insert_id, 'path' => $dbPath);
                            $this->db->insert('job_bid_attachments', $dataAttach);
                        }
                    }
                    $rs = array('code' => '1', 'msg' => '');
                    $this->session->set_flashdata('msg', 'You have successfully submitted proposal for ' . $title);
                    echo json_encode($rs);
                } else {
                    $rs = array('code' => '0', 'msg' => '<div class="alert alert-warning">
                    <strong>Warning!</strong>Something went wrong.
                  </div>');
                    echo json_encode($rs);
                }
                die;
            }
            $postId = base64_decode($postId);
            //$id = $this->session->userdata('id');
            $this->db->select(array('*', 'jobs.id as job_id'));
            $this->db->join('webuser', 'webuser.webuser_id=jobs.user_id', 'left');
            $this->db->join('webuser_basic_profile', 'webuser_basic_profile.webuser_id=jobs.user_id', 'left');
            $this->db->order_by("jobs.id", "desc");
            $query = $this->db->get_where('jobs', array('jobs.id' => $postId));
            //echo $this->db->last_query();
            $record = $query->row();
            // Davit start
            $data = array('value' => $record, 'proposals' => $proposals, 'js' => array('dropzone.js', 'vendor/jquery.form.js', 'internal/job_apply.js'));
            // Davit end
            $this->Admintheme->webview("jobs/apply", $data);
        }
    }

    public function bids_list() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 2) {
                redirect(site_url("jobs-home"));
            }
            $records = array();

            $id = $this->session->userdata('id');
            $this->db->select(array('job_bids.*', 'jobs.title', 'jobs.user_id as client_id', '(select webuser_company from webuser where webuser_id=jobs.user_id) as company'));
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'left');
            $this->db->where('job_bids.status', 0);
            $this->db->where('job_bids.bid_reject', 0);
            
            // added by jahid start 
             $this->db->where('job_bids.job_progres_status', 0);
             $this->db->where(array('job_bids.withdrawn' => NULL)); 
             // added by jahid end    
             
            $this->db->order_by("job_bids.id", "desc");
            $query = $this->db->get_where('job_bids', array('job_bids.user_id' => $id));
            if ($query->num_rows() > 0)
                $records = $query->result();

            // Davit start
            $this->db->select('id');
            $monthStart = date('Y-m-01');
            $monthEnd = date('Y-m-t');
            $this->db->where("(created BETWEEN '{$monthStart}' AND '{$monthEnd}')");
            $query = $this->db->get_where('job_bids', array('job_bids.user_id' => $id));

            $proposals = $query->num_rows();
            $data = array('records' => $records, 'proposals' => $proposals, 'title' => 'My Bids - Winjob' );
            // Davit end
            $this->Admintheme->webview("jobs/bids_list", $data);
        }
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
            $this->db->where('job_bids.status', 1);
            
            // added by jahid start 
             $this->db->where('job_bids.job_progres_status', 0);
             $this->db->where(array('job_bids.withdrawn' => 1)); 
             // added by jahid end 
            
            $this->db->order_by("job_bids.id", "desc");
            $query = $this->db->get_where('job_bids', array('job_bids.user_id' => $id));
            if ($query->num_rows() > 0)
                $records1 = $query->result();

            $id = $this->session->userdata('id');
            $this->db->select(array('job_bids.*', 'jobs.title', 'jobs.user_id as client_id', '(select webuser_company from webuser where webuser_id=jobs.user_id) as company'));
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'left');
            $this->db->where('job_bids.bid_reject', 1);
            
             // added by jahid start 
             $this->db->where('job_bids.job_progres_status', 0);
             $this->db->where(array('job_bids.withdrawn' => 1)); 
             // added by jahid end 
            
            $this->db->order_by("job_bids.id", "desc");
            $query = $this->db->get_where('job_bids', array('job_bids.user_id' => $id));
            if ($query->num_rows() > 0)
                $records2 = $query->result();
            $records = array_merge($records1, $records2);
            $data = array('records' => $records, 'title' => 'Archived Jobs - Winjob');
            $this->Admintheme->webview("jobs/archived_bids_list", $data);
        }
    }

    public function edit($postId = null) {
        if ($this->Adminlogincheck->checkx() && $this->session->userdata('type') == '1') {
            if ($this->input->post('title')) {
                if (isset($_FILES['userfile']['name']) && ($_FILES['userfile']['name'] != '')) {
                    $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
                    $newFileName = time() . rand(0000, 9999) . $this->session->userdata('id') . '.' . $ext;
                    $source = $_FILES['userfile']['tmp_name'];
                    $dest = './uploads/' . $newFileName;
                    if (move_uploaded_file($source, $dest)) {
                        $dbPath = '/uploads/' . $newFileName;
                        @unlink('/uploads/' . $this->input->post('oldUserFile'));
                    } else {
                        $rs = array('code' => '0', 'msg' => '<div class="alert alert-danger">
                              <strong>Error!</strong> Error in uploading file.
                            </div>');
                        echo json_encode($rs);
                        die;
                    }
                }

                //save
                $data = $this->input->post();
                unset($data['userfile']);
                if (isset($dbPath))
                    $data['userfile'] = $dbPath;
                $data['user_id'] = $this->session->userdata('id');
                unset($data['oldUserFile']);
                if ($data['job_type'] == 'hourly') {
                    unset($data['budget']);
                } else {
                    unset($data['hours_per_week']);
                }
                // Added by Armen start
                // update skills
                $this->db->where('job_id', $this->input->post('id'));
                $this->db->delete('job_skills');
                $skills = array();
                $skills['job_id'] = $this->input->post('id');
                foreach ($data['skills'] as $key => $value) {
                    $skills['skill_name'] = $value;
                    $this->db->insert('job_skills', $skills);
                }

                // Added by Armen end
                $data['skills'] = "";
                $this->db->where('id', $this->input->post('id'));
                if ($this->db->update('jobs', $data)) {
                    $rs = array('code' => '1', 'type' => $data['job_type']);
                    $this->session->set_flashdata('msg', $data['title'] . ' has been updated');
                    echo json_encode($rs);
                } else {
                    $rs = array('code' => '0', 'msg' => '<div class="alert alert-danger">
                      <strong>Error!</strong> Error occured.Try again.
                    </div>');
                    echo json_encode($rs);
                }
                die;
            }
            $postId = base64_decode($postId);
            $id = $this->session->userdata('id');
            $this->db->join('webuser', 'webuser.webuser_id=jobs.user_id', 'left');
            $this->db->order_by("jobs.id", "desc");
            $query = $this->db->get_where('jobs', array('user_id' => $id, 'id' => $postId));
            $record = $query->row();
           
            // Added by Armen start
            // Get job skills
            $this->db->select("skill_name");
            $this->db->from("job_skills");
            $this->db->where("job_id = ", $record->id);
            $query = $this->db->get();
            $job_skills = $query->result_array();

            // Get all skills
            $this->db->select("skill_name");
            $this->db->from("skills");
            $query_files = $this->db->get();
            $skillList = $query_files->result();
            $repeated = array();
            foreach ($skillList as $key => $value) {
                foreach ($job_skills as $index => $skill) {
                    if($value->skill_name == $skill['skill_name']){
                        array_push($repeated,$value->skill_name);
                    }
                }
            }
            // Added by Armen end
            $data = array('repeated' => $repeated,'job_skills' => $job_skills,'value' => $record, 'js' => array('vendor/jquery.form.js', 'internal/job_edit.js'),'skillList' => $skillList);
            $this->Admintheme->webview("jobs/edit", $data);
        }
    }

    public function browse() {
        if ($this->Adminlogincheck->checkx()) {
            $data = [];
            $this->Admintheme->webview("jobs/browse", $data);
        }
    }
        
    private function authorized(){
        if ( ! $this->Adminlogincheck->checkx() )
           redirect(home_url());  
    }
    
    // added by (Donfack Zeufack Hermann) start 
    // Merge code of {fixed|hourly}_{client|freelancer}_view
    
    
    private function _client_fixed_contract($job_status, $sender_id, $user_id, $ststus){
        
        $this->load->model('payment_model');
        $payments   = $this->payment_model->load_job_transactions($sender_id, $user_id, $job_id); 
        $this->twig->display('webview/jobs/twig/contract', compact('job_status', 'ststus', 'payments'));
    
    }
    
    private function _client_hourly_contract($job_status, $ststus){
        $this->Admintheme->webview("jobs/hourly_client_view", array('job_status' => $job_status, 'ststus' => $ststus));
    }
    
    private function _client_contracts(){
        try{
            $this->load->model(array('jobs_model', 'webuser_model'));
        }catch(RuntimeException $e){
            log_message('debug', $e->getMessage());
            $this->session->set_flashdata('error', $this->lang->item('text_app_runtime_exception_message'));
            redirect(home_url());
        }
        
        list($job_id, $sender_id, $user_id) = $this->prepare_client_data();  
        $job_status = $this->jobs_model->load_job_status($sender_id, $user_id, $job_id);
        
        if($job_status->job_type == "hourly"){
            $ststus     = $this->webuser_model->load_informations($job_status->buser_id);
            return $this->_client_hourly_contract($job_status, $ststus);
        }else{
            $ststus     = $this->webuser_model->load_informations($sender_id);
            return $this->_client_fixed_contract($job_status, $sender_id, $user_id, $ststus);
        }    
    }
    
    
    private function _freelancer_hourly_contract( $job_status, $ststus ){
        $this->Admintheme->webview("jobs/hourly_freelancer_view", array('job_status' => $job_status, 'ststus' => $ststus));
    }
    
    private function _freelancer_fixed_contract($job_status, $job_id, $user_id, $ststus){
        $payments   = $this->payment_model->load_job_transactions($job_status->buser_id, $user_id, $job_id); 
        $this->Admintheme->webview("jobs/fixed_freelancer_view", compact('job_status', 'ststus', 'payments'));
    }
    
    private function _freelancer_contracts(){
        
        try{
            $this->load->model(array('jobs_model', 'webuser_model', 'payment_model'));
        }catch(RuntimeException $e){
            log_message('debug', $e->getMessage());
            redirect(site_url("find-jobs"));
        }
        list($job_id, $user_id) = $this->prepare_fixed_freelancer_data();
        $job_status = $this->jobs_model->load_job_status(null, $user_id, $job_id);
        
        
        if($job_status->job_type == 'hourly'){
            $ststus = $this->webuser_model->load_informations($job_status->buser_id);
            $this->_freelancer_hourly_contract($job_status, $ststus);
        }else{
            $ststus  = $this->webuser_model->load_informations($job_status->buser_id);
            $this->_freelancer_fixed_contract($job_status, $job_id, $user_id, $ststus);
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
        
        if ($this->session->userdata('type') == 1) {
            return $this->_client_contracts();
        }elseif($this->session->userdata('type') == 2) {
            return $this->_freelancer_contracts();
        }else{
            redirect( home_url() );
        }
        
    }
    
    // added by (Donfack Zeufack Hermann) end
    
    
   // added by (Donfack Zeufack Hermann) start 
   // private function to sanitize $_GET fixed client view datas
    private function prepare_client_data(){
        
        $fm_job    = $this->input->get('fmJob');
        $fuser     = $this->input->get('fuser');

        if(empty($fm_job) || empty($fuser)){
            //TODO: set a message here to explain redirection.
            redirect(site_url('jobs/mystaff'));
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

            $jobId = base64_decode($jobId);

            $sender_id = $this->session->userdata(USER_ID);
            $this->db->select('*');
            $this->db->from('job_conversation');
            $this->db->join('job_bids', 'job_conversation.bid_id=job_bids.id', 'inner');
            $this->db->where('job_conversation.sender_id', $sender_id);
            $this->db->where('job_conversation.job_id', $jobId);
            $this->db->where('job_bids.bid_reject', 0);
            
              // added by jahid start 
             $this->db->where('job_bids.job_progres_status', 1);
             $this->db->where(array('job_bids.withdrawn' => NULL)); 
             // added by jahid end 
            
            $this->db->group_by('job_conversation.bid_id');
            $query = $this->db->get();
            $conversation_count = $query->num_rows();
            //  echo $this->db->last_query();

            $records = array();
            $this->db->join('webuser', 'webuser.webuser_id=job_bids.user_id', 'left');
            $this->db->order_by("job_bids.id", "desc");
             // added by jahid start 
             $this->db->where('job_bids.job_progres_status', 0);
             $this->db->where(array('job_bids.withdrawn' => NULL)); 
             // added by jahid end 
            $query = $this->db->get_where('job_bids', array('job_id' => $jobId, 'bid_reject' => 0, 'status!=1' => null));
                         
            if ($query->num_rows() > 0)
                $records = $query->result();            
            $this->db->where('id', $jobId);
            $q = $this->db->get('jobs');
            $jobDetails = $q->row();



            //Offer count
            $this->db->select('*');
            $this->db->from('job_bids');
            $this->db->where(array('job_id' => $jobId, 'hired' => '1'));
            
              // added by jahid start 
             $this->db->where('job_progres_status', 2);
             $this->db->where(array('withdrawn' => NULL)); 
             // added by jahid end 
            
            $query_totaloffer = $this->db->get();
            $Offer_count = $query_totaloffer->num_rows();

            //hire

            $this->db->select('*');
            $this->db->from('job_accepted');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->where('job_accepted.buser_id', $sender_id);
            $this->db->where('job_accepted.job_id', $jobId);
            $this->db->where('job_bids.jobstatus', '0');
                          // added by jahid start 
             $this->db->where('job_bids.job_progres_status', 3);
             $this->db->where(array('job_bids.withdrawn' => NULL)); 
             // added by jahid end 
            $query = $this->db->get();
            $hire_count = $query->num_rows();

            // reject count
            $this->db->select('*');
            $this->db->from('job_bids');
             // added by jahid start 
            $this->db->where(array('job_id' => $jobId));  
	    $this->db->where("(withdrawn=1 OR bid_reject=1)", NULL, FALSE); 
             // added by jahid end 
            
            $query_totalreject = $this->db->get();
            $reject_count = $query_totalreject->num_rows();

            $this->db->select('*');
            $this->db->from('webuser');
            $this->db->where('webuser.webuser_id', $sender_id);
            $query_status = $this->db->get();
            $ststus = $query_status->row();


            $data = array('jobId' => $jobId, 'Offer_count' => $Offer_count, 'hire_count' => $hire_count, 'records' => $records, 'jobDetails' => $jobDetails, 'interview_count' => $conversation_count, 'reject_count' => $reject_count, 'ststus' => $ststus);
            $this->Admintheme->webview("jobs/applied", $data);
        }
    }

    public function interviews($jobId = null) {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }

            $jobId = base64_decode($jobId);
            $sender_id = $this->session->userdata(USER_ID);



            $this->db->join('webuser', 'webuser.webuser_id=job_bids.user_id', 'left');
            $this->db->join('job_conversation', 'job_conversation.bid_id=job_bids.id', 'inner');
            $this->db->group_by('job_conversation.bid_id');
            $this->db->order_by("job_bids.id", "desc");
            // added by jahid start 
            $query = $this->db->get_where('job_bids', array('job_bids.job_id' => $jobId, 'bid_reject' => 0, 'job_bids.status!=1' => null,'job_bids.job_progres_status'=>1,'job_bids.withdrawn'=>NULL));
             // added by jahid end 
            //$this->db->last_query();
            $records = $query->result();

            $this->db->select('*');
            $this->db->from('job_conversation');
            $this->db->join('job_bids', 'job_conversation.bid_id=job_bids.id', 'inner');
            $this->db->where('job_conversation.sender_id', $sender_id);
            $this->db->where('job_conversation.job_id', $jobId);
            $this->db->where('job_bids.bid_reject', 0);
                          // added by jahid start 
             $this->db->where('job_bids.job_progres_status', 1);
             $this->db->where(array('job_bids.withdrawn' => NULL)); 
             // added by jahid end 
            $this->db->group_by('job_conversation.bid_id');
            $query = $this->db->get();
            $conversation_count = $query->num_rows();

            $this->db->where('id', $jobId);
            $q = $this->db->get('jobs');
            $jobDetails = $q->row();

            // total number of job
            $this->db->select('*');
            $this->db->from('job_bids');
                          // added by jahid start  
             // added by jahid end 
              $this->db->where(array('job_id' => $jobId, 'bid_reject' => 0, 'status!=1' => null,'job_progres_status'=>0,'withdrawn'=>NULL));
            $query_totalApplication = $this->db->get();
            $Application_count = $query_totalApplication->num_rows();
            //echo $Application_count; exit;

            //Offer count
            $this->db->select('*');
            $this->db->from('job_bids');
              // added by jahid start 
             $this->db->where('job_bids.job_progres_status', 2);
             $this->db->where(array('job_bids.withdrawn' => NULL)); 
             // added by jahid end 
            $this->db->where(array('job_id' => $jobId, 'hired' => '1'));
            $query_totaloffer = $this->db->get();
            $Offer_count = $query_totaloffer->num_rows();

            //hire
            $this->db->select('*');
            $this->db->from('job_accepted');
            $this->db->join('job_bids', 'job_bids.id=job_accepted.bid_id', 'inner');
            $this->db->where('job_accepted.buser_id', $sender_id);
            $this->db->where('job_accepted.job_id', $jobId);
            $this->db->where('job_bids.jobstatus', '0');
                          // added by jahid start 
             $this->db->where('job_bids.job_progres_status', 3);
             $this->db->where(array('job_bids.withdrawn' => NULL)); 
             // added by jahid end 
            $query = $this->db->get();
            $hire_count = $query->num_rows();


            // reject count
            $this->db->select('*');
            $this->db->from('job_bids');
            // added by Jahid start 
            $this->db->where(array('job_id' => $jobId));
             $this->db->where("(job_bids.withdrawn=1 OR job_bids.bid_reject=1)", NULL, FALSE);
             // added by Jahid end 
            $query_totalreject = $this->db->get();
            $reject_count = $query_totalreject->num_rows();

            $this->db->select('*');
            $this->db->from('webuser');
            $this->db->where('webuser.webuser_id', $sender_id);
            $query_status = $this->db->get();
            $ststus = $query_status->row();



            $data = array('jobId' => $jobId, 'records' => $records, 'jobDetails' => $jobDetails, 'interview_count' => $conversation_count, 'hire_count' => $hire_count, 'Application_count' => $Application_count, 'Offer_count' => $Offer_count, 'reject_count' => $reject_count, 'ststus' => $ststus);
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

            $data = array('job_details' => $job_details, 'offerduser_details' => $offerduser_details, 'user_details' => $user_details);
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
    
    
    private function extrat_all_job_ids( $jobs ){
        $job_ids = array();
        foreach( $jobs as $job){
            $job_ids[] = $job->job_id;
        }
        return $job_ids; 
    }

    public function mystaff() {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 1) {
                redirect(site_url("find-jobs"));
            }
            
            // added by (Donfack Zeufack Hermann) start 
            
            // load models
            try{
                $this->load->model(array('jobs_model'));
            }catch(RuntimeException $e){
                log_message('debug', $e->getMessage());
                $this->session->set_flashdata('error', $this->lang->item('text_job_runtime_exception_message'));
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
            
            $nb_offer            = $this->jobs_model->number_offer();
            $nb_past_hired       = $this->jobs_model->number_past_hired();
            
            $this->twig->display('webview/jobs/twig/my-staff', compact('nb_freelancer_hired', 'jobs_accepted', 'freelancer_job_hour', 'nb_offer', 'past_hired'));
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



            $data = array('all_data' => $result, 'offer_count' => $offer_count, 'past_hire' => $past_hire);
            $this->Admintheme->webview("jobs/active-contracts", $data);
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
            $this->Admintheme->webview("jobs/ended-contracts", $data);
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

                    redirect(site_url('Active_interview'));
                }

                redirect(site_url('jobs-home'));
            }
            $this->Admintheme->webview("jobs/send_invitation", $data);
        }
    }

    public function withdraw_system($bidId = null) {
        if ($this->Adminlogincheck->checkx()) {
            if ($this->session->userdata('type') != 2) {
                redirect(site_url("jobs-home"));
            }
            if ($this->input->post('proposal')) {
                $data = array();
                $data['bid_amount'] = $this->input->post('bid_amount');
                $bidId = $this->input->post('bid_id');
                $data['bid_fee'] = round($data['bid_amount'] / 10, 2);
                $data['bid_earning'] = $data['bid_amount'] - $data['bid_fee'];
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
            if ($this->input->post('withdraw')) {
                $data = array();
                $data['status'] = '1';
                // added by jahid start 
                 $data['withdrawn'] = '1';
                 $data['withdrawn_by'] = '1';
                  // added by jahid end 
                $bidId = $this->input->post('bid_id');
                $this->db->where('id', $bidId);
                if ($this->db->update('job_bids', $data)) {
                    $rs = array('code' => '1', 'modal' => '#myModal', 'amt' => '0', 'msg' => '<div class="alert alert-success">
                    <strong>Success!</strong> You have successfully withdraw with this job.
                  </div>');
                } else {
                    $rs = array('code' => '0', 'msg' => '<div class="alert alert-danger">
                    <strong>Warning!</strong> Something went wrong.
                  </div>');
                }
                echo json_encode($rs);
                die;
            }
            $bidId = base64_decode($bidId);
            $id = $this->session->userdata('id');
            $this->db->select(array('job_bids.*', 'jobs.title', 'jobs.job_type',
                'jobs.budget', 'jobs.hours_per_week', 'jobs.job_duration',
                'jobs.experience_level', 'jobs.skills', 'jobs.job_description', 'jobs.user_id as clientid'));
            $this->db->join('jobs', 'jobs.id=job_bids.job_id', 'left');
            $this->db->order_by("job_bids.id", "desc");
            $query = $this->db->get_where('job_bids', array('job_bids.user_id' => $id, 'job_bids.id' => $bidId));
            if ($query->num_rows() > 0)
                $value = $query->row();
            else
                redirect('/jobs/bids_list');

            $data = array('value' => $value, 'js' => array('vendor/jquery.form.js', 'internal/job_withdraw.js'));
            $this->Admintheme->webview("jobs/withdraw_system", $data);
        }
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
//        parse_str($_POST, $form);
//		print_r($_POST);
//        die;
//
        //die();
        // var_dump($_POST);die();
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
;


                    if ($budget_type == 1) {
                        $data_payment['des'] = 'Full Paid';
                    } elseif ($budget_type == 2) {
                        $data_payment['des'] = 'Milestone';
                    }
                    $data_payment['payment_gross'] = $budget;

                    $this->db->insert('payments', $data_payment);
					
					/* adding data at report end */
					
					
                }
                //updates by haseeburrehman.com ends     
            }
        } else {
             $response['success'] = false;
             $response['message'] = 'Unsuccessfull';
        }


        echo json_encode($response);
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

            $this->db->select('*');
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
            $this->db->where('job_bids.status', 0);
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

            $date = date('Y/m/d');

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
                $sql = "UPDATE  job_bids set status = '1',withdrawn=1,withdrawn_by=1 WHERE job_id ='" . $freelancer_hit_id . "' AND user_id=" . $user_id;
                $this->db->query($sql);
                redirect(site_url('Active_interview'));
            } else {
                $bid_id = $_POST['form'];
                $sql = "UPDATE  job_bids set bid_reject = '1',withdrawn=1,withdrawn_by=2  WHERE id ='" . $bid_id . "'";
                $this->db->query($sql);
            }
         // added by jahid end 
            $response['success'] = true;
            
          
            print_r(json_encode($response));
        }
    }

}
